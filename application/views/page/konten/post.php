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
				<div class="cms-content-article">
					<div class="cms-detail-body">
						<?= $datas != false ? $datas->{'pageContent'.$lang} : "" ?>
						<?php if ($datas != false && !empty($datas->{'pageTag'.$lang})) : ?>
							<div class="cms-detail-tag"><i class="fa fa-tag" aria-hidden="true"></i> <?= $datas->{'pageTag'.$lang} ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

