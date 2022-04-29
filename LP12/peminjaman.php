<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");
include("includes/Buku.class.php");
include("includes/peminjaman.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$peminjaman = new Peminjaman($db_host, $db_user, $db_pass, $db_name);
$member->open();
$member->getMember();
$buku->open();
$buku->getBuku();
$peminjaman->open();
$peminjaman->getPeminjaman();
$dataBuku = null;
$dataMember = null;
while (list($id_buku, $judul_buku, $penerbit, $deskripsi, $status, $id_author) = $buku->getResult()){
    $dataBuku .= "<option value='".$id_buku."'"; 
    $dataBuku .= ">" . $judul_buku. "</option>";
}
while(list($nim, $nama, $jurusan) = $member->getResult()){
    $dataMember .= "<option value='".$nim."'"; 
    $dataMember .= ">" . $nama. "</option>";
}
if(isset($_POST['add'])){
    $peminjaman->add($_POST);
    header("location: peminjaman.php");
}
//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $peminjaman->delete($id);
    header("location:peminjaman.php");
}

if (!empty($_GET['id_edit'])) {
    //memanggil add
    $id = $_GET['id_edit'];

    $peminjaman->statuspengembalian($id);
    header("location:peminjaman.php");
}

$data = null;
$no = 1;

while (list($id, $bukuPeminjaman, $memberPeminjaman, $status_pengembalian) = $peminjaman->getResult()) {
    $buku->getWhereBuku($bukuPeminjaman);
    $member->getWhereMember($memberPeminjaman);
    $namabuku = $buku->getResult();
    $namamember = $member->getResult();
    if ($status_pengembalian == 'Sudah') {
        $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $namabuku['judul_buku'] . "</td>
                <td>" . $namamember['nama'] . "</td>
                <td>" . $status_pengembalian . "</td>
                <td>
                <a href='peminjaman.php?id_hapus=" . $id . "' class='btn btn-danger''>Hapus</a>
                </td>
                </tr>";
    } else {
        $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $namabuku['judul_buku'] . "</td>
                <td>" . $namamember['nama'] . "</td>
                <td>" . $status_pengembalian . "</td>
                <td>
                <a href='peminjaman.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                <a href='peminjaman.php?id_hapus=" . $id . "' class='btn btn-danger''>Hapus</a>
                </td>
                </tr>";
    }
}


$buku->close();
$member->close();
$peminjaman->close();
$tpl = new Template("templates/peminjaman.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("DATA_tabelbuku", $dataBuku);
$tpl->replace("DATA_tabelmember", $dataMember);
$tpl->write();
