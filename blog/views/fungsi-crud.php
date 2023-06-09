<?php

function koneksi(){
    $hostname = 'sql105.byethost13.com';
    $username = 'b13_33329497';
    $password = '123456';
    $dbName = 'b13_33329497_blog';
    $port = '3306';

    $conn = mysqli_connect($hostname,$username,$password,$dbName,$port);

    if ($conn) {
        return $conn;
    } else {
        die('Gagal terhubung ke Database');
    }
}

function myQuery($query){
    $sql = mysqli_query(koneksi(),$query);
    if ($sql) {
        return $sql;
    } else {
        die('kesalahan query');
    }
}

function insert($table,$data){
    if(!is_array($data) || count($data)== 0){
        return false;
    }

    $field = '';
    $val = '';

    foreach ($data as $key => $isi) {
        $field .= ", $key";
        $val .= ", '$isi'";
    }
    $field_ = substr($field,1);
    $val_ = substr($val,1);

    $sql = "INSERT INTO $table ($field_) VALUE ($val_)";

    $query = myQuery($sql);

    return $query;
}

function update($table,$data,$syarat){
    if(!is_array($data) || count($data)== 0){
        return false;
    }

    $set = '';

    foreach ($data as $key => $isi) {
        $set .= ", $key = '$isi'";
    }
    $set_ = substr($set,1);

    $sql = "UPDATE $table SET $set_ WHERE $syarat";

    $query = myQuery($sql);

    return $query;
}

function allData($table,$syarat="",$order="",$limit=""){
    $sql = "SELECT * FROM $table  $syarat $order $limit";
    $query = myQuery($sql);
    $datas = array();
    while ($data = mysqli_fetch_array($query)){//assoc //row
        $datas[] = $data;
    }
    return $datas;
}

function oneData($table,$key){
    $sql = "SELECT * FROM $table  WHERE $key";
    $query = myQuery($sql);
    $data = mysqli_fetch_assoc($query);

    return $data;
}

function delete($table,$key){
    $sql = "DELETE FROM $table WHERE $key";
    $query = myQuery($sql);
    return $query;
}

function upload($nama_file,$tmp_file,$max_file=2,$size_file,$extention){
    //gambar.jpg
    $explode_file= explode(".",$nama_file);
    //['gambar','jpg']
    $extention_file = end($explode_file);

    if (in_array($extention_file,$extention)) {
        if ($size_file < $max_file) {
            if (move_uploaded_file($tmp_file,"images/$nama_file")) {
                $pesan['status'] = 1;
                $pesan['message'] = "File berhasil di Upload";
            }
        }else {
            $pesan['status'] = 0;
            $pesan['message'] = "File maximal $max_file Mb";
        }
    }else {
        $pesan['status'] = 0;
        $pesan['message'] = "File Bukan Gambar, Silahkan di upload kembali";
    }

    return $pesan;
}