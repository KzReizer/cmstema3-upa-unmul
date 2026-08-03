<!-- ============================================================
     cmstema3 - Premium Footer
     ============================================================ -->
<footer class="cms-footer">
    <div class="container">
        <div class="row">
            <!-- Faculty Info -->
            <div class="col-lg-4 col-md-6">
                <div class="cms-footer-widget">
                    <div class="cms-footer-brand">
                        <img src="<?php echo base_url(); ?>front/img/logo/unmul.png" alt="Universitas Mulawarman">
                        <h5><?= $master->{'temaNama' . $lang} ?></h5>
                        <span>Universitas Mulawarman</span>
                    </div>
                    <p style="font-size:0.88rem;color:rgba(255,255,255,0.5);line-height:1.8;">
                        <?= $lang == 'ID' ? 'Fakultas Pertanian Universitas Mulawarman berkomitmen menjadi pusat unggulan pendidikan, penelitian, dan pengabdian masyarakat bidang pertanian tropis.' : 'The Faculty of Agriculture, Mulawarman University is committed to being a center of excellence in education, research, and community service in tropical agriculture.' ?>
                    </p>
                    <div class="cms-footer-social">
                        <a href="<?= $master->footLinkFacebook ?>" target="_blank" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="<?= $master->footLinkYoutube ?>" target="_blank" aria-label="YouTube"><i class="fa fa-youtube"></i></a>
                        <a href="<?= $master->footLinkInstagram ?>" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                        <?php if (!empty($master->footLinkAndroid)): ?>
                            <a href="<?= $master->footLinkAndroid ?>" target="_blank" aria-label="Google Play"><i class="fa fa-android"></i></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <div class="cms-footer-widget">
                    <h4><?= $lang == 'ID' ? 'Tautan Cepat' : 'Quick Links' ?></h4>
                    <ul class="cms-footer-links">
                        <li><a href="<?= base_url(); ?>"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Beranda' : 'Home' ?></a></li>
                        <li><a href="<?= base_url(); ?>page?content=profil"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Profil' : 'Profile' ?></a></li>
                        <li><a href="<?= base_url(); ?>page/list/berita"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Berita' : 'News' ?></a></li>
                        <li><a href="#"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Akademik' : 'Academic' ?></a></li>
                        <li><a href="#"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Penelitian' : 'Research' ?></a></li>
                        <li><a href="#"><i class="fa fa-chevron-right" style="font-size:8px;"></i> <?= $lang == 'ID' ? 'Unduhan' : 'Downloads' ?></a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <div class="cms-footer-widget">
                    <h4><?= $lang == 'ID' ? 'Kontak' : 'Contact' ?></h4>
                    <ul class="cms-footer-contact">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <span>
                                <strong><?= $lang == 'ID' ? 'Alamat' : 'Address' ?>:</strong><br>
                                <?= $master->footAlamat ?>
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i>
                            <span>
                                <strong><?= $lang == 'ID' ? 'Telp.' : 'Phone' ?>:</strong><br>
                                <?= $master->footTlp ?>
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <span>
                                <strong>Email:</strong><br>
                                <a href="mailto:<?= $master->footEmail ?>"><?= $master->footEmail ?></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Google Map -->
            <div class="col-lg-3 col-md-6">
                <div class="cms-footer-widget">
                    <h4><?= $lang == 'ID' ? 'Lokasi' : 'Location' ?></h4>
                    <div class="cms-footer-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31910.7368858984!2d116.8598812453814!3d-1.2674810181070364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df146c24f48cd29%3A0xa72e7d4633fa77ec!2sUniversitas%20Mulawarman!5e0!3m2!1sid!2sid!4v1" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?= $lang == 'ID' ? 'Lokasi Kampus' : 'Campus Location' ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="cms-footer-bottom">
        <div class="container">
            <p style="margin-bottom:0;">
                &copy; <?= date('Y') ?> <?= $master->{'temaNama' . $lang} ?> <?= $lang == 'ID' ? 'Universitas Mulawarman' : 'Mulawarman University' ?>.
                <?= $lang == 'ID' ? 'Hak Cipta Dilindungi.' : 'All rights reserved.' ?>
            </p>
        </div>
    </div>
</footer>
