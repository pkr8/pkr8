<?php
  if(!isset($_GET['mylocation'])&& !isset($_SESSION['username'])) {
    die();
  }
  session_start();
  $mylocation = $_GET['mylocation'];
  $myname = $_SESSION['username'];
  $mydate = $_GET['mydate'];


?>

<?php
  try {
    // Including connection info (including database password) from outside
    // the public HTML directory means it is not exposed by the web server,
    // so it is safer than putting it directly in php code:
    include("pdo-events.php");
    $dbh = dbconnect();
  } catch (PDOException $e) {
    print "Error connecting to the database: " . $e->getMessage() . "<br />";
    die();
  }
  try {
    // One could construct a parameterized query manually as follows,
    // but it is prone to SQL injection attack:
    // $st = $dbh->query("SELECT address FROM Drinker WHERE name='" . $drinker . "'");
    // A much safer method is to use prepared statements:
    if ($mylocation!="All"){
        if ($mydate==null){
          $st = $dbh->prepare("SELECT * FROM DukeEvent WHERE location = ? and eventid IN (SELECT eventid from Attending where netid = ?) ORDER BY 3");
          $st->execute(array($mylocation, $myname));
        }
        else{
          $st = $dbh->prepare("SELECT * FROM DukeEvent WHERE location= ? and  eventid IN (SELECT eventid FROM Attending WHERE netid = ?) and CAST (starttime as DATE) = ? ORDER BY 3");
          $st->execute(array($mylocation, $myname, $mydate));
        }
    }
    else{
          if ($mydate==null){
          $st=$dbh->prepare("SELECT * FROM DukeEvent WHERE eventid in (SELECT eventid from Attending where netid = ?) ORDER BY 3");
          $st->execute(array($myname));
        }
        else{
          $st=$dbh->prepare("SELECT * FROM DukeEvent WHERE eventid in (SELECT eventid from Attending where netid = ?) and CAST(starttime as DATE) = ? ORDER BY 3");
          $st->execute(array($myname, $mydate));
        }
    }


    if (($myrow = $st->fetch())) {
       $outp = "[";
        do {
        if ($outp != "[") {$outp .= ",";}

        $outp .= '{"Name" : "' . $myrow["eventname"] . '",';
        $outp .= '"Time" : "' . $myrow["starttime"] . '",';
        $outp .= '"Location" : "' . $myrow["location"] . '",';
        $outp .= '"Id" : "' . $myrow["eventid"] . '",';
        $outp .= '"Going" : "' . true . '",';
        $outp .= '"HostUrl" : "' . $myRow["hosturl"] . '"}';
        } while ($myrow = $st->fetch());
      // Below we will see the use of a "short open tag" that is equivalent
      // to echoing the enclosed expression.
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
