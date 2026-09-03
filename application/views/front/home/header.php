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

            <!-- Theme Selector -->
            <div class="cms-theme-switch" role="group" aria-label="<?= $lang == 'ID' ? 'Pilih tema' : 'Choose theme' ?>">
                <button class="cms-theme-option" type="button" data-theme-choice="light" aria-label="<?= $lang == 'ID' ? 'Mode terang' : 'Light mode' ?>" aria-pressed="false">
                    <i class="fa fa-sun-o" aria-hidden="true"></i><span><?= $lang == 'ID' ? 'Terang' : 'Light' ?></span>
                </button>
                <button class="cms-theme-option" type="button" data-theme-choice="dark" aria-label="<?= $lang == 'ID' ? 'Mode gelap' : 'Dark mode' ?>" aria-pressed="false">
                    <i class="fa fa-moon-o" aria-hidden="true"></i><span><?= $lang == 'ID' ? 'Gelap' : 'Dark' ?></span>
                </button>
            </div>

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
            <button class="cms-navbar-toggle" type="button" aria-expanded="false" aria-controls="cmsMobileDrawer" aria-label="<?= $lang == 'ID' ? 'Buka menu' : 'Toggle menu' ?>">
                <span></span>
            </button>
        </div>
    </div>
    <?php $this->load->view('front/partials/mobile_drawer'); ?>
</nav>
