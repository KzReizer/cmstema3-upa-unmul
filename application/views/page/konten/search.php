<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div role="main" class="main">

    <section class="cms-page-banner">
        <div class="cms-page-banner-overlay"></div>
        <div class="container cms-page-banner-content">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="active">Informasi</li>
            </ul>
            <h1>Pencarian</h1>
        </div>
    </section>

    <div class="container cms-content-page">

        <div class="row">
            <div class="col-lg-9">
                <div class="cms-content-list">
                    <?php if ($keyword !== FALSE) :
                        if (empty($datasearch)) { ?>
                            <div>
                                <p>Tidak ditemukan data dengan kata kunci "<?= $this->session->keyword ?>"</p>
                            </div>
                        <?php } else { ?>
                            <div>
                                <h4>Telah ditemukan <?= $datasearch !== false ? count($datasearch) : "" ?> konten dengan kata kunci "<?= $this->session->keyword ?>"</h4>
                                <br>
                            </div>
                        <?php }
                    endif;
                    if ($datasearch !== false) {
                        $i = 1;
                        foreach ($datasearch as $row) { ?>

                            <div class="cms-content-list-item" style="flex-direction:column;">
                                <div class="row" style="width:100%;">
                                    <div class="col-lg-5">
                                        <div class="post-image">
                                            <div>
                                                <?php if (!empty($row->kontenBanner)) { ?>
                                                    <div class="img-thumbnail" style="border:none;border-radius:var(--cms-radius-md);overflow:hidden;">
                                                        <a href="<?=base_url()?>page/detail/<?= $row->{'kontenNama' . $lang} ?>"><img class="img-fluid" src="<?= $row->kontenBanner ?>" style="border-radius:var(--cms-radius-md);"></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="img-thumbnail" style="border:none;border-radius:var(--cms-radius-md);overflow:hidden;">
                                                        <img alt="" class="img-fluid" src="<?= site_url('page/loadthumb/noimage.jpg'); ?>" style="border-radius:var(--cms-radius-md);">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="list-content">
                                            <a href="<?= base_url(); ?>page/list/<?= strtolower($row->kategoriNama) ?>"><span class="badge badge-primary badge-sm" style="background:var(--cms-primary);padding:4px 12px;border-radius:var(--cms-radius-full);font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;"><?= $row->kategoriNama ?></span></a>
                                            <h4><a href="../../page/detail/<?= $row->{'kontenNama' . $lang} ?>"><?= $row->{'kontenJudul' . $lang} ?></a></h4>
                                            <p><?= substr($row->{'kontenIsi' . $lang}, 0, strpos(wordwrap($row->{'kontenIsi' . $lang}, 200), "\n")); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="width:100%;">
                                    <div class="col">
                                        <div class="cms-detail-meta">
                                            <span><i class="fa fa-calendar"></i> <?= datetoindo($row->kontenTanggal) ?> </span>
                                            <span><i class="fa fa-user"></i> By <?= $row->kontenAuthor ?> </span>
                                            <span><i class="fa fa-tag"></i> <?= $row->{'kontenTag' . $lang} ?> </span>
                                            <span class="d-block d-md-inline-block float-md-right mt-3 mt-md-0"><a href="../../page/detail/<?= $row->{'kontenNama' . $lang} ?>" class="cms-btn cms-btn-primary cms-btn-sm"><?= $lang == 'ID' ? 'Lihat Selengkapnya' : 'Read More' ?> <i class="fa fa-arrow-right"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php $i++;
                        }
                    } ?>
                </div>
                <nav aria-label="Page navigation" class="cms-pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>

            <?php
            $this->load->view('page/sidebar');
            ?>
        </div>

    </div>

</div>

