-- -------------------------------------------------
--  TABLE: users
-- -------------------------------------------------
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(150) NOT NULL,
    lastname VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(250) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'customer',
    PRIMARY KEY (id),
    UNIQUE KEY (email),
    UNIQUE KEY (username)
);

-- -------------------------------------------------
--  TABLE: products
-- -------------------------------------------------
CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    stock INT(11) DEFAULT 100,
    PRIMARY KEY (id)
);

-- -------------------------------------------------
--  TABLE: orders
-- -------------------------------------------------
CREATE TABLE orders (
    order_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    amount INT(11) NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    product_image VARCHAR(255),

    PRIMARY KEY (order_id),

    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
