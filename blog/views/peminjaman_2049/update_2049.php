<div class="row.justify-content-center">
    <div class="col-lg-8">
    <?php
        extract($_GET);
        extract($_POST);
        $dataPeminjaman = oneData($table="peminjaman_2049",$key="id_peminjaman ='$id_peminjaman'");
        //jika data post ditemukan
        if(is_array($dataPeminjaman)){
            //jika sudah klik submut
            if(isset($simpan)){
                if($_FILES['bukti_pinjam']['name'] != ""){
                    $upload_file = upload(
                        $nama_file = $_FILES['bukti_pinjam']['name'],
                        $tmp_file = $_FILES['bukti_pinjam']['tmp_name'],
                        $max_file = 2,
                        $size_file = $_FILES['bukti_pinjam']['size'] / (1024*1025),
                        ['jpg','jpeg','png']
                    );
                    if ($upload_file['status'] == 0) {
                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                            <strong>Informasi</strong> {$upload_file['message']}
                        </div>";   
                    }else{
                        $dataUpdatePeminjaman=[
                            'kode_pinjam'=>$kode_pinjam,
                            'id_anggota'=>$id_anggota,
                            'id_buku'=>$id_buku,
                            'jumlah'=>$jumlah,
                            'keterangan'=>$keterangan,
                            'bukti_pinjam'=>$_FILES['bukti_pinjam']['name']
                        ];
                        update($table="peminjaman_2049",$dataUpdatePeminjaman,$syarat="id_peminjaman");
                        echo "<script>location='index.php?folder=peminjaman_2049&file=index_2049'</script>";
                    }
    
                }else{
                    $dataUpdatePeminjaman=[
                        'kode_pinjam'=>$kode_pinjam,
                        'id_anggota'=>$id_anggota,
                        'id_buku'=>$id_buku,
                        'jumlah'=>$jumlah,
                        'keterangan'=>$keterangan,
        
                    ];
                    update($table="peminjaman_2049",$dataUpdatePeminjaman,$syarat="id_peminjaman");
                    echo "<script>location='index.php?folder=peminjaman_2049&file=index_2049'</script>";
                }
            }
        }else{
            echo "<script>location='index.php?folder=peminjaman_2049&file=index_2049'</script>";
        }
    ?>

        <h3>
            <center>Update Peminjaman</center>
        </h3>
        <form actions="index.php?folder=peminjaman_2049&file=update_2049&id_peminjaman=<?= $id_peminjaman?>" method="post" enctype="multipart/form-data" class="peminjaman_2049-validation" novalidate>
            <div class="mb-3">
                <label for="" class="form-label">Kode Pinjam</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="bi bi-journal-text"></i></span>
                    <input type="text" name="kode_pinjam" id="" class="form-control" value=<?= $dataPeminjaman['kode_pinjam']?> required>
                    <div class="invalid-feedback">
                        silahkan isi Kode Pinjam
                    </div>
                </div>  
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Anggota</label>
                <select class="form-select form-select-lg" name="id_anggota" id="">    
                    <?php
                        $dataAnggota = allData($table="anggota_2049");
                        foreach($dataAnggota as $item){                       
                    ?>                                
                    <option value="<?= $item['id_anggota']?>"><?= $item['nama']?></option>                    
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Buku</label>
                <select class="form-select form-select-lg" name="id_buku" id="">    
                    <?php
                        $dataBuku = allData($table="buku_2049");
                        foreach($dataBuku as $item){                       
                    ?>                                
                    <option <?= $dataPeminjaman['id_buku']==$item['id_buku'] ? "selected" : ""?> value="<?= $item['id_buku']?>"><?= $item['nama_buku']?></option>  
                    <?php
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Jumlah Pinjam</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="bi bi-journal-text"></i></span>
                    <input type="text" name="jumlah" id="" class="form-control" value=<?= $dataPeminjaman['jumlah']?> required>
                    <div class="invalid-feedback">
                        silahkan isi Jumlah Pinjam
                    </div>
                </div>  
            </div>            
            <div class="mb-3">
              <label for="" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="" rows="3"  required><?= $dataPeminjaman['keterangan']?></textarea>
              <div class="invalid-feedback">
                silahkan isi Keterangan
              </div>
            </div>
            

            <div class="mb-3">
              <label for="" class="form-label">Bukti Pinjam</label>
              <input type="file" class="form-control" name="bukti_pinjam" id="" aria-describedby="helpId" placeholder="">
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
  const forms = document.querySelectorAll('.peminjaman_2049-validation')

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
        