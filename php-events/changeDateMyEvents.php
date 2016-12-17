<?php
  if (!isset($_GET['mydate']) && !isset($_SESSION['username'])) {
    die();
  }
  session_start();
  $mydate = $_GET['mydate'];
  $mygroup = $_GET['mygroup'];
  $myname = $_SESSION['username'];

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
    
    
        $st=$dbh->prepare("SELECT * FROM DukeEvent WHERE CAST(starttime AS DATE) = ? AND eventid IN (SELECT eventid from Attending where netid = ?) ORDER BY 3");
        $st->execute(array( $mydate, $myname));
  
    if (($myrow = $st->fetch())) {
       $outp = "[";
        do {
        if ($outp != "[") {$outp .= ",";}
        $outp .= '{"Name" : "' . $myrow["eventname"] . '",';
        $outp .= '"Time" : "' . $myrow["starttime"] . '",';
	$outp .= '"Location" : "' . $myrow["location"] . '",';
        $outp .= '"Going" : "' . true . '",';
        $outp .= '"Id" : "' . $myrow["eventid"] . '",';
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
