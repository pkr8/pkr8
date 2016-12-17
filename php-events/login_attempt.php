<?php
if  (!isset($_POST['username'])&& !isset($_POST['password'])) {
    die();
  }
  $myuser = $_POST['username'];
  $mypassword= $_POST['password'];
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
                $st = $dbh->prepare("SELECT * FROM  DukeUser WHERE netid=? and password=?");
                $st->execute(array($myuser, $mypassword));
                if (($myrow= $st->fetch())){
                   echo "Log-In Complete!";
                }
                else{
                    echo "Log-In Failed - Incorrect Username/Password";
                }
        } catch (PDOException $e) {
                print "Database error: " . $e->getMessage() . "<br />";
                die();
        }
?>
