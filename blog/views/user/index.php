<nav class="navbar navbar-expand-sm navbar-light bg-default">
      <div class="container">
        <a class=" btn btn-primary" href="index.php?folder=user&file=create"><i class="bi bi-plus-circle"></i> Tambah</a>
            <form class="d-flex my-2 my-lg-0">
                <input type="hidden" name="folder" value="user">
                <input type="hidden" name="file" value="index">
                <input class="form-control me-sm-2" name="cari" type="text" value="<?php if (isset($cari)) echo $cari;?>" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
</nav>

<div class="table-responsive mt-2">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
                <th scope="col">Pria/Wanita</th>
                <th scope="col">Gambar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                extract($_GET);
                $keyword ='';
                if (isset($cari)) {
                    $keyword = "where nama_user LIKE '%$cari%'";
                }
                $dataUser = allData("user",$keyword);
                $no = 0;
                foreach ($dataUser as $value) {
                    $no++;
               
            ?>
            <tr class="">
                <td scope="row"><?= $no ?></td>
                <td> <?= $value['nama_user'];?></td>
                <td> <?= $value['email'];?></td>
                <td> <?= $value['level'] == 1 ? "Administartor" : "Operator";?></td>
                <td> <?= $value['jekel'];?></td>
                <td>
                    <?php
                        if ($value['gambar'] == NULL) {
                            if ($value['jekel'] == "Pria") {
                                $gambar = "images/pria.jpg";
                            }else {
                                $gambar = "images/wanita.jpg";
                            }
                        }else {
                            // jika gambar sudah di upload
                            $gambar = "images/".$value['gambar'];
                        }
                    ?>
                    <img src="<?=$gambar?>" alt="<?= $value['nama_user']?>" class="rounded-circle" width="120" height="110">
                </td>
                <td><a href="index.php?folder=user&file=update&id_user=<?= $value['id_user']?>" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                <a href="index.php?folder=user&file=index&id_user=<?= $value['id_user']?>" class="btn btn-danger"
                onclick="return confirm('Apakah anda yakin ingin menghapus <?= $value['nama_user'];?>')"><i class="bi bi-x-circle"></i></a>
                </td>
            </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<?php
if (isset($id_user)) {
    delete('user',"id_user = '$id_user'");
    echo "<script>location='index.php?folder=user&file=index'</script>";
}
?>