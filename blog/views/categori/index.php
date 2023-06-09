<nav class="navbar navbar-expand-sm navbar-light bg-default">
      <div class="container">
        <a class="btn btn-primary" href="index.php?folder=categori&file=create">Tambah</a>
            <form class="d-flex my-2 my-lg-0">
                <input type="hidden" name="folder" value="categori">
                <input type="hidden" name="file" value="index">
                <input class="form-control me-sm-2" type="text" name="cari" value="<?php if(isset($cari)) echo $cari;?>" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
</nav>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th> 
                <th scope="col">Categori</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        extract($_GET);
        $keyword = "";
        if(isset($cari)){
            $keyword = "WHERE nama_categori LIKE '%$cari%'";
        }
            $dataCategori = allData($table = "categori",$syarat=$keyword);
            $no = 0;
            foreach ($dataCategori as $value) {
                $no++;
            
         ?>
            <tr class="">
                <td scope="row"><?= $no; ?></td>
                <td><?= $value['nama_categori']?></td>
                <td><a href="index.php?folder=categori&file=update&id_categori=<?= $value['id_categori']; ?>" class="btn btn-success">Edit</td>
                <td><a href="index.php?folder=categori&file=index&id_categori=<?= $value['id_categori']; ?>" onClick="return confirm('Apakah anda yakin = <?= $value['nama_categori']?> sheesshhh??')" class="btn btn-danger">Delete</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php

if(isset($id_categori)){
    delete($table="categori",$key="id_categori = '$id_categori'");
    echo "<script>location='index.php?folder=categori&file=index'</script>";
}
?>

