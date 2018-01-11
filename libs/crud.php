<?php

// fonctions debug
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include "utility.php";

$exec;
$db = connectDB("localhost","biz_stock","root","root");

$products = getProducts();

if (isset($_GET["id"])){
    $product = getProduct($_GET["id"]);
}

if (isset($_POST["update_product"])){
    UpdateProduct();
}

if(isset($_POST["create_product"])){
	createProduct();
}


function getProducts(){
    global $db;
    global $exec;

    $sql = "SELECT * FROM produits";
    $exec = $db->query($sql);
    return $exec->fetchAll(PDO::FETCH_OBJ);
}

function getProduct($id){
    global $db;
    $sql = "SELECT * FROM produits WHERE id=:id";
    $statement = $db->prepare($sql);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
}

function UpdateProduct(){
    global $db;
    $sql = "UPDATE produits SET nom = :nom, prix = :prix, description = :description WHERE id = :id";
    

    $statement = $db->prepare($sql);
    $statement->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
    $statement->bindParam(":nom", $_POST["nom"], PDO::PARAM_STR);
    $statement->bindParam(":prix", $_POST["prix"], PDO::PARAM_INT);
    $statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
    $statement->execute();
    header("location: index.php");

}

function createProduct(){
	global $db;

		$sql ="INSERT INTO produits (nom, prix, description)
			   VALUES(:nom, :prix, :description)";

	$statement = $db->prepare($sql);
	$statement->bindParam(":nom", $_POST["nom"], PDO::PARAM_STR);
	$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
	$statement->bindParam(":prix", $_POST["prix"], PDO::PARAM_INT);
	$res=$statement->execute();
	$msg_crud=($res===true)? "insertion ok" : "soucis à l'insertion";
	header("Location:index.php");
}

?>