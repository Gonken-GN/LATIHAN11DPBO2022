<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();
$member->getMember();
$member2 = new Member($db_host, $db_user, $db_pass, $db_name);
$member2->open();
$member2->getMember();
$submit = "Add";
$freeze = null;
$nimData = null;
$namaData = null;
$jurusanData = null;
if (isset($_POST['Add'])) {
    //memanggil add
    $member2->getWhereMember($_POST['tnim']);
    $cek = $member2->getResult();
    if(isset($cek)){
        echo "<script type='text/javascript'>alert('NIM Tersebut Sudah ada dalam Database!!');</script>"; 
    }else{
        $member->add($_POST);
        header("location:member.php");
    }
    

}

//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $member->delete($id);
    header("location:member.php");
}

if (!empty($_GET['id_edit'])) {
    //memanggil add
    $id = $_GET['id_edit'];
    $member2->getWhereMember($_GET['id_edit']);
    $submit = "Update";
    $update = $member2->getResult();
    $nimData = $update['nim'];
    $namaData = $update['nama'];
    $jurusanData = $update['jurusan'];
    $freeze = "Disabled";
    if(isset($_POST['Update'])){
        
        $member->update($_POST, $id);
        header("location:member.php");
    }
}

$data = null;
$no = 1;

while (list($nim, $nama, $jurusan) = $member->getResult()) {

        $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $nim . "</td>
                <td>" . $nama . "</td>
                <td>" . $jurusan . "</td>
                <td>
                <a href='member.php?id_edit=" . $nim .  "' class='btn btn-warning''>Edit</a>
                <a href='member.php?id_hapus=" . $nim . "' class='btn btn-danger''>Hapus</a>
                </td>
             </tr>";
}


$member->close();
$member2->close();
$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("DATA_tnim", $nimData);
$tpl->replace("DATA_tnama", $namaData);
$tpl->replace("DATA_tjurusan", $jurusanData);
$tpl->replace("DATA_freeze", $freeze);
$tpl->replace("DATA_submit", $submit);
$tpl->write();
