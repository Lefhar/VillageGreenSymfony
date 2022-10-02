
#  trigger après mise à jour de commande

DELIMITER $$
CREATE TRIGGER maj_stock_update AFTER update ON orders_details
    FOR EACH ROW
BEGIN
    DECLARE idproduit INT;
    DECLARE quantite int;
    SET idproduit = NEW.product_id;
    SET quantite = NEW.quantite;

    update products set stock = stock - quantite   where id = idproduit;

END $$
DELIMITER ;


#  trigger après insertion de commande

DELIMITER $$
CREATE TRIGGER maj_stock_insert AFTER insert ON orders_details
    FOR EACH ROW
BEGIN
    DECLARE idproduit INT;
    DECLARE quantite int;
    SET idproduit = NEW.product_id;
    SET quantite = NEW.quantite;

    update products set stock = stock - quantite   where id = idproduit;

END $$
DELIMITER ;


#  trigger après suppréssion de commande
DELIMITER $$
CREATE TRIGGER maj_stock_delete AFTER delete ON orders_details
    FOR EACH ROW
BEGIN
    DECLARE idproduit INT;
    DECLARE quantite int;
    SET idproduit = OLD.product_id;
    SET quantite = OLD.quantite;

    update products set stock = stock + quantite   where id = idproduit;

END $$
DELIMITER ;