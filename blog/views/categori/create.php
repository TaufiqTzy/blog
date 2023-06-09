<?php
    extract($_POST);
    if(isset($simpan)){
        $cek_dataCategori = oneData($table="categori",$key = "nama_categori = '$categori'");
        //jika categori sudah ada
        if(is_array($cek_dataCategori)){
            echo"<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            Data kategori = $categori sudah ada
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
          </div>";
        }else{
            $dataCategori = [
                'nama_categori' => $categori,
            ];
            insert($table="categori",$dataCategori);
            echo "<script>location='index.php?folder=categori&file=index'</script>";
        }
    }
?>
<form class="row g-3 categori-validation" action="index.php?folder=categori&file=create" method="POST" novalidate>
  <div class="col-md-4">
    <label  class="form-label">Kateogri</label>
    <input type="text" class="form-control" name="categori" value="<?php if(isset($categori)) echo $categori;?>"required>
    <div class="valid-feedback">
      Sudah Terisi dengan benar
    </div>
    <div class="invalid-feedback">
        Silahkan di isi kategori
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
  const forms = document.querySelectorAll('.categori-validation')

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