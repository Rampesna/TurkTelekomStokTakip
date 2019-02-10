<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 10:30
 */
?>
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="stats-2-block block d-flex">
                    <div class="stats-2 d-flex">
                        <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div>
                        <?php

                        $girisler = $db->query("SELECT * FROM urunler WHERE eklenme_tarihi >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)")->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_giris = 0;
                        foreach ($girisler as $liste) {
                            $toplam_giris += $liste['adet'];
                        }

                        ?>

                        <div class="stats-2-content"><strong class="d-block"><?php echo $toplam_giris; ?></strong><span
                                    class="d-block">SON 1 HAFTAYA AİT TOPLAM ÜRÜN GİRİŞİ</span>
                            <div class="progress progress-template progress-small">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
