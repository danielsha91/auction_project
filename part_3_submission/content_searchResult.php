
<?php
$searchType = $_POST["searchType"];
$query      = $_POST["query"];

try {

    $db->beginTransaction();

    if ($searchType == "ItemID") {
        include("./content_auction.php");
        content_auction($db, $query);
    }
    else if ($searchType == "UserID") {
        include("./content_user.php");
        content_user($db, $query);
    }

    $db->commit();
}
catch (PDOException $e) {
    try {
        $db->rollback();
    } catch (PDOException $pe) {}
    echo "Failed in retrieving search result ".$e->getMessage();
}

?>

