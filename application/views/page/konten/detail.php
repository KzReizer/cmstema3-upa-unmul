<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div role="main" class="main">

    <section class="cms-page-banner">
        <div class="cms-page-banner-overlay"></div>
        <div class="container cms-page-banner-content">
            <ul class="breadcrumb">
                <li><a href="<?=base_url()?>"><?=$lang=='ID'?'Beranda':'Home'?></a></li>
                <li class="active"><?=$is_active ?></li>
            </ul>
            <h1><?= $datas!=false?$datas->{'kontenJudul'.$lang}:"" ?></h1>
        </div>
    </section>

    <div class="container cms-content-page">
        <div class="row">
            <div class="col-lg-9">
                <div class="cms-content-article">
                    <?php if (!empty($datas->kontenBanner)) { ?>
                        <div class="cms-detail-image">
                            <img alt="" class="img-fluid" src="<?=$datas!=false?$datas->kontenBanner:'';?>">
                        </div>
                    <?php } ?>
                    <div class="cms-detail-meta">
                        <span><i class="fa fa-calendar"></i> <?= !empty($datas->kontenTanggal)?date('d M Y', strtotime($datas->kontenTanggal)):'' ?></span>
                        <span><i class="fa fa-user"></i> <?= $datas!=false?$datas->kontenAuthor:"" ?></span>
                        <span><i class="fa fa-tag"></i> <?= $datas!=false?$datas->{'kontenTag'.$lang}:"" ?></span>
                    </div>
                    <div class="cms-detail-body">
                        <?= $datas != false ? $datas->{'kontenIsi'.$lang} : "" ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <?php $this->load->view('page/sidebar');?>
            </div>
        </div>
    </div>

</div>

