<div class="row justify-content-center">
    <div class="col-lg-8">
        <?php
            $dataPost = oneData($table = "posts", $key = "id_post = '$id_post'" );
            $dataUser = OneData($table="user",$key="id_user= '{$dataPost['id_user']}'");
            $dataCategori = oneData ($table="categori",$key="id_categori='{$dataPost['id_categori']}'");
            $gambar="";
            if($dataPost['gambar'] != ""){
                $gambar = $dataPost['gambar'];
            }else{
                $gambar="images/pria.jpg";
            }
        ?>
        <h2><?= $dataPost['title']?></h2>
        <h5>
            By : <?= $dataUser['nama_user']; ?> <br>
            In : <?= $dataCategori['nama_categori']?>

        </h5>
        <img src="images/<?= $gambar ?>" class="img-fluid" height="350" alt="<?= $dataPost['title']?>">
        <article class="my-3 fs-5">
            <?= $dataPost['body'] ?>
        </article>
    </div>
</div>