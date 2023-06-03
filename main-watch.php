<?php

include("baglanti.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link rel="stylesheet" href="main-watch.css">
    <link rel="stylesheet" href="main-watch.js">
    
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
            <div class="video">
                <video width="640px" height="360px" controls class="video">
                    <source src="naruto.mp4">
                </video>     
            </div>
            <div class="message">
                <h2>Film Değerlendirme</h2>
                <p>Ne kadar beğendiniz?</p>
                <form action="main-watch.php" method="POST">
                <input type="text" class="textbox" value="" placeholder="Ad Soyad" name="adsoyad"/>
                <div class="rating">
                    
                <label for="">Puanlayınız:</label>
                    <select name="rating" id="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    </form>
                    <button class="submit" name="gonder">Gönder</button>

                    <?php

                    include("baglanti.php");

                    if (isset($_POST['gonder'])) {
                        $adsoyad = $_POST['adsoyad'];
                        $rating = $_POST['rating'];
                    
                        if ($adsoyad == "") {
                            echo '<script>alert("Lütfen isminizi giriniz.")</script>';
                        } else {
                            // İsim kontrolü yapılıyor
                            $kontrol = mysqli_query($baglan, "SELECT * FROM degerlendirme WHERE adsoyad = '$adsoyad'");
                    
                            if (mysqli_num_rows($kontrol) > 0) {
                                echo '<script>alert("Bu isimle zaten bir giriş yapılmış.")</script>';
                            } else {
                                // Yeni değerlendirme veritabanına ekleniyor
                                $veriekle = "INSERT INTO `degerlendirme`(`adsoyad`, `oylama`) VALUES ('$adsoyad', '$rating')";
                    
                                if ($baglan->query($veriekle) === TRUE) {
                                    echo '<script>alert("Oyunuz kaydedilmiştir.")</script>';
                                }
                            }
                        }
                    
                        $baglan->close();
                    }
                    

                    

                    ?>

                </div>
                
                    
                

                <p class="average-rating">Ortalama Puan: <span id="average-rating-value">
                
                <?php

                        include("baglanti.php");


                        $result= mysqli_query($baglan,"SELECT ROUND(AVG(oylama),1) AS oylama FROM degerlendirme");

                        $row = mysqli_fetch_assoc($result); 

                        $average = $row['oylama'];

                        echo ("$average");



                    ?>
            
            </span></p>
            </div>    
        </div>
    </div>    
</body>
</html>
