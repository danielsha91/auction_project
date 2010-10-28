create table Item (
    id integer not null,
    name text not null,
    buyPrice real,
    firstPrice real not null,
    started date not null,
    ends date not null,
    sellerId integer not null,
    description text not null,
    primary key (id)
    );

create table Category (
    id integer not null,
    tag text not null,
    primary key (id)
    );

create table ItemCategory (
    itemId integer not null,
    categoryId integer not null,
    primary key (itemId, categoryId)
    );

create table AuctionUser (
    id integer not null,
    rating integer not null,
    location text,
    country text,
    primary key (id)
    );

create table Bid (
    id integer not null, -- in cases >1 bid/user/item
    itemId integer not null,
    bidderId integer not null,
    bidTime date not null,
    price real not null,
    primary key (id)
    );

