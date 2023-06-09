<?php
    extract($_POST);
    if(isset($simpan)){
        $cek_dataProdi = oneData($table="prodi",$key = "nama_prodi = '$prodi'");
        //jika categori sudah ada
        if(is_array($cek_dataProdi)){
            echo"<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            Data prodi = $prodi sudah ada
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
          </div>";
        }else{
            $dataProdi = [
                'nama_prodi' => $prodi,
            ];
            insert($table="prodi",$dataProdi);
            echo "<script>location='index.php?folder=prodi&file=index'</script>";
        }
    }
?>
<form class="row g-3 prodi-validation" action="index.php?folder=prodi&file=create" method="POST" novalidate>
  <div class="col-md-4">
    <label  class="form-label">Prodi</label>
    <input type="text" class="form-control" name="prodi" value="<?php if(isset($prodi)) echo $prodi;?>"required>
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