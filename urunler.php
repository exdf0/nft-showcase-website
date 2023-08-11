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
    <title>Nft!</title>
</head>

<body style="background-color: #13101e;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">COOL PİXEL CLUB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mycollection">My Collection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
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


    <div class="container pb-5 mb-2" id="mycollection">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5 text-center">
                <h3 style="color: white;">My Collection</h3>
            </div>
            <?php
            $urunler_sorgu = $db->prepare("SELECT * FROM urunler ORDER BY id DESC"); // nft ürünlerimizin sorgusunu yapıyoruz ve çekilmeye hazır.
            $urunler_sorgu->execute();
            while ($urunler_sonuc = $urunler_sorgu->fetch()) { // ürünlerimizi döngü ile yazdırıyoruz.
            ?> <?php
                $kullanici_puan_sayisi_sorgu = $db->prepare("SELECT * FROM puanlar WHERE urun_id=:urun_id AND kullanici_id=:kullanici_id"); // kullanıcı bir nftye birden fazla oy vermişse artık vermemesini sağlıyoruz
                $kullanici_puan_sayisi_sorgu->execute(['kullanici_id' => $kullanici_sonuc['id'], 'urun_id' => $urunler_sonuc['id']]);
                $kullanici_puan_sayisi_sonuc = $kullanici_puan_sayisi_sorgu->rowCount();
                $yorum_sonuc = 0;
                while ($urun_yorum_sonuc = $kullanici_puan_sayisi_sorgu->fetch()) {
                    $yorum_sonuc += $urun_yorum_sonuc['puan'];
                }
                $urun_son_sonuc = $yorum_sonuc / $kullanici_puan_sayisi_sonuc;
                ?>
                <div class="col-md-4 pb-3">
                    <div class="koleksiyon-kutulari">
                        <div class="koleksiyon-kutucugu">
                            <div>
                                <img src="admin/images/urunler/<?= $urunler_sonuc['dosya'] ?>" style="width: 100%; height:200px;border-radius:15px;margin-bottom:5px" alt="">
                                <?= $urunler_sonuc['isim'] ?><br>
                                <?= $urunler_sonuc['fiyat'] ?><br>
                                ⭐ ️<?= intval($urun_son_sonuc) ?> /5 <br>
                                <a href="<?= $urunler_sonuc['link'] ?>" target="_blank" style="padding-top: 5px;" class="btn new-btn  my-2 my-sm-0">İncele</a>
                                <?php if (isset($_SESSION['giris'])) { // Giriş yapılmışsa Puan ver butonunu gösteriyoruz.
                                ?>
                                    <button class="btn new-btn my-2 my-sm-0" data-toggle="modal" data-target="#exampleModalCenter-<?= $urunler_sonuc['id'] ?>">Puan Ver</button>
                                <?php } ?>

                                <div class="modal fade" id="exampleModalCenter-<?= $urunler_sonuc['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"><?= $urunler_sonuc['isim'] ?> - Puan Ver</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 pb-4 table-responsived">

                                                        <h5 style="border: 1px solid #e3e3e3; padding:8px; border-radius:15px"> Ortalama Puan : <?= intval($urun_son_sonuc) ?> / 5 Üzerinden</h5>
                                                        <?php if ($kullanici_puan_sayisi_sonuc < 1) { ?>
                                                            <form action="islem.php" method="POST">
                                                                <!-- form içerisindeki verileri islem.pgp ye yönlendiriyoruz orada sorgu yaptıracağız. -->
                                                                <table class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>1</th>
                                                                            <th>2</th>
                                                                            <th>3</th>
                                                                            <th>4</th>
                                                                            <th>5</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input checked type="radio" class="form-control" name="puan" value="1">
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" class="form-control" name="puan" value="2">
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" class="form-control" name="puan" value="3">
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" class="form-control" name="puan" value="4">
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" class="form-control" name="puan" value="5">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <input type="hidden" name="kullanici_id" value="<?= $kullanici_sonuc['id'] ?>">
                                                                <input type="hidden" name="urun_id" value="<?= $urunler_sonuc['id'] ?>">
                                                                <div class="form-gorup">
                                                                    <input type="submit" class="btn btn-dark" name="puanla" value="Puanı Gönder">
                                                                </div>
                                                            </form>
                                                        <?php } else {
                                                            echo '<div class="alert alert-danger">Zaten Puan Verdiniz!</div>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container pb-5 mb-2" id="contact">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5 text-center">
                <h3 style="color: white;">Contact</h3>
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
                <a target="_blank" href="https://www.deklodsoftware.com" style="color:white">2022, All Rights Reserved Designed by Deklod Software</a>
            </div>
        </div>
    </div>
    <!-- Ana Sayfa Kodları Buraya Geliyor. -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>