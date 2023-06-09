<?php
//memulai sebuah session//
session_start();
    require_once 'views/header.php';

    extract($_GET);
    require_once 'fungsi-crud.php';

    //Halaman Back End atau Halaman User
    if((isset($folder))&&(isset($file))){
        $views_page = "views/$folder";
        //apakah user sudah login
        if(isset($_SESSION['sesi'])){
            if(is_dir($views_page)){
                $file_pages = "$views_page/$file.php";
    
                if(is_file($file_pages)){            
                    
                    require_once "$file_pages";
                    
                }else{
                    require_once 'views/404.php';
                }
            }else{
                require_once 'views/404.php';
            }
        }else{
            //jika user belum login
            require_once 'views/user/login.php';
        }
    }

    //halaman homepage
    if(isset($front_folder) && isset($file)){
        $views_front = "views/$front_folder";
        if(is_dir($views_front)){
            $file_front ="$views_front/$file.php";
            if(is_file($file_front)){
                require_once $file_front;
            }else{
                require_once 'views/404.php';
            }
        }
    }

    //Jika tidak ada parameter folder dan front folder
    if(isset($folder) == "" && isset($front_folder) == ""){
        require_once 'views/homepages.php';
    }
    require_once 'views/footer.php';
?>