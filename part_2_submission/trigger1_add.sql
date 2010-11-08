-- description: start time of an auction must be earlier than end time
PRAGMA foreign_keys = ON;
drop trigger if exists trigger1;
create trigger trigger1
before insert on Item
for each row
when New.started >= New.ends
begin
    select raise(rollback, 'start time of auction must be earlier than end time');
end;
select * from Item where started > ends;
insert into Item values
('1679480996', 'fake name', null, 0.01, '2001-12-18 18:49:56', '2001-12-17 18:49:56', 'jtvfeather', 'fake description');

