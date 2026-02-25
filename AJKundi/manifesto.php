<?php
session_start();
include('header.php');
include('connection.php');

// baca manifesto dari JSON
$fail = 'manifesto-data.json';
$manifestoMap = [];

if (file_exists($fail)) {
    $json = file_get_contents($fail);
    $data = json_decode($json, true);
    if (is_array($data)) $manifestoMap = $data;
}

// ambil calon + jawatan dari DB (kau memang dah guna DB untuk calon)
$sql = "SELECT calon.noCalon, calon.namaCalon, calon.gambar, jawatan.namaJawatan
        FROM calon
        JOIN jawatan ON calon.kodJawatan = jawatan.kodJawatan
        ORDER BY jawatan.kodJawatan, calon.namaCalon";
$q = mysqli_query($condb, $sql);
?>

<h2 style="text-align:center; font-size:30px; margin-top:25px;">Manifesto Calon</h2>

<?php if (!empty($_SESSION['jenisPengguna']) && $_SESSION['jenisPengguna'] == 'admin') { ?>
    <div style="text-align:center; margin: 10px 0 20px 0;">
        <a class="nav" href="manifesto-kemaskini.php">Kemaskini Manifesto</a>
    </div>
<?php } ?>

<div class="manifesto-grid">
<?php while ($m = mysqli_fetch_array($q)) {
    $id = (string)$m['noCalon'];
    $txt = isset($manifestoMap[$id]) ? trim($manifestoMap[$id]) : '';
    if ($txt === '') $txt = "Tiada manifesto lagi.";
?>
    <div class="manifesto-card">
        <div class="manifesto-head">
            <img class="manifesto-gambar" src="gambar/<?php echo htmlspecialchars($m['gambar']); ?>" alt="Gambar calon">
            <div class="manifesto-info">
                <div class="manifesto-nama"><?php echo htmlspecialchars($m['namaCalon']); ?></div>
                <div class="manifesto-jawatan"><?php echo htmlspecialchars($m['namaJawatan']); ?></div>
            </div>
        </div>

        <div class="manifesto-body">
            <?php echo nl2br(htmlspecialchars($txt)); ?>
        </div>
    </div>
<?php } ?>
</div>

<div class="manif">
    <h2>Sudah Tentukan Calon Yang Layak?✅</h2>
    <p>Sila Daftar atau Log Masuk dan Mula Mengundi 🗳️</p>
</div>

<?php include('footer.php'); ?>

<style>
    .manif{
        width: min(900px, 92vw);
        margin: 24px auto;
        padding: 18px 20px;
        background: lightblue;   
        border: 3px solid #001a7a;            
        border-radius: 18px;
        box-shadow: 0 10px 22px rgba(0,0,0,.18);
        text-align: center;
    }

    .manif h2{
        margin: 0 0 10px 0;
        font-size: 28px;
    }

    .manif p{
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }
</style>