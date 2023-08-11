<?php
session_start(); // Oturumu başlatıyoruz.
error_reporting(0); // Hata kodlarını esgeçiyoruz.
include('admin/db.php'); // Veritabanı bağlantımızı sayfaya dahil ettik.
$kullanici_sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi=:kullaniciadi"); // giriş yapmış kullanıcının bilgilerini veritabanından sorgulayıp çekiyoruz. NFT puanlarken buradan bilgi alacağız.
$kullanici_sorgu->execute(['kullaniciadi' => $_SESSION['kullaniciadi']]);
$kullanici_sonuc = $kullanici_sorgu->fetch();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyamızı ekliyoruz. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- İcon dosyamızı ekliyoruz. -->
    <title>ExDF & Auraxael NFT!</title>
</head>

<body style="background-color: #13101e;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"> ExDF & Auraxael NFT Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about">Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mycollection">Koleksiyonumuz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">İletişim</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php if (isset($_SESSION['giris'])) { // Giriş yapılmışsa çıkış yap butonunu gösteriyoruz.
                ?>
                    <a href="cikis.php" class="btn new-btn btn-outline-success my-2 my-sm-0">Çıkış Yap</a>
                <?php } else { // giriş yapılmamışsa giriş yap butonunu gösteriyoruz.
                ?>
                    <button class="btn new-btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModalCenter">Giriş Yap</button>
                <?php } ?>
            </div>

            <!-- Giriş yap ve kayıt ol html kodlarımız -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Giriş Yap veya Kayıt Ol</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 pb-4">
                                    <h5 style="border: 1px solid #e3e3e3; padding:8px; border-radius:15px">Giriş Yap</h5>
                                    <form action="islem.php" method="POST">
                                        <!-- form içerisindeki verileri islem.pgp ye yönlendiriyoruz orada sorgu yaptıracağız. -->
                                        <div class="form-group">
                                            <label>Mail Adresiniz</label>
                                            <input required type="email" name="kullaniciadi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Şifreniz</label>
                                            <input required type="password" name="sifre" class="form-control">
                                        </div>
                                        <div class="form-gorup">
                                            <input type="submit" class="btn btn-dark" name="girisyap" value="Giriş Yap">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h5 style="border: 1px solid #e3e3e3; padding:8px; border-radius:15px">Kayıt Ol</h5>
                                    <form action="islem.php" method="POST">
                                        <!-- form içerisindeki verileri islem.pgp ye yönlendiriyoruz orada sorgu yaptıracağız. -->
                                        <div class="form-group">
                                            <label>Mail Adresiniz</label>
                                            <input required type="email" name="kullaniciadi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Şifreniz</label>
                                            <input required type="password" name="sifre" class="form-control">
                                        </div>
                                        <div class="form-gorup">
                                            <input type="submit" class="btn btn-dark" name="kayitol" value="Kayıt Ol">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Giriş yap ve kayıt ol html kodlarımız -->

        </div>
    </nav>

    <!-- Ana Sayfa Kodları Buraya Geliyor. -->
    <div class="container-fluid pb-5 pt-5 mb-5" style="background-repeat: no-repeat;
    width: 100% !important;
    background-position-x: inherit !important;
    background-size: cover !important; background: url('http://www.coolpixelclub.com/wp-content/uploads/2022/02/monterajpg06.jpg');">
        <div class="row">
            <div class="col-md-6" style="">
                <div class="slider-sol" style=""></div>
            </div>
            <div class="col-md-6">
                <div class="slider-sag" style="">
                    <h3 class="fs85" style="font-size: 85px; ">
                        ExDF & Auraxael NFT Marketplace
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">
            <div class="col-md-12">
                <a href="#" target="_blank"><i style="color: white; font-size:30px; margin-right:25px" class="fa-brands fa-instagram"></i></a>
                <a href="#" target="_blank"><i style="color: white; font-size:30px; margin-right:25px" class="fa-brands fa-twitter"></i></a>
                <a href="#" target="_blank"><i style="color: white; font-size:30px; margin-right:25px" class="fa-brands fa-github"></i></a>
                <a href="#" target="_blank"><i style="color: white; font-size:30px; margin-right:25px" class="fa-brands fa-telegram"></i></a>
            </div>
        </div>
    </div>

    <div class="container" id="about">
        <div class="row">
            <div class="col-md-6">
                <img src="https://www.coolpixelclub.com/wp-content/uploads/2022/02/opensea-profil.gif" style="width: 100%;" alt="">
            </div>
            <div class="col-md-6">
                <div class="about-hizala pt-5 mt-5">
                    <h3 style="color: blue;">Hakkımızda</h3>
                    <p style="color: white; font-size:25px">
                        These pixel characters are trying to escape from the digital world and therefore they chose a style for themselves. they think this style makes them attractive. They believe they will find someone to own them. When they find their owners, they will feel free and live with people.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5 mb-2" id="mycollection">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5 text-center">
                <h3 style="color: white;">Koleksiyonumuz</h3>
            </div>
            <div class="col-md-3 pb-3">
                <div class="koleksiyon-kutucugu">
                    <div>
                        <img src="https://cdn.webrazzi.com/uploads/2022/03/bayc-madonna-566.png" style="width: 100%; height:200px;border-radius:15px;margin-bottom:5px" alt="">
                        <a href="urunler.php" target="_blank" style="padding-top: 5px;" class="btn new-btn  my-2 my-sm-0">Ürünlerim</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="koleksiyon-kutucugu">
                    <div>
                        <img src="https://cdn.webrazzi.com/uploads/2022/03/bayc-madonna-566.png" style="width: 100%; height:200px;border-radius:15px;margin-bottom:5px" alt="">
                        <a href="urunler.php" target="_blank" style="padding-top: 5px;" class="btn new-btn  my-2 my-sm-0">Ürünlerim</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="koleksiyon-kutucugu">
                    <div>
                        <img src="https://cdn.webrazzi.com/uploads/2022/03/bayc-madonna-566.png" style="width: 100%; height:200px;border-radius:15px;margin-bottom:5px" alt="">
                        <a href="urunler.php" target="_blank" style="padding-top: 5px;" class="btn new-btn  my-2 my-sm-0">Ürünlerim</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="koleksiyon-kutucugu">
                    <div>
                        <img src="https://cdn.webrazzi.com/uploads/2022/03/bayc-madonna-566.png" style="width: 100%; height:200px;border-radius:15px;margin-bottom:5px" alt="">
                        <a href="urunler.php" target="_blank" style="padding-top: 5px;" class="btn new-btn  my-2 my-sm-0">Ürünlerim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5 mb-2" id="contact">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5 text-center">
                <h3 style="color: white;">İletişim Bilgilerimiz</h3>
            </div>
            <div class="col-md-4 pb-3">
                <div class="iletisim-kutulari">
                    <div class="iletisim-kutucugu">
                        <i style="color: white; font-size:30px;" class="fa-brands fa-telegram"></i>
                        <div>
                            <a href="#" target="_blank" style="color:white">Telegram</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="iletisim-kutulari">
                    <div class="iletisim-kutucugu">
                        <i style="color: white; font-size:30px;" class="fa-brands fa-twitter"></i>
                        <div>
                            <a href="#" target="_blank" style="color:white">Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="iletisim-kutulari">
                    <div class="iletisim-kutucugu">
                        <i style="color: white; font-size:30px;" class="fa-brands fa-telegram"></i>
                        <div>
                            <a href="#" target="_blank" style="color:white">Telegram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-3">
        <div class="row">
            <div class="col-md-12">
                <hr style="border: 1px solid #ffffff47;">
                <a target="_blank" href="https://www.deklodsoftware.com" style="color:white">2022, All Rights Reserved Designed by ExDF</a>
            </div>
        </div>
    </div>
    <!-- Ana Sayfa Kodları Buraya Geliyor. -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>