<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
  <title>Hasil Registrasi IT Club Data Science</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<?php
$proses = $_POST['proses'];
$nama_siswa = $_POST['nama'];
$mata_kuliah = $_POST['matkul'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_uas = $_POST['nilai_uas'];
$nilai_tugas = $_POST['nilai_tugas'];


/* MENENTUKAN LULUS ATAU TIDAK MENGGUNAKAN IF ELSE
SISWA DINYATAKAN LULUS JIKA NILAI TOTAL dengan presentase 30% UTS, 35% UAS dan TUGAS 35% melebihi 55+*/
$nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);

$status = ($nilai_akhir > 55) ? 'Lulus' : "Tidak Lulus";

/* MENENTUKAN GRADE NILAI MENGGUNAKAN IF ELSE*/
if ($nilai_akhir >=85 && $nilai_akhir <=100) {
    $grade = "A";
} elseif ($nilai_akhir >=70 && $nilai_akhir <= 84) {
    $grade = "B";
} elseif ($nilai_akhir >= 56 && $nilai_akhir <= 69) {
    $grade = "C";
} elseif ($nilai_akhir >= 36 && $nilai_akhir <=55) {
    $grade = "D";
} elseif ($nilai_akhir >=0) {
    $grade = "E";
} else {
    $grade = "I";
}

/* MENENTUKAN PREDIKAT NILAI MENGGUNAKAN SWITCH*/ 
switch ($grade) {
    case 'A' :
        $predikat = 'Sangat Memuaskan';
        break;
    case 'B' :
        $predikat = 'Memuaskan';
        break;
    case 'C' :
        $predikat = 'Cukup';
        break;
    case 'D' :
        $predikat = 'Kurang';
        break;
    case 'E' :
        $predikat = 'Sangat Kurang';
        break;
    default:
        $predikat = 'Tidak ada';

}

if (!empty($proses)) {
    echo 'Proses : ' . $proses;
    echo '<br/>Nama : ' . $nama_siswa;
    echo '<br/>Mata Kuliah : ' . $mata_kuliah;
    echo '<br/>Nilai UTS : ' . $nilai_uts;
    echo '<br/>Nilai UAS : ' . $nilai_uas;
    echo '<br/>Nilai Tugas Praktikum : ' . $nilai_tugas;
    echo '<br/>Nilai Akhir : ' . number_format($nilai_akhir, 2, ',', '.');
    echo '<br/>Status : ' . $status;
    echo '<br/>Grade : ' . $grade;
    echo '<br/>Predikat : ' . $predikat;
}
?>