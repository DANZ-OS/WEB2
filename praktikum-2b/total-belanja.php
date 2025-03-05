<?php
if (isset($_POST['proses'])) {
    // Menerima data dari form
    $customer = $_POST['customer'];
    $produk = isset($_POST['produk']) ? $_POST['produk'] : []; // Pastikan produk tidak kosong
    $jumlah = $_POST['jumlah'];

    // Daftar harga produk
    $harga_produk = [
        "TV" => 4200000,
        "Kulkas" => 3100000,
        "Mesin Cuci" => 3800000
    ];

    // Menghitung total harga
    $total_belanja = 0;
    $detail_produk = "";

    if (!empty($produk)) {
        foreach ($produk as $item) {
            if (isset($harga_produk[$item])) {
                $subtotal = $jumlah * $harga_produk[$item];
                $total_belanja += $subtotal;
                $detail_produk .= "<li>Produk: <strong>$item</strong>, Harga: Rp " . number_format($harga_produk[$item], 0, ',', '.') . ", Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "</li>";
            }
        }
    } else {
        $detail_produk = "<p class='text-danger'>Tidak ada produk yang dipilih.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Detail Belanja</h2>
        <div class="mt-4">
            <p><strong>Nama Customer:</strong> <?php echo $customer; ?></p>
            <p><strong>Jumlah Beli:</strong> <?php echo $jumlah; ?></p>
            <h4>Produk yang Dibeli:</h4>
            <ul><?php echo $detail_produk; ?></ul>
            <p><strong>Total Belanja:</strong> Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></p>
        </div>
    </div>
</body>
</html>