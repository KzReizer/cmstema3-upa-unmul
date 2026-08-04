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
                      foreach($konten as $row) {
                        $detailSlug = !empty($row->{'kontenNama'.$lang}) ? $row->{'kontenNama'.$lang} : (isset($row->kontenNamaID) ? $row->kontenNamaID : '');
                        $rawExcerpt = strip_tags($row->{'kontenIsi'.$lang});
                        $wrappedExcerpt = wordwrap($rawExcerpt, 250);
                        $excerpt = strpos($wrappedExcerpt, "\n") !== false ? substr($wrappedExcerpt, 0, strpos($wrappedExcerpt, "\n")) : substr($rawExcerpt, 0, 250);
                        $excerpt = trim($excerpt);
                    ?>
                        <article class="cms-content-list-item">
                            <div class="row gx-4 gy-4 align-items-start">
                                <div class="col-lg-5">
                                    <div class="post-image">
                                        <div class="img-thumbnail">
                                            <?php if (!empty($row->kontenBanner)) { ?>
                                                <a href="<?=base_url()?>page/detail/<?= $detailSlug ?>"><img class="img-fluid" src="<?= $row->kontenBanner ?>"></a>
                                            <?php } else { ?>
                                                <img alt="" class="img-fluid" src="<?=site_url('page/loadthumb/noimage.jpg');?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="list-content">
                                        <h4><a href="<?=base_url()?>page/detail/<?= $detailSlug ?>"><?= $row->{'kontenJudul'.$lang} ?></a></h4>
                                        <p><?= $excerpt ?><?= mb_strlen($excerpt) < mb_strlen($rawExcerpt) ? '...' : '' ?></p>
                                        <div class="cms-detail-meta">
                                            <div class="meta-group">
                                                <?php if (!empty($row->kontenTanggal)): ?><span class="meta-item"><i class="fa fa-calendar"></i> <?= datetoindo($row->kontenTanggal) ?></span><?php endif; ?>
                                                <?php if (!empty($row->kontenAuthor)): ?><span class="meta-item"><i class="fa fa-user"></i> <?= $row->kontenAuthor ?></span><?php endif; ?>
                                                <?php if (!empty($row->{'kontenTag'.$lang})): ?><span class="meta-item"><i class="fa fa-tag"></i> <?= $row->{'kontenTag'.$lang} ?></span><?php endif; ?>
                                            </div>
                                            <a href="<?=base_url()?>page/detail/<?= $detailSlug ?>" class="cms-btn cms-btn-primary cms-btn-sm"><?= $lang=='ID' ? 'Lihat Selengkapnya' : 'Read More' ?> <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
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

        <div class="col-lg-3">
            <?php $this->load->view('page/sidebar'); ?>
        </div>

    </div>

</div>

</div>

