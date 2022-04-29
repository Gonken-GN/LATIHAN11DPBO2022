<?php

class Peminjaman extends DB
{
    function getPeminjaman()
    {
        $query = "SELECT * FROM peminjaman";
        return $this->execute($query);
    }
    function add($data){
        $buku = $data['tbuku'];
        $member = $data['tmember'];
        $status_pengembalian = "Belum";
        $query = "INSERT INTO peminjaman VALUES (NULL, $buku, $member, '$status_pengembalian')";
        return $this->execute($query);
    }
    function delete($id)
    {

        $query = "delete FROM peminjaman WHERE kode_peminjaman = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function statuspengembalian($id)
    {

        $status = "Sudah";
        $query = "update peminjaman set Status_Pengembalian = '$status' where kode_peminjaman = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}


?>