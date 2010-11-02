select count(*) from (select * from ItemCategory group by itemId having count(itemId)=4);
