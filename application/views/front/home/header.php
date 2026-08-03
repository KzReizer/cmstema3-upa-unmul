<!-- Old Porto Header (kept hidden for compatibility) -->
<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-55px', 'stickyChangeLogo': true}" style="display:none;">
	<div class="header-body">
		<div class="header-container container">
			<div class="header-row">
				<div class="header-column">
					<div class="header-row">
						<?php if (empty($master->temaLogo)) { ?>
							<div class="header-logo">
								<a href="<?php echo base_url(); ?>">
									<img alt="Unmul" width="auto" height="88" data-sticky-width="auto" data-sticky-height="46" data-sticky-top="45" src="<?php echo base_url(); ?>front/img/logo/unmul.png">
								</a>
							</div>
							<div class="header-logo">
								<a href="<?php echo base_url(); ?>">
									<img alt="BLU" width="auto" height="88" data-sticky-width="auto" data-sticky-height="46" data-sticky-top="45" src="<?php echo base_url(); ?>front/img/logo/blu450.png">
								</a>
							</div>
						<?php } else { ?>
							<div class="header-logo">
								<a href="<?php echo base_url(); ?>">
									<img alt="Unmul" width="auto" height="88" data-sticky-width="auto" data-sticky-height="46" data-sticky-top="45" src="<?= $master->temaLogo ?>">
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="header-column justify-content-end" style="col-lg-11">
					<div class="header-row pt-3">
						<nav class="header-nav-top">
							<ul class="nav nav-pills">
								<li class="nav-item dropdown">
									<a class="nav-link" href="#" role="button" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<img src="<?php echo base_url(); ?>front/img/blank.gif" class="flag <?= $lang == 'ID' ? 'flag-id' : 'flag-us' ?>" alt="Indonesia" /> <?= $lang == 'ID' ? 'Indonesia' : 'English' ?>
										<i class="fa fa-angle-down"></i>
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownLanguage">
										<a class="dropdown-item lang" lang-value='EN' href="javascript:void(0)"><img src="<?php echo base_url(); ?>front/img/blank.gif" class="flag flag-us" alt="English" /> English</a>
										<a class="dropdown-item lang" lang-value='ID' href="javascript:void(0)"><img src="<?php echo base_url(); ?>front/img/blank.gif" class="flag flag-id" alt="Indonesia" /> Indonesia</a>
									</div>
								</li>
							</ul>
							<ul class="header-social-icons social-icons d-none d-sm-block">
								<li class="social-icons-facebook"><a href="<?= $master->footLinkFacebook ?>" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-youtube"><a href="<?= $master->footLinkYoutube ?>" target="_blank" title="YouTube"><i class="fa fa-youtube"></i></a></li>
								<li class="social-icons-instagram"><a href="<?= $master->footLinkInstagram ?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</nav>
						<div class="header-search d-none d-md-block">
							<form id="keyword" action="<?= $search_url ?>" method="post">
								<div class="input-group">
									<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search..." required>
									<span class="input-group-btn">
										<button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<div class="header-row">
						<div class="header-nav">
							<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
								<nav class="collapse">
									<ul class="nav nav-pills" id="mainNav">
										<li class="dropdown">
											<a class="nav-item <?php echo $is_active == 'home' ? 'start active open' : ''; ?>" href="<?php echo base_url(); ?>">
												<?= $lang == 'ID' ? 'Beranda' : 'Home' ?>
											</a>
										</li>
										<?php
										if ($menu !== false) {
											foreach ($menu as $row) {
												if ($row['parentId'] == '2') {
										?>
													<li class="dropdown">
														<a class="nav-item" href="<?= !empty($row['link']) ? $row['link'] : base_url() . "page?content=" . $row['headId'] ?>">
															<?= $row['headNama'] ?>
														</a>
													</li>
												<?php
												} else {
												?>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle <?= $row['headId'] == $is_active ? 'active open' : '' ?>" href="#">
															<?= $row['headNama'] ?>
														</a>
														<ul class="dropdown-menu">
															<?php
															foreach ($row['child'] as $cRow) {
															?>
																<li><a class="dropdown-item" href="<?= !empty($cRow->pageLink) ? $cRow->pageLink : base_url().'page?content='.$cRow->{'pageNama' . $lang}; ?>"><?= $cRow->{'pageJudul' . $lang} ?></a></li>
															<?php
															}
															?>
														</ul>
													</li>
										<?php
												}
											}
										}
										?>
										<?php if ($master->temaPub != NULL) { ?>
											<li class="dropdown">
												<a class="dropdown-item dropdown-toggle <?php echo $is_active == 'publikasi' ? ' active open' : ''; ?>" href="#">
													<?= $lang == 'ID' ? 'Publikasi' : 'Publication' ?>
												</a>
												<ul class="dropdown-menu">
													<?php if ($publikasi !== false) {
														foreach ($publikasi as $row) { ?>
															<li class="dropdown">
																<a class="dropdown-item" href="<?= base_url(); ?>publikasi/publikasi/<?= strtolower($row->publikasiNama) ?>">
																	<?= $row->{'publikasiKet' . $lang} ?>
																</a>
															</li>
													<?php }
													} ?>
												</ul>
											</li>
										<?php } ?>
										<li class="dropdown">
											<a class="dropdown-item dropdown-toggle <?php echo $is_active == 'ragam' ? ' active open' : ''; ?>" href="#">
												<?= $lang == 'ID' ? 'Informasi' : 'Information' ?>
											</a>
											<ul class="dropdown-menu">
										<?php if ($master->temaIKU == '1') { ?>
												<?php if ($kategoriiku !== false) {
													foreach ($kategoriiku as $row) { ?>
														<li class="dropdown">
															<a class="dropdown-item" href="<?= base_url(); ?>page/list/<?= strtolower($row->kategoriNama) ?>">
																<?= $row->{'kategoriKet' . $lang} ?>
															</a>
														</li>
												<?php }
												} ?>
										<?php } else { ?>
												<?php if ($kategori !== false) {
													foreach ($kategori as $row) { ?>
														<li class="dropdown">
															<a class="dropdown-item" href="<?= base_url(); ?>page/list/<?= strtolower($row->kategoriNama) ?>">
																<?= $row->{'kategoriKet' . $lang} ?>
															</a>
														</li>
												<?php }
												} ?>
										<?php } ?>
											</ul>
										</li>
									</ul>
								</nav>
							</div>
							<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
								<i class="fa fa-bars"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- ===== NEW MODERN GLASSMORPHISM NAVBAR ===== -->
<nav class="cms-navbar" role="navigation" aria-label="<?= $lang == 'ID' ? 'Navigasi utama' : 'Main navigation' ?>">
    <div class="cms-navbar-inner">
        <!-- Logo -->
        <div class="cms-navbar-logo">
            <?php if (empty($master->temaLogo)) { ?>
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>front/img/logo/unmul.png" alt="Universitas Mulawarman">
                </a>
            <?php } else { ?>
                <a href="<?php echo base_url(); ?>">
                    <img src="<?= $master->temaLogo ?>" alt="<?= $master->{'temaNama' . $lang} ?>">
                </a>
            <?php } ?>
            <div class="cms-navbar-logo-text d-none d-lg-block">
                <span class="brand-top"><?= $master->{'temaNama' . $lang} ?></span>
                <span class="brand-bottom">Universitas Mulawarman</span>
            </div>
        </div>

        <!-- Navigation -->
        <ul class="cms-navbar-nav" id="cmsNav">
            <li class="<?php echo $is_active == 'home' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>"><?= $lang == 'ID' ? 'Beranda' : 'Home' ?></a>
            </li>

            <?php
            if ($menu !== false) {
                foreach ($menu as $row) {
                    if ($row['parentId'] == '2') {
            ?>
                        <li>
                            <a href="<?= !empty($row['link']) ? $row['link'] : base_url() . "page?content=" . $row['headId'] ?>">
                                <?= $row['headNama'] ?>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="#" class="<?= $row['headId'] == $is_active ? 'active' : '' ?>">
                                <?= $row['headNama'] ?>
                            </a>
                            <div class="cms-dropdown-menu">
                                <?php
                                foreach ($row['child'] as $cRow) {
                                ?>
                                    <a href="<?= !empty($cRow->pageLink) ? $cRow->pageLink : base_url() . 'page?content=' . $cRow->{'pageNama' . $lang}; ?>">
                                        <?= $cRow->{'pageJudul' . $lang} ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
            <?php
                    }
                }
            }
            ?>

            <?php if ($master->temaPub != NULL) { ?>
                <li>
                    <a href="#" class="<?php echo $is_active == 'publikasi' ? 'active' : ''; ?>">
                        <?= $lang == 'ID' ? 'Publikasi' : 'Publication' ?>
                    </a>
                    <div class="cms-dropdown-menu">
                        <?php
                        if ($publikasi !== false) {
                            foreach ($publikasi as $row) {
                        ?>
                                <a href="<?= base_url(); ?>publikasi/publikasi/<?= strtolower($row->publikasiNama) ?>">
                                    <?= $row->{'publikasiKet' . $lang} ?>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </li>
            <?php } ?>

            <li>
                <a href="#" class="<?php echo $is_active == 'ragam' ? 'active' : ''; ?>">
                    <?= $lang == 'ID' ? 'Informasi' : 'Information' ?>
                </a>
                <div class="cms-dropdown-menu">
                    <?php if ($master->temaIKU == '1') { ?>
                        <?php if ($kategoriiku !== false) {
                            foreach ($kategoriiku as $row) { ?>
                                <a href="<?= base_url(); ?>page/list/<?= strtolower($row->kategoriNama) ?>">
                                    <?= $row->{'kategoriKet' . $lang} ?>
                                </a>
                        <?php }
                        } ?>
                    <?php } else { ?>
                        <?php if ($kategori !== false) {
                            foreach ($kategori as $row) { ?>
                                <a href="<?= base_url(); ?>page/list/<?= strtolower($row->kategoriNama) ?>">
                                    <?= $row->{'kategoriKet' . $lang} ?>
                                </a>
                        <?php }
                        } ?>
                    <?php } ?>
                </div>
            </li>
        </ul>

        <!-- Actions -->
        <div class="cms-navbar-actions">
            <!-- Language Switcher (Animated Dropdown) -->
            <div class="cms-lang-dropdown" id="cmsLangDropdown" data-lang-url="<?= site_url('beranda/switchlang') ?>">
                <button class="cms-nav-btn cms-lang-btn" type="button" aria-haspopup="true" aria-expanded="false" aria-label="<?= $lang == 'ID' ? 'Bahasa' : 'Language' ?>">
                    <i class="fa fa-globe"></i>
                    <span class="cms-lang-code"><?= $lang ?></span>
                </button>
                <div class="cms-lang-menu" role="menu">
                    <a class="cms-lang-item lang <?= $lang == 'EN' ? 'active' : '' ?>" lang-value="EN" href="javascript:void(0)" role="menuitem">
                        <img src="<?php echo base_url(); ?>front/img/blank.gif" class="flag flag-us" alt="English" /> English
                    </a>
                    <a class="cms-lang-item lang <?= $lang == 'ID' ? 'active' : '' ?>" lang-value="ID" href="javascript:void(0)" role="menuitem">
                        <img src="<?php echo base_url(); ?>front/img/blank.gif" class="flag flag-id" alt="Indonesia" /> Indonesia
                    </a>
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <button class="cms-dark-toggle" aria-label="<?= $lang == 'ID' ? 'Mode gelap' : 'Dark mode' ?>">
                <span class="cms-dark-toggle-thumb">☀️</span>
            </button>

<!-- Inline Expanding Search Box -->
            <div class="cms-nav-search" id="cmsNavSearch">
                <form action="<?= $search_url ?>" method="post" class="cms-nav-search-form" id="cmsSearchForm">
                    <i class="fa fa-search cms-nav-search-icon"></i>
                    <input type="text" name="keyword" id="cmsSearchInput" class="cms-nav-search-input" placeholder="<?= $lang == 'ID' ? 'Cari...' : 'Search...' ?>" autocomplete="off" required>
                    <button type="submit" class="cms-nav-search-submit" aria-label="<?= $lang == 'ID' ? 'Cari' : 'Search' ?>">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            <!-- Search Trigger -->
            <button class="cms-nav-btn cms-search-trigger" type="button" aria-label="<?= $lang == 'ID' ? 'Cari' : 'Search' ?>">
                <i class="fa fa-search"></i>
            </button>

            <!-- Mobile Toggle -->
            <button class="cms-navbar-toggle" aria-label="<?= $lang == 'ID' ? 'Buka menu' : 'Toggle menu' ?>">
                <span></span>
            </button>
        </div>
    </div>
</nav>
