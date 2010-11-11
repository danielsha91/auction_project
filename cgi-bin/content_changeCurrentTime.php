
<h4>Please change current time:</h4>
<?php
    $MM   = $_POST["MM"];
    $dd   = $_POST["dd"];
    $yyyy = $_POST["yyyy"];
    $HH   = $_POST["HH"];
    $mm   = $_POST["mm"];
    $ss   = $_POST["ss"];    
    $entername = htmlspecialchars($_POST["entername"]);
    
    if($_POST["MM"]) {
        $selectedtime = $yyyy."-".$MM."-".$dd." ".$HH.":".$mm.":".$ss;
        echo "<p> Hello, ".$entername.", current time is: ".$selectedtime."</p>";
        try {
            // start transcation to update time
            $db->beginTransaction();

            // update time to selectedtime
            $qUpdateTime = "update Time set currentTime=:selectedtime";
            $rUpdateTime = $db->prepare($qUpdateTime);
            $rUpdateTime->execute(array(":selectedtime"=>$selectedtime));

            /*
             * There is no need to update auction information after time
             * changes. Instead, all queries trying to determine whether
             * a bid is closed should call bidIsOpen() function. One example
             * is on auction information page, the open/closed status of a
             * bid is computed this way, and will thus automatically change
             * with time each time user loads the page.
             */

            // commit the transaction
            $db->commit();
        }
        catch (PDOException $e) {
            try {
                $db->rollback();
            } catch (PDOException $pe) {}
            echo "Update time failed: ".$e->getMessage();
        }
    }
?>
<form method="POST" action="changeCurrentTime.php">
    <?php include ('./timetable.html'); ?>
</form>

