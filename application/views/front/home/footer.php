<!-- ============================================================
     cmstema3 - Premium Footer
     ============================================================ -->
<footer class="cms-footer">
    <?php
        $logoSrc = !empty($master->temaLogo) ? $master->temaLogo : '';
        $brandSubtitle = isset($master->{'temaSubNama' . $lang}) ? trim($master->{'temaSubNama' . $lang}) : '';
        $footerDescription = !empty($master->{'temaDeskripsi' . $lang}) ? $master->{'temaDeskripsi' . $lang} : '';

        $quickLinks = [];
        if ($menu !== false && is_array($menu)) {
            foreach ($menu as $m) {
                $href = !empty($m['link']) ? $m['link'] : (isset($m['headId']) ? base_url().'page?content='.$m['headId'] : '');
                $label = !empty($m['headNama']) ? $m['headNama'] : '';
                $trimmedHref = trim($href);
                if ($href && $label && $trimmedHref !== '#' && stripos($trimmedHref, 'javascript:') !== 0) {
                    $quickLinks[] = ['href' => $href, 'label' => $label];
                }
            }
        }

        $contactItems = [];
        if (!empty($master->footAlamat)) {
            $contactItems[] = [
                'icon' => 'fa-map-marker',
                'label' => $lang == 'ID' ? 'Alamat' : 'Address',
                'value' => $master->footAlamat,
                'href' => ''
            ];
        }
        if (!empty($master->footTlp)) {
            $contactItems[] = [
                'icon' => 'fa-phone',
                'label' => $lang == 'ID' ? 'Telp.' : 'Phone',
                'value' => $master->footTlp,
                'href' => 'tel:'.$master->footTlp
            ];
        }
        if (!empty($master->footEmail)) {
            $contactItems[] = [
                'icon' => 'fa-envelope',
                'label' => 'Email',
                'value' => $master->footEmail,
                'href' => 'mailto:'.$master->footEmail
            ];
        }

        $mapEmbed = '';
        if (!empty($master->footMapEmbed)) {
            $mapEmbed = $master->footMapEmbed;
        } elseif (!empty($master->footLat) && !empty($master->footLng)) {
            $mapEmbed = 'https://www.google.com/maps?q='.urlencode($master->footLat.','.$master->footLng).'&amp;output=embed';
        }

        $copyrightText = '';
        if (!empty($master->footCopyright)) {
            $copyrightText = $master->footCopyright;
        }
    ?>
    <div class="container">
        <div class="row">
            <!-- Faculty Info -->
            <div class="col-lg-4 col-md-6">
                <div class="cms-footer-widget">
                    <div class="cms-footer-brand">
                        <?php if (!empty($logoSrc)): ?>
                            <img src="<?= $logoSrc ?>" alt="<?= !empty($master->{'temaNama' . $lang}) ? $master->{'temaNama' . $lang} : 'Footer Logo' ?>">
                        <?php endif; ?>
                        <?php if (!empty($master->{'temaNama' . $lang})): ?>
                            <h5><?= $master->{'temaNama' . $lang} ?></h5>
                        <?php endif; ?>
                        <?php if (!empty($brandSubtitle)): ?>
                            <span><?= $brandSubtitle ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($footerDescription)): ?>
                        <p><?= $footerDescription ?></p>
                    <?php endif; ?>
                    <div class="cms-footer-social">
                        <?php if (!empty($master->footLinkFacebook)): ?>
                            <a href="<?= $master->footLinkFacebook ?>" target="_blank" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($master->footLinkYoutube)): ?>
                            <a href="<?= $master->footLinkYoutube ?>" target="_blank" aria-label="YouTube"><i class="fa fa-youtube"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($master->footLinkInstagram)): ?>
                            <a href="<?= $master->footLinkInstagram ?>" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($master->footLinkAndroid)): ?>
                            <a href="<?= $master->footLinkAndroid ?>" target="_blank" aria-label="Google Play"><i class="fa fa-android"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($quickLinks)): ?>
                <div class="col-lg-2 col-md-6">
                    <div class="cms-footer-widget">
                        <h4><?= $lang == 'ID' ? 'Tautan Cepat' : 'Quick Links' ?></h4>
                        <ul class="cms-footer-links">
                            <?php $count = 0; foreach ($quickLinks as $ql): if ($count++ >= 8) break; ?>
                                <li><a href="<?= $ql['href'] ?>"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $ql['label'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($contactItems)): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="cms-footer-widget">
                        <h4><?= $lang == 'ID' ? 'Kontak' : 'Contact' ?></h4>
                        <ul class="cms-footer-contact">
                            <?php foreach ($contactItems as $item): ?>
                                <li>
                                    <i class="fa <?= $item['icon'] ?>"></i>
                                    <span>
                                        <strong><?= $item['label'] ?>:</strong><br>
                                        <?php if (!empty($item['href'])): ?>
                                            <a href="<?= $item['href'] ?>"><?= $item['value'] ?></a>
                                        <?php else: ?>
                                            <?= $item['value'] ?>
                                        <?php endif; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($mapEmbed)): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="cms-footer-widget">
                        <h4><?= $lang == 'ID' ? 'Lokasi' : 'Location' ?></h4>
                        <div class="cms-footer-map">
                            <iframe src="<?= $mapEmbed ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?= $lang == 'ID' ? 'Lokasi Kampus' : 'Campus Location' ?>"></iframe>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Copyright -->
    <div class="cms-footer-bottom">
        <div class="container">
            <p style="margin-bottom:0;">
                &copy; <?= date('Y') ?><?= !empty($master->{'temaNama' . $lang}) ? ' '.$master->{'temaNama' . $lang} : '' ?>
                <?php if (!empty($copyrightText)): ?>
                    <?= $copyrightText ?>
                <?php endif; ?>
            </p>
        </div>
    </div>
</footer>
