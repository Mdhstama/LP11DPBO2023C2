<?php

interface KontrakPasienView
{
    public function tampil();

    public function editFormPasien($id);

    public function addFormPasien();

    public function ubahData($id, $data);

    public function addData($data);

    public function deleteData($id);
}

interface KontrakPasienPresenter
{
    public function prosesDataPasien();
    public function prosesDataPasienById($id);
    public function editDataPasien($id, $data);
    public function addDataPasien($data);
    public function deleteDataPasien($id);
    public function getId($i);
    public function getNik($i);
    public function getNama($i);
    public function getTempat($i);
    public function getTl($i);
    public function getGender($i);
    public function getEmail($i);
    public function getTelp($i);
    public function getSize();
}