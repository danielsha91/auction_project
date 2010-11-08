-- description: a seller cannot bid on the item he/she listed to sell
PRAGMA foreign_keys = ON;
drop trigger if exists trigger3;
create trigger trigger3
before insert on Bid
for each row
when New.bidderId = (select sellerId from Item where Item.id=New.itemId)
begin
    select raise(rollback, 'a seller connot bid on the item he/she listed to sell');
end;
select * from Bid, Item where itemId=item.id and bidderId=sellerId;
insert into Bid values ('1679249851', 'buysellstuffcheap', '2001-12-18 23:31:35', 3.28);