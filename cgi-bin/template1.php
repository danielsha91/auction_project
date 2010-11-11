
<!-- open db connection -->
<?php include ('./sqlitedb.php'); ?>
<?php include("./db_query.php"); ?>


<head>
<title>AuctionBase</title>
</head>


<!-- head navigation bar for pages -->
<table width="90%" border="1"><tr><td>
<?php include ('./navbar.html'); ?>
</td></tr></table>

<!-- head search bar -->
<table width="90%" border="1"><tr><td>
<form method="POST" action="searchResult.php">
    <?php include ('./searchBar.php'); ?>
</form>
</td></tr></table>

<!-- main body -->
<table width="90%" border="1"><tr>

<!-- left navigation bar for categories -->
<td width="20%"><?php include ('./category.php'); ?></td>

<!-- TO BE FOLLOWED BY CONTENT ELEMENT -->

