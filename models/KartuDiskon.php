<?php
namespace models;

use config\Connection;
use PDO;
require_once __DIR__ . '/../config/Connection.php';

class KartuDiskon {
    public static function getAll() {
        $pdo = Connection::make();
        $statement = $pdo->query("SELECT * FROM kartu_diskon ORDER BY nama ASC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($data) {
    global $pdo;
    $sql = "INSERT INTO kartu_diskon (nama, deskripsi, persen_diskon) 
            VALUES (:nama, :deskripsi, :persen_diskon)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama' => $data['nama'],
        ':deskripsi' => $data['deskripsi'],
        ':persen_diskon' => $data['persen_diskon'],
    ]);
}

}
