<?php

include("baglanti.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HerHaftaBirFilm</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="first_page.css">
</head>

<body>
  <script src="bootstrap.js"></script>
  <div id="Container">
    <div id="firstPage">
      <div id="scrollOne">Her Hafta Bir Film</div>
      <div id="iconOne"><img id="firstIcon" src="icons\firstIcon.png" alt="logo"></div>
    </div>
    <div id="secondPage">
      <div>
        <h1>Her Hafta Bir Film'de sizi neler bekliyor?</h1>
        <div>
          <p>Her hafta bir film, Filmi izle ve hemen puanla!</p>
        </div>
        <div>
          <a href="main-watch.php" class="button">Hemen İzle</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Mouse tekerleğiyle kaydırma olayını yakala
    window.addEventListener('wheel', function (e) {
      if (e.deltaY > 0) {
        // Aşağı kaydırma olduğunda alttaki bölüme geç
        e.preventDefault();
        window.scroll({
          top: document.getElementById('secondPage').offsetTop,
          behavior: 'smooth'
        });
      } else {
        // Yukarı kaydırma olduğunda üstteki bölüme geç
        e.preventDefault();
        window.scroll({
          top: 0,
          behavior: 'smooth'
        });
      }
    });
  </script>
</body>

</html>
