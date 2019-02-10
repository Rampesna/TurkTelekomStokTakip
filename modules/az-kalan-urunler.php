<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 10:25
 */

?>

<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>KART</strong>
                        </div>
                        <?php

                        $kart = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $kart->execute(array('Kart'));
                        $kart_sonuc = $kart->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_kart = 0;
                        foreach ($kart_sonuc as $kart_liste){
                            $toplam_kart += $kart_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-3"><?php echo $toplam_kart; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>FİBER</strong>
                        </div>
                        <?php

                        $fiber = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $fiber->execute(array('Fiber Optik Kablo'));
                        $fiber_sonuc = $fiber->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_fiber = 0;
                        foreach ($fiber_sonuc as $fiber_liste){
                            $toplam_fiber += $fiber_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-1"><?php echo $toplam_fiber; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>SFP</strong>
                        </div>
                        <?php

                        $sfp = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $sfp->execute(array('SFP'));
                        $sfp_sonuc = $sfp->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_sfp = 0;
                        foreach ($sfp_sonuc as $sfp_liste){
                            $toplam_sfp += $sfp_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-3"><?php echo $toplam_sfp; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>SWİTCH</strong>
                        </div>
                        <?php

                        $switch = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $switch->execute(array('Switch'));
                        $switch_sonuc = $switch->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_switch = 0;
                        foreach ($switch_sonuc as $switch_liste){
                            $toplam_switch += $switch_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-1"><?php echo $toplam_switch; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>TDM</strong>
                        </div>
                        <?php

                        $tdm = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $tdm->execute(array('TDM'));
                        $tdm_sonuc = $tdm->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_tdm = 0;
                        foreach ($tdm_sonuc as $tdm_liste){
                            $toplam_tdm += $tdm_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-3"><?php echo $toplam_tdm; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>DİĞER</strong>
                        </div>
                        <?php

                        $diger = $db->prepare("SELECT * FROM urunler WHERE kategori= ?");
                        $diger->execute(array('Diğer'));
                        $diger_sonuc = $diger->fetchAll(PDO::FETCH_ASSOC);
                        $toplam_diger = 0;
                        foreach ($diger_sonuc as $diger_liste){
                            $toplam_diger += $diger_liste['adet'];
                        }
                        ?>
                        <div class="number dashtext-1"><?php echo $toplam_diger; ?></div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
