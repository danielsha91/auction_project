Part B

Item (item id primary key, name text, buy_price float, first_price float not null, started, ends, seller_id, description text)

ItemCategory (item id, category id)

Category (category id primary key, 

User (user id primary key, rating, location, country)

Bid (bid id primary key, bidder_id, time, amount float)


List your relations. Please specify all keys that hold on each relation. You need not specify attribute types at this stage.

List all completely nontrivial functional dependencies that hold on each relation, excluding those that effectively specify keys.

Are all of your relations in Boyce-Codd Normal Form (BCNF)? If not, either redesign them and start over, or explain why you feel it is advantageous to use non-BCNF relations.

List all nontrivial multivalued dependencies that hold on each relation, excluding those that are also functional dependencies.

Are all of your relations in Fourth Normal Form (4NF)? If not, either redesign them and start over, or explain why you feel it is advantageous to use non-4NF relations.

