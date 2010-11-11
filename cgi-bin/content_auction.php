<?php

/**
 *  Display auction information content on search result page
 */
function content_auction($db, $itemId) {
    $r = $db->query("select * from Item where id=\"".$itemId."\"")->fetchAll();

    // report if no match
    if (!$r) {
        echo "<h4>No Item with input id: ".$itemId."</h4>";
        return;
    }

    // display auction item information
    display_item_info($r);

    // display auction status
    display_bid_status($db, $itemId);

    // display bid information
    display_bid_info($db, $itemId);
}


function display_item_info($r) {
    echo "<h4>Auction Information</h4>";
    echo "<table width=\"100%\" border=\"1\">";
    foreach ($r as $row) {
        echo "<tr><td>";
        echo "Item <b>".$row["id"]."</b> listed by <b>".$row["sellerId"]."</b>";
        echo "</td></tr>";

        echo "<tr><td>";
        echo "From <b>".$row["started"]."</b> to <b>".$row["ends"]."</b>";
        echo "</td></tr>";

        if ($row["buyPrice"] != "") {
            echo "<tr><td>";
            echo "Buy Price: <b>".$row["buyPrice"]."</b>";
            echo "</td></tr>";
        }

        $name = $row["name"];
        $short_description = substr($row["description"], 0, 240)."...";
        echo "<tr><td>";
        echo "<p><b>".$name."</b></p>";
        echo "<p>Description: ".$short_description."</p>";
        echo "</td></tr>";
    }
    echo "</table>";
}


function display_bid_status($db, $itemId) {
    echo "<h4>Auction Status</h4>";
    $isOpen = bidIsOpen($itemId);
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr><td>";
    if ($isOpen) {
        echo "Still going on";
    }
    else {
        $result       = bidWinner($itemId);
        $winnerId     = $result["winnerId"];
        $winningPrice = $result["winningPrice"];
        if ($winnerId != "") {
            echo "Closed, won by ".$winnerId." at price ".$winningPrice;
        }
        else {
            echo "Closed, no one bid.";
        }
    }
    echo "</td></tr>";
    echo "</table>";
}


function display_bid_info($db, $itemId) {
    echo "<h4>All Bids on this Auction</h4>";
    $bids = $db->query("select * from Bid where itemId=".$itemId.
                       " order by bidTime desc");
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr><th>Bidder</th><th>Price</th><th>Time</th></tr>";
    foreach ($bids as $row) {
        echo "<tr>";
        echo "<td>".$row["bidderId"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["bidTime"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>

