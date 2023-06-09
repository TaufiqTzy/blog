<?php

extract($_GET);
extract($_POST);
$dataUpdate = oneData('user',"id_user='$id_user'");

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
                $userUpdate = [
                    'nama_user' => $nama_user,
                    'email' => $email,
                    'password' => $password,
                    'level' => $level,
                    'jekel' => $jekel,
                    'gambar' => $_FILES['gambar']['name']
                    
                ];
                update($table = "user", $userUpdate, $key = "id_user='$id_user'");
                echo "<script>location='index.php?folder=user&file=index'</script>";
            }
        }else{
            $userUpdate = [
                'nama_user' => $nama_user,
                'email' => $email,
                'password' => $password,
                'level' => $level,
                'jekel' => $jekel,
                'gambar' => $_FILES['gambar']['name']
                
            ];
            update($table = "user", $userUpdate, $key = "id_user='$id_user'");
            echo "<script>location='index.php?folder=user&file=index'</script>";
        }
        update('user',$userUpdate,"id_user='$id_user'");
        echo "<script>location='index.php?folder=user&file=index'</script>";
    }
?>
<!-- Tag HTML -->
        <h3>
            <center>Update User</center>
        </h3>

        <form action="index.php?folder=user&file=update&id_user=<?= $id_user?>" method="post" class="user-validation" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">Nama User</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama_user" value="<?= $dataUpdate['nama_user'];?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi Nama User
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-key"></i></span>
                <input type="password" name="password" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi Password
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Level</label>
            <select name="level" class="form-select">
            <option value="1" <?= ($dataUpdate['level']=='1')? 'selected' : ''?>
                >Administrator</option>
            <option value="2" <?= ($dataUpdate['level']=='2')? 'selected' : ''?>
            >Operator</option>
        </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" readonly value="<?= ($dataUpdate['email'])?>"
                 class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi Email
                </div>
            </div>
        </div>

        <div class="mb-3">
        <label for="" class="form-label">Jenis Kelamin</label>
        <select name="jekel" class="form-select">
            <option value="Pria" <?= ($dataUpdate['jekel']=='Pria')? 'selected' : ''?>
            >Pria</option>
            <option value="Wanita" <?= ($dataUpdate['jekel']=='Wanita')? 'selected' : ''?>
            >Wanita</option>
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
    echo "<script>location='index.php?folder=user&file=index'</script>";
}

?>