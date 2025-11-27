USE FCS_66;

CREATE TABLE products (
product_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
price DECIMAL (10,2) NOT NULL,
description TEXT

);

ALTER TABLE products
ADD COLUMN available_quantity INT NOT NULL DEFAULT 0;

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    customer_name VARCHAR(255),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO products (name, price, available_quantity) VALUES
('Master Chips', 2, 100),
('Albeni', 1.5, 50);