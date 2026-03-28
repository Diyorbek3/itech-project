@extends('layouts.app')

@section('styles')

<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>bolib otgan Master Classlar</title>

<style>
body {
  margin: 0;
  font-family: sans-serif;
  background: #f4f6f9;
}

header {
  background: linear-gradient(135deg,#4facfe,#00f2fe);
  color: white;
  text-align: center;
  padding: 20px;
  font-size: 24px;
}

h2 {
  text-align: center;
  margin: 20px 0;
}

.carousel {
  width: 90%;
  max-width: 900px;
  margin: auto;
  overflow: hidden;
  border-radius: 15px;
  background: #fff;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  position: relative;
}

.track {
  display: flex;
  transition: 0.5s;
}

.slide {
  min-width: 100%;
}

.slide img {
  width: 100%;
  height: 230px;
  object-fit: cover;
}

.content {
  padding: 20px;
}

.content h3 {
  margin-bottom: 10px;
}

.content p {
  margin: 6px 0;
  color: #555;
}

.btn {
  display: inline-block;
  margin-top: 10px;
  padding: 10px 15px;
  background: #4facfe;
  color: white;
  border-radius: 8px;
  text-decoration: none;
}

.btn-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 28px;
  background: none;
  border: none;
  cursor: pointer;
}

.prev { left: 10px; }
.next { right: 10px; }
</style>
</head>

<body>

<header>ITech Academy 🚀</header>

<h2>📚 Bo‘lib o‘tgan Master Classlar</h2>

<div class="carousel">
  <div class="track" id="track">

    <!-- 1 -->
    <div class="slide">
      <img src="http://127.0.0.1:8000/images/tg bot.png">
      <div class="content">
        <h3>🤖 Telegram Bot Master Klass</h3>
        <p><b>Bo‘lib o‘tgan:</b> 28-avgust 2025</p>
        <p><b>Mavzu:</b> Telegram bot yaratish</p>
        <p>Botlar qanday ishlaydi va pyTelegramBotAPI orqali yozish.</p>
        
      </div>
    </div>

    <!-- 2 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1518770660439-4636190af475">
      <div class="content">
        <h3>🎨 CSS Animation Master Class</h3>
        <p><b>Bo‘lib o‘tgan:</b> 27-avgust 2025</p>
        <p>Transition, transform va animatsiyalar yaratish.</p>
        
      </div>
    </div>

    <!-- 3 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1581091870627-3d3c3d0b9c29">
      <div class="content">
        <h3>🎮 XO Game Master Class</h3>
        <p><b>Bo‘lib o‘tgan:</b> 29-avgust 2025</p>
        <p>HTML, CSS va JavaScript orqali o‘yin yaratish.</p>
        
      </div>
    </div>

    <!-- 4 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1531498860502-7c67cf02f657">
      <div class="content">
        <h3>⚛️ DOM vs React DOM</h3>
        <p><b>Bo‘lib o‘tgan:</b> 30-avgust 2025</p>
        <p><b>Ustoz:</b> G‘ayratjon Mirzamahmudov</p>
        <p>Virtual DOM va React tezligi sirlari.</p>
        
      </div>
    </div>

    <!-- 5 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1526378722484-cc5c510f5c65">
      <div class="content">
        <h3>💻 IT Master Klass</h3>
        <p><b>Bo‘lib o‘tgan:</b> 27-aprel 2025</p>
        <p><b>Speaker:</b> Otabek Nurmuhammad</p>
        <p>Linux, Backend/Frontend va AI asoslari.</p>
       
      </div>
    </div>

    <!-- 6 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7">
      <div class="content">
        <h3>🎤 Savol-Javob Sessiyasi</h3>
        <p><b>Bo‘lib o‘tgan:</b> 19-aprel</p>
        <p><b>Mehmon:</b> Otabek Nurmuhammad</p>
        <p>AT bo‘yicha savollarga jonli javoblar.</p>
        
      </div>
    </div>

    <!-- 7 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d">
      <div class="content">
        <h3>👨‍💻 Backend & Frontend Uchrashuv</h3>
        <p><b>Bo‘lib o‘tgan:</b> 2025</p>
        <p>Payme va Uniconsoft dasturchilari bilan uchrashuv.</p>
        <p>Junior’dan Middle’ga o‘tish sirları.</p>
        
      </div>
    </div>

    <!-- 8 -->
    <div class="slide">
      <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f">
      <div class="content">
        <h3>🌐 IT Olamiga Sayohat</h3>
        <p><b>Bo‘lib o‘tgan:</b> 21-dekabr</p>
        <p><b>Speaker:</b> Eljahon Normaminov</p>
        <p>IT ni o‘rganish va rivojlanish bosqichlari.</p>
        
      </div>
    </div>

  </div>

  <button class="btn-nav prev" onclick="move(-1)">❮</button>
  <button class="btn-nav next" onclick="move(1)">❯</button>

</div>

<script>
let index = 0;
const track = document.getElementById("track");
const slides = document.querySelectorAll(".slide");

function show(i) {
  index = (i + slides.length) % slides.length;
  track.style.transform = `translateX(-${index * 100}%)`;
}

function move(step) {
  show(index + step);
}

setInterval(() => move(1), 4000);
</script>

</body>
</html>

@endsection