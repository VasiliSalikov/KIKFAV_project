-- H178 34 - KIKFAV - Teamworking Website Database Setup Script

-- The database cannot be hosted locally on your machine, so run this on your databse on the college server (like we've done in the E-Commerce class)
-- The drop script below will delete previous versions of the tables & their contents.
-- This will erase any data you've inserted into them yourself.
DROP TABLE IF EXISTS tw_orderline;
DROP TABLE IF EXISTS tw_orders;
DROP TABLE IF EXISTS tw_stock;
DROP TABLE IF EXISTS tw_users;

-- Table for holding account, contact and shipping details of users.
CREATE TABLE tw_users (
	userid INT(6) NOT NULL AUTO_INCREMENT,
	username VARCHAR(30),
	password VARCHAR(40),
	email VARCHAR(50),
	forename VARCHAR(30),
	surname VARCHAR(30),
	street_address VARCHAR(40),
	city VARCHAR(30),
	postcode VARCHAR(8),
	access_level TINYINT(1),
    PRIMARY KEY (userid)
);

-- Table for holding stock details.
CREATE TABLE tw_stock (
	stockno CHAR(5) NOT NULL,
	description CHAR(50),
	price DECIMAL(10,2),
	qtyinstock INT(6),
    PRIMARY KEY (stockno)
);

-- Table for creating & holding order IDs, along with their related user IDs.
CREATE TABLE tw_orders (
	orderno INT(8) AUTO_INCREMENT NOT NULL,
	userid INT(6) NOT NULL,
    PRIMARY KEY (orderno),
	FOREIGN KEY (userid) REFERENCES tw_users(userid)
);

-- Table for holding order details.
CREATE TABLE tw_orderline (
	orderno INT(8) NOT NULL,
	stockno CHAR(5) NOT NULL,
	qty INT(3) NOT NULL,
    PRIMARY KEY (orderno,stockno),
	FOREIGN KEY (orderno) REFERENCES tw_orders(orderno),
	FOREIGN KEY (stockno) REFERENCES tw_stock(stockno)
);

-- Script for inserting test user. User can be accessed at login screen with username "test" and with the password being "password" (encrypted on this database. enter "password" at login).
INSERT INTO tw_users (username, password, email, forename, surname, street_address, city, postcode, access_level)
VALUES 
	('test', '5f4dcc3b5aa765d61d8327deb882cf99', 'test@test.test', 'test', 'test', 'test', 'test', 'TE57 1OL', 0);

-- Script for inserting sample stock for testing ordering system.
INSERT INTO tw_stock (stockno, description, price, qtyinstock)
VALUES 
	('TXB01', 'Placeholder Generic Textbook', 50.00, 42),
	('WIN01', 'Placeholder Windows Laptop', 500.00, 0),
	('USB01', 'Placeholder USB-C Cables', 9.00, 37);