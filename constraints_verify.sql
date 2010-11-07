select sellerId from Item where sellerId not in (select id from AuctionUser); /* select statement verifying referential integrity constraint #1 */
select itemId from ItemCategory where itemId not in (select id from Item);  /* select statement verifying referential integrity constraint #2 */
select itemId from Bid where itemId not in (select id from Item);  /* select statement verifying referential integrity constraint #3 */
select bidderId from Bid where bidderId not in (select id from AuctionUser);  /* select statement verifying referential integrity constraint #4 */
