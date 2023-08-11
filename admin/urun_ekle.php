<?php
include('header.php');

if ($_POST) {
    $dosya = uniqid() . $_FILES["dosya"]["name"];
    $temp  = $_FILES["dosya"]["tmp_name"];

    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];
    $link = $_POST['link'];

    $data = [
        'dosya' => $dosya,
        'isim' => $isim,
        'fiyat' => $fiyat,
        'link' => $link
    ];
    $ekle = $db->prepare("INSERT INTO urunler SET dosya=:dosya,isim=:isim,fiyat=:fiyat,link=:link")->execute($data);

    if ($ekle == true) {
        move_uploaded_file($temp, "images/urunler/" . $dosya);
        header("Location: urunler.php");
    } else {
        header("Location: urunler.php");
    }
}

?>


<div class="container-fluid p-0">

    <h1 class="h3 mb-3"> Ürün Ekle</h1>
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
                                    <label>Ürün Resmi</label>
                                    <input required type="file" class="form-control" name="dosya">
                                </div>

                                <div class="form-group pb-2">
                                    <label>Ürün Adı</label>
                                    <input required type="text" class="form-control" name="isim">
                                </div>

                                <div class="form-group pb-2">
                                    <label>Ürün Fiyatı</label>
                                    <input required type="text" class="form-control" name="fiyat">
                                </div>

                                <div class="form-group pb-2">
                                    <label>Ürün Linki</label>
                                    <input required type="text" class="form-control" name="link">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Ekle</button>
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