<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div role="main" class="main">

    <section class="cms-page-banner">
        <div class="cms-page-banner-overlay"></div>
        <div class="container cms-page-banner-content">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url()?>">Home</a></li>
            </ul>
            <h1>News, Event, Announcement, Journal & Agenda</h1>
        </div>
    </section>

    <div class="container cms-content-page">

        <div class="row">
            <div class="col-12">
                <div class="cms-content-list">
                <?php if ($keyword !== FALSE): ?>
    <div>
        <h4>Search results with keyword "<?=$this->session->keyword?>"</h4>
    </div>
    <br>
    <br>
    <?php if (empty($datassearch)): ?>
      <div>
        <p>Datas Not Found with Keyword "<?=$this->session->keyword?>"</p>
      </div>
    <?php endif ?>
  <?php endif; ?> 
                <?php
	                if($datassearch!==false) {
	                	$i = 1;
						foreach($datassearch as $row) { ?>

                      <?php if ($row->beritaSection == in_array($row->beritaSection , array("agenda","berita","pengumuman","kegiatan"))) { ?>

                    <div class="cms-content-list-item" style="flex-direction:column;">
                        <div class="row" style="width:100%;">

                            <div class="col-lg-5">
                                <div class="post-image">
                                        <div>
                                            <div class="img-thumbnail" style="border:none;border-radius:var(--cms-radius-md);overflow:hidden;">
                                                <img class="img-fluid" src="<?php echo base_url('berita/loadthumb/') . $row->beritaBanner ?>" alt="" style="border-radius:var(--cms-radius-md);">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-7">

                                <div class="list-content">
                                    <h4><a href="<?php echo base_url() ?>berita/post/<?= $row->BeritaNamaEng ?>"><?=$row->BeritaJudulEng?></a></h4>
                                    <p><?= substr(strip_tags($row->BeritaContentEng), 0, 200) . '...'; ?></p>
                                    
                                </div>
                            </div>

                        </div>
                        <div class="row" style="width:100%;">
                            <div class="col">
                                <div class="cms-detail-meta">
                                    <span><i class="fa fa-calendar"></i> <?=$row->beritaDatetime?> </span>
                                    <span><i class="fa fa-user"></i> By <?=$row->beritaAuthor?> </span>
                                    <span><i class="fa fa-tag"></i> <?=$row->beritaTag?> </span>
                                    <span class="d-block d-md-inline-block float-md-right mt-3 mt-md-0"><a href="<?php echo base_url() ?>berita/post/<?= $row->BeritaNamaEng ?>" class="cms-btn cms-btn-primary cms-btn-sm">Read more... <i class="fa fa-arrow-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else { ?>
                     <div class="cms-content-list-item" style="flex-direction:column;">                       
                        <div>
                            <div class="row" style="width:100%;">
                                <div class="col-sm-6">
                                    <div class="feature-box">
                                        <div class="feature-box-icon">
                                            <i class="fa fa-group"></i>
                                        </div>
                                        <div class="feature-box-info">
                                            <h4 class="mb-0" style="font-family:var(--cms-font-heading);font-weight:600;"><?=$row->BeritaJudulEng?></h4>
                                            <div class="row" style="width:100%;">
                                                <div class="col">
                                                    <div class="cms-detail-meta">
                                                        <span><i class="fa fa-calendar"></i> <?=$row->beritaDatetime?> </span>
                                                        <span><i class="fa fa-user"></i>By <?=$row->BeritaNamaEng?> </span>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4"><a href="<?=$row->beritaTag?>">Journal Link</a></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php } ?>
            <?php   $i++;}} ?>
                </div>
            </div>
        </div>

    </div>

</div>

