<?php

/**
 *  Display user information content on search result page
 */
function content_user($db, $userId) {
    $r = $db->query("select * from AuctionUser where id=\"".$userId."\"")->fetchAll();

    // report if no match
    if (!$r) {
        echo "<h4>No User with input id: ".$userId."</h4>";
        return;
    }

    display_user_profile($db, $userId);
    display_user_bid_history($db, $userId);
    display_user_sell_history($db, $userId);

}


function display_user_profile($db, $userId) {
    // after we have verified userId is valid
    $r = $db->query("select * from AuctionUser where id=\"".$userId."\"")->fetchAll();

    echo "<h4>User Profile</h4>";
    echo "<table width=\"100%\" border=\"1\">";
    foreach ($r as $row) {
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>".$row["id"]."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Rating</td>";
        echo "<td>".$row["rating"]."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Is seller?</td>";
        echo "<td>".meaningfulBool($row["isSeller"])."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Is bidder?</td>";
        echo "<td>".meaningfulBool($row["isBidder"])."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Location</td>";
        echo "<td>".$row["location"]."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Country</td>";
        echo "<td>".$row["country"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


function display_user_bid_history($db, $userId) {
    $rUserBid = $db->query("select * from Bid where bidderId=\"".$userId."\"");

    if (!$rUserBid) {
        // user has no bid history
        return;
    }

    echo "<h4>User Bid History</h4>";
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr>";
    echo "<th>Item ID</th>";
    echo "<th>Bid Time</th>";
    echo "<th>Bid Price</th>";
    echo "</tr>";
    foreach ($rUserBid as $row) {
        echo "<tr>";
        echo "<td>".$row["itemId"]."</td>";
        echo "<td>".$row["bidTime"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


function display_user_sell_history($db, $userId) {
    $rUserSell = $db->query("select * from Item where sellerId=\"".$userId."\"");

    if (!$rUserSell) {
        // user has no sell history
        return;
    }

    echo "<h4>User Sell History</h4>";
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr>";
    echo "<th>Item ID</th>";
    echo "<th>Item Name</th>";
    echo "<th>First Price</th>";
    echo "</tr>";
    foreach ($rUserSell as $row) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["firstPrice"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


function meaningfulBool($inputBool) {
    if ($inputBool == "1") {
        return "yes";
    }
    else {
        return "no";
    }
}


?>
