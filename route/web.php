<?php 
    
    require_once('config/database.php');
    require_once('model/models.php');
    require_once('controller/controllers.php');

    // $genre = new GenreController();

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            if($page == 'home') { include "page/home.php"; }
            else if ($page == 'shopAll') { include "page/shopAll.php"; }
            else if ($page == 'detail') { include "page/detailProduk.php"; }
            else if ($page == 'cart') { include "page/cart.php"; }
            else if ($page == 'checkout') { include "page/checkout.php"; }
            else if ($page == 'about') { include "page/about.php"; }
            else if ($page == 'contact') { include "page/contact.php"; }
            else if ($page == 'login') { include "page/login.php"; }
            else if ($page == 'register') { include "page/register.php"; }
            else if ($page == 'profile') { include "page/profile.php"; }
            else if ($page == 'faq') { include "page/faq.php"; }
            else if ($page == 'terms') { include "page/terms.php"; }
            else if ($page == 'privacy') { include "page/privacy.php"; }
            else if ($page == 'admin') { include "route/admin.php"; }
            else if($page == 'admin') { include "page/admin/dashboard.php"; }   
            else if($page == 'maintenance') { include "page/maintenance.php"; } 
