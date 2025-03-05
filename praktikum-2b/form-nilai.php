<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="font-size; 18px;">
<form action="nilai-mahasiswa.php" method="POST" class="container mt-5">
    <fieldset class="border border-dark p-3 rounded" style="background-color: lightyellow;">
        <legend class="float-none w-auto px-3 fw-bold h3">Form Nilai Mahasiswa</legend>
     <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama lengkap</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-book"></i>
          </div>
        </div> 
        <input id="nama" name="nama" placeholder="*Dadang Ubuntu" type="text" class="form-control" required="required">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="matkul" class="col-4 col-form-label">Mata Kuliah</label> 
    <div class="col-8">
      <select id="matkul" name="matkul" class="custom-select" required="required">
        <option value="DDP">Dasar Dasar Pemrograman</option>
        <option value="BD1">Basis Data</option>
        <option value="PW1">Pemrograman Web</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_uts" class="col-4 col-form-label">Nilai UTS</label> 
    <div class="col-8">
      <input type="nilai_uts" name="nilai_uts" placeholder="*70" type="number" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_uas" class="col-4 col-form-label">Nilai UAS</label> 
    <div class="col-8">
      <input type="nilai_uas" name="nilai_uas" placeholder="*70" type="number" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_tugas" class="col-4 col-form-label">Nilai Tugas/Praktikum</label> 
    <div class="col-8">
      <input type="nilai_tugas" name="nilai_tugas" placeholder="*70" value=""  type="number" required="required" class="form-control" >
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <input type="submit" value="simpan" name="proses"/>
    </div>
  </div>
</fieldset>
</form>
</body>
</html>
