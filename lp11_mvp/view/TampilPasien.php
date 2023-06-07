<?php


include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class TampilPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
        <td>" . $no . "</td>
        <td>" . $this->prosespasien->getNik($i) . "</td>
        <td>" . $this->prosespasien->getNama($i) . "</td>
        <td>" . $this->prosespasien->getTempat($i) . "</td>
        <td>" . $this->prosespasien->getTl($i) . "</td>
        <td>" . $this->prosespasien->getGender($i) . "</td>
        <td>" . $this->prosespasien->getEmail($i) . "</td>
        <td>" . $this->prosespasien->getTelp($i) . "</td>
        <td>
            <a class='btn btn-success btn-sm' href='index.php?id_edit=" . $this->prosespasien->getId($i) . "'>Edit</a>
            <a class='btn btn-danger btn-sm' href='index.php?id_hapus=" . $this->prosespasien->getId($i) . "'>Delete</a>
        </td>";
		}

		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function editFormPasien($id)
	{
		$labelform = null;
		$form = null;

		$labelform = "Edit Data Pasien";

		$form .= '
		<div class="form-group mb-3">
			<label for="nik" class="fw-bold">NIK:</label>
			<input type="text" name="nik" class="form-control" id="nik" value="VAL_NIK">
		</div>
		<div class="form-group mb-3">
			<label for="nama" class="fw-bold">NAMA:</label>
			<input type="text" name="nama" class="form-control" id="nama" value="VAL_NAMA">
		</div>
		<div class="form-group mb-3">
			<label for="tempat" class="fw-bold">TEMPAT:</label>
			<input type="text" name="tempat" class="form-control" id="tempat" value="VAL_TEMPAT">
		</div>
		<div class="form-group mb-3">
			<label for="tl" class="fw-bold">TANGGAL LAHIR:</label>
			<input type="date" name="tl" class="form-control" id="tl" value="VAL_TL">
		</div>
		<div class="form-group mb-3">
			<label for="gender" class="fw-bold">GENDER:</label>
			<input type="text" name="gender" class="form-control" id="gender" value="VAL_GENDER">
		</div>
		<div class="form-group mb-3">
			<label for="email" class="fw-bold">EMAIL:</label>
			<input type="email" name="email" class="form-control" id="email" value="VAL_EMAIL">
		</div>
		<div class="form-group mb-3">
			<label for="telp" class="fw-bold">TELP:</label>
			<input type="text" name="telp" class="form-control" id="telp" value="VAL_TELP">
		</div>';

		$tpl = new Template("templates/form.html");
		$this->prosespasien->prosesDataPasienById($id);
		$tpl->replace("LABEL_FORM", $labelform);
		$tpl->replace("DATA_FORM", $form);
		$tpl->replace("VAL_NIK", $this->prosespasien->getNik(0));
		$tpl->replace("VAL_NAMA", $this->prosespasien->getNama(0));
		$tpl->replace("VAL_TEMPAT", $this->prosespasien->getTempat(0));
		$tpl->replace("VAL_TL", $this->prosespasien->getTl(0));
		$tpl->replace("VAL_GENDER", $this->prosespasien->getGender(0));
		$tpl->replace("VAL_EMAIL", $this->prosespasien->getEmail(0));
		$tpl->replace("VAL_TELP", $this->prosespasien->getTelp(0));
		$tpl->write();
	}

	function ubahData($id, $data)
	{
		$this->prosespasien->editDataPasien($id, $data);
	}

	function addFormPasien()
	{
		$labelform = null;
		$form = null;

		$labelform = "Add Data Pasien";

		$form .= '
		<div class="form-group mb-3">
			<label for="nik" class="fw-bold">NIK:</label>
			<input type="text" name="nik" class="form-control" id="nik">
		</div>
		<div class="form-group mb-3">
			<label for="nama" class="fw-bold">NAMA:</label>
			<input type="text" name="nama" class="form-control" id="nama" ">
		</div>
		<div class="form-group mb-3">
			<label for="tempat" class="fw-bold">TEMPAT:</label>
			<input type="text" name="tempat" class="form-control" id="tempat"">
		</div>
		<div class="form-group mb-3">
			<label for="tl" class="fw-bold">TANGGAL LAHIR:</label>
			<input type="date" name="tl" class="form-control" id="tl">
		</div>
		<div class="form-group mb-3">
			<label for="gender" class="fw-bold">GENDER:</label>
			<input type="text" name="gender" class="form-control" id="gender">
		</div>
		<div class="form-group mb-3">
			<label for="email" class="fw-bold">EMAIL:</label>
			<input type="email" name="email" class="form-control" id="email">
		</div>
		<div class="form-group mb-3">
			<label for="telp" class="fw-bold">TELP:</label>
			<input type="text" name="telp" class="form-control" id="telp">
		</div>';

		$tpl = new Template("templates/form.html");
		$tpl->replace("LABEL_FORM", $labelform);
		$tpl->replace("DATA_FORM", $form);
		$tpl->write();
	}

	function addData($data)
	{
		$this->prosespasien->addDataPasien($data);
	}

	function deleteData($id)
	{
		$this->prosespasien->deleteDataPasien($id);
	}
}