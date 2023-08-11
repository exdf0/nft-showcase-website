<?php
include('header.php');
$puanlar_sorgu = $db->prepare("SELECT * FROM puanlar ORDER BY id DESC");
$puanlar_sorgu->execute();
if (isset($_POST['urunliste'])) {
    //Seçilenleri pdo ile toplu silme kodu:

}
else{
    
}
?>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"> Puanlar</h1>

    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">	
                        <thead>
                    
                            <tr>
                                <th>Ürün Görseli</th>
                                <th><button name="urunliste" type="button"class="btn btn-success" >Ürün Adı</button></th>
                                <th>Kullanıcı Maili</th>
                                <th><button type="button" class="btn btn-danger">Puanı</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            while ($puanlar_sonuc = $puanlar_sorgu->fetch()) {
                                $urunler_sorgu = $db->prepare("SELECT * FROM urunler WHERE id=:id");
                                $urunler_sorgu->execute(['id' => $puanlar_sonuc['urun_id']]);
                                while ($urunler_sonuc = $urunler_sorgu->fetch()) {
                                    $kullanicilar_sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE id=:id");
                                    $kullanicilar_sorgu->execute(['id' => $puanlar_sonuc['kullanici_id']]);
                                    while ($kullanicilar_sonuc = $kullanicilar_sorgu->fetch()) {
                            ?>

                                        <tr>
                                            <td><img src="images/urunler/<?= $urunler_sonuc['dosya'] ?>" width="25px" alt=""></td>
                                            <td><?= $urunler_sonuc['isim'] ?></td>
                                            <td><?= $kullanicilar_sonuc['kullaniciadi'] ?></td>
                                            <td><?= $puanlar_sonuc['puan'] ?></td>
                                        </tr>
                            <?php }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.js"></script>


<script>
        $('#myTable').DataTable({
            language: {
                info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                infoEmpty:      "Gösterilecek hiç kayıt yok.",
                loadingRecords: "Kayıtlar yükleniyor.",
                zeroRecords: "Tablo boş",
                search: "Arama:",
                infoFiltered:   "(toplam _MAX_ kayıttan filtrelenenler)",
                buttons: {
                    copyTitle: "Panoya kopyalandı.",
                    copySuccess:"Panoya %d satır kopyalandı",
                    copy: "Kopyala",
                    print: "Yazdır",
                },

                paginate: {
                    first: "İlk",
                    previous: "Önceki",
                    next: "Sonraki",
                    last: "Son"
                },
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
</script>


<?php include('footer.php'); ?>