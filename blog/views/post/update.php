<div class="row.justify-content-center">
    <div class="col-lg-8">
    <?php
        extract($_GET);
        extract($_POST);
        $dataPost = oneData($table="posts",$key="id_post = '$id_post'");
        //jika data post ditemukan
        if(is_array($dataPost)){
            //jika sudah klik submut
            if(isset($simpan)){
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
                        $dataPostUpdate=[
                            'id_categori'=>$id_categori,
                            'id_user'=>$id_user,
                            'title'=>$title,
                            'excerpt'=>$excerpt,
                            'body'=>$body,
                            'gambar'=>$_FILES['gambar']['name']
                        ];
                        update($table="posts",$dataPostUpdate,$syarat="id_post='$id_post'");
                        echo "<script>location='index.php?folder=post&file=index'</script>";
                    }
    
                }else{
                    $dataPostUpdate=[
                        'id_categori'=>$id_categori,
                        'id_user'=>$id_user,
                        'title'=>$title,
                        'excerpt'=>$excerpt,
                        'body'=>$body,                        
                    ];
                    update($table="posts",$dataPostUpdate,$syarat="id_post='$id_post'");
                    echo "<script>location='index.php?folder=post&file=index'</script>";
                }
            }
        }else{
            echo "<script>location='index.php?folder=post&file=index'</script>";
        }
    ?>
    <h3>
            <center>Update Post</center>
        </h3>
        <form actions="index.php?folder=post&file=update&id_post=<?= $id_post?>" method="post" enctype="multipart/form-data" class="post-validation" novalidate>
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="bi bi-journal-text"></i></span>
                    <input type="text" name="" id="" class="form-control" value=<?= $dataPost['title']?> required>
                    <div class="invalid-feedback">
                        silahkan isi title
                    </div>
                </div>  
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Excerpt</label>
              <textarea class="form-control" name="excerpt" id="" rows="3" required><?= $dataPost['excerpt']?></textarea>
              <div class="invalid-feedback">
                silahkan isi Excerpt
              </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Body</label>
                <input id="body" class="form-control d-none" type="text" name="body" value ="<?= $dataPost['body']?>" required>
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
                    <option <?= $dataPost['id_categori']==$item['id_categori'] ? "selected" : ""?> value="<?= $item['id_categori']?>"><?= $item['nama_categori']?></option>                    
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
                    <option <?= $dataPost['id_user']==$item['id_user'] ? "selected" : ""?> value="<?= $item['id_user']?>"><?= $item['nama_user']?></option>                    
                    <?php
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Gambar</label>
              <input type="file" class="form-control" name="gambar" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">File Gambar (JPG, JPEG, PNG</small>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary" name="simpan">Update</button>
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
</script>