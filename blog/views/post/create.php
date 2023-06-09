<div class="row.justify-content-center">
    <div class="col-lg-8">
        <?php
        extract($_POST);
        if(isset($simpan)){
            //jika upload file
            if($_FILES['gambar']['name'] != ""){
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
                }else{
                    $dataPost=[
                        'id_categori'=>$id_categori,
                        'id_user'=>$id_user,
                        'id_prodi'=>$id_prodi,
                        'title'=>$title,
                        'excerpt'=>$excerpt,
                        'body'=>$body,
                        'gambar'=>$_FILES['gambar']['name']
                    ];
                    insert($table="posts",$dataPost);
                    echo "<script>location='index.php?folder=post&file=index'</script>";
                }

            }else{
                $dataPost=[
                    'id_categori'=>$id_categori,
                    'id_user'=>$id_user,
                    'id_prodi'=>$id_prodi,
                    'title'=>$title,
                    'excerpt'=>$excerpt,
                    'body'=>$body,
                    'gambar'=>''
                ];
                insert($table="posts",$dataPost);
                echo "<script>location='index.php?folder=post&file=index'</script>";
            }
        }
        ?>

        <h3>
            <center>New Post</center>
        </h3>
        <form actions="" method="post" enctype="multipart/form-data" class="post-validation" novalidate>
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="bi bi-journal-text"></i></span>
                    <input type="text" name="title" id="" class="form-control" required>
                    <div class="invalid-feedback">
                        silahkan isi title
                    </div>
                </div>  
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Excerpt</label>
              <textarea class="form-control" name="excerpt" id="" rows="3" required></textarea>
              <div class="invalid-feedback">
                silahkan isi Excerpt
              </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Body</label>
                <input id="body" class="form-control d-none" type="text" name="body" required>
                <trix-editor input="body"></trix-editor>
                <div class="invalid-feedback">
                    Silahkan isi body
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select class="form-select form-select-lg" name="id_categori" id="">    
                    <?php
                        $dataCategori = allData($table="categori");
                        foreach($dataCategori as $item){                       
                    ?>                                
                    <option value="<?= $item['id_categori']?>"><?= $item['nama_categori']?></option>                    
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">User</label>
                <select class="form-select form-select-lg" name="id_user" id="">   
                    <?php
                        $dataUser = allData($table="user");
                        foreach($dataUser as $item){
                    ?>                 
                    <option value="<?= $item['id_user']?>"><?= $item['nama_user']?></option>                    
                    <?php
                        }
                    ?>
                </select>
            </div>
             </div>

            <div class="mb-3">
              <label for="" class="form-label">Gambar</label>
              <input type="file" class="form-control" name="gambar" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">File Gambar (JPG, JPEG, PNG</small>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.post-validation')

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
</script>   <div class="mb-3">
                <label for="" class="form-label">Prodi</label>
                <select class="form-select form-select-lg" name="id_prodi" id="">   
                    <?php
                        $dataProdi = allData($table="prodi");
                        foreach($dataProdi as $item){
                    ?>                 
                    <option value="<?= $item['id_prodi']?>"><?= $item['nama_prodi']?></option>                    
                    <?php
                        }
                    ?>
                </select>
        