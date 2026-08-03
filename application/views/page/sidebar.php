<?php if (empty($datas->{'pageSidebar' . $lang})) { ?>
    <aside class="cms-sidebar">
        <!-- Latest Posts -->
        <div class="cms-sidebar-card">
            <h4><i class="fa fa-newspaper-o" style="margin-right:8px;color:var(--cms-primary);"></i> <?= $lang == 'ID' ? 'Terbaru' : 'Latest' ?></h4>
            <ul class="cms-sidebar-list">
                <?php if ($terbaru != false) {
                    foreach ($terbaru as $row) { ?>
                        <li>
                            <div class="thumb">
                                <img src="<?= $row->kontenBanner ?>" alt="<?= $row->{'kontenJudul' . $lang} ?>">
                            </div>
                            <div class="info">
                                <a href="<?= base_url() ?>page/detail/<?= $row->{'kontenNama' . $lang} ?>">
                                    <?= $row->{'kontenJudul' . $lang} ?>
                                </a>
                                <span class="date"><i class="fa fa-calendar"></i> <?= !empty($row->kontenTanggal) ? datetoindo($row->kontenTanggal) : '' ?></span>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>

        <!-- Pinned Posts -->
        <div class="cms-sidebar-card">
            <h4><i class="fa fa-map-pin" style="margin-right:8px;color:var(--cms-secondary);"></i> <?= $lang == 'ID' ? 'Berita Pilihan' : 'Pinned News' ?></h4>
            <ul class="cms-sidebar-list">
                <?php if ($pin != false) {
                    foreach ($pin as $row) { ?>
                        <li>
                            <div class="thumb">
                                <img src="<?= $row->kontenBanner ?>" alt="<?= $row->{'kontenJudul' . $lang} ?>">
                            </div>
                            <div class="info">
                                <a href="<?= base_url() ?>page/detail/<?= $row->{'kontenNama' . $lang} ?>">
                                    <?= $row->{'kontenJudul' . $lang} ?>
                                </a>
                                <span class="date"><i class="fa fa-calendar"></i> <?= !empty($row->kontenTanggal) ? datetoindo($row->kontenTanggal) : '' ?></span>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>

        <!-- Pengumuman -->
        <div class="cms-sidebar-card">
            <h4><i class="fa fa-bullhorn" style="margin-right:8px;color:var(--cms-accent);"></i> <?= $lang == 'ID' ? 'Pengumuman' : 'Announcements' ?></h4>
            <ul class="cms-sidebar-list">
                <?php if ($pengumuman != false) {
                    foreach ($pengumuman as $row) { ?>
                        <li>
                            <div class="thumb">
                                <img src="<?= $row->kontenBanner ?>" alt="<?= $row->{'kontenJudul' . $lang} ?>">
                            </div>
                            <div class="info">
                                <a href="<?= base_url() ?>page/detail/<?= $row->{'kontenNama' . $lang} ?>">
                                    <?= $row->{'kontenJudul' . $lang} ?>
                                </a>
                                <span class="date"><i class="fa fa-calendar"></i> <?= !empty($row->kontenTanggal) ? datetoindo($row->kontenTanggal) : '' ?></span>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>
    </aside>
<?php } else { ?>
    <aside class="cms-sidebar">
        <div class="cms-sidebar-card">
            <?= $datas->{'pageSidebar' . $lang} ?>
        </div>
    </aside>
<?php } ?>
