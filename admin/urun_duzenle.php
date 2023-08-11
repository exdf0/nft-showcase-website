<?php
include('header.php');

$id = $_GET['id'];
$urunler_sorgu = $db->prepare("SELECT * FROM urunler WHERE id=:id");
$urunler_sorgu->execute(['id' => $id]);
$urunler_sonuc = $urunler_sorgu->fetch();




if ($_POST) {

    if ($_FILES['dosya']['name'] === "") {
        $dosya = $_POST['eski_dosya'];
    } else {
        $dosya = uniqid() . $_FILES["dosya"]["name"];
        $temp  = $_FILES["dosya"]["tmp_name"];
    }

    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];
    $link = $_POST['link'];

    $data = [
        'id' => $id,
        'dosya' => $dosya,
        'isim' => $isim,
        'fiyat' => $fiyat,
        'link' => $link
    ];
    $ekle = $db->prepare("UPDATE urunler SET dosya=:dosya,isim=:isim,fiyat=:fiyat,link=:link WHERE id=:id")->execute($data);
    if ($ekle == true) {
        if ($_FILES['dosya']['name'] === "") {
        } else {
            unlink("images/urunler/" . $_POST['eski_dosya']);
            move_uploaded_file($temp, "images/urunler/" . $dosya);
        }
        header("Location: urunler.php");
    } else {
        header("Location: urunler.php");
    }
}




?>

<style>
    .flexx {
        display: flex;
        justify-content: center;
    }
</style>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"> Ürün Düzenle</h1>
    <div>
        <a href="urunler.php" class="btn btn-success">Ürünler</a>
    </div>

    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">


                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group pb-2">
                                    <label>Ürün Resmi</label> <br>
                                    <img src="images/urunler/<?= $urunler_sonuc['dosya'] ?>" style="width: 150px; height:150px" alt="">
                                    <input type="file" class="form-control  mt-2" name="dosya">
                                    <input type="hidden" name="eski_dosya" value="<?= $urunler_sonuc['dosya'] ?>">
                                </div>


                                <div class="form-group pb-2">
                                    <label>Ürün Adı</label>
                                    <input required type="text" class="form-control" name="isim" value="<?= $urunler_sonuc['isim'] ?>">
                                </div>

                                <div class="form-group pb-2">
                                    <label>Ürün Fiyatı</label>
                                    <input required type="text" class="form-control" name="fiyat" value="<?= $urunler_sonuc['fiyat'] ?>">
                                </div>

                                <div class="form-group pb-2">
                                    <label>Ürün Linki</label>
                                    <input required type="text" class="form-control" name="link" value="<?= $urunler_sonuc['link'] ?>">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Düzenle</button>
                                    <button type="reset" class="btn btn-danger">Temizle</button>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php include('footer.php'); ?>