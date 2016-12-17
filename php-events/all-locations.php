<?php
    try{
    include("pdo-events.php");
    $dbh = dbconnect();
  } catch (PDOException $e) {
    print "Error connecting to the database: " . $e->getMessage() . "<br/>";
    die();
  }
  try {
    $st = $dbh->query('SELECT distinct location  FROM DukeEvent ORDER BY 1');
    if (($myrow = $st->fetch())) {
    $outp = "[";
?>
<?php
        do {
              
        if ($myrow["location"]!=""){
                if ($outp != "["){$outp .= ",";}
        	$outp .= '{"Name" : "' . $myrow["location"] . '"}';
       }
        } while ($myrow = $st->fetch());
      
$outp.="]";
echo $outp;
?>
<?php
    } else {
      echo "[]";
    }
  } catch (PDOException $e) {
    print "Database error: " . $e->getMessage() . "<br/>";
    die();
  }
?>
