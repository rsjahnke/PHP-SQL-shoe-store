<?php
function get_shoes_by_brand($brand_id) {
    global $db;
    $query = 'SELECT * FROM shoes
              WHERE shoes.brandID = :brand_id
              ORDER BY shoeID';
    $statement = $db->prepare($query);
    $statement->bindValue(":brand_id", $brand_id);
    $statement->execute();
    $shoes = $statement->fetchAll();
    $statement->closeCursor();
    return $shoes;
}

function get_shoe($shoe_id) {
    global $db;
    $query = 'SELECT * FROM shoes
              WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":shoe_id", $shoe_id);
    $statement->execute();
    $shoe = $statement->fetch();
    $statement->closeCursor();
    return $shoe;
}

function get_stock($shoe_id) {
    global $db;
    //echo 'in function! shoe id is ' . $shoe_id;
    $query = 'SELECT quantity_in_stock FROM shoes
              WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":shoe_id", $shoe_id);
    $statement->execute();
    $stock = $statement->fetchColumn();
    $stock = intval($stock);
    //echo 'in function! stock fetched: ' . $stock;
    $statement->closeCursor();
    return $stock;
}

function delete_shoe($shoe_id) {
    global $db;
    $query = 'DELETE FROM shoes
              WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_shoe($shoe_id, $code, $name, $price, $quantity, $brand_id) {
    global $db;
    $query = 'UPDATE shoes
              SET shoeCode = :code, shoeName = :name, listPrice = :price, 
                  quantity_in_stock = :quantity, brandID = :brand_id 
              WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->bindValue(':brand_id', $brand_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':brand_id', $brand_id);
    $statement->execute();
    $statement->closeCursor();
}


function add_shoe($brand_id, $code, $name, $price, $quantity) {
    global $db;
    $query = 'INSERT INTO shoes
                 (brandID, shoeCode, shoeName, listPrice, quantity_in_stock)
              VALUES
                 (:brand_id, :code, :name, :price, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':brand_id', $brand_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}
?>