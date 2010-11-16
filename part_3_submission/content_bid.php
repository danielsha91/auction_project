
<?php # operations

if (!empty($_POST)) {
    $itemId   = $_POST["ItemId"];
    $userId   = $_POST["UserId"];
    $bidPrice = $_POST["BidPrice"];

    handle_bid($db, $itemId, $userId, $bidPrice);
}

display_bidTable();

?>

<?php # functions

/**
 *  Handle bid input
 *  including constraint checking and database updating
 */
function handle_bid($db, $itemId, $userId, $bidPrice) {
    // verify bid is open
    // though most likely user are lead to here from search result page
    // showing this auction is still open, it is possible that in between
    // someone else has bid on this auction and sealed the deal
    // so we need to check again
    if (!bidIsOpen($itemId)) {
        echo "Sorry, the bid on item \"".$itemId."\" is closed.";
        return;
    }

    // verify input format is valid
    if (!is_numeric($bidPrice)) {
        echo "Please input a valid bid price<br/>";
        return;
    }


    // verify referential integrity on ItemId and UserId
    $rUser = $db->query("select * from AuctionUser where id=\"".$userId.
                        "\"")->fetchAll();
    // report if no match
    if (!$rUser) {
        echo "<h4>No User with input id: \"".$userId."\"</h4>";
        return;
    }
    $rItem = $db->query("select * from Item where id=\"".$itemId.
                        "\"")->fetchAll();
    // report if no match
    if (!$rItem) {
        echo "<h4>No Item with input id: \"".$itemId."\"</h4>";
        return;
    }


    // seller bid on his/her own item is forbidden
    if ($rItem[0]["sellerId"] == $userId) {
        echo "Hi ".$userId.", you cannot bid on your own item.";
        return;
    }


    // find current time
    $currTime = getCurrentTime();


    // compare prices and detemine bid result
    $rBid = $db->query("select * from Bid where itemId=\"".$itemId.
                       "\" order by price desc")->fetchAll();
    $lastBidPrice = $rBid[0]["price"];;
    $firstPrice  = $rItem[0]["firstPrice"];
    $buyPrice    = $rItem[0]["buyPrice"];

    // check bid price is higher than first price, current price
    $currentPrice = max((float)$firstPrice, (float)$lastBidPrice);
    if ((float)$bidPrice <= $currentPrice) {
        echo "Sorry, bid price should be higher than current price ".
             $currentPrice;
        return;
    }

    // add one more entry in bid
    // other checks such as auction status will be computed
    // every time auction is queried
    $insertQuery = "insert into bid values (\"".$itemId.
                   "\", \"".$userId."\", \"".$currTime.
                   "\", \"".$bidPrice."\")";
    try {
        $count = $db->exec($insertQuery);

        // report bid success
        echo "Congratulations ".$userId.
             ", you successfully bid on ".$itemId.
             " at price ".$bidPrice."<br/>";
    }
    catch (PDOException $e) {
        echo "Insert failed: maybe you need to update time";
        //echo $e->getMessage();
    }
}


/**
 *  Display standard bid table for further bids
 */
function display_bidTable() {
    echo "<form method=\"POST\" action=\"bid.php\">";
    include ('./bidTable.html');
    echo "</form>";
}

?>

