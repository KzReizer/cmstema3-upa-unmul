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
            <h1><?=$is_active?></h1>
        </div>
    </section>

    <div class="container cms-content-page">

        <div class="row">
            <div class="col-lg-9">
                <div class="cms-content-list">
                    <?php                    
                    if($konten!==false) {
                      $i = 1;                      
                      foreach($konten as $row) { ?>
                        <div class="cms-content-list-item" style="flex-direction:column;">
                            <div class="row" style="width:100%;">
                                <div class="col-lg-5">
                                    <div class="post-image">
                                        <div>
                                            <?php if (!empty($row->kontenBanner)) { ?>
                                            <div class="img-thumbnail" style="border:none;border-radius:var(--cms-radius-md);overflow:hidden;">
                                                <a href="<?=base_url()?>page/detail/<?= $row->{'kontenNama' . $lang} ?>"><img class="img-fluid" src="<?= $row->kontenBanner ?>" style="border-radius:var(--cms-radius-md);"></a>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="img-thumbnail" style="border:none;border-radius:var(--cms-radius-md);overflow:hidden;">
                                                <img alt=""  class="img-fluid" src="<?=site_url('page/loadthumb/noimage.jpg');?>" style="border-radius:var(--cms-radius-md);">
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="list-content">
                                        <h4><a href="<?=base_url()?>page/detail/<?= $row->{'kontenNama'.$lang} ?>"><?=$row->{'kontenJudul'.$lang}?></a></h4>
                                        <p><?=substr(strip_tags($row->{'kontenIsi'.$lang}), 0, strpos(wordwrap($row->{'kontenIsi'.$lang}, 250), "\n"));?>..</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width:100%;">
                                <div class="col">
                                    <div class="cms-detail-meta">
                                        <span><i class="fa fa-calendar"></i> <?=!empty($row->kontenTanggal)?datetoindo($row->kontenTanggal):"";?> </span>
                                        <span><i class="fa fa-user"></i> By <?=$row->kontenAuthor?> </span>
                                        <span><i class="fa fa-tag"></i> <?=$row->{'kontenTag'.$lang}?> </span>
                                        <span class="d-block d-md-inline-block float-md-right mt-3 mt-md-0"><a href="<?=base_url()?>page/detail/<?= $row->{'kontenNama'.$lang} ?>" class="cms-btn cms-btn-primary cms-btn-sm"><?=$lang=='ID'?'Lihat Selengkapnya':'Read More'?> <i class="fa fa-arrow-right"></i></a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php }
                }else{?>
                <h5>Oppssss.. Tidak Ada Data  <?=$is_active ?> !</h5>
                <?php 
                }?>
                
            </div>
            <nav aria-label="Page navigation" class="cms-pagination">
                <?= $this->pagination->create_links(); ?>
            </nav>

        </div>

        <?php
        $this->load->view('page/sidebar');
        ?>
    </div>

</div>

</div>

