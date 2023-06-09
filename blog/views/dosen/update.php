<?php

extract($_GET);
extract($_POST);
$dataUpdate = oneData('dosen',"id_dosen='$id_dosen'");

if (is_array($dataUpdate)) {
    if (isset($simpan)) {
        //proses update
        if($_FILES['gambar']['name']!=""){
            $upload_file = upload(
                $nama_file = $_FILES['gambar']['name'],
                $tmp_file = $_FILES['gambar']['tmp_name'],
                $max_file = 2,
                $size_file = $_FILES['gambar']['size'] / (1024*1025),
                ['jpg','jpeg','png']
            );
            if ($upload_file['status'] == 0) {
                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    <strong>Informasi</strong> {$upload_file['message']}
                </div>";
                
            } else {
                $dosenUpdate = [
                    'nidn' => $nidn,
                    'nama' => $nama,
                    'no_tlp' => $no_tlp,                                        
                    'jekel' => $jekel,
                    'gambar' => $_FILES['gambar']['name']
                    
                ];
                update($table = "dosen", $dosenUpdate, $key = "id_dosen='$id_dosen'");
                echo "<script>location='index.php?folder=dosen&file=index'</script>";
            }
        }else{
            $dosenUpdate = [
                'nidn' => $nidn,
                'nama' => $nama,
                'no_tlp' => $no_tlp,                                        
                'jekel' => $jekel,
                'gambar' => $_FILES['gambar']['name']
                
            ];
            update($table = "dosen", $dosenUpdate, $key = "id_dosen='$id_dosen'");
            echo "<script>location='index.php?folder=dosen&file=index'</script>";
        }
        update($table = "dosen", $dosenUpdate, $key = "id_dosen='$id_dosen'");
        echo "<script>location='index.php?folder=dosen&file=index'</script>";
    }
?>
<!-- Tag HTML -->
        <h3>
            <center>Update Dosen</center>
        </h3>

        <form action="index.php?folder=dosen&file=update&id_dosen=<?= $id_dosen?>" method="post" class="user-validation" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">NIDN</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tablet"></i></span>
                <input type="text" name="nidn" value="<?= $dataUpdate['nidn']?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silhakan Isi NIDN
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Nama</label>
            <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama" value="<?= $dataUpdate['nama']?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi Nama
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">No Telepon</label>
            <div class="input-group">
            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" name="no_tlp" value="<?= $dataUpdate['no_tlp']?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi No telepon
                </div>
            </div>
        </div>

        <div class="mb-3">
        <label for="" class="form-label">Jenis Kelamin</label>
        <select name="jekel" class="form-select">
            <option value="Pria" <?php if($dataUpdate['jekel'] == "Pria") echo"selected" ?>>Pria</option>
            <option value="Wanita" <?php if($dataUpdate['jekel'] == "Wanita") echo"selected"?>>Wanita</option>
        </select>
        </div>

        <div class="mb-3">
        <label for="" class="form-label">Gambar</label>
        <input type="file" class="form-control" name="gambar">
                <div class="invalid-feedback">
                    Silahkan Upload Gambar
                </div>
        <div class="alert alert-info mt-1" role="alert">
            <strong>Informasi</strong> File yang diupload(JPG, JPEG, PNG),
            <strong>Maximal</strong> 2MB
        </div>
        </div>

        <div class="mb-3">
        <button name="simpan" class="btn btn-success">SIMPAN</button>
        </div>
        </form>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.user-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
<?php
} else {
    // Jika data tidak ditemukan --> direct ke index categori  
    echo "<script>location='index.php?folder=dosen&file=index'</script>";
}

?>