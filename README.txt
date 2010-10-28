TODO: research on auto increment key for sqlite


==============================================================================
Part B

List of Relations
- Item (id, name, buyPrice, firstPrice, started, ends, sellerId, description)
    - key: {id}
- Category (id, tag)
    - key: {id}
- ItemCategory (itemId, categoryId)
    - key: {itemId, categoryId}
- AuctionUser (id, rating, location, country)
    - key: {id}
- Bid (id, itemId, bidderId, bidTime, price)
    - key: {id}, {bidderId, bidTime}
    -- assume one bidder can only bid for one item at each given time

List of completely nontrivial functional dependencies
- Item
    - none if excluding id->{all other attributes}
- Category
    - none if excluding id->tag
- ItemCategory
    - none, since all attributes combined forms key
- AuctionUser
    - none if excluding id->{all other attributes}
- Bid
    - {bidderId, bidTime} -> {itemId, price}

Are all of your relations in Boyce-Codd Normal Form (BCNF)? If not, either redesign them and start over, or explain why you feel it is advantageous to use non-BCNF relations.
BCNF
- Bid is not in BCNF
    - Because currently I assume one bideer can only bid for one item at each
      given time. There is the possibility that in the future our business
      needs to drop this assumption, then a separate id attribute will save us
      from changing the database schema.

List of nontrivial multivalued dependencies
- Item
    - none
- Category
    - none
- ItemCategory
    - none
- AuctionUser
    - none
- Bid
    - none

4NF
- All the relations are in 4NF.





