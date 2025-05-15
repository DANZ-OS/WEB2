<?php
namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class Pegawai {
    public static function get(){
        $pdo = Connection::make();
        $pdo->query('SELECT * FROM pegawai');
        $sql = 'SELECT * FROM pegawai';
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllBelumJadiAnggota() {
    $pdo = Connection::make();
    $sql = "SELECT * FROM pegawai WHERE id NOT IN (SELECT pegawai_id FROM anggota)";
    $statement = $pdo->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllIncluding($pegawai_id) {
    $pdo = Connection::make();
    $sql = "
        SELECT * FROM pegawai 
        WHERE id = :pegawai_id 
        OR id NOT IN (SELECT pegawai_id FROM anggota)
    ";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':pegawai_id', $pegawai_id);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function create($data)
    {
        $pdo = Connection::make();
        $sql = 'INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) VALUES (:nip, 
        :nama, :jenis_kelamin, :jabatan)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':nip', $data['nip']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $statement->bindParam(':jabatan', $data['jabatan']);

        return $statement->execute();

       // return $statement->execute([
         //   ':firstname' => $data['firstname'],
        // ':lastname' => $data['lastname'],
        //    ':gender' => $data['gender'],
        //    'age' => $data['age'],
        //    ':weight' => $data['weight'],
        //]);
    }

    public static function find($id){
        $pdo = Connection::make();
        $sql = 'SELECT * FROM pegawai WHERE id= :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = Connection::make();
        $sql = 'UPDATE pegawai SET nip = :nip, nama = :nama, jenis_kelamin = :jenis_kelamin,
        jabatan = :jabatan WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':nip', $data['nip']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $statement->bindParam(':jabatan', $data['jabatan']);

        return $statement->execute();
    }

    public static function delete($id){
        $pdo = Connection::make();
        $sql = 'DELETE FROM pegawai WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}