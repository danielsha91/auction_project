
<?php

// test functions
/*
//$test_itemId = "1043495702";
$test_itemId = "1043374545";
echo "Bid is open? ".bidIsOpen($test_itemId);
echo "<p/>";
echo "Bid winner is : ".bidWinner($test_itemId);
echo "<p/>";
*/

?>


<?php
/*****************************************************************************/
// functions
/*****************************************************************************/

/**
 *  Bonnect DB
 */
function dbConnect() {
    $dbname = "./auction.db";
    try {
        $db = new PDO("sqlite:" . $dbname);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        "SQLite connection failed: " . $e->getMessage();
        exit();
    }
    return $db;
}


/**
 *  Get current time
 */
function getCurrentTime() {
    try {
        $db = dbConnect();
        $db->beginTransaction();

        $result = $db->query("select * from Time")->fetchColumn(0);
 
        $db->commit();
        $db = null;

        return $result;
    }
    catch (PDOExcepeion $e) {
        try {
            $db->rollback();
        } catch (PDOException $pe) {}
        echo "Failed in function bidIsOpen: ".$e->getMessage();
    }
}


/**
 *  Determine whether the bid on item is still open
 */
function bidIsOpen($itemId) {
    try {
        $db = dbConnect();
        $db->beginTransaction();

        $item = $db->query("select * from Item where id=".$itemId)->fetch();
        //print_r($item);

        // auction close condition 1: buyPrice is reached
        $closeCond1 = false;
        if ($item["buyPrice"] != "") {
            $bids = $db->query("select * from Bid where itemId=".$itemId);
            foreach ($bids as $row) {
                if ((float)$row["price"] >= $item["buyPrice"]) {
                    $closeCond1 = true;
                }
            }
        }

        // auction close condition 2: end time is past
        $closeCond2 = false;
        $currTime = $db->query("select * from Time")->fetchColumn(0);
        if ($currTime >= $item["ends"]) {
            $closeCond2 = true;
        }

        /*
        echo "<p/>";
        if ($closeCond1) { echo "close cond1 satisfied"; }
        else { echo "close cond1 not satisfied"; }
        echo "<p/>";
        if ($closeCond2) { echo "close cond2 satisfied"; }
        else { echo "close cond2 not satisfied"; }
        echo "<p/>";
        */

        $db->commit();
        $db = null;

        return !($closeCond1 || $closeCond2);
    }
    catch (PDOExcepeion $e) {
        try {
            $db->rollback();
        } catch (PDOException $pe) {}
        echo "Failed in function bidIsOpen: ".$e->getMessage();
    }
}


/**
 *  Find the current price of a bid
 *  max(firstPrice, max(bid price))
 *  Return value is float number
 */
function getCurrentPrice($itemId) {
    try {
        $db = dbConnect();
        $db->beginTransaction();

        // get first price from Item
        $rItem = $db->query("select * from Item where id=\"".$itemId.
                            "\"")->fetchAll();
        $firstPrice = $rItem[0]["firstPrice"];

        // get highest bid price
        $rBid = $db->query("select * from Bid where itemId=\"".$itemId.
                           "\" order by price desc")->fetchAll();
        $lastBidPrice = $rBid[0]["price"];

        $result = max((float)$firstPrice, (float)$lastBidPrice);

        $db->commit();
        $db = null;

        return $result;
    }
    catch (PDOExcepeion $e) {
        try {
            $db->rollback();
        } catch (PDOException $pe) {}
        echo "Failed in function bidIsOpen: ".$e->getMessage();
    }
}


/**
 *  Find the winner of a bid
 *  return userId if exists, and empty string otherwise
 */
function bidWinner($itemId) {
    try {
        $result = array();

        if (!bidIsOpen($itemId)) {
            $db = dbConnect();
            $db->beginTransaction();

            $winningBid = $db->query("select * from Bid where itemId=".$itemId.
                                     " order by price desc")->fetch();

            // could be empty
            $result = array(
                "winnerId" => $winningBid["bidderId"],
                "winningPrice" => $winningBid["price"]
                );

            $db->commit();
            $db = null;
        }

        return $result;
    }
    catch (PDOException $e) {
        try {
            $db->rollback();
        } catch (PDOException $pe) {}
        echo "Failed in function bidWinner: ".$e->getMessage();
    }
}

?>

