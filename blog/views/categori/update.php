<?php
extract($_GET);
extract($_POST);
$dataUpdate = oneData($table = "categori",$key = "id_categori = '$id_categori'");
if(is_array($dataUpdate)){
    if(isset($simpan)){
        $categoriUpdate = [
            'nama_categori' => $categori
        ];

        update($table="categori",$categoriUpdate,$syarat="id_categori = '$id_categori'");
        echo "<script>location='index.php?folder=categori&file=index'</script>";
    }
?>
<form class="row g-3 categori-validation" action="index.php?folder=categori&file=update&id_categori=<?= $id_categori?>" method="POST" novalidate>
  <div class="col-md-4">
    <label  class="form-label">Kateogri</label>
    <input type="text" class="form-control" name="categori" value="<?= $dataUpdate['nama_categori'] ?>"required>
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
<?php
}else{
    echo "<script<location='index.php?folder=categori&file=index'</script>";
}
?>
