<div class="row">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <?php
        $dataSlide = allData($table = "slide_show");
        $no_button = 0;
    ?>
  <div class="carousel-indicators">
    <?php
        foreach ($dataSlide as $item ) {   
    ?>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $no_button ?>" class="<?= $no_button == 1 ? "active" : "";?>" aria-current="true" aria-label="Slide <?= $no_button + 1 ?>"></button>
    <?php
            $no_button++;
        }
    ?>
  </div>
  <div class="carousel-inner">
    <?php
        $no_item = 0;
        foreach ($dataSlide as $item) {
            $no_item++;
        
    ?>
    <div class="carousel-item <?= $no_item == 1 ? "active" : "";?>">
      <img src="images/<?= $item['gambar']?>" class="d-block w-100" alt="..." height="455">
      <div class="carousel-caption d-none d-md-block p-0" style="background-color: rgba(0, 0, 0, 0.7);">
        <h5><?= $item['title']?></h5>
        <p><?= $item['body']?></p>
      </div>
    </div>
    <?php
        }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
<div class="row">
    <?php
    $dataPosts = allData($table="posts");
    foreach ($dataPosts as $item) {
        $gambar="";
        if($item['gambar'] != ""){
            $gambar = $item['gambar'];
        }else{
            $gambar="images/pria.jpg";
        }
    ?>
    <div class="col-lg-4">        
        <div class="card">
            <div class="position-absolute text-white p-3 fs-5 top-0 start-0" style="background-color: rgba(0,0, 0, 0.7);" >
            <?php
                $dataCategori = oneData ($table="categori",$key="id_categori={$item['id_categori']}");
                echo $dataCategori['nama_categori'];
            ?>
            </div>
            <div class="position-absolute text-white p-3 fs-7 top-0 end-0" style="background-color: rgba(0,0, 0, 0.7);" >
            <?php
                $dataProdi = oneData ($table="prodi",$key="id_prodi={$item['id_prodi']}");
                echo $dataProdi['nama_prodi'];
            ?>
            </div>
            <img class="card-img-top" src="images/<?= $gambar ?>" alt="<?= $item['title'] ?>" width="100" height="180">
            <div class="card-body">
                <h4 class="card-title"><?= $item['title'] ?></h4>
                <p class="card-text">                    
                    <?= $item['excerpt'] ?>                    
                <p>
                <a href="index.php?front_folder=post&file=single&id_post=<?= $item['id_post'] ?>" class="btn btn-success">Read More.....</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>