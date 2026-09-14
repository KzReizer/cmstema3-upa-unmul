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
        $mapLink = '';
        if (!empty($master->footMap)) {
            $mapLink = trim($master->footMap);
            // Admin may enter either a Google Maps link or an iframe embed URL.
            if (preg_match('/<iframe[^>]+src=["\']([^"\']+)["\']/i', $mapLink, $matches)) {
                $mapLink = trim(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'));
            }

            if (stripos($mapLink, 'maps/embed') !== false) {
                $mapEmbed = $mapLink;
            } else {
                $mapQuery = $mapLink;
                $parsedMapUrl = parse_url($mapLink);
                if (!empty($parsedMapUrl['query'])) {
                    parse_str($parsedMapUrl['query'], $mapParameters);
                    if (!empty($mapParameters['q'])) {
                        $mapQuery = $mapParameters['q'];
                    } elseif (!empty($mapParameters['query'])) {
                        $mapQuery = $mapParameters['query'];
                    }
                }
                $mapEmbed = 'https://www.google.com/maps?q='.urlencode($mapQuery).'&amp;output=embed';
            }
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1220.8970629992361!2d117.15819937915062!3d-0.4680705142885659!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df6799771161c2d%3A0x4b6dd6948fb89f5b!2sUNMUL%20HUB!5e0!3m2!1sen!2sid!4v1789349951206!5m2!1sen!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                        <?php if (!empty($mapLink)): ?>
                            <a class="cms-footer-map-link" href="<?= $mapLink ?>" target="_blank" rel="noopener noreferrer">
                                <i class="fa fa-external-link"></i>
                                <?= $lang == 'ID' ? 'Buka di Google Maps' : 'Open in Google Maps' ?>
                            </a>
                        <?php endif; ?>
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
