<?php
include('header.php');
$urunler_sorgu = $db->prepare("SELECT * FROM urunler ORDER BY id DESC");
$urunler_sorgu->execute();
?>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"> Ürünler</h1>
    <div>
        <a href="urun_ekle.php" class="btn btn-success">Ürün Ekle</a>
    </div>

    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ürün Görseli</th>
                                <th>Ürün Adı</th>
                                <th>Ürün Fiyatı</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php while ($urunler_sonuc = $urunler_sorgu->fetch()) { ?>
                            <tr>
                                <td><?= $urunler_sonuc['id'] ?></td>
                                <td><img src="images/urunler/<?= $urunler_sonuc['dosya'] ?>" width="25px" alt=""></td>
                                <td><?= $urunler_sonuc['isim'] ?></td>
                                <td><?= $urunler_sonuc['fiyat'] ?></td>
                                <td>
                                    <a href="urun_duzenle.php?id=<?= $urunler_sonuc['id'] ?>" class="btn btn-primary">Düzenle</a>
                                    <a href="sil.php?sayfa=urunler&id=<?= $urunler_sonuc['id'] ?>" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?php include('footer.php'); ?>