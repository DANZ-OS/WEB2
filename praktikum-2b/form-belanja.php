<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

$ar_produk = [
    'Kulkas' => 3100000,
    'TV' => 4200000,
    'Mesin Cuci' => 3800000
];
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Belanja</h2>
        <form method="POST" action="total-belanja.php">
            <div class="form-group">
                <label for="customer">Nama Customer:</label>
                <input type="text" id="customer" name="customer" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="produk">Pilih Produk:</label><br>
                <?php
                foreach ($ar_produk as $nama => $harga) {
                    echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                    echo "<input name='produk[]' id='produk_$nama' type='checkbox' class='custom-control-input' value='$nama'>";
                    echo "<label for='produk_$nama' class='custom-control-label'>$nama</label>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah Beli:</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" required min="1">
            </div>
            <button type="submit" name="proses" class="btn btn-primary">Simpan</button>
        </form>

        <?php
        if (isset($_POST['proses'])) {
            $customer = $_POST['customer'];
            $produk = isset($_POST['produk']) ? $_POST['produk'] : []; // Cegah error jika tidak ada produk dipilih
            $jumlah = $_POST['jumlah'];

            echo "<div class='mt-4'>";
            echo "<h4>Detail Belanja</h4>";
            echo "Nama Customer: <strong>$customer</strong><br>";

            if (!empty($produk)) {
                $total_belanja = 0;

                echo "<ul>";
                foreach ($produk as $item) {
                    if (isset($ar_produk[$item])) {
                        $subtotal = $jumlah * $ar_produk[$item];
                        $total_belanja += $subtotal;
                        echo "<li>Produk: <strong>$item</strong>, Harga: Rp " . number_format($ar_produk[$item], 0, ',', '.') . ", Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "</li>";
                    }
                }
                echo "</ul>";

                echo "Jumlah Beli: <strong>$jumlah</strong><br>";
                echo "Total Belanja: <strong>Rp " . number_format($total_belanja, 0, ',', '.') . "</strong><br>";
            } else {
                echo "<p class='text-danger'>Tidak ada produk yang dipilih.</p>";
            }

            echo "</div>";
        }
        ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
