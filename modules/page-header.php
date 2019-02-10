<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 09:24
 */
?>
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Kapat<i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="Ne Aramıştınız?">
                        <button type="submit" class="submit">Ara</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="index.php" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">TÜRK
                            TELEKOM</strong><strong>&nbsp;STOK TAKİP</strong></div>
                    <div class="brand-text brand-sm"><strong class="text-primary">TT</strong><strong></strong></div>
                </a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">
                <div style="display: none" class="list-inline-item"><a href="#" class="search-open nav-link"><i
                                class="icon-magnifying-glass-browser"></i></a></div>
                <div class="list-inline-item logout">
                    <a id="logout" href="logout.php" class="nav-link">Çıkış Yap <i class="icon-logout"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="d-flex align-items-stretch">