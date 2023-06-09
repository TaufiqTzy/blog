<nav class="navbar navbar-expand-sm navbar-light bg-default">
      <div class="container">
        <a class=" btn btn-primary" href="index.php?folder=peminjaman_2049&file=create_2049"><i class="bi bi-plus-circle"></i> Tambah</a>
            <form class="d-flex my-2 my-lg-0">
                <input type="hidden" name="folder" value="peminjaman_2049">
                <input type="hidden" name="file" value="index_2049">
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
                <th scope="col">Kode Pinjam</th>
                <th scope="col">Nama Anggota</th>
                <th scope="col">Nama Buku - ISBN - Penerbit - Pengarang</th>
                <th scope="col">Bukti Pinjam</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Action</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php 
                extract($_GET);
                $keyword ='';
                if (isset($cari)) {
                    $keyword = "where kode_pinjam LIKE '%$cari%'";
                }
                $dataPeminjaman = allData($table="peminjaman_2049",$keyword);
                $no=0;
                foreach ($dataPeminjaman as $item) {
                    $no++;                           
            ?>
            <tr class="">
                <td scope="row"><?= $no ?></td>
                <td> <?= $item['kode_pinjam'];?></td>
                <td>
                    <?php 
                        $dataAnggota = OneData($table="anggota_2049",$key="id_anggota={$item['id_anggota']}");                                         
                        if(is_array($dataAnggota)){
                            echo $dataAnggota['nama'];
                        }else{                            
                            echo "Anggota Tidak Ditemukan";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $dataBuku = oneData ($table="buku_2049",$key="id_buku={$item['id_buku']}");                        
                        if(is_array($dataBuku)){
                            echo $dataBuku['nama_buku'];
                            echo " - ";
                            echo $dataBuku['isbn'];
                            echo " - (";
                            echo ($dataBuku['penerbit']); 
                            echo ") - (";
                            echo ($dataBuku['pengarang']);
                            echo ")";                         
                        }else{
                            //jika tidak ditemukan
                            echo "Buku Tidak Ditemukan";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $gambar="";
                        if($item['bukti_pinjam'] != ""){
                            $gambar = $item['bukti_pinjam'];
                        }else{
                            $gambar="images/pria.jpg";
                        }
                    ?>
                    <img src="images/<?=$gambar?>" alt="" class="rounded-circle" width="120" height="110">
                </td>
                <td> <?= $item['tanggal_pinjam'];?></td>
                <td>
                    <a href="index.php?folder=peminjaman_2049&file=update_2049&id_peminjaman=<?= $item['id_peminjaman'];?>" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                    <a href="index.php?folder=peminjaman_2049&file=index_2049&id_peminjaman=<?= $item['id_peminjaman']; ?>" onClick="return confirm('Apakah anda yakin menghapus = <?= $value['kode_post']?>??')" class="btn btn-danger"><i class="bi bi-x-circle"></i></a>
                </td>                
            </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<?php
if(isset($id_peminjaman)){
    delete($table="peminjaman_2049",$key="id_peminjaman = '$id_peminjaman'");
    echo "<script>location='index.php?folder=peminjaman_2049&file=index_2049'</script>";
}
?>