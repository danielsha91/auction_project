===============================================================================
    How-to on Basic Functionalities
===============================================================================

* Manually change the "current time"
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - click on "Change Current Time" in the top navigation bar
    - select year, month .. and optionally input your name
    - press "change time" button

* Enter bids on an open auction
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - clock on "Bid" in the top navigation bar
    - input Item Id, for example: 1043374545
    - input User Id, for example: nobody138
    - input Bid Price, for example: 1234
    - note, we will check the referential integrity on item id, user id and
      also that bid price is higher than item current price
    - also note, repeated bid on this page will result in bids at the same
      "virtual time", so remember to update current time before bid again

* Automatic auction closing
    - the user won't need to worry about this
    - I designed the database and AuctionBase system so that every time when
      the system is querying an auction, it will combine time and price
      information to determine whether the auction is closed. As a result, what
      is exposed to user is that every time he/she sees an auction, the
      open/close status of the auction is guaranteed to be most up to date.
    - to test this, first set the time to a really late time, when all auctions
      will be closed
        http://stanford.edu/~yinfeng/cgi-bin/changeCurrentTime.php
    - then goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - input an item id in the search bar at the top, for example: 1043374545
    - press "Quick Search" button, you will be lead to search result page
    - you can see in the Auction Status section it is already closed

* See the winner of an auction
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - input item id in the search bar at the top of the page, say 1043374545
    - press "Quick Search" button
    - you will be lead to search result page with auction information
    - if the auction is closed, you can see find the winnner in the "Auction
      Status" section

* Browse auctions of interest
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - click on "Browse" in the top navigation bar
    - input any combination of conditions, for example:
        category: movie
        price below: 30

* Find an (open or closed) auction based on itemID
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - input itemID in the search bar text box at the top
    - press "Quick Search!"
    - you will be lead to the search result page showing the auction


===============================================================================
    A short description of the input parameters a user can provide
    when browsing auctions.
===============================================================================

* Category:
    - strings containing category names of interest to the user
* Price Below:
    - a real number indicating the price
* Seller Rating Above:
    - an integer showing the minimum seller rating the user wants to deal with


===============================================================================
    How-to on Extra Functionalities
===============================================================================

* Retrieve auction or bidding history of a given user
    - goto:
        http://stanford.edu/~yinfeng/cgi-bin/index.php
    - in the pull-down menu of the search bar, choose "UserID"
    - input a user id in the search box, for example: nobody138
    - press "Quick Search!"
    - you will be lead to the search result page showing all user information
      and auction/bidding history

* Check hot categories at the home page
    - on any page, you can find the hot categories in the left panel
    - the data is counted from actual bid statistics in real-time

