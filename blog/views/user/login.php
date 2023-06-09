<div class="row justify-content-center">
    <div class="col-lg-4">
        <h3>
            <center>Login</center>
        </h3>
        <?php
            extract($_POST);
            if(isset($login)){
                $dataLogin = oneData($table="user",$key="email = '$email' and password='$password'");
                //jika berhasil login
                if(is_array($dataLogin)){
                    $_SESSION['sesi'] = $dataLogin['id_user'];
                    $_SESSION['nama'] = $dataLogin['nama_user'];
                    echo "<script>location='index.php'</script>";
                }else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                    
                        <strong>Login Gagal</strong> Username atau Password Anda Salah !
                        </div>';
                    
                }
            }
        ?>
        
        <form action="" method="post" class="login-validation" novalidate>
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="" class="form-control" required placeholder="example@gmail.com">
                    <div class="invalid-feedback">
                        Silahkan Isi Username
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" name="password" class="form-control" required>
                    <div class="invalid-feedback">
                        Silahkan Isi Password
                    </div>
                </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
        </form>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.login-validation')

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