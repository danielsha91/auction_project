==============================================================================
Part B

------------------------------------------------------------------------------
List of Relations
- Item (id, name, buyPrice, firstPrice, started, ends, sellerId, description)
    - key: {id}
- ItemCategory (itemId, category)
    - key: {itemId, category}
- AuctionUser (id, isSeller, isBidder, rating, location, country)
    - key: {id}
- Bid (itemId, bidderId, bidTime, price)
    - key: {itemId, bidderId, bidTime}
    -- one bidder can only bid for one item at each given time
    -- however, the document does not rule out the possiblity that a user
       account bid on different item at the same time

------------------------------------------------------------------------------
List of completely nontrivial functional dependencies
- Item
    - none if excluding {id}->{all other attributes}
- ItemCategory
    - none, since all attributes combined forms key
- AuctionUser
    - none if excluding {id}->{all other attributes}
- Bid
    - none if excluding {itemId, bidderId, bidTime} -> {price}

------------------------------------------------------------------------------
BCNF
- All the relations are in BCNF.

------------------------------------------------------------------------------
List of nontrivial multivalued dependencies
- Item
    - none
- ItemCategory
    - none
- AuctionUser
    - none
- Bid
    - none

------------------------------------------------------------------------------
4NF
- All the relations are in 4NF.


------------------------------------------------------------------------------
For coming project parts: extension approach once online
- Enter bids on items
    - require bidder id
    - check Item about auction end time
    - insert new entry in Bid
- Close auction
    - identify bidder id and item id
    - determine bid winner
    - design scheme to automatically close auction upon end time
    - maybe allow seller optionally close auction before end time
- Add new user
    - insert new entry in AuctionUser, make sure no duplicate id
    - ask user's interest in being seller/bidder/both
    - initialize rating to 0
- Add new auction
    - auto generate auction id
    - require user to fill in necessary information

