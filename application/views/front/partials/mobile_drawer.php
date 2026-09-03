<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="cms-drawer-backdrop" data-drawer-backdrop hidden></div>
<div class="cms-drawer" id="cmsMobileDrawer" data-drawer hidden aria-hidden="true" role="dialog" aria-modal="true" aria-label="Mobile navigation">
    <div class="cms-drawer-header">
        <button class="cms-drawer-close" data-drawer-close aria-label="Close menu">
            <i class="fa fa-times"></i>
        </button>
        <div class="cms-drawer-brand">
            <?php if (empty($master->temaLogo)) { ?>
                <a href="<?= base_url() ?>"><img src="<?= base_url() ?>front/img/logo/unmul.png" alt="<?= $master->{'temaNama'.$lang} ?>"></a>
            <?php } else { ?>
                <a href="<?= base_url() ?>"><img src="<?= $master->temaLogo ?>" alt="<?= $master->{'temaNama'.$lang} ?>"></a>
            <?php } ?>
        </div>
    </div>
    <div class="cms-drawer-body">
        <div class="cms-drawer-search">
            <form action="<?= $search_url ?>" method="post">
                <input type="text" name="keyword" placeholder="<?= $lang=='ID'?'Cari...':'Search...' ?>" aria-label="Search">
                <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <nav class="cms-drawer-nav" aria-label="Mobile main navigation">
            <ul>
                <li class="<?= $is_active=='home'?'active':'' ?>"><a href="<?= base_url() ?>"><?= $lang=='ID'?'Beranda':'Home' ?></a></li>
                <?php if ($menu !== false) {
                    foreach ($menu as $row) {
                        if ($row['parentId']=='2') { ?>
                            <li><a href="<?= !empty($row['link']) ? $row['link'] : base_url() . 'page?content=' . $row['headId'] ?>"><?= $row['headNama'] ?></a></li>
                        <?php } else { ?>
                            <li class="has-children">
                                <button class="drawer-accordion-toggle" aria-expanded="false"><?= $row['headNama'] ?> <i class="fa fa-chevron-down"></i></button>
                                <ul class="drawer-submenu" hidden>
                                    <?php foreach ($row['child'] as $cRow) { ?>
                                        <li><a href="<?= !empty($cRow->pageLink) ? $cRow->pageLink : base_url().'page?content='.$cRow->{'pageNama'.$lang} ?>"><?= $cRow->{'pageJudul'.$lang} ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                    }
                } ?>
            </ul>
        </nav>

        <div class="cms-drawer-footer">
            <div class="cms-drawer-footer-heading">
                <span><?= $lang == 'ID' ? 'Pengaturan' : 'Settings' ?></span>
            </div>
            <div class="cms-drawer-lang" role="group" aria-label="<?= $lang == 'ID' ? 'Pilih bahasa' : 'Choose language' ?>">
                <span class="cms-drawer-lang-label"><?= $lang == 'ID' ? 'Bahasa' : 'Language' ?></span>
                <a href="javascript:void(0)" class="lang <?= $lang == 'EN' ? 'active' : '' ?>" lang-value="EN">English</a>
                <a href="javascript:void(0)" class="lang <?= $lang == 'ID' ? 'active' : '' ?>" lang-value="ID">Indonesia</a>
            </div>
            <div class="cms-theme-switch cms-drawer-theme-switch" role="group" aria-label="<?= $lang == 'ID' ? 'Pilih tema' : 'Choose theme' ?>">
                <span class="cms-drawer-setting-label"><?= $lang == 'ID' ? 'Tampilan' : 'Appearance' ?></span>
                <div class="cms-theme-options">
                    <button class="cms-theme-option" type="button" data-theme-choice="light" aria-label="<?= $lang == 'ID' ? 'Mode terang' : 'Light mode' ?>" aria-pressed="false">
                        <i class="fa fa-sun-o" aria-hidden="true"></i><span><?= $lang == 'ID' ? 'Terang' : 'Light' ?></span>
                    </button>
                    <button class="cms-theme-option" type="button" data-theme-choice="dark" aria-label="<?= $lang == 'ID' ? 'Mode gelap' : 'Dark mode' ?>" aria-pressed="false">
                        <i class="fa fa-moon-o" aria-hidden="true"></i><span><?= $lang == 'ID' ? 'Gelap' : 'Dark' ?></span>
                    </button>
                </div>
            </div>
            <div class="cms-drawer-footer-note">
                <?= $lang == 'ID' ? 'Sesuaikan tampilan dan bahasa situs.' : 'Customize the site language and appearance.' ?>
            </div>
        </div>
    </div>
</div>
