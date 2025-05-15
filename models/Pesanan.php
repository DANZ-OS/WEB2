<?php
namespace models;

use PDO;
use config\Connection;
require_once __DIR__ . '/../config/Connection.php';

class Pesanan
{
    public static function getAll() {
    $pdo = Connection::make();
    $sql = "
        SELECT 
            p.id,
            p.tanggal,
            p.diskon,
            p.status_bayar,
            a.id AS anggota_id,
            pegawai.nama AS nama_pegawai
        FROM pesanan p
        JOIN anggota a ON p.anggota_id = a.id
        JOIN pegawai ON a.pegawai_id = pegawai.id
        ORDER BY p.tanggal DESC
    ";
    $statement = $pdo->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("INSERT INTO pesanan (tanggal, diskon, status_bayar, anggota_id) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $data['tanggal'],
            $data['diskon'],
            $data['status_bayar'],
            $data['anggota_id']
        ]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $data)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("UPDATE pesanan SET tanggal = ?, diskon = ?, status_bayar = ?, anggota_id = ? WHERE id = ?");
        return $statement->execute([
            $data['tanggal'],
            $data['diskon'],
            $data['status_bayar'],
            $data['anggota_id'],
            $id
        ]);
    }

    public static function findWithDetails($data) {
    $pdo = Connection::make();
    $statement = $pdo->prepare("
        SELECT 
            p.*,
            a.id AS anggota_id,
            pegawai.nama AS nama_pegawai,
            pegawai.jabatan
        FROM pesanan p
        JOIN anggota a ON p.anggota_id = a.id
        JOIN pegawai ON a.pegawai_id = pegawai.id
        WHERE p.id = ?
    ");
    $statement->execute([$data]);
    return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public static function delete($data)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("DELETE FROM pesanan WHERE id = ?");
        return $statement->execute([$data]);
    }
}
