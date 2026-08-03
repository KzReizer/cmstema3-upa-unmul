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
			<div class="col-lg-9">
				<div class="cms-content-article">
					<div class="cms-detail-body">
						<p><?= $datas!=false?$datas->{'pageContent'.$lang}:""?></p>
						<i class="fa fa-tag"> <?= $datas!=false?$datas->{'pageTag'.$lang}:""?></i>
					</div>
				</div>
			</div>
			<?php $this->load->view('page/sidebar');?>
		</div>
	</div>

</div>

