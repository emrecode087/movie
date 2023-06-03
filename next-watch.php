<?php
include("baglanti.php");

if (isset($_POST['gonder'])) {
    $adsoyad = $_POST['adsoyad'];
    $secim = $_POST['secim'];

    if ($adsoyad == "") {
        echo '<script>alert("Lütfen isminizi giriniz.")</script>';
    } else {
        // İsim kontrolü yapılıyor
        $kontrol = mysqli_query($baglan, "SELECT * FROM oyla WHERE adsoyad = '$adsoyad'");

        if (mysqli_num_rows($kontrol) > 0) {
            echo '<script>alert("Bu isimle zaten bir giriş yapılmış.")</script>';
        } else {
            // Yeni değerlendirme veritabanına ekleniyor
            $veriekle = "INSERT INTO `oyla`(`adsoyad`, `secim`) VALUES ('$adsoyad', '$secim')";

            if (mysqli_query($baglan, $veriekle)) {
                echo '<script>alert("Oyunuz kaydedilmiştir.")</script>';
            } else {
                echo "Error: " . $veriekle . "<br>" . mysqli_error($baglan);
            }
        }
    }
}

// Veritabanından her film için oy sayılarını al
$oylar = mysqli_query($baglan, "SELECT COUNT(*) AS oy_sayisi, secim FROM oyla GROUP BY secim");

// Oy sayılarını bir diziye kaydet
$oy_sayilari = array();
while ($row = mysqli_fetch_assoc($oylar)) {
    $secim = $row['secim'];
    $oy_sayisi = $row['oy_sayisi'];
    $oy_sayilari[$secim] = $oy_sayisi;
}

$baglan->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelecek Haftanın Filmi</title>
    <link rel="stylesheet" href="next-watch.css">
</head>
<body>
    <header id="panel">
        <img id="logo" src="icons\logo.png">
        <a id="logo-yazi">HER HAFTA BİR FİLM</a>     
    </header>
    <div class="ana_cerceve">
        <div class="menu">
            <ul>
                <p><a href="main-watch.php" class="a">Bu Haftanın Filmi</a></p>
                <p><a href="next-watch.php" class="a">Gelecek Haftanın Filmi</a></p>
            </ul>
        </div>
        <div class="icerik">
            <h1 class="baslik">Gelecek Hafta Hangi Film Gelsin?</h1>
            <form action="next-watch.php" method="POST" id="oy-form">
                <input type="text" id="ad-soyad" class="textbox" name="adsoyad" placeholder="Ad Soyad" />
                <select name="secim" id="secim">
                        <option value="1">Film 1</option>
                        <option value="2">Film 2</option>
                        <option value="3">Film 3</option>
                </select>
                <button id="oy-kullan" class="button" type="submit" name="gonder">Oyunu kullan!</button>
            </form>

            <div class="film-listesi">
                <div class="film">
                    <h2 class="film-baslik">Film 1</h2>
                    <p class="oy-sayisi">Oy Sayısı: <?php echo isset($oy_sayilari[1]) ? $oy_sayilari[1] : 0; ?></p>
                    <img class="film_foto" src="icons\batman.webp" >
                </div>
                <div class="film">
                    <h2 class="film-baslik">Film 2</h2>
                    <p class="oy-sayisi">Oy Sayısı: <?php echo isset($oy_sayilari[2]) ? $oy_sayilari[2] : 0; ?></p>
                    <img class="film_foto" src="icons\avatar.webp">
                </div>
                <div class="film">
                    <h2 class="film-baslik">Film 3</h2>
                    <p class="oy-sayisi">Oy Sayısı: <?php echo isset($oy_sayilari[3]) ? $oy_sayilari[3] : 0; ?></p>
                    <img class="film_foto" src="icons\thor.webp">
                </div>
            </div>
        </div>
    </div>
</body>
</html>