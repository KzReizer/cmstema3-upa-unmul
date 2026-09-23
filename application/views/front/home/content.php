
<div role="main" class="main">

    <!-- ============================================================
    1. HERO SECTION
    ============================================================ -->
    <section class="cms-hero" id="home">
        <div class="cms-hero-bg">
            <?php if ($slider != false) {
                $first = true;
                foreach ($slider as $sld) {
                    if ($first) { ?>
                        <img src="<?= $sld->sliderFile ?>" alt="" style="display:block;" />
            <?php $first = false;
                    }
                }
            } else { ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg, #005BAC, #003a75);"></div>
            <?php } ?>
        </div>
        <div class="cms-hero-overlay"></div>

        

     
       
    </section>

   

    <!-- ============================================================
    3. FACULTY PROFILE
    ============================================================ -->
    <section id="profil" class="cms-section cms-profile-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-reveal>
                    <div class="cms-profile-image">
                        <?php if ($logounit != false) {
                            foreach ($logounit as $lgu) { ?>
                                <div class="hero-photo-card">
                                    <img class="hero-photo-img" src="<?= $lgu->galeriFiles ?>" alt="<?= $master->{'temaNama' . $lang} ?>" loading="lazy">
                                </div>
                        <?php }
                        } else { ?>
                            <div class="hero-photo-card">
                                <img class="hero-photo-img" src="https://via.placeholder.com/600x400/005BAC/ffffff?text=Faculty+of+Agriculture" alt="Faculty" loading="lazy">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 cms-profile-content" data-reveal data-reveal-delay="200">
                    <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Tentang Kami' : 'About Us' ?></span>
                    <h2><strong><?= $master->{'temaNama' . $lang} ?></strong></h2>
                    <p><?= $master->{'temaDeskripsi' . $lang} ?></p>
                    
                </div>
            </div>
        </div>
    </section>

    <hr class="cms-divider">

    <!-- ============================================================
    4. STATISTICS SECTION 
    ============================================================ -->
    <?php if ($master->statTemaId != NULL && $stat != false) { ?>
        <section class="cms-section cms-stat-section">
            <div class="container">
                <div class="cms-stat-heading">
                    <div>
                        <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Capaian' : 'Highlights' ?></span>
                        <h2><?= $lang == 'ID' ? 'Fakultas dalam <strong>Angka</strong>' : 'Faculty in <strong>Numbers</strong>' ?></h2>
                    </div>
                    
                </div>
                <div class="cms-stat-grid">
                    <?php foreach ($stat as $index => $sta) { ?>
                        <div class="cms-stat-card" data-reveal>
                            <div class="cms-stat-card-top">
                                <span class="cms-stat-index"><?= sprintf('%02d', $index + 1) ?></span>
                                <i class="<?= $sta->refstatIcon ?>" aria-hidden="true"></i>
                            </div>
                            <strong data-to="<?= $sta->statJumlah ?>">0</strong>
                            <span class="cms-stat-card-line" aria-hidden="true"></span>
                            <label><?= $sta->refstatNamaID ?></label>
                            <span class="cms-stat-card-glow" aria-hidden="true"></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <hr class="cms-divider">
    <?php } ?>

    

    <hr class="cms-divider">

    <!-- ============================================================
    6. LATEST NEWS
    ============================================================ -->
    <?php if ($berita != false) { ?>
        <section id="berita-home" class="cms-section">
            <div class="container">
                <div class="text-center cms-section-heading">
                    <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Kabar Terkini' : 'Latest Stories' ?></span>
                    <h2><?= $lang == 'ID' ? '<strong>Berita</strong> Terbaru' : '<strong>Latest</strong> News' ?></h2>
                </div>
                <div class="news-grid row gx-4 gy-4">
                    <?php
                    $newsCount = 0;
                    foreach ($berita as $row) {
                        if ($newsCount >= 3) break;
                        $detailSlug = !empty($row->{'kontenNama'.$lang}) ? $row->{'kontenNama'.$lang} : (isset($row->kontenNamaID) ? $row->kontenNamaID : '');
                        $rawExcerpt = strip_tags($row->{'kontenIsi'.$lang});
                        $wrappedExcerpt = wordwrap($rawExcerpt, 150);
                        $excerpt = strpos($wrappedExcerpt, "\n") !== false ? substr($wrappedExcerpt, 0, strpos($wrappedExcerpt, "\n")) : substr($rawExcerpt, 0, 150);
                        $excerpt = trim($excerpt);
                    ?>
                        <article class="news-card col-12 col-md-6 col-lg-4" data-reveal>
                            <div class="card">
                                <div class="card-image">
                                    <div class="img-thumbnail">
                                        <?php if (!empty($row->kontenBanner)) { ?>
                                            <a href="<?= base_url() ?>page/detail/<?= $detailSlug ?>"><img class="img-fluid" src="<?= $row->kontenBanner ?>" alt="<?= htmlspecialchars($row->{'kontenJudul'.$lang}, ENT_QUOTES, 'UTF-8') ?>"></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>page/detail/<?= $detailSlug ?>"><img alt="" class="img-fluid" src="<?= site_url('page/loadthumb/noimage.jpg');?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="<?= base_url() ?>page/detail/<?= $detailSlug ?>"><?= htmlspecialchars($row->{'kontenJudul'.$lang}, ENT_QUOTES, 'UTF-8') ?></a></h4>
                                    <p class="card-excerpt"><?= $excerpt ?><?= mb_strlen($excerpt) < mb_strlen($rawExcerpt) ? '...' : '' ?></p>
                                    <div class="cms-detail-meta">
                                        <div class="meta-group">
                                            <?php if (!empty($row->kontenTanggal)): ?><span class="meta-item"><i class="fa fa-calendar"></i> <?= datetoindo($row->kontenTanggal) ?></span><?php endif; ?>
                                            <?php if (!empty($row->kontenAuthor)): ?><span class="meta-item"><i class="fa fa-user"></i> <?= $row->kontenAuthor ?></span><?php endif; ?>
                                            <?php if (!empty($row->{'kontenTag'.$lang})): ?><span class="meta-item"><i class="fa fa-tag"></i> <?= $row->{'kontenTag'.$lang} ?></span><?php endif; ?>
                                        </div>
                                        <a href="<?= base_url() ?>page/detail/<?= $detailSlug ?>" class="cms-btn cms-btn-primary cms-btn-sm"><?= $lang == 'ID' ? 'Baca Selengkapnya' : 'Read More' ?> <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php
                        $newsCount++;
                    }
                    ?>
                </div>
                <div class="text-center mt-5">
                    <a class="cms-btn cms-btn-outline" href="<?= base_url() ?>page/list/berita">
                        <?= $lang == 'ID' ? 'Lihat Semua Berita' : 'View All News' ?>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <hr class="cms-divider">
    <?php } ?>

    <!-- ============================================================
    7. QUOTE / TESTIMONIAL
    ============================================================ -->
    <?php if ($quote != false && !empty($quote)) { ?>
        <section class="cms-section cms-testimonials-section" id="testimonials">
            <div class="container">
                <div class="cms-section-heading cms-testimonials-heading">
                    <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Ucapan' : 'Quotes' ?></span>
                    <h2><?= $lang == 'ID' ? '<strong>Kata</strong> Mereka' : '<strong>What </strong> They Say' ?></h2>
                    <p><?= $lang == 'ID' ? 'Cerita dan dukungan dari keluarga besar Universitas Mulawarman.' : 'Stories and support from the Universitas Mulawarman community.' ?></p>
                </div>
                <div class="cms-testimonials-grid">
                    <?php foreach ($quote as $index => $quo) {
                            $quoteName = htmlspecialchars($quo->quoteNama, ENT_QUOTES, 'UTF-8');
                            $quoteRole = htmlspecialchars($quo->quoteJabatan, ENT_QUOTES, 'UTF-8');
                            $quoteText = htmlspecialchars($quo->{'quoteIsi' . $lang}, ENT_QUOTES, 'UTF-8');
                            $quoteImage = !empty($quo->quoteFile) ? htmlspecialchars($quo->quoteFile, ENT_QUOTES, 'UTF-8') : '';
                    ?>
                        <article class="cms-testimonial-card" data-testimonial-index="<?= $index ?>">
                            <div class="cms-testimonial-card-inner">
                                <div class="cms-testimonial-card-top">
                                    <?php if ($quoteImage) { ?>
                                        <img class="cms-testimonial-avatar" src="<?= $quoteImage ?>" alt="<?= $quoteName ?>" loading="lazy">
                                    <?php } else { ?>
                                        <span class="cms-testimonial-avatar cms-testimonial-avatar-fallback" aria-hidden="true"><?= strtoupper(mb_substr($quo->quoteNama, 0, 1)) ?></span>
                                    <?php } ?>
                                    <span class="cms-testimonial-quote-mark" aria-hidden="true">“</span>
                                </div>
                                <blockquote class="cms-testimonial-quote"><?= $quoteText ?></blockquote>
                                <footer class="cms-testimonial-author">
                                    <strong><?= $quoteName ?></strong>
                                    <span><?= $quoteRole ?></span>
                                </footer>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <div class="cms-testimonials-controls" aria-label="<?= $lang == 'ID' ? 'Navigasi testimonial' : 'Testimonial navigation' ?>">
                    <button type="button" class="cms-testimonial-control cms-testimonial-prev" aria-label="<?= $lang == 'ID' ? 'Enam quote sebelumnya' : 'Previous six quotes' ?>">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </button>
                    <span class="cms-testimonials-page" aria-live="polite"></span>
                    <button type="button" class="cms-testimonial-control cms-testimonial-next" aria-label="<?= $lang == 'ID' ? 'Enam quote berikutnya' : 'Next six quotes' ?>">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        <hr class="cms-divider">
    <?php } ?>

   

    <!-- ============================================================
    9. GALLERY / EXPLORE
    ============================================================ -->
    <?php if (!empty($master->{'temaJelajah' . $lang}) && $explore != false) { ?>
        <section class="cms-section">
            <div class="container">
                <div class="text-center cms-section-heading">
                    <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Galeri' : 'Gallery' ?></span>
                    <h2><?= $lang == 'ID' ? 'Jelajahi <strong>Kampus</strong>' : '<strong>Explore</strong> Our Campus' ?></h2>
                    <p><?= $master->{'temaJelajah' . $lang} ?></p>
                </div>
                <div class="cms-gallery-grid">
                    <?php
                    $galleryCount = 0;
                    foreach ($explore as $xpl) {
                        if ($galleryCount >= 4) break;
                    ?>
                        <div class="cms-gallery-item" data-reveal>
                            <a class="cms-gallery-link" href="<?= $xpl->galeriFiles ?>">
                                <img src="<?= $xpl->galeriFiles ?>" alt="Gallery">
                                <div class="cms-gallery-overlay">
                                    <span><i class="fa fa-search-plus"></i> <?= $lang == 'ID' ? 'Lihat' : 'View' ?></span>
                                </div>
                            </a>
                        </div>
                    <?php $galleryCount++;
                    } ?>
                </div>
            </div>
        </section>

        <hr class="cms-divider">
    <?php } ?>

    <!-- ============================================================
    10. DYNAMIC CONTENT FROM ADMIN
    ============================================================ -->
    <?php if (!empty($master->temaIntro)) { ?>
        <section class="cms-section">
            <div class="container">
                <?= $master->temaIntro ?>
            </div>
        </section>
    <?php } ?>

    <?php if (!empty($master->temaHomeStatis)) { ?>
        <section class="cms-section">
            <div class="container">
                <?= $master->temaHomeStatis ?>
            </div>
        </section>
    <?php } ?>

    <!-- ============================================================
    11. PARTNER LOGOS
    ============================================================ -->
    <section class="cms-partner-section">
        <div class="container">
            <div class="text-center cms-section-heading" style="margin-bottom:32px;">
                <span class="cms-eyebrow"><?= $lang == 'ID' ? 'Mitra' : 'Partners' ?></span>
                <h2 class="cms-partner-title"><?= $lang == 'ID' ? 'Bersama Mitra Strategis' : 'Our Strategic Partners' ?></h2>
            </div>
            <div class="cms-partner-carousel">
                <div class="owl-carousel owl-theme" data-plugin-options="{'items': 6, 'autoplay': true, 'autoplayTimeout': 3000, 'responsive': {'0':{'items':3}, '768':{'items':4}, '992':{'items':6}}}">
                    <?php if ($logo != false) {
                        foreach ($logo as $lgo) { ?>
                            <div class="cms-partner-card">
                                <a href="<?= $lgo->galeriLinkEmbed ?>" target="_blank" rel="noopener noreferrer">
                                    <div class="cms-partner-logo-wrap">
                                        <img class="cms-partner-logo" loading="lazy" src="<?= $lgo->galeriFiles ?>" alt="Partner" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27180%27 height=%2780%27%3E%3Crect width=%27180%27 height=%2780%27 fill=%27%23005BAC%27/%3E%3Ctext x=%2790%27 y=%2748%27 font-size=%2712%27 text-anchor=%27middle%27 fill=%27white%27 font-family=%27Inter,sans-serif%27%3EPartner%3C/text%3E%3C/svg%3E';">
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </section>

</div>
