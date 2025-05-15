<?php
namespace models;

use config\Connection;
use PDO;
use Exception;

require_once __DIR__ . '/../config/Connection.php'; // pastikan file ini menginisialisasi $pdo

class JenisProduk
{
    /**
     * Mengambil semua data jenis produk.
     *
     * @return array
     */
    public static function getAll(): array
    {
        $pdo = Connection::make();

        $statement = $pdo->query("SELECT * FROM jenis_produk ORDER BY nama");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): ?array
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare("SELECT * FROM jenis_produk WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
}
