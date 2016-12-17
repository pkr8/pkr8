<?php
  if  (!isset($_GET['mylocation'])) {
    die();
  }
  session_start();
  $mylocation = $_GET['mylocation'];

  if (!isset($_SESSION['username'])){
     $myuser="";
  }else{
     $myuser=$_SESSION['username'];
  }

?>
<?php
  try {

   include("pdo-events.php");
    $dbh = dbconnect();
  } catch (PDOException $e) {
    print "Error connecting to the database: " . $e->getMessage() . "<br />";
    die();
  }
  try {

    if ($mylocation!="All"){
        $st = $dbh->prepare("SELECT * FROM DukeEvent WHERE Location = ? ORDER BY 3");
        $st->execute(array($mylocation));
    }
    else{
        $st = $dbh->query('SELECT * FROM DukeEvent');
    }


    if (($myrow = $st->fetch())) {
       $outp = "[";
        do {
        $st2 = $dbh->prepare("SELECT * FROM Attending WHERE netid=? and eventid=?");
        $st2->execute(array($myuser, $myrow["eventid"]));
        $isEvent=false;
        if (($myrow2= $st2->fetch())){
          $isEvent=true;
        }
        if ($outp != "[") {$outp .= ",";}
        $outp .= '{"Name" : "' . $myrow["eventname"] . '",';
        $outp .= '"Time" : "' . $myrow["starttime"] . '",';
        $outp .= '"Location" : "' . $myrow["location"] . '",';
        $outp .= '"Id" : "' . $myrow["eventid"] . '",';
        $outp .= '"Going" : "' . $isEvent . '",';
        $outp .= '"HostUrl" : "' . $myRow["hosturl"] . '"}';
        } while ($myrow = $st->fetch());

       $outp.="]";
        echo $outp;
        }
     else{
        echo "[]";
        }
  } catch (PDOException $e) {
    print "Database error: " . $e->getMessage() . "<br />";
    die();
  }
?>

