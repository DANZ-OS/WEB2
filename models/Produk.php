<?php
namespace models;

require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/DetailPesanan.php';

use config\Connection;
use PDO;

class Produk {
    public static function getWithJenis() {
        $pdo = Connection::make();
        $sql = "
            SELECT 
                produk.*,
                jenis_produk.nama AS jenis_nama
            FROM produk
            JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $pdo = Connection::make();
        $sql = "
            INSERT INTO produk (kode, nama, deskripsi, harga, stok, jenis_produk_id)
            VALUES (:kode, :nama, :deskripsi, :harga, :stok, :jenis_produk_id)
        ";

        $statement = $pdo->prepare($sql);
        return $statement->execute([
            ':kode' => $data['kode'],
            ':nama' => $data['nama'],
            ':deskripsi' => $data['deskripsi'],
            ':harga' => $data['harga'],
            ':stok' => $data['stok'],
            ':jenis_produk_id' => $data['jenis_produk_id'],
        ]);
    }
    public static function find($id) {
        $pdo = Connection::make();
        $sql = 'SELECT 
                produk.*, 
                jenis_produk.nama AS nama_jenis, 
                jenis_produk.deskripsi AS deskripsi_jenis 
                FROM produk 
                LEFT JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id 
                WHERE produk.id = :id';
    
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data){
        $pdo = Connection::make();
        $sql = 'UPDATE produk SET nama = :nama, harga = :harga, stok = :stok, 
                jenis_produk_id = :jenis_produk_id WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':harga', $data['harga']);
        $statement->bindParam(':stok', $data['stok']);
        $statement->bindParam(':jenis_produk_id', $data['jenis_produk_id']);
        return $statement->execute();
    }
        
    public static function delete($id){

        DetailPesanan::deleteByProdukId($id);

        $pdo = Connection::make();
        $sql = 'DELETE FROM produk WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
