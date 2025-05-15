<?php
namespace models;

use PDO;
use config\Connection;

class DetailPesanan
{
    public static function getByPesananId($pesanan_id)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("SELECT dp.*, p.nama as nama_produk FROM detail_pesanan dp JOIN produk p ON dp.produk_id = p.id WHERE dp.pesanan_id = ?");
        $statement->execute([$pesanan_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertMany($pesanan_id, $produk_list)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (?, ?, ?)");
        foreach ($produk_list as $produk) {
            $statement->execute([$pesanan_id, $produk['produk_id'], $produk['jumlah']]);
        }
    }

    public static function deleteByPesananId($pesanan_id)
    {
        $pdo = Connection::make();
        $statement = $pdo->prepare("DELETE FROM detail_pesanan WHERE pesanan_id = ?");
        $statement->execute([$pesanan_id]);
    }

    public static function deleteByProdukId($produk_id) {
    $pdo = Connection::make();
    $statement = $pdo->prepare("DELETE FROM detail_pesanan WHERE produk_id = ?");
    $statement->execute([$produk_id]);
    }
}
