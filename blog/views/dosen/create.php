<div class="row justify-content-center">
    <div class="col-md-6">
        <?php
            extract($_POST);
            if (isset($simpan)) {
                // echo print_r($_FILES);
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
                    $dataDosen = [
                        'nidn' => $nidn,
                        'nama' => $nama,
                        'no_tlp' => $no_tlp,
                        'jekel' => $jekel,    
                        'gambar' => $_FILES['gambar']['name']
                    ];
                    insert('dosen',$dataDosen);
                    echo "<script>location='index.php?folder=dosen&file=index'</script>";
                }
            }

        ?>
        <h3>
            <center>Input Dosen</center>
        </h3>
        <form action="" method="post" class="user-validation" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">NIDN</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nidn" value="<?php if (isset($simpan)) {
                    echo $nidn;
                } ?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silhakan Isi NIDN
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Nama</label>
            <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama" value="<?php if (isset($simpan)) {
                    echo $nama;
                } ?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi Nama
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">No Telepon</label>
            <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="no_tlp" value="<?php if (isset($simpan)) {
                    echo $no_tlp;
                } ?>" class="form-control" required>
                <div class="invalid-feedback">
                    Silahkan Isi No telepon
                </div>
            </div>
        </div>

        <div class="mb-3">
        <label for="" class="form-label">Jenis Kelamin</label>
        <select name="jekel" class="form-select">
            <option value="Pria" <?php if (isset($simpan)) {
                    $jekel == "Pria" ? $selected = "selected":$selected = "";
                    echo $selected;
                } ?>>Pria</option>
            <option value="Wanita" <?php if (isset($simpan)) {
                    $jekel == "Wanita" ? $selected2 = "selected":$selected2 = "";
                    echo $selected2;
                } ?>>Wanita</option>
        </select>
        </div>

        <div class="mb-3">
        <label for="" class="form-label">Gambar</label>
        <input type="file" class="form-control" required name="gambar">
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