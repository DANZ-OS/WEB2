<?php
namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class Anggota
{
    public static function getWithDetails()
    {
        $pdo = Connection::make();
        $sql = "
            SELECT 
                anggota.id AS anggota_id,
                anggota.status_aktif,

                pegawai.id AS pegawai_id,
                pegawai.nip,
                pegawai.nama AS nama_pegawai,
                pegawai.jenis_kelamin,
                pegawai.jabatan,

                kartu_diskon.id AS kartu_diskon_id,
                kartu_diskon.nama AS nama_diskon,
                kartu_diskon.deskripsi,
                kartu_diskon.persen_diskon

            FROM anggota
            JOIN pegawai ON anggota.pegawai_id = pegawai.id
            LEFT JOIN kartu_diskon ON anggota.kartu_diskon_id = kartu_diskon.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $sql = "
            INSERT INTO anggota (status_aktif, pegawai_id, kartu_diskon_id)
            VALUES (:status_aktif, :pegawai_id, :kartu_diskon_id)
        ";
        $statement = $pdo->prepare($sql);
        return $statement->execute([
            ':status_aktif' => $data['status_aktif'],
            ':pegawai_id' => $data['pegawai_id'],
            ':kartu_diskon_id' => $data['kartu_diskon_id'] !== '' ? $data['kartu_diskon_id'] : null
        ]);
    }

    public static function findWithDetails($id) {
    $pdo = Connection::make();
    $statement = $pdo->prepare("
        SELECT 
            a.id AS anggota_id,
            a.status_aktif,
            a.pegawai_id,
            a.kartu_diskon_id,
            p.nama AS nama_pegawai,
            p.jabatan,
            kd.nama AS nama_diskon,
            kd.deskripsi AS deskripsi_diskon
        FROM anggota a
        JOIN pegawai p ON a.pegawai_id = p.id
        LEFT JOIN kartu_diskon kd ON a.kartu_diskon_id = kd.id
        WHERE a.id = ?
    ");
    $statement->execute([$id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}


    public static function update($id, $data)
    {
        $pdo = Connection::make();
        $sql = "
            UPDATE anggota SET 
                status_aktif = :status_aktif,
                pegawai_id = :pegawai_id,
                kartu_diskon_id = :kartu_diskon_id
            WHERE id = :id
        ";
        $statement = $pdo->prepare($sql);
        return $statement->execute([
            ':status_aktif' => $data['status_aktif'],
            ':pegawai_id' => $data['pegawai_id'],
            ':kartu_diskon_id' => $data['kartu_diskon_id'] !== '' ? $data['kartu_diskon_id'] : null,
            ':id' => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $sql = "DELETE FROM anggota WHERE id = :id";
        $statement = $pdo->prepare($sql);
        return $statement->execute([':id' =>$id]);
    }
}
