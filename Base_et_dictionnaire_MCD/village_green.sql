DROP DATABASE if exists village_green;
create database village_green;
use village_green;
CREATE TABLE categories
(
    cat_id   INT AUTO_INCREMENT,
    cat_name VARCHAR(50) NOT NULL,
    cat_id_parent INT,
    PRIMARY KEY (cat_id),
    FOREIGN KEY (cat_id_parent) REFERENCES categories (cat_id)
);

CREATE TABLE departments
(
    dep_id   INT AUTO_INCREMENT,
    dep_name VARCHAR(50),
    PRIMARY KEY (dep_id)
);

CREATE TABLE posts
(
    pos_id   INT AUTO_INCREMENT,
    pos_name VARCHAR(50),
    PRIMARY KEY (pos_id)
);

CREATE TABLE Live
(
    Id_Live       INT AUTO_INCREMENT,
    Live_address  VARCHAR(150),
    Live_city     VARCHAR(50),
    Live_country  VARCHAR(50),
    Live_zip_code VARCHAR(15),
    PRIMARY KEY (Id_Live)
);

CREATE TABLE suppliers
(
    sup_id        INT AUTO_INCREMENT,
    sup_firstname VARCHAR(50),
    sup_lastname  VARCHAR(50),
    sup_type      VARCHAR(50),
    Id_Live       INT NOT NULL,
    PRIMARY KEY (sup_id),
    FOREIGN KEY (Id_Live) REFERENCES Live (Id_Live)
);

CREATE TABLE employees
(
    emp_id        INT AUTO_INCREMENT,
    emp_firstname VARCHAR(50),
    emp_lastname  VARCHAR(50),
    emp_tel       VARCHAR(15),
    Id_Live       INT NOT NULL,
    dep_id        INT NOT NULL,
    pos_id        INT NOT NULL,
    PRIMARY KEY (emp_id),
    FOREIGN KEY (Id_Live) REFERENCES Live (Id_Live),
    FOREIGN KEY (dep_id) REFERENCES departments (dep_id),
    FOREIGN KEY (pos_id) REFERENCES posts (pos_id)
);

CREATE TABLE products
(
    pro_id          INT AUTO_INCREMENT,
    pro_name        VARCHAR(50),
    pro_description VARCHAR(150),
    pro_photo       VARCHAR(50),
    pro_label       VARCHAR(50),
    pro_ref         VARCHAR(50),
    pro_price       DECIMAL(5, 2),
    pro_status      INT,
    pro_stock       INT,
    cat_id          INT NOT NULL,
    sup_id          INT NOT NULL,
    PRIMARY KEY (pro_id),
    FOREIGN KEY (cat_id) REFERENCES categories (cat_id),
    FOREIGN KEY (sup_id) REFERENCES suppliers (sup_id)
);

CREATE TABLE customers
(
    cus_id        INT AUTO_INCREMENT,
    cus_firstname VARCHAR(50),
    cus_lastname  VARCHAR(50),
    cus_telephone VARCHAR(15),
    cus_type      VARCHAR(50),
    cus_coef      INT,
    emp_id        INT NOT NULL,
    PRIMARY KEY (cus_id),
    FOREIGN KEY (emp_id) REFERENCES employees (emp_id)
);

CREATE TABLE orders
(
    ord_id            INT AUTO_INCREMENT,
    ode_order_date    DATETIME,
    ord_date_payment  DATETIME,
    ord_date_ship     DATETIME,
    ord_date_delivery DATETIME,
    ord_status        VARCHAR(50),
    ord_billing_address           INT NOT NULL,
    ord_shippen_address         INT NOT NULL,
    cus_id            INT NOT NULL,
    PRIMARY KEY (ord_id),
    FOREIGN KEY (ord_billing_address) REFERENCES Live (Id_Live),
    FOREIGN KEY (ord_shippen_address) REFERENCES Live (Id_Live),
    FOREIGN KEY (cus_id) REFERENCES customers (cus_id)
);

CREATE TABLE orders_details
(
    ode_id         INT AUTO_INCREMENT,
    ode_unit_price DECIMAL(10, 2),
    ode_qte        INT,
    ode_discount   INT,
    pro_id         INT NOT NULL,
    ord_id         INT NOT NULL,
    PRIMARY KEY (ode_id),
    FOREIGN KEY (pro_id) REFERENCES products (pro_id),
    FOREIGN KEY (ord_id) REFERENCES orders (ord_id)
);

CREATE TABLE habiter
(
    cus_id  INT,
    Id_Live INT,
    PRIMARY KEY (cus_id, Id_Live),
    FOREIGN KEY (cus_id) REFERENCES customers (cus_id),
    FOREIGN KEY (Id_Live) REFERENCES Live (Id_Live)
);
