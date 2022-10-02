## entré de donnée  de coordonnées pour les fournisseurs dans la table live

INSERT INTO Live (address, city, zipcode, country)
VALUES (1, '532 Cursus. St.', 'Chimbote', 'Russian Federation', '21104'),
       (2, '304-1775 Feugiat Rd.', 'Thanh Hóa', 'Mexico', '640982'),
       (3, '6007 Tellus. Avenue', 'Ijebu Ode', 'Netherlands', '1427'),
       (4, '532 Cursus. St.', 'Chimbote', 'Russian Federation', '21104'),
       (5, '304-1775 Feugiat Rd.', 'Thanh Hóa', 'Mexico', '640982'),
       (6, '6007 Tellus. Avenue', 'Ijebu Ode', 'Netherlands', '1427'),
       (7, '6008 rar. Avenue', 'Ijebu Ode', 'Netherlands', '1997'),
       (8, '5007 dsfdg. Avenue', 'Ijebu Ode', 'Netherlands', '1427'),
       (9, '3007 abcd. Avenue', 'Ijebu Ode', 'Netherlands', '8427');

## entré de fournisseur qui sera relié au adresse dans live

INSERT INTO suppliers (firstname, lastname, type, suplive_id )
VALUES ("Brenden", "Lynch", "professionnel", 1),
       ("Gretchen", "Steele", "professionnel", 2),
       ("Amela", "Allison", "particulier", 3);


## entré de département genre comptabilité, marketing, etc

INSERT INTO departments (dep_name)
VALUES ('Comptabilité'),
       ('Ressources Humaines'),
       ('Logistique'),
       ('Maintenance'),
       ('Marketing'),
       ('Direction');


## entré du post genre commercial, manager, Comptable etc

INSERT INTO posts (pos_name)
VALUES ('commercial'),
       ('manager'),
       ('Comptable');

## entré des employées

INSERT INTO employees (emp_firstname, emp_lastname, emp_tel, Id_Live, dep_id, pos_id)
VALUES ('françois-régis', 'caumartin', '0663534369', '8', '6', '1');

## entré des catégories

INSERT INTO categories (cat_name, cat_id_parent)
VALUES ('Guit/Bass', NULL),
       ('Batteries', NULL),
       ('Clavier', NULL),
       ('Studio', NULL),
       ('Sono', NULL),
       ('Eclairage', NULL),
       ('DJ', NULL),
       ('Cases', NULL),
       ('Accessoires', NULL);

##insertion de sous catégorie de Guit/bass
INSERT INTO categories (cat_name, cat_id_parent)
VALUES ('Guitares Electriques', 1),('Guitares Classiques', 1);


#entré de 3 clients avec le commercial françois-regis :)
INSERT INTO customers (cus_firstname, cus_lastname, cus_telephone, cus_type, cus_coef, emp_id)
VALUES ('Harold', 'Lefebvre', '0610012548', 'particulier', '60', '1'),
       ('Emmanuel', 'Berthome', '', 'particulier', '60', '1'),
       ('Marion', 'Joly', '060837188', 'particulier', '60', '1');


#entré d'association avec l'entité live pour l'adresse du client
INSERT INTO habiter (cus_id, Id_Live)
VALUES ('1', '7'),('2', '8'),('3', '9');


# entré de produit
INSERT INTO products (name, description, photo, label, pro_ref, price,
                      status, stock, catprod_id , sup_id )
VALUES ('Fender Squier Affinity Strat MN BK',
        'Série Affinity Corps en peuplier Manche en érable Profil du manche en C Touche en érable Diapason: 648 mm (25,5\")',
        'jpg', 'guitare', 'gui123', '200.00', '1', '20', '10', '3'),
       ('Startone CG 851 1/8', 'Taille: 1/8 Corps en tilleul Manche en nato Touche en érable', 'jpg',
        'guitare startone', 'gui124', '220.00', '1', '20', '11', '2');

#entré de commande dans order
INSERT INTO orders (ode_order_date, ord_date_payment, ord_date_ship, ord_date_delivery,
                    ord_status, ord_billing_address, ord_shippen_address, cus_id)
VALUES ('2021-12-08 14:23:22', '2021-12-08 14:23:22', '2021-12-08 14:23:22', '2021-12-16 14:23:22', 'expédié',
        '7', '8', '1');

#entré de ligne de commande
INSERT INTO orders_details (ode_unit_price, ode_qte, ode_discount, pro_id, ord_id)
VALUES ('200', '2', '70', '1', '1');
