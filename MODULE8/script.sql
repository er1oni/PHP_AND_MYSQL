--cretate the categories table
CREATE TABLE categories (
    id INTEGER PRIMARY KEY, --THIS COLUMN IS THE PRIMARY KEY ANDMIS OF THE TYPE INTERGER
    name VARCHAR(255) NOT NULL --This colmn is of the type VARCHaR(255) and canot br null
)

--Create the products table
CREATE TABLE produtcts (
        id INTEGER PRIMARY KEY, --THIS COLUMN IS THE PRIMARY KEY ANDMIS OF THE TYPE INTERGER
    name VARCHAR(255) NOT NULL --This colmn is of the type VARCHaR(255) and canot br null
    category_id INTEGER NOT NULL, -- tHIS COLUMN IS OF THE TYPE INTEGER AND CANOT BE NULL
    FOREIGN KEY(category_id) REFERENCES catergories(id) --THis column is a foreing key that references the i column in 
    --categories table
) 

--insert data into the categories table
INSERT INTO categories (id,name) VALUES
(1, 'Fruit'),
(2, 'Barkery'),
(3, 'Dry Goods'),
(4, 'Vegetables');

--insert data into the products table
INSERT INTO proucts(id, name, category_id) VALUES
(1, 'Apples', 1),
(2, 'Bananas', 1),
(3, 'Oranges' 1),
(4, 'Strawberries', 1),
(5, 'Bread', 2),
(6, 'Cake', 2),
(7, 'Cokkies', 2),
(8, 'Pasta', 3),
(9, 'Rice', 3),
(10, 'Cereal', 3),




