PRAGMA foreign_keys = ON;

insert into Item values
('1679480995', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-23 18:49:56', 'jtvfeather', 'fake description');  /* modification violating constraint1; should produce an error */

insert into ItemCategory values ('1679480995', 'Hot Wheels');  /* modification violating constraint2; should produce an error */

insert into AuctionUser values ('geenafan', 0, 0, 0, 'fake location', 'fake country');  /* modification violating constraint3; should produce an error */

insert into Bid values ('1679249851', 'waltera317a', '2001-12-18 07:12:35', 2.43);  /* modification violating constraint4; should produce an error */

insert into Item values
('1679480996', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-23 18:49:56', 'fakeUserId', 'fake description');  /* modification violating constraint5; should produce an error */

insert into ItemCategory values ('1679480996', 'fake category');  /* modification violating constraint6; should produce an error */

insert into Bid values ('1679480996', 'waltera317a', '2001-12-18 07:12:36', 2.43);  /* modification violating constraint7; should produce an error */

insert into Bid values ('1679480995', 'fakeUserId', '2001-12-18 07:12:36', 2.43);  /* modification violating constraint8; should produce an error */

