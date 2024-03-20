-- H178 34 - KIKFAV - Teamworking Website Database Setup Script

-- The drop script below will delete previous versions of the tables & their contents.
-- This will erase any data you've inserted into them yourself.
DROP TABLE IF EXISTS orderline;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS users;

-- Table for holding account, contact and shipping details of users.
CREATE TABLE users (
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
CREATE TABLE stock (
	stockno CHAR(5) NOT NULL,
	description CHAR(50),
	price DECIMAL(10,2),
	qtyinstock INT(6),
    PRIMARY KEY (stockno)
);

-- Table for creating & holding order IDs, along with their related user IDs.
CREATE TABLE orders (
	orderno INT(8) AUTO_INCREMENT NOT NULL,
	userid INT(6) NOT NULL,
    PRIMARY KEY (orderno),
	FOREIGN KEY (userid) REFERENCES users(userid)
);

-- Table for holding order details.
CREATE TABLE orderline (
	orderno INT(8) NOT NULL,
	stockno CHAR(5) NOT NULL,
	qty INT(3) NOT NULL,
    PRIMARY KEY (orderno,stockno),
	FOREIGN KEY (orderno) REFERENCES orders(orderno),
	FOREIGN KEY (stockno) REFERENCES stock(stockno)
);

-- Script for inserting test user. User can be accessed at login screen with username "test" and with password "test".
INSERT INTO users (username, password, email, forename, surname, street_address, city, postcode)
VALUES 
	('test', 'test', 'test@test.test', 'test', 'test', 'test', 'test', 'TE57 1OL');

-- Script for inserting sample stock for testing ordering system.
INSERT INTO stock (stockno, description, price, qtyinstock)
VALUES 
	('TXB01', 'Placeholder Generic Textbook', 50.00, 42),
	('WIN01', 'Placeholder Windows Laptop', 500.00, 0),
	('USB01', 'Placeholder USB-C Cables', 9.00, 37);