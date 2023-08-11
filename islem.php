<?php
include('admin/db.php'); // Veritabanı bağlantımızı sayfaya dahil ettik.

if (isset($_POST['girisyap'])) {
    $kullaniciadi = $_POST['kullaniciadi']; // post metodu ile girilen bilgileri alıyoruz.
    $sifre = $_POST['sifre']; // post metodu ile girilen bilgileri alıyoruz.

    $sorgu = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi='$kullaniciadi' && sifre='$sifre'"); // kullanıcının olup olmadığını veritabanından sorguluyoruz.
    if ($say = $sorgu->rowCount()) {

        if ($say > 0) { // kullanıcı var ise session ile oturumu aktif ediyoruz true ile.
            session_start();
            $_SESSION['giris'] = true;
            $_SESSION['kullaniciadi'] = $kullaniciadi;
            header('Location: index.php'); // ana sayfaya yönlendiriyoruz.
        }
    } else {
        header('Location: index.php'); // ana sayfaya yönlendiriyoruz.
    }
} elseif (isset($_POST['kayitol'])) {
    $kullaniciadi = $_POST['kullaniciadi']; // post metodu ile girilen bilgileri alıyoruz.
    $sifre = $_POST['sifre']; // post metodu ile girilen bilgileri alıyoruz.

    $data = [
        'kullaniciadi' => $kullaniciadi,
        'sifre' => $sifre
    ];
    $insert = $db->prepare("INSERT INTO kullanicilar SET kullaniciadi=:kullaniciadi,sifre=:sifre")->execute($data);

    if ($insert == true) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
} elseif (isset($_POST['puanla'])) {
    $urun_id = $_POST['urun_id']; // post metodu ile girilen bilgileri alıyoruz.
    $kullanici_id = $_POST['kullanici_id']; // post metodu ile girilen bilgileri alıyoruz.
    $puan = $_POST['puan']; // post metodu ile girilen bilgileri alıyoruz.

    $data = [
        'urun_id' => $urun_id,
        'kullanici_id' => $kullanici_id,
        'puan' => $puan
    ];
    $ekle = $db->prepare("INSERT INTO puanlar SET urun_id=:urun_id,kullanici_id=:kullanici_id,puan=:puan")->execute($data); // kullanici id'sini ve puanını "puanlar tablosuna yazdırıyoruz."

    if ($ekle == true) {
        header("Location: urunler.php");
    } else {
        header("Location: urunler.php");
    }
}
