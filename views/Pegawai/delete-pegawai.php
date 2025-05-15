<?php
require_once __DIR__ . '/../../models/Pegawai.php';

use models\Pegawai;

if(!isset($_GET['id'])){
    header("Location: list-pegawai.php");
    exit;
}

$user = Pegawai::find($_GET['id']);

if(!$user){
    header("Location: list-pegawai.php");
    exit; 
}

Pegawai::delete($user['id']);
header("Location: list-pegawai.php");