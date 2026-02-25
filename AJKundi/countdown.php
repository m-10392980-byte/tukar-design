<?php
session_start();
include("header.php");
include("footer.php");
?>



<style>
html, body {
  height: 100vh;
  overflow: hidden;
}

.page-content{
  padding-top: 60px;    
  padding-bottom: 110px;  
}

.card-countdown {
  width: min(720px, 92vw);
  margin: 40px auto 0 auto;   
  padding: 30px;
  border: 10px solid darkblue;
  border-radius: 20px;
  background-color: lightsteelblue;
  box-shadow: 0 0 20px black;
  position: static;  
  text-align: center;
}

.card-countdown h2 {
  background: lightblue;
  border: 3px solid darkblue;
  border-radius: 10px;
  color: #007B55;
  font-size: 28px;
  margin-bottom: 20px;
}

#countdown {
  font-size: 32px;
  font-weight: bold;
  color: #e63946;
  background: lightsteelblue;
  padding: 20px;
  border-radius: 10px;
  display: inline-block;
}
</style>

<div class="page-content">
  <div class="card-countdown">
    <h2>Tarikh Akhir Mengundi<br><?php echo date("d M Y, h:i A", strtotime($tarikh)); ?></h2>
    <div id="countdown">Loading...</div>
  </div>
</div>


<script>
const countDownDate = new Date("<?php echo $tarikh; ?>").getTime();
const countdownEl = document.getElementById("countdown");

const x = setInterval(() => {
  const now = new Date().getTime();
  const distance = countDownDate - now;

  if (distance < 0) {
    clearInterval(x);
    countdownEl.innerHTML = "🛑 Masa Mengundi Tamat!";
    countdownEl.style.color = "#6c757d";
    return;
  }

  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  countdownEl.innerHTML = `${days} hari ${hours} jam ${minutes} minit ${seconds} saat`;
}, 1000);
</script>

<?php
$tarikh = "2026-10-10 23:59:59"; // tarikh akhir mengundi
?>

