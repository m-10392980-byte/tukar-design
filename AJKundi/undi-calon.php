<head>
<link rel="stylesheet" href="css/style.css">
</head>

<style>
    h3 {
        font-family: Arial, sans-serif;
    }
</style>

<?php
session_start();
include('header.php');
include('connection.php');
include('kawalan-pengguna.php');


// SEMAK JIKA TARIKH HARI SEMASA TELAH MELEBIHI TARIKH TAMAT MENGUNDI
if(strtotime(date("Y-m-d H:i:s")) > strtotime($tarikh)) {
    echo"<div style='font-size:30px; font-family: Arial, sans-serif; color:red; font-weight:bold; text-align:center;'>
            Proses Mengundi Telah Tamat
        </div>";
} else {
    echo"<div style='font-size:30px; font-family: Arial, sans-serif; color:green; font-weight:bold; text-align:center;'>
            Proses Mengundi Masih Berjalan
        </div>";
}

// UMPUK NILAI NOMBOR KAP PENGENALAN PENGGUNA DARI SESI LOGIN
$noKP = $_SESSION['noKP'];

// SEMAK SAMA ADA PENGGUNA TELAH MEMBUAT UNDIAN
$arahan_semak = "
    SELECT *
    FROM undian
    JOIN calon ON undian.noCalon = calon.noCalon
    JOIN jawatan ON calon.kodJawatan = jawatan.kodJawatan
    WHERE undian.noKP = '$noKP'
";
$laksana_semak = mysqli_query($condb, $arahan_semak);

// PAPAR CALON YANG DIPILIH OLEH PENGGUNA
if(mysqli_num_rows($laksana_semak) > 0) {
    echo"<h3 align='center'>Anda Telah Berjaya Mengundi</h3>
        <table class='table' align='center' border='1' width='50%'>
            <tr style='font-size:20px;'>
                <th>Jawatan</th>
                <th>Calon</th>
                <th>Gambar</th>
                </tr>";
                
    while ($pilihan = mysqli_fetch_array($laksana_semak)) {
    echo "<tr align='center'>
            <td>{$pilihan['namaJawatan']}</td>
            <td>{$pilihan['namaCalon']}</td>
            <td><img src='gambar/{$pilihan['gambar']}' 
                    style='width:100px; height:100px; border-radius:5px;'></td>
        </tr>";
    }

    echo "</table>";
} else {
    // Papar borang untuk memilih calon jika belum mengundi
    echo "<h3 align='center' style='font-family: Arial, sans-serif; font-size: 20px;'>Pilih Calon Yang Menurut Anda Layak</h3>
            <form action='undi-proses.php' method='POST'>";

    // Ambil Semua jawatan daripada pangkalan data
    $arahan_jawatan = "SELECT * FROM jawatan ORDER BY kodJawatan";
    $laksana_jawatan = mysqli_query($condb, $arahan_jawatan);

    while($jawatan = mysqli_fetch_array($laksana_jawatan)) {
        echo "<h3 align='center'>{$jawatan['namaJawatan']}</h3>
        <div style='display: flex; flex-wrap: wrap; justify-content: center;'>"; 

// Ambil calon yang bertanding bagi jawatan tersebut
    $arahan_calon = "
        SELECT * FROM calon
        WHERE kodJawatan = '{$jawatan['kodJawatan']}'
        ORDER BY namaCalon
    ";
    $laksana_calon = mysqli_query($condb, $arahan_calon);

    while($calon = mysqli_fetch_array($laksana_calon)) {
        echo "<div style='margin: 10px; text-align: center;'>
                    <img src='gambar/{$calon['gambar']}'
                        style = 'width: 150px; height: 150px; border-radius: 10px; border:3px solid black; object-fit:cover;' >

                    <p>{$calon['namaCalon']}</p>

                    <label>
                        <input type='radio' name='undi_{$jawatan['kodJawatan']}'
                        value='{$calon['noCalon']}' required> Pilih </label>
                    </div>";
    }
    echo "</div>";

    }

// Butang hantar undian
echo"<div align='center'>
        <input style='font-size: 15px;padding: 12px 26px;background: #166534;color: white;border: none;border-radius: 10px;cursor: pointer;' type='submit' value='Saya Undi'>
    </div>
</form>";
}
?>
<?php include('footer.php'); ?>