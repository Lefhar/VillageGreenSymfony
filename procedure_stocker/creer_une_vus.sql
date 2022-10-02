#Créez une vue correspondant à la jointure Produits - Fournisseurs
CREATE VIEW product_fournis
AS
SELECT pro_id, pro_name, suppliers.sup_id
FROM `products`
         join suppliers ON products.sup_id = suppliers.sup_id;


CREATE VIEW product_fournis_categorie
AS
SELECT pro_id, pro_name, suppliers.sup_id, categories.cat_id, categories.cat_id_parent
FROM `products`
         join suppliers ON products.sup_id = suppliers.sup_id
         right JOIN categories  on products.cat_id=categories.cat_id ;