<?php
session_start();
include('db.php');
$sayfa = $_GET['sayfa'];
$id = $_GET['id'];


$sayfa_dosya_sorgu = $db->prepare("SELECT * FROM $sayfa WHERE id=:id");
$sayfa_dosya_sorgu->execute(['id' => $id]);
$sayfa_dosya_sonuc = $sayfa_dosya_sorgu->fetch();

unlink('images/'.$sayfa.'/'.$sayfa_dosya_sonuc['dosya'].'');


$delete_sorgu = $db->query("DELETE FROM $sayfa WHERE id = $id");

if($delete_sorgu){
    header("Location: $sayfa.php");
}else{
     header("Location: $sayfa.php");
}
