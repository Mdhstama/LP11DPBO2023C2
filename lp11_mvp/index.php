<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
include_once("view/TampilPasien.php");

$tp = new TampilPasien();
if (isset($_POST['submit'])) {
    if ($_GET['id_edit'] > 0) {
        $id = $_GET['id_edit'];
        $tp->ubahData($id, $_POST);
    } else {
        $tp->addData($_POST);
    }
} else if (!empty($_GET['add'])) {
    $tp->addFormPasien();
} else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $tp->deleteData($id);
    header("location:index.php");
} else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $tp->editFormPasien($id);
} else {
    $tp->tampil();
}