<?php
if  (!isset($_GET['mygroup'])&& !isset($_GET['mydate'])) {
    die();
  }
  session_start();
  $mygroup = $_GET['mygroup'];
  $mydate= $_GET['mydate'];

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
    print "Error connecting to the database: " . $e->getMessage() . "<br/>";
    die();
  }
  try {
    
    if ($mygroup!="All"){
    	$st = $dbh->prepare("SELECT * FROM DukeEvent WHERE eventid IN (SELECT eventid FROM Hosting WHERE groupname = ? ) AND CAST(starttime AS DATE) = ?  ORDER BY 3");
        $st->execute(array($mygroup, $mydate));
    }
    else{
        $st=$dbh->prepare("SELECT * FROM DukeEvent WHERE CAST (starttime AS DATE) = ?  ORDER BY 3");
        $st->execute(array($mydate));
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
    print "Database error: " . $e->getMessage() . "<br/>";
    die();
  }
?>
