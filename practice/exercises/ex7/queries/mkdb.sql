DROP DATABASE IF EXISTS products_store;
CREATE DATABASE products_store;

USE products_store;

CREATE TABLE user_roles (
    name VARCHAR(20) PRIMARY KEY NOT NULL
);

CREATE TABLE users (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    email VARCHAR(36) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'customer',
    CONSTRAINT role_fk FOREIGN KEY(role) REFERENCES user_roles(name) ON DELETE NO ACTION
);

CREATE TABLE product_types(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL
);

CREATE TABLE products (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    name VARCHAR(100) NOT NULL,
    type INT NOT NULL,
    CONSTRAINT type_fk FOREIGN KEY(type) REFERENCES product_types(id) ON DELETE NO ACTION
);

CREATE TABLE user_products(
    user_id VARCHAR(36),
    product_id VARCHAR(36),
    CONSTRAINT user_id_fk FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT product_id_fk FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE
);

SET @userID = UUID();
SET @prod_id1 = UUID();
SET @prod_id2 = UUID();
SET @prod_id3 = UUID();

INSERT INTO user_roles(name)
VALUES("admin"),
("customer");

INSERT INTO users(id, email, password, role)
VALUES(@userID, "admin@a.bg", "$2y$10$7nah1/Iz/xEV2L8eOAq9ZuqNSU8P4w0cF/i5o.V8VBdD0rHiiyn4G", "admin");

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
