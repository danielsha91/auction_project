select id from
    (
    select itemId as id, price from Bid where price=(select max(price) from Bid)
    union
    select id, firstPrice as price from Item where firstPrice=(select max(firstPrice) from Item)
    )
where price=(select max(price) from
    (
    select itemId as id, price from Bid where price=(select max(price) from Bid)
    union
    select id, firstPrice as price from Item where firstPrice=(select max(firstPrice) from Item)
    )
);
