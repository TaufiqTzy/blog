<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!--CSS Trix-->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?folder=categori&file=index">Categori</a></li>
            <li><a class="dropdown-item" href="index.php?folder=user&file=index">User</a></li>
            <li><a class="dropdown-item" href="index.php?folder=prodi&file=index">Prodi</a></li>
            <li><a class="dropdown-item" href="index.php?folder=dosen&file=index">Dosen</a></li>
            <li><a class="dropdown-item" href="index.php?folder=post&file=index">Post</a></li>
            <li><a class="dropdown-item" href="index.php?folder=peminjaman_2049&file=index_2049">Peminjaman</a></li>
          </ul>
        </li>
      </ul>
      <?php
        //jika sudah login
        if(isset($_SESSION['sesi'])){
      ?>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?= $_SESSION['nama']?></a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#tab2Id">Profile</a>
                <a class="dropdown-item" href="index.php">Home</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?folder=user&file=logout">Logout</a>
              </div>
            </li>          
        </ul>
      <?php
        }else{
      ?>
      <ul class="navbar-nav">
        <li class="nav-item">
            <a href="index.php?front_folder=user&file=login" class="nav-link"><i class="bi bi-box-arrow-right">login</i></a>
        </li>
      </ul>
      <?php
        }
      ?>
    </div>
  </div>
</nav>
<div class="container mt-4">