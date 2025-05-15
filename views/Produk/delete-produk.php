<?php
require_once __DIR__ . '/../../models/Produk.php';

use models\Produk;

if(!isset($_GET['id'])){
    header("Location: list-produk.php");
    exit;
}

$item = Produk::find($_GET['id']);

if(!$item){
    header("Location: list-produk.php");
    exit; 
}

Produk::delete($item['id']);
header("Location: list-produk.php");