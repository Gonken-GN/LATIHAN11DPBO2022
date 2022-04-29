<?php

class Member extends DB
{
    function getMember()
    {
        $query = "SELECT * FROM member";
        return $this->execute($query);
    }
    function getWhereMember($id){
        $query = "SELECT * from member where nim = $id";
        return $this->execute($query);
    }
    function add($data)
    {
        $name = $data['tname'];
        $jurusan = $data['tjurusan'];
        $nim = $data['tnim'];
        $query = "insert into member values ($nim, '$name', '$jurusan')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "delete FROM member WHERE nim = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data, $id)
    {
        
        $nama = $data['tname'];
        $jurusan = $data['tjurusan'];

        $query = "update member set nama= '$nama', jurusan ='$jurusan' where nim = '$id'";
        
        return $this->execute($query);
    }
}
