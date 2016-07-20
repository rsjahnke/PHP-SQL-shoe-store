-- create the tables
CREATE TABLE brands (
  brandID       INT(11)        NOT NULL   AUTO_INCREMENT,
  brandName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (brandID)
);

CREATE TABLE shoes (
  shoeID        INT(11)        NOT NULL   AUTO_INCREMENT,
  brandID       INT(11)        NOT NULL,
  shoeCode      VARCHAR(10)    NOT NULL   UNIQUE,
  shoeName      VARCHAR(255)   NOT NULL,
  listPrice        DECIMAL(10,2)  NOT NULL,
  PRIMARY KEY (shoeID)
);

CREATE TABLE online_orders (
  orderID        INT(11)        NOT NULL   AUTO_INCREMENT,
  customerID     INT            NOT NULL,
  orderDate      DATETIME       NOT NULL,
  PRIMARY KEY (orderID)
);

CREATE TABLE items_in_order (
  id  INT(11)        NOT NULL   AUTO_INCREMENT,
  shoeID  INT(11)        NOT NULL,
  orderID INT(11)        NOT NULL,
  item_quantity INT(11)        NOT NULL,
  PRIMARY KEY (id)
);

-- insert data into the database
INSERT INTO brands VALUES
(1, 'BCBG'),
(2, 'Steve Madden'),
(3, 'Frye');

INSERT INTO shoes VALUES
(1, 1, 'runway_wedge', 'Runway Wedge', '275.00'),
(2, 1, 'laceup_sandal', 'Lace-Up Sandal', '138.00'),
(3, 2, 'proto_pump', 'Proto Pump', '79.98'),
(4, 2, 'maryjane_pump', 'Mary Jane Pump', '119.95'),
(5, 3, 'fringe_boot', 'Fringe Boot', '368.00'),
(6, 3, 'riding_boot', 'Riding Boot', '448.00');

INSERT INTO online_orders VALUES
(1, 1, '2016-04-05 13:00:00'),
(2, 2, '2016-04-05 15:00:00'),
(3, 3, '2016-04-06 20:00:00');
