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

function meaningfulBool($inputBool) {
    if ($inputBool == "1") {
        return "yes";
    }
    else {
        return "no";
    }
}


?>
