<?php
function koneksi(){
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "tk_2a_blog";
    $port = "3306";

    $conn = mysqli_connect($hostName,$userName,$password,$dbName,$port);

    if($conn){
        return $conn;
    }else{
        die('yahaha gagal hayyuukk');
    }
}
function myQuery($query){
    $sql = mysqli_query(koneksi(),$query);
    if($sql){
        return $sql;
    }else{
        die('yahaha gagal ngambil data');
    }
}
function insert($table,$data){
    if(!is_array($data) || count($data) == 0){
        return false;
    }

    $field = "";
    $value = "";

    foreach ($data as $key => $isi){
        $field .=",$key";
        $value .= ",'$isi'";
    }
    $field_ = substr($field,1);
    $value_ = substr($value,1);
    
    $sql = "INSERT INTO $table ($field_) VALUE ($value_)";
    $query = myQuery($sql);
    return $query;
}

function update($table,$data,$syarat){
    if(!is_array($data) || count($data) == 0){
        return false;
    }

    $set ="";
    foreach ($data as $key => $isi){
        $set .= ", $key = '$isi'";
    }
    
    $set_ = substr($set,1);

    $sql = "UPDATE $table SET $set_ WHERE $syarat";

    $query = myQuery ($sql);
    return $query;
}

function allData($table,$syarat="",$order="",$limit=""){
    $sql = "SELECT * FROM $table $syarat $order $limit";
    $query= myQuery($sql);
    $datas = array();
    while ($data = mysqli_fetch_assoc($query)){
        $datas[]=$data;
    }
    return $datas;
}

function oneData($table,$key){
    $sql = "SELECT * FROM $table WHERE $key";
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
    $explode_file = explode(".",$nama_file);

    //['gamabr'.'jpg']
    $extention_file = end($explode_file);

    if(in_array($extention_file,$extention)){
        if($size_file < $max_file){
            if (move_uploaded_file($tmp_file,"images/$nama_file")) {
                $pesan['status']=1;
                $pesan['mesaage'] = "File berhasil diupload";
            }
        }else{
            $pesan['status']=0;
            $pesan['mesaage'] = "File maximal $max_file Mb";
        }
    }else{
        $pesan['status']=0;
        $pesan['message'] = "File Bukan Gambar, Silahan di upload kembali";
    }

    return $pesan;
}

// $delete = delete($table = "mhs", $key = "no_bp = '123123'");

// $oneData = oneData(
//     $table = "mhs",
//     $key = "no_bp = '123123'"
// );
// if(is_array($oneData)){
//     echo "<pre>";
//     print_r($oneData);
//     echo "</pre>";
// }else{
//     echo"yahaha data burik";
// }

// $allData = allData(
//     $table = "categori",
//     $syarat = "",
//     $order = "",
//     $limit = ""
// );
// foreach ($allData as $isi){
//     echo $isi['no_bp']."-".$isi['nama']."-".$isi['prodi']."-"."<br>";
// }
// echo "<pre>";
// print_r($allData);
// echo "</pre>";
// $dataMhsUpdate = [
//     "nama" => "fek",
//     "jurusan" => "TI",
//     "prodi" => "MI",
//     "email" => "ril@gmail.com",
//     "tlp" => "081231123"
// ];
// update($table="mhs", $dataMhsUpdate, $syarat ="no_bp = '112333'");
// $dataDosenUpdate = [
//     "nip" => "21021366",
//     "nama" => "Taufiq",
//     "jurusan" => "TI",
//     "pangkat" => "9",
// ];
// update($table="dosen", $dataDosenUpdate, $syarat ="nidn = '112333'");
// $dataMhs = array(
//     "no_bp" => "112333",
//     "nama" => "ril",
//     "jurusan" => "TI",
//     "prodi" => "MI",
//     "email" => "fek@gmail.com",
//     "tlp" => "081231123"
// );
// $dataDosen = array(
//     "nidn" => "112333",
//     "nip" => "112333",
//     "nama" => "ril",
//     "jurusan" => "TI",
//     "pangkat" => "3",

// );

// // insert($table="mhs", $dataMhs);
// insert($table="dosen", $dataDosen);
