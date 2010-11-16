
<?php # operations

display_browseTable();

if (!empty($_POST)) {
    //print_r($_POST);

    $category = $_POST["category"];
    $priceBelow = $_POST["priceBelow"];
    $sellerRatingAbove = $_POST["sellerRatingAbove"];

    handle_browse($db, $category, $priceBelow, $sellerRatingAbove);
}

?>


<?php # functions

function handle_browse($db, $category, $priceBelow, $sellerRatingAbove) {
    //echo $category;
    //echo $priceBelow;
    //echo $sellerRatingAbove;

    $query = "";
    if ($category != "") {
        $query = "select * from Item, ItemCategory ".
                 "where Item.id=ItemCategory.itemId and ".
                 "category=\"".$category."\"";
    }
    else {
        $query = "select * from Item";
    }

    // it is crucial to limit number of search results !!!
    $query = $query . " limit 10";

    //echo $query."<p/>";

    // iterate over query results
    $rItem = $db->query($query);
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr>";
    echo "<th>Item ID</th>";
    echo "<th>Current Price</th>";
    echo "<th>Seller</th>";
    echo "<th>Seller Rating</th>";
    echo "</tr>";
    foreach ($rItem as $row) {
        // determine price in range
        $currPrice = getCurrentPrice($row["id"]);
        if ($priceBelow != "") {
            if ($currPrice >= (float)$priceBelow) {
                continue;
            }
        }

        // determine seller rating in range
        $sellerId = $row["sellerId"];
        $rSeller = $db->query("select * from AuctionUser where id=\"".$sellerId."\"")->fetchAll();
        $sellerRating = $rSeller[0]["rating"];
        if ($sellerRatingAbove != "") {
            if ((float)$sellerRatingAbove >= (float)$sellerRating) {
                continue;
            }
        }

        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$currPrice."</td>";
        echo "<td>".$row["sellerId"]."</td>";
        echo "<td>".$sellerRating."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function display_browseTable() {
    echo "<form method=\"POST\" action=\"browse.php\">";
    include ('./browseTable.html');
    echo "</form>";
}

?>
