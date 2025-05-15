<?php
namespace models;

use PDO;
use config\Connection;

require_once __DIR__ . '/../config/Connection.php';

class Pembayaran {
    public static function getAllWithDetails(): array
    {
        $pdo = Connection::make();
        $sql = "SELECT 
                    pembayaran.id, 
                    pembayaran.jumlah_bayar, 
                    pembayaran.tanggal,
                    pesanan.id AS pesanan_id,
                    pegawai.nama AS nama_anggota
                FROM pembayaran
                INNER JOIN pesanan ON pembayaran.pesanan_id = pesanan.id
                INNER JOIN anggota ON pesanan.anggota_id = anggota.id
                INNER JOIN pegawai ON anggota.pegawai_id = pegawai.id
                ORDER BY pembayaran.tanggal DESC";

        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function findById(int $id)
    {
        $pdo = Connection::make();
        $sql = "SELECT * FROM pembayaran WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): bool
    {
        $pdo = Connection::make();
        $sql = "INSERT INTO pembayaran (jumlah_bayar, tanggal, pesanan_id) 
                VALUES (:jumlah_bayar, :tanggal, :pesanan_id)";
        $statement = $pdo->prepare($sql);
        return $statement->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Connection::make();
        $sql = "UPDATE pembayaran 
                SET jumlah_bayar = :jumlah_bayar, tanggal = :tanggal 
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $data['id'] = $id;
        return $statement->execute($data);
    }

    public static function delete(int $id): bool
    {
        $pdo = Connection::make();
        $sql = "DELETE FROM pembayaran WHERE id = :id";
        $statement = $pdo->prepare($sql);
        return $statement->execute(['id' => $id]);
    }
}
