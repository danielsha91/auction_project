PRAGMA doreign_keys = ON;
insert into Item values
('1679480996', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-23 18:49:56', 'jtvfeather', 'fake description');
delete from Item where id='1679480996';
drop trigger trigger1;
