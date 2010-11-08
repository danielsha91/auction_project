-- description: a bid on an item must have a higher price than previous bids
PRAGMA foreign_keys = ON;
drop trigger if exists trigger2;
create trigger trigger2
before insert on Bid
for each row
when New.price <= (select max(price) from Bid where Bid.itemId=New.itemId)
begin
    select raise(rollback, 'new bid price must be higher than previous bids');
end;
select * from Bid as Bid1, Bid as Bid2 where Bid1.itemId=Bid2.itemId and Bid1.bidTime<Bid2.bidTime and Bid1.price>Bid2.price;
insert into Bid values ('1679249851', 'waltera317a', '2001-12-19 07:12:36', 3.25);