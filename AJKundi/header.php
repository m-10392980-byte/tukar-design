<?php
$tarikh = "2026-10-10 23:59:59"; // tarikh akhir mengundi
?>


<!doctype html>
<html>
<head>
        <link rel="stylesheet" href="css/style.css">
</head>

<body class="<?php echo basename($_SERVER['PHP_SELF'], '.php'); ?>"></body>
<!-- TAJUK SISTEM  -->
<h1 class="tajuk">AJKundi - Pengundian Pemilihan AJK Kampung Dusun Merah</h1>
<hr>

<?php if (!empty($_SESSION['jenisPengguna'])) { ?>
<!-- MENU NAVIGASI UNTUK PENGGUNA YANG TELAH LOG MASUK -->

<div class="navbar">
        <div class="nav-spacer"></div>

        <nav class="nav-menu">
                <?php if ($_SESSION['jenisPengguna'] == "admin") { ?>
                        |<a class="nav" href="index.php">Laman Utama</a>
                        |<a class="nav" href="manifesto.php">Manifesto</a>
                        |<a class="nav" href="calon-senarai.php">Senarai Calon</a>
                        |<a class="nav" href="pengguna-senarai.php">Senarai Pengguna</a>
                        |<a class="nav" href="laporan.php">Laporan Undian</a>
                        |<a class="nav" href="countdown.php">Pengiraan Masa</a>
                
                <?php } elseif ($_SESSION['jenisPengguna'] == "pengundi") { ?>
                        |<a class="nav" href="index.php">Laman Utama</a>
                        |<a class="nav" href="manifesto.php">Manifesto</a>
                        |<a class="nav" href="undi-calon.php">Undi Calon</a>
                        |<a class="nav" href="countdown.php">Pengiraan Masa</a>
                <?php } ?>

                |<a class="logout" href="logout.php">Logout</a>|
        </nav>
</div>

<?php } else { ?>

<div class="navbar">
        <div class="nav-spacer"></div>

        <nav class="nav-menu">
                |<a class="nav" href="index.php">Laman Utama</a>
                |<a class="nav" href="manifesto.php">Manifesto</a>
                |<a class="nav" href="login.php">Log Masuk</a>
                |<a class="nav" href="signup.php">Daftar Sini</a>
                |<a class="nav" href="countdown.php">Pengiraan Masa</a>|
        </nav>
</div>
<?php } ?>