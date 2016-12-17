<?php
if  (!isset($_GET['mygroup'])&& !isset($_SESSION['username'])) {
    die();
  }
  session_start();
  $mygroup = $_GET['mygroup'];
  $myname = $_SESSION['username'];
  $mydate = $_GET['mydate'];


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
	if ($mydate==null){
          $st = $dbh->prepare("SELECT * FROM DukeEvent WHERE eventid IN (SELECT h.eventid FROM Hosting h, Attending a WHERE h.groupname = ? AND a.netid = ? and h.eventid = a.eventid) ORDER BY 3");
          $st->execute(array($mygroup, $myname));
	}
	else{
	  $st = $dbh->prepare("SELECT * FROM DukeEvent WHERE eventid IN (SELECT h.eventid FROM Hosting h, Attending a WHERE h.groupname = ? AND a.netid = ? and h.eventid = a.eventid) and CAST (starttime as DATE) = ? ORDER BY 3");
          $st->execute(array($mygroup, $myname, $mydate));
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
