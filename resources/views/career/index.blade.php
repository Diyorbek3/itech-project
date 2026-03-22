<!-- index.html -->
<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ITech Career</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <h1>Bizning jamoaga qo‘shiling</h1>
  <p>ITech Call Center bilan kelajagingizni birga quring</p>
</header>

<div class="container">

  <div class="section">
    <h2>Biz haqimizda</h2>
    <p class="about-text">
      ITech Call Center — bu mijozlarga yuqori sifatli xizmat ko‘rsatadigan zamonaviy kompaniya.
      Biz doimiy rivojlanish va xodimlarimizning o‘sishini qo‘llab-quvvatlaymiz.
    </p>
  </div>

  <div class="section">
    <h2>Nima uchun biz?</h2>
    <div class="cards">
      <div class="card">✔️ Qulay ish muhiti</div>
      <div class="card">✔️ O‘qitish va treninglar</div>
      <div class="card">✔️ Moslashuvchan ish vaqti</div>
      <div class="card">✔️ Yaxshi maosh va bonuslar</div>
    </div>
  </div>

  <div class="section">
    <h2>Vakansiyalar</h2>
    <div class="cards">
      <div class="card">
        <h3>Call Center Operator</h3>
        <p>Mijozlar bilan muloqot qilish</p>
      </div>
      <div class="card">
        <h3>Support Manager</h3>
        <p>Mijozlarga yordam berish</p>
      </div>
    </div>
  </div>

  <div class="section">
    <h2>Talablar</h2>
    <ul class="requirements">
      <li>✔️ Yaxshi muloqot qobiliyati</li>
      <li>✔️ Kompyuter savodxonligi</li>
      <li>✔️ Mas’uliyatlilik</li>
      <li>✔️ Rus yoki Ingliz tili (afzal)</li>
    </ul>
  </div>

  <div class="section cta">
    <h2>Bizga qo‘shiling!</h2>
    <button onclick="applyNow()">Apply Now</button>
  </div>

</div>

<footer>
  <p>© 2026 ITech Call Center</p>
</footer>

<script src="script.js"></script>
</body>
</html>


/* style.css */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f5f7fa;
}

header {
  background: linear-gradient(135deg, #007bff, #00c6ff);
  color: white;
  text-align: center;
  padding: 60px 20px;
}

.container {
  width: 90%;
  max-width: 1100px;
  margin: auto;
  padding: 40px 0;
}

.section {
  margin-bottom: 40px;
}

.section h2 {
  text-align: center;
}

.about-text {
  text-align: center;
  max-width: 700px;
  margin: auto;
}

.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}

.requirements {
  text-align: center;
  list-style: none;
  padding: 0;
}

button {
  background: #28a745;
  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

button:hover {
  background: #218838;
}

footer {
  background: #222;
  color: white;
  text-align: center;
  padding: 20px;
}


// script.js
function applyNow() {
  alert("Ariza topshirish bo‘limi tez orada ishga tushadi!");
}