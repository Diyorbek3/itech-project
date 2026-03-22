@extends('layouts.app')

@section('styles')
<style>
  body {
    font-family: Arial;
    background: #f1f5f9;
    margin: 0;
  }

  header {
    background: #3b82f6;
    color: white;
    text-align: center;
    padding: 15px;
    font-size: 24px;
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    justify-content: center;
  }

  .card {
    background: white;
    width: 250px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    overflow: hidden;
    text-align: center;
  }

  .card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }

  .card h3 {
    margin: 10px 0 5px;
  }

  .card p {
    font-size: 14px;
    padding: 0 10px;
  }
</style>
@endsection

@section('content')
<header>💻 Dasturchilar haqida</header>

<div class="container">

  <div class="card">
    <img src="https://heartdirected.com/wp-content/uploads/2023/06/Front-End-Develop2.jpg">
    <h3>Frontend Developer</h3>
    <p>🕒 2 yil tajriba</p>
    <p>HTML, CSS, JavaScript orqali web saytlar yaratadi.</p>
  </div>

  <div class="card">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdRaKRSFts6z-_VEg7LkeSNBxF_RH2n0N5_A&s">
    <h3>Backend Developer</h3>
    <p>🕒 3 yil tajriba</p>
    <p>Server, database va API bilan ishlaydi.</p>
  </div>

  <div class="card">
    <img src="https://xaltam.com/blogs/wp-content/uploads/2024/11/mobile-app-development-trends-xaltam.png">
    <h3>Mobile Developer</h3>
    <p>🕒 2.5 yil tajriba</p>
    <p>Android va iOS ilovalar yaratadi.</p>
  </div>

  <div class="card">
    <img src="https://eu-images.contentstack.com/v3/assets/blt69509c9116440be8/blt25ac3c488d76676a/671a7a173fe49b837e2e389a/AI_technology-AkarapongChairean-AlamyStockPhoto.jpg">
    <h3>AI Engineer</h3>
    <p>🕒 4 yil tajriba</p>
    <p>Sun'iy intellekt va machine learning bilan ishlaydi.</p>
  </div>

  <div class="card">
    <img src="https://heartdirected.com/wp-content/uploads/2023/06/Front-End-Develop2.jpg">
    <h3>Full-stack Developer</h3>
    <p>🕒 2 yil tajriba</p>
    <p>Frontend + backend to'liq yaratadi.</p>
  </div>

  <div class="card">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdRaKRSFts6z-_VEg7LkeSNBxF_RH2n0N5_A&s">
    <h3>DevOps Engineer</h3>
    <p>🕒 3 yil tajriba</p>
    <p>Server, database va API bilan ishlaydi.</p>
  </div>

  <div class="card">
    <img src="https://xaltam.com/blogs/wp-content/uploads/2024/11/mobile-app-development-trends-xaltam.png">
    <h3>Mobile Developer</h3>
    <p>🕒 2.5 yil tajriba</p>
    <p>Android va iOS ilovalar yaratadi.</p>
  </div>

  <div class="card">
    <img src="https://eu-images.contentstack.com/v3/assets/blt69509c9116440be8/blt25ac3c488d76676a/671a7a173fe49b837e2e389a/AI_technology-AkarapongChairean-AlamyStockPhoto.jpg">
    <h3>AI Engineer</h3>
    <p>🕒 4 yil tajriba</p>
    <p>Sun'iy intellekt va machine learning bilan ishlaydi.</p>
  </div>

</div>
@endsection