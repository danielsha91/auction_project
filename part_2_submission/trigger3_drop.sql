PRAGMA foreign_keys = ON;
insert into Bid values ('1679249851', 'waltera317a', '2001-12-18 23:31:35', 3.28);
delete from Bid where itemId='1679249851' and bidTime='2001-12-18 23:31:35';
drop trigger trigger3;