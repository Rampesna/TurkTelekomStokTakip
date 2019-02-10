<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 09:45
 */
session_start();
?>

<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <a href="profil.php?uid=<?php echo $_SESSION["k_adi"] ?>">
            <img src="<?php echo $_SESSION['resim']; ?>"
                 alt="<?php echo ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']); ?>"
                 class="img-fluid rounded-circle">
            </a></div>
        <div class="title">
            <h1 class="h5"><a href="profil.php?uid=<?php echo $_SESSION["k_adi"] ?>"><?php echo ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']); ?></a></h1>
            <p><?php echo ucwords($_SESSION['birim']); ?></p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">İşlemler</span>
    <ul class="list-unstyled">
        <li><a href="index.php"> <i class="icon-home"></i>Anasayfa </a></li>

        <li><a href="stok-urunler.php"> <i class="icon-list"></i>Stoktaki Ürünler </a></li>
        <li><a href="#urun" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Stok İşlemleri </a>
            <ul id="urun" class="collapse list-unstyled ">
                <li><a href="stok-giris.php">Stok Girişi</a></li>
                <li style="<?php
                if($_SESSION["yetki"] == 0){
                    echo 'display:none;';
                }
                ?>"><a href="kategoriler.php">Kategoriler</a></li>
                <li style="<?php
                if($_SESSION["yetki"] == 0){
                    echo 'display:none;';
                }
                ?>"><a href="firmalar.php">Firmalar</a></li>
                <li style="<?php
                if($_SESSION["yetki"] == 0){
                    echo 'display:none;';
                }
                ?>"><a href="tipler.php">Tipler</a></li>
            </ul>
        </li>
        <li style="<?php
            if($_SESSION["yetki"] == 0){
                echo 'display:none;';
            }
        ?>"><a href="#user" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Kullanıcı İşlemleri
            </a>
            <ul id="user" class="collapse list-unstyled ">
                <li><a href="kullanicilar.php">Kullanıcılar</a></li>
                <li><a href="kullanici-ekle.php">Kullanıcı Ekle</a></li>
            </ul>
        </li>
        <li style="<?php
        if($_SESSION["yetki"] == 0){
            echo 'display:none;';
        }
        ?>"><a href="log.php"><i class="icon-computer"></i>İşlem Kayıtları </a></li>
        <li><a href="fis-olustur.php"> <i class="icon-bill"></i>Fiş Oluştur</a></li>

    </ul>
</nav>
<div class="page-content">
