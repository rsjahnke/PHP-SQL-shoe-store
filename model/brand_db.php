<?php
function get_brands() {
    global $db;
    $query = 'SELECT * FROM brands
              ORDER BY brandID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;    
}

function get_brand_name($brand_id) {
    global $db;
    $query = 'SELECT * FROM brands
              WHERE brandID = :brand_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':brand_id', $brand_id);
    $statement->execute();    
    $brand = $statement->fetch();
    $statement->closeCursor();    
    $brand_name = $brand['brandName'];
    return $brand_name;
}
?>