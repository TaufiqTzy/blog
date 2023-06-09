<nav class="navbar navbar-expand-sm navbar-light bg-default">
      <div class="container">
        <a class=" btn btn-primary" href="index.php?folder=post&file=create"><i class="bi bi-plus-circle"></i> Tambah</a>
            <form class="d-flex my-2 my-lg-0">
                <input type="hidden" name="folder" value="post">
                <input type="hidden" name="file" value="index">
                <input class="form-control me-sm-2" name="cari" type="text" value="<?php if (isset($cari)) echo $cari;?>" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
</nav>


<div class="table-responsive-lg">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Excerpt</th>
                <th scope="col">User</th>      
                <th scope="col">Categori</th>                
                <th scope="col">Prodi</th>                
                <th scope="col">Gambar</th>          
                <th scope="col">Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                extract($_GET);
                $keyword ='';
                if (isset($cari)) {
                    $keyword = "where title LIKE '%$cari%'";
                }
                $dataPosts = allData($table="posts");
                $no=0;
                foreach ($dataPosts as $item) {
                    $no++;                           
            ?>
            <tr class="">
                <td scope="row"><?= $no ?></td>
                <td> <?= $item['title'];?></td>
                <td> <?= $item['excerpt'];?></td>
                <td>
                    <?php 
                        $dataUser = OneData($table="user",$key="id_user={$item['id_user']}");                
                        //jika data posts berelasi ke user
                        if(is_array($dataUser)){
                            echo $dataUser['nama_user'];
                        }else{
                            //jika tidak ditemukan
                            echo "User Tidak Ditemukan";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $dataCategori = oneData ($table="categori",$key="id_categori={$item['id_categori']}");
                        //Jika data posts berelasi ke categori
                        if(is_array($dataCategori)){
                            echo $dataCategori['nama_categori'];                            
                        }else{
                            //jika tidak ditemukan
                            echo "Categori Tidak Ditemukan";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $dataProdi = oneData ($table="prodi",$key="id_prodi={$item['id_prodi']}");
                        //Jika data posts berelasi ke categori
                        if(is_array($dataProdi)){
                            echo $dataProdi['nama_prodi'];                            
                        }else{
                            //jika tidak ditemukan
                            echo "Prodi Tidak Ditemukan";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $gambar="";
                        if($item['gambar'] != ""){
                            $gambar = $item['gambar'];
                        }else{
                            $gambar="images/pria.jpg";
                        }
                    ?>
                    <img src="images/<?=$gambar?>" alt="<?= $item['title']?>" class="rounded-circle" width="120" height="110">
                </td>
                <td>
                    <a href="index.php?folder=post&file=update&id_post=<?= $item['id_post'];?>" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                    <a href="index.php?folder=post&file=index&id_post=<?= $item['id_post']; ?>" onClick="return confirm('Apakah anda yakin = <?= $value['id_post']?> sheesshhh??')" class="btn btn-danger"><i class="bi bi-x-circle"></i></a>
                </td>                
            </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<?php
if(isset($id_post)){
    delete($table="posts",$key="id_post = '$id_post'");
    echo "<script>location='index.php?folder=post&file=index'</script>";
}
?>

