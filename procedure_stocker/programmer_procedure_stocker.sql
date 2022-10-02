delimiter §§
CREATE procedure commande_non_solder(In status varchar(50))
begin

    SELECT * FROM `orders` WHERE `ord_date_payment` IS NULL and `ord_status` =status;
end §§
delimiter ;