<?php
  if (!isset($_GET['mydate'])) {
    die();
  }
  $mydate = $_GET['mydate'];
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
                $st = $dbh->prepare("select eventid from dukeevent where cast(starttime as date) < ?");
		$st -> execute(array($mydate));
                if (($myrow = $st->fetch())) {
        	do{
 		   $st2=$dbh->prepare("DELETE FROM HOSTING WHERE eventid=?");
                   $st2->execute(array($myrow['eventid']));
                   $st2=$dbh->prepare("DELETE FROM ATTENDING WHERE eventid=?");
                   $st2->execute(array($myrow['eventid']));
                   $st2=$dbh->prepare("DELETE FROM DUKEEVENT WHERE eventid=?");
                   $st2->execute(array($myrow['eventid']));
        	} while ($myrow = $st->fetch());
       
		}
		$dbh->commit();

        } catch (PDOException $e) {
		$dbh->rollBack();
                print "Database error: " . $e->getMessage() . "<br />";
                die();
        }
?>
