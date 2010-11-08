PRAGMA foreign_keys = ON;
insert into Bid values ('1679249851', 'waltera317a', '2001-12-19 07:12:36', 3.58);
delete from Bid where itemId='1679249851' and bidTime='2001-12-19 07:12:36';
drop trigger trigger2;