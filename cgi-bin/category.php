
<h4> Hot Categories </h4>

<?php
    $db->beginTransaction();

    $query  = "select category, count(*) " .
              "from ItemCategory group by category " .
              "order by count(*) desc limit 5";
    $result = $db->prepare($query);
    $result->execute();

    foreach ($result as $row) {
        echo '<p><a href="http://www.google.com">' .
             $row['category'] . ' (' .
             $row['count(*)'] .
             ')</a></p>';
    }

    $db->commit();
?>
