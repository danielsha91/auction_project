PRAGMA foreign_keys = ON;

insert into Item values
('1679480996', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-23 18:49:56', 'jtvfeather', 'fake description');  /* modification for constraint1 */
delete from Item where id='1679480996';  /* undo the modification */

insert into ItemCategory values ('1679480995', 'fake category');  /* modification for constraint2 */
delete from ItemCategory where itemId='1679480995' and category='fake category';  /* undo the modification */

insert into AuctionUser values ('fakeUserId', 0, 0, 0, 'fake location', 'fake country');  /* modification for constraint3 */
delete from AuctionUser where id='fakeUserId';  /* undo the modification */

insert into Bid values ('1679249851', 'waltera317a', '2001-12-18 07:12:36', 2.43);  /* modification for constraint4 */
delete from Bid where itemId='1679249851' and bidTime='2001-12-18 07:12:36';  /* undo the modification */

insert into Item values
('1679480996', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-23 18:49:56', 'jtvfeather', 'fake description');  /* modification for constraint5 */
delete from Item where id='1679480996';  /* undo the modification */

insert into ItemCategory values ('1679480995', 'fake category');  /* modification for constraint6 */
delete from ItemCategory where itemId='1679480995' and category='fake category';  /* undo the modification */

insert into Bid values ('1679480995', 'waltera317a', '2001-12-18 07:12:36', 2.43);  /* modification for constraint7 */
delete from Bid where itemId='1679480995' and bidTime='2001-12-18 07:12:36';  /* undo the modification */

insert into Bid values ('1679480995', 'waltera317a', '2001-12-18 07:12:36', 2.43);  /* modification for constraint8 */
delete from Bid where itemId='1679480995' and bidTime='2001-12-18 07:12:36';  /* undo the modification */

