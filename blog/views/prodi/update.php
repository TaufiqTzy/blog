<?php
extract($_GET);
extract($_POST);
$dataUpdate = oneData($table = "prodi",$key = "id_prodi = '$id_prodi'");
if(is_array($dataUpdate)){
    if(isset($simpan)){
        $prodiUpdate = [
            'nama_prodi' => $prodi
        ];

        update($table="prodi",$prodiUpdate,$syarat="id_prodi = '$id_prodi'");
        echo "<script>location='index.php?folder=prodi&file=index'</script>";
    }
?>
<form class="row g-3 prodi-validation" action="index.php?folder=prodi&file=update&id_prodi=<?= $id_prodi?>" method="POST" novalidate>
  <div class="col-md-4">
    <label  class="form-label">Prodi</label>
    <input type="text" class="form-control" name="prodi" value="<?= $dataUpdate['nama_prodi'] ?>"required>
    <div class="valid-feedback">
      Sudah Terisi dengan benar
    </div>
    <div class="invalid-feedback">
        Silahkan di isi prodi
      </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
  </div>
</form>
<script>
    (() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.prodi-validation')

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
}else{
    echo "<script<location='index.php?folder=prodi&file=index'</script>";
}
?>