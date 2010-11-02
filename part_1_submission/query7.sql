select count(distinct c) from
(select ItemCategory.category as c from Item, ItemCategory, Bid
 where Item.id=ItemCategory.itemId
   and Item.id=Bid.itemId
   and Bid.price>100
 group by ItemCategory.category);
