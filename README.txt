TODO: research on auto increment key for sqlite


==============================================================================
Part B

List of Relations
- Item (id, name, buyPrice, firstPrice, started, ends, sellerId, description)
    - key: {id}
- ItemCategory (itemId, category)
    - key: {itemId, category}
- AuctionUser (id, rating, location, country)
    - key: {id}
- Bid (itemId, bidderId, bidTime, price)
    - key: {itemId, bidderId, bidTime}
    -- one bidder can only bid for one item at each given time

List of completely nontrivial functional dependencies
- Item
    - none if excluding {id}->{all other attributes}
- ItemCategory
    - none, since all attributes combined forms key
- AuctionUser
    - none if excluding {id}->{all other attributes}
- Bid
    - none if excluding {itemId, bidderId, bidTime} -> {price}

BCNF
- All the relations are in BCNF.

List of nontrivial multivalued dependencies
- Item
    - none
- ItemCategory
    - none
- AuctionUser
    - none
- Bid
    - none

4NF
- All the relations are in 4NF.


