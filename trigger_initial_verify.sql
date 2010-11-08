
select * from Item where started > ends;

select * from Item where started > (select * from Time);

select * from Item, AuctionUser where sellerId=AuctionUser.id and isSeller=0;

select * from Bid, AuctionUser  where bidderId=AuctionUser.id and isBidder=0;

select * from Bid, Item where itemId=Item.id and bidTime<started;

select * from Bid where bidTime > (select * from Time);

select * from Bid, Item where itemId=Item.id and Bid.price<Item.firstPrice;

select * from Bid as Bid1, Bid as Bid2 where Bid1.itemId=Bid2.itemId and Bid1.bidTime<Bid2.bidTime and Bid1.price>Bid2.price;

select * from Bid, Item where itemId=item.id and bidderId=sellerId;

