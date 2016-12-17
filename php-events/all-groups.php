<?php
    try{
    include("pdo-events.php");
    $dbh = dbconnect();
  } catch (PDOException $e) {
    print "Error connecting to the database: " . $e->getMessage() . "<br/>";
    die();
  }
  try {
    $st = $dbh->query('SELECT * FROM DukeGroup ORDER BY 1');
    if (($myrow = $st->fetch())) {
    $outp = "[";
?>
<?php
        do {
        
        if ($outp != "[") {$outp .= ",";}
        $outp .= '{"Name" : "' . $myrow["name"] . '",';
        $outp .= '"Website" : "' . $myrow["websiteURL"] . '"}';
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
