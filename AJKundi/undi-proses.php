<head>
<link rel="stylesheet" href="css/style.css">
</head>

<?php
session_start();
include('connection.php');
include('kawalan-pengguna.php');

// SEMAK KEWUJUDAN DATA POST UNTUK PROSES UNDIAN
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo"<script>
            alert('Sila Buat Undian Terlebih Dahulu.');
            window.location.href='undi-calon.php';
        </script>";
    exit;
}
// Proses menyimpan data undian ke dalam pangkalan data
foreach($_POST as $jawatan => $noCalon) {
    $noCalon = mysqli_real_escape_string($condb, $noCalon);

    // arahan SQL untuk simpan undian
    $arahan_undi = "
        INSERT INTO undian (noKP, noCalon)
        VALUES ('{$_SESSION['noKP']}', '$noCalon') ";

    // Jika gagal, papar mesej dan kembali ke halaman undian
    if(!mysqli_query($condb, $arahan_undi)) {
        echo"<script>
                alert('Proses Undian Gagal');
                window.location.href='undi-calon.php';
            </script>";
        exit;
    }
}
// Jika berjaya, papar mesej berjaya dan kembali ke halaman undian
echo"<script>
        alert('Undian Berjaya Direkodkan.');
        window.location.href='undi-calon.php';
    </script>";
?>