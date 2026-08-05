<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div role="main" class="main">

    <section class="cms-page-banner">
        <div class="cms-page-banner-overlay"></div>
        <div class="container cms-page-banner-content">
            <ul class="breadcrumb">
                
            </ul>
            <h1><?=$is_active?></h1>
        </div>
    </section>

    <div class="container cms-content-page">

        <div class="row">
            <div class="col-12">
                <div class="news-grid row gx-4 gy-4">
                    <?php
                    if($konten!==false) {
                        $count = 0;
                        foreach($konten as $row) {
                            // safety: ensure we only render up to 9 items in the view (controller should limit)
                            if ($count >= 9) break;
                            $detailSlug = !empty($row->{'kontenNama'.$lang}) ? $row->{'kontenNama'.$lang} : (isset($row->kontenNamaID) ? $row->kontenNamaID : '');
                            $rawExcerpt = strip_tags($row->{'kontenIsi'.$lang});
                            $wrappedExcerpt = wordwrap($rawExcerpt, 250);
                            $excerpt = strpos($wrappedExcerpt, "\n") !== false ? substr($wrappedExcerpt, 0, strpos($wrappedExcerpt, "\n")) : substr($rawExcerpt, 0, 250);
                            $excerpt = trim($excerpt);
                    ?>
                        <article class="news-card col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-image">
                                    <div class="img-thumbnail">
                                        <?php if (!empty($row->kontenBanner)) { ?>
                                            <a href="<?=base_url()?>page/detail/<?= $detailSlug ?>"><img class="img-fluid" src="<?= $row->kontenBanner ?>" alt="<?= htmlentities($row->{'kontenJudul'.$lang}) ?>"></a>
                                        <?php } else { ?>
                                            <a href="<?=base_url()?>page/detail/<?= $detailSlug ?>"><img alt="" class="img-fluid" src="<?=site_url('page/loadthumb/noimage.jpg');?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="<?=base_url()?>page/detail/<?= $detailSlug ?>"><?= $row->{'kontenJudul'.$lang} ?></a></h4>
                                    <p class="card-excerpt"><?= $excerpt ?><?= mb_strlen($excerpt) < mb_strlen($rawExcerpt) ? '...' : '' ?></p>
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
                        </article>
                    <?php
                        $count++;
                        }
                    }else{?>
                    <h5>Oppssss.. Tidak Ada Data  <?=$is_active ?> !</h5>
                    <?php
                    }?>
                </div>

                <nav aria-label="Page navigation" class="cms-pagination mt-4">
                    <?= $this->pagination->create_links(); ?>
                </nav>

            </div>
        </div>

    </div>

</div>

</div>

