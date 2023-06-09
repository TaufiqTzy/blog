<nav class="navbar navbar-expand-sm navbar-light bg-default">
      <div class="container">
        <a class=" btn btn-primary" href="index.php?folder=dosen&file=create"><i class="bi bi-plus-circle"></i> Tambah</a>
            <form class="d-flex my-2 my-lg-0">
                <input type="hidden" name="folder" value="dosen">
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
                <th scope="col">NIDN</th>
                <th scope="col">NAMA</th>
                <th scope="col">NO TELEPON</th>
                <th scope="col">JENIS KELAMIN</th>
                <th scope="col">GAMBAR</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                extract($_GET);
                $keyword ='';
                if (isset($cari)) {
                    $keyword = "where nama LIKE '%$cari%'";
                }
                $dataDosen = allData("dosen",$keyword);
                $no = 0;
                foreach ($dataDosen as $value) {
                    $no++;
               
            ?>
            <tr class="">
                <td scope="row"><?= $no ?></td>
                <td> <?= $value['nidn'];?></td>
                <td> <?= $value['nama'];?></td>
                <td> <?= $value['no_tlp'];?></td>
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
                    <img src="<?=$gambar?>" alt="<?= $value['nama']?>" class="rounded-circle" width="120" height="110">
                </td>
                <td><a href="index.php?folder=dosen&file=update&id_dosen=<?= $value['id_dosen']?>" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                <a href="index.php?folder=dosen&file=index&id_dosen=<?= $value['id_dosen']?>" class="btn btn-danger"
                onclick="return confirm('Apakah anda yakin ingin menghapus <?= $value['nama'];?>')"><i class="bi bi-x-circle"></i></a>
                </td>
            </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<?php
if (isset($id_dosen)) {
    delete('dosen',"id_dosen = '$id_dosen'");
    echo "<script>location='index.php?folder=dosen&file=index'</script>";
}
?>