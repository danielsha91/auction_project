
<h3> Current Time </h3> 

<?php
  $query = "select currentTime from Time";
  
  try {
    $result = $db->query($query);
    $row = $result->fetch();
    echo "Current time is: ".htmlspecialchars($row["currentTime"]);
  } catch (PDOException $e) {
    echo "Current time query failed: " . $e->getMessage();
  }
  
  $db = null;
?>


