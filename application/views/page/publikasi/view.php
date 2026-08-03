<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div role="main" class="main">

    <section class="cms-page-banner">
        <div class="cms-page-banner-overlay"></div>
        <div class="container cms-page-banner-content">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()?>publikasi/publikasi/<?=$jenis_publikasi?>/"><?= $lang == 'ID' ? 'Publikasi' : 'Publication' ?></a></li>
                <li class="active"><?=$is_active?> <?= $lang == 'ID' ? $jenis_publikasi : $jenis_publikasiEN ?></li>
            </ul>
            <h1><?= $lang == 'ID' ? $jenis_publikasi : $jenis_publikasiEN ?></h1>
        </div>
    </section>

    <div class="container cms-content-page">

        <div class="row">
            <div class="col-lg-9">

                <form id="contactForm"action="<?=$searchpublikasi_url?>" method="POST">
                    <div class="form-row">
                       <div class="form-group col">
                            <label><?= $lang == 'ID' ? 'Tahun' : 'Year' ?></label>
                            <select class="form-control m-select2" id="hakakses" name="tahun">
                             <option value=""></option>
                             <?php for ($x = date('Y'); $x >= 2019; $x--) { ?>
                                <option value="<?= $x ?>"><?= $x ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if (($jenis_publikasi !='Penelitian') and ($jenis_publikasi !='Pengabdian Masyarakat')) {?>
                    <div class="form-group col">
                        <label><?= $lang == 'ID' ? 'Jenis' : 'Type' ?> <?= $lang == 'ID' ? $jenis_publikasi : $jenis_publikasiEN ?></label>
                        <select class="form-control m-select2" name="jenisp">
                           <option value=""></option>
                           <option value="%">Select All</option>
                            <?php
                                    if ($jenis_pub->data != false) {
                                        $rsuket = '';
                                        $i = 1;
                                        foreach ($jenis_pub->data as $row) {
                                            if ($rsuket != $row->rsuket) {
                                                if ($i > 1) {
                                                    echo '</optgroup>';
                                                }
                                                $rsuket = $row->rsuket;
                                                echo '<optgroup label="' . $rsuket . '">';
                                            }
                                            echo '<option value="' . $row->rkgid . '">'.$row->rkgkegiatan . '</option>';
                                            $i++;
                                        }
                                    }
                                    ?>

                    </select>
                </div>
                  <?php }?>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <input type="submit" value="Search" class="cms-btn cms-btn-primary" data-loading-text="Loading...">
                </div>
            </div>
        </form>

        <?php if ($dataspublikasi->status !== false) { ?>

            <div class="col-lg-12 text-center" style="margin-bottom:32px;">
                <h2 class="mt-2 mb-0"><strong> <?= $lang == 'ID' ? $jenis_publikasi : $jenis_publikasiEN ?></strong></h2>
                <br>
                <p class="lead"> <span class="alternative-font text-5"> <?= $lang == 'ID' ? 'Tahun' : 'Year' ?>
                     <?php if ($jenis_publikasi !='Pengabdian Masyarakat') { ?>
                         <?=$tahun?>
                      <?php }else{ ?>
                     <?=$tahunpm?>
                      <?php } ?> </span></p>
            </div>

            <div class="table-responsive">
            <table class="table table-hover" style="background:var(--cms-bg-card);border-radius:var(--cms-radius-md);overflow:hidden;box-shadow:var(--cms-shadow-sm);">
              <thead>
                 <tr style="background:var(--cms-primary);color:white;">
                    <?php if ($jenis_publikasi !='Pengabdian Masyarakat') {?>
                    <th style="padding:16px;">No</th>
                    <th style="padding:16px;">Title</th>
                    <th style="padding:16px;">Author</th>
                    <th style="padding:16px;">Member</th>
                    <th style="padding:16px;">Detail</th>
                    <?php }else{ ?>
                    <th style="padding:16px;">No</th>
                    <th style="padding:16px;">Description</th>
                    <th style="padding:16px;">Lecturer</th>
                    <th style="padding:16px;">Detail</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                  $nomor = $offset+1;
                foreach($dataspublikasi->data as $row) { ?>

                     <?php if ($jenis_publikasi !='Pengabdian Masyarakat') {?>
                 <tr>
                    <th scope="row" style="padding:12px 16px;"><?=$nomor++?></th>
                    <td style="padding:12px 16px;"><?=$row->pltjudul?> <br>
                        <?=$row->pltnama?></td>
                    <td style="padding:12px 16px;"><?=$row->pltpenulis?></td>
                    <td style="padding:12px 16px;"><?=$row->pegmNama?> (<?=$row->sebagai?>)</td>
                    <td style="padding:12px 16px;">Publisher : <?=$row->pltpenerbit?> <br> ISBN : <?=$row->pltisbn?></td>
                </tr>
            <?php }else{ ?>

                  <tr>
                    <th scope="row" style="padding:12px 16px;"><?=$nomor++?></th>
                    <td style="padding:12px 16px;"><?=$row->pgdketerangan?></td>
                    <td style="padding:12px 16px;"><?=$row->pegmNama?></td>
                    <td style="padding:12px 16px;">Semester : <?=$row->pgdsemester?> <br>
                        Date :<?=$row->pgdtanggal?></td>
                </tr>

             <?php } }
            ?>
        </tbody>
    </table>
    </div>
     <nav aria-label="Page navigation" class="cms-pagination">
        <?php echo $this->pagination->create_links(); ?>
    </nav>
<?php }else{?>
      <div class="col-lg-12 text-center">
                <h2 class="mt-2 mb-0"><strong> <?=$jenis_publikasi?></strong></h2>
                <p class="lead">Oppss!! Not Found  <span class="alternative-font text-4"> <?= $lang == 'ID' ? 'Tahun' : 'Year' ?>
                    <?php if ($jenis_publikasi !='Pengabdian Masyarakat') { ?>
                       <?=$tahun?>
                   <?php }else{ ?>
                       <?=$tahunpm?>
                   <?php } ?>
                       </span></p>
            </div>
<?php }?>
</div>

 <?php
    $this->load->view('page/sidebar');
    ?>
</div>

</div>

</div>

