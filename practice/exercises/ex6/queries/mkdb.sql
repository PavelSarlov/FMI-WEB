DROP DATABASE IF EXISTS products_store;
CREATE DATABASE products_store;

USE products_store;

CREATE TABLE users (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID() NOT NULL,
    username VARCHAR(16) UNIQUE NOT NULL,
    password VARCHAR(64) NOT NULL
);

CREATE TABLE product_types(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL
);

CREATE TABLE products (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID() NOT NULL,
    name VARCHAR(100) NOT NULL,
    type INT NOT NULL,
    CONSTRAINT type_fk FOREIGN KEY(type) REFERENCES product_types(id)
);

CREATE TABLE user_products(
	user_id VARCHAR(36),
    product_id VARCHAR(36),
    CONSTRAINT user_id_fk FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT product_id_fk FOREIGN KEY(product_id) REFERENCES products(id)
);

SET @userID = UUID();
SET @prod_id1 = UUID();
SET @prod_id2 = UUID();
SET @prod_id3 = UUID();

INSERT INTO users(id, username, password)
VALUES(@userID, "admin", SHA2("admin", 256));

INSERT INTO product_types(name)
VALUES
	("clothes"),
	("drinks"),
    ("food");
    
INSERT INTO products(id, name, type)
VALUES
	(@prod_id1, "t-shirt", 1),
    (@prod_id2, "burger", 3),
    (@prod_id3, "water", 2);

INSERT INTO user_products(user_id, product_id)
VALUES
    (@userID, @prod_id1),
    (@userID, @prod_id2);

SELECT * FROM users;
SELECT * FROM product_types;
SELECT * FROM products;
SELECT * FROM user_products;

