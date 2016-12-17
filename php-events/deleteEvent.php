<?php
  if  (!isset($_SESSION['username'])&& !isset($_GET['eventid'])) {
    die();
  }
  session_start();
  $myuser = $_SESSION['username'];
  $event= $_GET['eventid'];
?>
<?php
        try{
                include("pdo-events.php");
                $dbh = dbconnect();
         }catch (PDOException $e) {
                 print "Error connecting to the database: " . $e->getMessage() . "<br />";
                 die();
         }
        try{
 		$dbh->beginTransaction();
                $st = $dbh->prepare("SELECT * FROM  DukeUser WHERE netid=?");
                $st->execute(array($myuser));
                if (($myrow= $st->fetch())){
                   $st = $dbh->prepare("SELECT * FROM  Attending WHERE netid=? AND eventid=?");
                   $st->execute(array($myuser, $event));
                   if (($myrow =$st->fetch())){
                   	$st = $dbh->prepare("DELETE FROM  Attending WHERE netid=? AND eventid=?");
                     	$st->execute(array($myuser, $event));
                        echo "Delete";
		   }
                   else{
                       echo "Already not Going";
                   }
                }
                else{
                   echo "User not in the database";
                }
		$dbh->commit();
        } catch (PDOException $e) {
                $dbh->rollBack();
                print "Database error: " . $e->getMessage() . "<br />";
                die();
        }
?>             
