<?php
/**
 * Seed dummy content into the local development database.
 *
 * Run from the repository root with: php seed_dummy_content.php
 */

define('BASEPATH', __DIR__ . '/');
if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 'development');
}

require __DIR__ . '/application/config/database.php';

if (empty($db[$active_group])) {
    echo "Unable to load database configuration.\n";
    exit(1);
}

$config = $db[$active_group];
$hostname = $config['hostname'];
$port = 0;
if (strpos($hostname, ':') !== false) {
    list($hostname, $maybePort) = explode(':', $hostname, 2);
    $port = is_numeric($maybePort) ? (int) $maybePort : 0;
}

$mysqli = new mysqli($hostname, $config['username'], $config['password'], $config['database'], $port);
if ($mysqli->connect_error) {
    echo "Database connection failed: " . $mysqli->connect_error . "\n";
    exit(1);
}
$mysqli->set_charset('utf8');

$now = (new DateTime())->format('Y-m-d H:i:s');
$today = (new DateTime())->format('Y-m-d');

$newsItems = [
    [
        'id' => 'dummy-berita-1',
        'en' => 'dummy-news-1',
        'title_id' => 'Berita Uji Coba 1',
        'title_en' => 'Dummy News 1',
        'banner' => 'public/front/img/news/news-campus.svg',
        'body_id' => '<p>Universitas Mulawarman terus memperkuat kualitas layanan akademik dan informasi publik melalui pengembangan berbagai kanal digital. Berita ini menjadi contoh konten yang lebih lengkap agar pembaca dapat memperoleh informasi mengenai latar belakang kegiatan, proses pelaksanaan, serta manfaat yang dihasilkan bagi sivitas akademika.</p><p>Pengembangan layanan dilakukan secara bertahap dengan melibatkan unit kerja terkait, dosen, tenaga kependidikan, mahasiswa, dan mitra. Setiap masukan dihimpun untuk memastikan informasi yang disampaikan mudah dipahami, dapat dipertanggungjawabkan, dan tetap relevan dengan kebutuhan pengguna.</p><p>Melalui kolaborasi yang konsisten, universitas berharap kehadiran informasi digital tidak hanya menjadi sarana publikasi, tetapi juga menjadi ruang komunikasi yang terbuka. Pembaruan berikutnya akan disampaikan melalui kanal resmi universitas.</p>',
        'body_en' => '<p>Universitas Mulawarman continues to strengthen the quality of its academic services and public information through the development of various digital channels. This article provides a complete example of content so readers can understand the background, implementation process, and benefits for the academic community.</p><p>The service improvements are carried out gradually with the involvement of relevant units, lecturers, administrative staff, students, and partners. Feedback is collected to ensure that every publication is clear, accountable, and relevant to users needs.</p><p>Through consistent collaboration, the university hopes that digital information will become more than a publication tool. It should also serve as an open communication space, with future updates delivered through the official university channels.</p>',
    ],
    [
        'id' => 'dummy-berita-2',
        'en' => 'dummy-news-2',
        'title_id' => 'Berita Uji Coba 2',
        'title_en' => 'Dummy News 2',
        'banner' => 'public/front/img/news/news-digital.svg',
        'body_id' => '<p>Kegiatan akademik di lingkungan universitas terus berkembang seiring dengan meningkatnya kebutuhan pembelajaran yang fleksibel, kolaboratif, dan berbasis teknologi. Dosen dan mahasiswa didorong untuk memanfaatkan sumber belajar digital secara bijak, sekaligus menjaga kualitas interaksi dan diskusi yang menjadi bagian penting dari proses pendidikan.</p><p>Dalam pelaksanaannya, setiap program disusun dengan memperhatikan capaian pembelajaran, ketersediaan fasilitas, dan kesiapan sumber daya manusia. Evaluasi dilakukan secara berkala melalui umpan balik peserta, pemantauan kegiatan, serta pembahasan bersama pengelola program.</p><p>Hasil evaluasi tersebut menjadi dasar untuk menyusun perbaikan pada periode berikutnya. Dengan cara ini, kegiatan akademik dapat terus menyesuaikan diri tanpa meninggalkan nilai integritas, kedisiplinan, dan kepedulian terhadap kebutuhan mahasiswa.</p>',
        'body_en' => '<p>Academic activities at the university continue to evolve as the need for flexible, collaborative, and technology-based learning grows. Lecturers and students are encouraged to use digital learning resources responsibly while maintaining the quality of interaction and discussion that remains essential to education.</p><p>Each program is planned by considering learning outcomes, available facilities, and human resource readiness. Regular evaluations are conducted through participant feedback, activity monitoring, and discussions with program managers.</p><p>The results provide a basis for improvements in the following period. In this way, academic activities can adapt continuously while upholding integrity, discipline, and attention to student needs.</p>',
    ],
    [
        'id' => 'dummy-berita-3',
        'en' => 'dummy-news-3',
        'title_id' => 'Berita Uji Coba 3',
        'title_en' => 'Dummy News 3',
        'banner' => 'public/front/img/news/news-research.svg',
        'body_id' => '<p>Universitas juga memberikan perhatian pada penguatan budaya riset dan pengabdian kepada masyarakat. Gagasan yang lahir dari dosen dan mahasiswa diarahkan untuk menjawab persoalan nyata di lingkungan sekitar, khususnya isu pendidikan, lingkungan, kesehatan, ekonomi, dan pemanfaatan teknologi.</p><p>Setiap tim peneliti memiliki kesempatan untuk membangun kerja sama dengan pemerintah daerah, sekolah, komunitas, serta dunia usaha. Kerja sama tersebut penting agar hasil kajian tidak berhenti sebagai dokumen, tetapi dapat diterapkan, diuji, dan dikembangkan menjadi solusi yang memberikan dampak nyata.</p><p>Selain menghasilkan pengetahuan baru, rangkaian kegiatan ini diharapkan menumbuhkan pengalaman belajar yang bermakna bagi mahasiswa. Keterlibatan langsung dalam riset dan pengabdian membentuk kemampuan berpikir kritis, komunikasi, manajemen kegiatan, dan tanggung jawab sosial.</p>',
        'body_en' => '<p>The university also continues to strengthen its research and community service culture. Ideas developed by lecturers and students are directed toward real challenges in society, particularly education, the environment, health, the economy, and the use of technology.</p><p>Research teams are encouraged to build partnerships with local governments, schools, communities, and businesses. These partnerships help ensure that research findings do not remain in documents, but can be implemented, tested, and developed into solutions with a practical impact.</p><p>In addition to producing new knowledge, these activities provide meaningful learning experiences for students. Direct involvement in research and community service develops critical thinking, communication, project management, and social responsibility.</p>',
    ],
    [
        'id' => 'dummy-berita-4',
        'en' => 'dummy-news-4',
        'title_id' => 'Berita Uji Coba 4',
        'title_en' => 'Dummy News 4',
        'banner' => 'public/front/img/news/news-partnership.svg',
        'body_id' => '<p>Kerja sama kelembagaan menjadi salah satu langkah penting dalam memperluas manfaat pendidikan tinggi. Melalui pertemuan, diskusi, dan penyusunan program bersama, universitas dapat mempertemukan keahlian akademik dengan kebutuhan pembangunan di daerah.</p><p>Kolaborasi yang baik dibangun melalui tujuan yang jelas, pembagian peran yang terukur, dan komunikasi yang terbuka. Setiap kegiatan juga perlu memiliki indikator keberhasilan agar hasilnya dapat dipantau dan menjadi pembelajaran bagi program kerja selanjutnya.</p><p>Universitas berkomitmen menjaga kemitraan tersebut secara berkelanjutan. Dengan semangat saling mendukung, kerja sama diharapkan dapat membuka peluang bagi mahasiswa, meningkatkan kompetensi lulusan, serta memperkuat kontribusi universitas bagi masyarakat.</p>',
        'body_en' => '<p>Institutional partnerships are an important way to expand the benefits of higher education. Through meetings, discussions, and joint programs, the university can connect academic expertise with development needs in the region.</p><p>Effective collaboration requires clear objectives, measurable roles, and open communication. Each activity should also have success indicators so its results can be monitored and used as lessons for future programs.</p><p>The university is committed to maintaining these partnerships sustainably. With a spirit of mutual support, collaboration can create opportunities for students, improve graduate competencies, and strengthen the university contribution to society.</p>',
    ],
    [
        'id' => 'dummy-berita-5',
        'en' => 'dummy-news-5',
        'title_id' => 'Berita Uji Coba 5',
        'title_en' => 'Dummy News 5',
        'banner' => 'public/front/img/news/news-campus.svg',
        'body_id' => '<p>Transparansi informasi merupakan bagian penting dari tata kelola universitas. Informasi mengenai kegiatan, kebijakan, layanan, dan capaian perlu disajikan secara teratur agar dapat diakses oleh mahasiswa, orang tua, mitra, alumni, dan masyarakat luas.</p><p>Untuk mendukung hal tersebut, pengelola informasi melakukan peninjauan terhadap alur pengumpulan data, proses penyuntingan, dan jadwal publikasi. Informasi yang diterbitkan diupayakan memiliki sumber yang jelas, bahasa yang mudah dipahami, serta konteks yang cukup agar tidak menimbulkan kesalahpahaman.</p><p>Partisipasi pembaca juga sangat berarti. Saran dan pertanyaan yang disampaikan melalui kanal resmi akan menjadi bahan evaluasi dalam meningkatkan mutu komunikasi publik universitas.</p>',
        'body_en' => '<p>Information transparency is an important part of university governance. Details about activities, policies, services, and achievements should be shared regularly so they are accessible to students, parents, partners, alumni, and the wider community.</p><p>To support this goal, information managers review data collection, editing processes, and publication schedules. Every article should have a clear source, accessible language, and sufficient context to prevent misunderstanding.</p><p>Reader participation is also valuable. Suggestions and questions submitted through official channels will be considered when improving the quality of the university public communication.</p>',
    ],
    [
        'id' => 'dummy-berita-6',
        'en' => 'dummy-news-6',
        'title_id' => 'Berita Uji Coba 6',
        'title_en' => 'Dummy News 6',
        'banner' => 'public/front/img/news/news-digital.svg',
        'body_id' => '<p>Pengembangan fasilitas kampus dilakukan dengan mempertimbangkan kenyamanan, keamanan, dan aksesibilitas seluruh pengguna. Ruang belajar, area layanan, fasilitas pendukung, dan lingkungan terbuka perlu dirawat serta dikembangkan agar dapat menunjang kegiatan akademik dan kemahasiswaan.</p><p>Perencanaan fasilitas tidak hanya berfokus pada pembangunan fisik. Pengelola juga memperhatikan efisiensi energi, kebersihan, ketersediaan akses bagi penyandang disabilitas, dan pemanfaatan ruang secara berkelanjutan.</p><p>Mahasiswa dan seluruh warga kampus dapat berperan dengan menjaga fasilitas bersama, melaporkan kerusakan melalui jalur yang tersedia, serta menggunakan setiap ruang sesuai peruntukannya. Kebiasaan sederhana tersebut membantu menciptakan lingkungan belajar yang tertib dan nyaman.</p>',
        'body_en' => '<p>Campus facility development considers the comfort, safety, and accessibility of every user. Learning spaces, service areas, supporting facilities, and open environments must be maintained and improved to support academic and student activities.</p><p>Facility planning is not limited to physical construction. Managers also consider energy efficiency, cleanliness, access for people with disabilities, and sustainable use of space.</p><p>Students and all members of the campus community can contribute by caring for shared facilities, reporting damage through the available channels, and using each space appropriately. These simple habits help create an orderly and comfortable learning environment.</p>',
    ],
    [
        'id' => 'berita-transformasi-digital',
        'en' => 'digital-transformation-news',
        'title_id' => 'Universitas Perkuat Transformasi Digital untuk Layanan Akademik',
        'title_en' => 'University Strengthens Digital Transformation for Academic Services',
        'banner' => 'public/front/img/news/news-digital.svg',
        'body_id' => '<p>Transformasi digital menjadi bagian penting dari upaya Universitas Mulawarman meningkatkan mutu layanan akademik. Pemanfaatan teknologi diarahkan untuk mempercepat akses informasi, menyederhanakan proses administrasi, dan membantu sivitas akademika memperoleh layanan yang konsisten dari berbagai perangkat.</p><p>Dalam penerapannya, pengembangan sistem dilakukan dengan memperhatikan kebutuhan pengguna. Masukan dari mahasiswa, dosen, tenaga kependidikan, dan pengelola program studi menjadi bahan untuk menyusun fitur yang lebih mudah digunakan. Pendampingan dan sosialisasi juga disiapkan agar perubahan dapat dipahami serta dimanfaatkan secara optimal.</p><p>Transformasi ini akan terus dievaluasi melalui pemantauan kinerja layanan dan tingkat kepuasan pengguna. Universitas berharap ekosistem digital yang semakin terintegrasi dapat mendukung pembelajaran, penelitian, dan tata kelola yang lebih efektif, transparan, serta responsif.</p>',
        'body_en' => '<p>Digital transformation is an important part of Universitas Mulawarman efforts to improve academic services. Technology is used to provide faster access to information, simplify administrative processes, and help the academic community receive consistent services across devices.</p><p>The systems are developed by considering user needs. Feedback from students, lecturers, staff, and study program managers helps shape features that are easier to use. Guidance and outreach are also prepared so the changes can be understood and adopted effectively.</p><p>The transformation will continue to be evaluated through service performance monitoring and user satisfaction. The university hopes an increasingly integrated digital ecosystem will support learning, research, and governance that are more effective, transparent, and responsive.</p>',
    ],
    [
        'id' => 'berita-prestasi-mahasiswa',
        'en' => 'student-achievement-news',
        'title_id' => 'Prestasi Mahasiswa Menjadi Inspirasi untuk Terus Berkarya',
        'title_en' => 'Student Achievements Inspire the Community to Keep Creating',
        'banner' => 'public/front/img/news/news-campus.svg',
        'body_id' => '<p>Prestasi mahasiswa dalam bidang akademik, olahraga, seni, dan kewirausahaan menunjukkan bahwa lingkungan kampus dapat menjadi ruang tumbuh bagi beragam potensi. Setiap pencapaian lahir dari proses panjang yang membutuhkan ketekunan, latihan, bimbingan, dan dukungan dari banyak pihak.</p><p>Universitas memberikan apresiasi kepada mahasiswa yang membawa nama baik institusi melalui kompetisi maupun kegiatan pengembangan diri. Apresiasi tersebut diharapkan tidak berhenti pada penghargaan, tetapi menjadi dorongan agar mahasiswa berani menetapkan target baru dan membagikan pengalaman kepada rekan-rekannya.</p><p>Kisah para mahasiswa berprestasi juga mengingatkan bahwa keberhasilan dapat ditempuh melalui banyak jalur. Yang terpenting adalah kemauan untuk belajar, kemampuan bekerja sama, serta komitmen untuk menjaga integritas dalam setiap proses.</p>',
        'body_en' => '<p>Student achievements in academics, sports, arts, and entrepreneurship show that the campus can nurture many kinds of potential. Every achievement is built through a long process requiring persistence, practice, guidance, and support from many people.</p><p>The university appreciates students who represent the institution in competitions and personal development activities. Recognition should not end with an award, but encourage students to set new goals and share their experiences with their peers.</p><p>These stories also remind us that success can be reached through many paths. The essential qualities are a willingness to learn, the ability to collaborate, and a commitment to integrity throughout the process.</p>',
    ],
    [
        'id' => 'berita-pengabdian-masyarakat',
        'en' => 'community-service-news',
        'title_id' => 'Pengabdian kepada Masyarakat Dorong Solusi Berkelanjutan',
        'title_en' => 'Community Service Encourages Sustainable Solutions',
        'banner' => 'public/front/img/news/news-partnership.svg',
        'body_id' => '<p>Program pengabdian kepada masyarakat menjadi kesempatan bagi universitas untuk berbagi pengetahuan sekaligus belajar dari pengalaman warga. Kegiatan dirancang berdasarkan kebutuhan lokal sehingga solusi yang ditawarkan dapat diterapkan sesuai kondisi, sumber daya, dan kebiasaan masyarakat setempat.</p><p>Dosen dan mahasiswa bekerja bersama mitra untuk menyusun pemetaan masalah, menjalankan pelatihan, serta mendampingi proses penerapan. Pendekatan partisipatif membuat masyarakat tidak hanya menjadi penerima program, tetapi juga terlibat dalam menentukan prioritas dan mengukur perubahan yang terjadi.</p><p>Keberlanjutan menjadi perhatian utama dalam setiap kegiatan. Karena itu, program dilengkapi dengan penguatan kapasitas dan rencana tindak lanjut agar manfaatnya tetap terasa setelah rangkaian pendampingan selesai.</p>',
        'body_en' => '<p>Community service programs allow the university to share knowledge while learning from the experiences of local residents. Activities are designed around local needs so that proposed solutions fit the conditions, resources, and habits of each community.</p><p>Lecturers and students work with partners to map challenges, deliver training, and assist implementation. This participatory approach makes residents active contributors who help set priorities and measure the changes taking place.</p><p>Sustainability is a key consideration in every activity. Programs therefore include capacity building and follow-up plans so their benefits continue after the assistance period ends.</p>',
    ],
    [
        'id' => 'berita-lingkungan-kampus',
        'en' => 'green-campus-news',
        'title_id' => 'Gerakan Kampus Hijau Dimulai dari Kebiasaan Sehari-hari',
        'title_en' => 'Green Campus Movement Starts with Daily Habits',
        'banner' => 'public/front/img/news/news-research.svg',
        'body_id' => '<p>Upaya mewujudkan kampus yang ramah lingkungan membutuhkan keterlibatan seluruh warga universitas. Pengurangan sampah sekali pakai, penghematan energi dan air, serta pemeliharaan ruang hijau merupakan langkah sederhana yang dapat dilakukan secara konsisten dalam kegiatan sehari-hari.</p><p>Kesadaran lingkungan dibangun melalui edukasi dan contoh nyata. Unit kerja, organisasi mahasiswa, dan komunitas dapat mengembangkan kegiatan yang mendorong penggunaan ulang, pemilahan sampah, penghijauan, dan perawatan fasilitas bersama.</p><p>Gerakan ini diharapkan menjadi budaya, bukan hanya program sesaat. Dengan kebiasaan yang terukur dan evaluasi berkala, kampus dapat menciptakan lingkungan belajar yang sehat sekaligus memberikan teladan pengelolaan lingkungan bagi masyarakat.</p>',
        'body_en' => '<p>Creating an environmentally friendly campus requires the involvement of everyone at the university. Reducing single-use waste, saving energy and water, and caring for green spaces are simple actions that can be practiced consistently every day.</p><p>Environmental awareness grows through education and real examples. Units, student organizations, and communities can develop activities that encourage reuse, waste sorting, tree planting, and shared facility maintenance.</p><p>The movement is intended to become a culture rather than a temporary program. With measurable habits and regular evaluation, the campus can provide a healthy learning environment and become an example of responsible environmental management.</p>',
    ],
];

foreach ($newsItems as $item) {
    $kontenNamaID = $mysqli->real_escape_string($item['id']);
    $check = $mysqli->query("SELECT kontenId FROM f_konten WHERE kontenNamaID = '$kontenNamaID' OR kontenNamaEN = '$kontenNamaID'");
    if ($check && $check->num_rows > 0) {
        $stmt = $mysqli->prepare(
            "UPDATE f_konten SET kontenIsiID = ?, kontenIsiEN = ?, kontenBanner = ? WHERE kontenNamaID = ? OR kontenNamaEN = ?"
        );
        $stmt->bind_param('sssss', $item['body_id'], $item['body_en'], $item['banner'], $item['id'], $item['en']);
        if ($stmt->execute()) {
            echo "Updated berita: {$item['id']}\n";
        } else {
            echo "Update error for {$item['id']}: " . $stmt->error . "\n";
        }
        $stmt->close();
        continue;
    }

    $stmt = $mysqli->prepare(
        "INSERT INTO f_konten (kontenNamaID, kontenNamaEN, kontenJudulID, kontenJudulEN, kontenIsiID, kontenIsiEN, kontenTagID, kontenTagEN, kontenKategoriId, kontenAuthor, kontenBanner, kontenIsDisplay, kontenDatetime, kontenTemaId, kontenIsPin, kontenUnitApprov, kontenUserNama, kontenUrut, kontenTanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', ?, 1, '0', '1', 'seed-script', '0', ?);"
    );
    $tagId = 'dummy,berita';
    $tagEn = 'dummy,news';
    $kategoriId = 2;
    $author = 'Admin Dummy';
    $datetime = $now;
    $date = $today;
    $stmt->bind_param(
        'ssssssssissss',
        $item['id'],
        $item['en'],
        $item['title_id'],
        $item['title_en'],
        $item['body_id'],
        $item['body_en'],
        $tagId,
        $tagEn,
        $kategoriId,
        $author,
        $item['banner'],
        $datetime,
        $date
    );

    if ($stmt->execute()) {
        echo "Inserted berita: {$item['id']}\n";
    } else {
        echo "Insert error for {$item['id']}: " . $stmt->error . "\n";
    }
    $stmt->close();
}

$pageItems = [
    [
        'id' => 'dummy-page-1',
        'en' => 'dummy-page-1-en',
        'head_id' => 'Halaman Dummy 1',
        'head_en' => 'Dummy Page 1',
        'title_id' => 'Halaman Konten Dummy 1',
        'title_en' => 'Dummy Content Page 1',
        'content_id' => 'Ini adalah halaman konten dummy untuk memeriksa tampilan halaman penuh tanpa sidebar.',
        'content_en' => 'This is a dummy content page used to verify full-width page rendering without a sidebar.',
        'link' => 'dummy-page-1',
    ],
    [
        'id' => 'dummy-page-2',
        'en' => 'dummy-page-2-en',
        'head_id' => 'Halaman Dummy 2',
        'head_en' => 'Dummy Page 2',
        'title_id' => 'Halaman Konten Dummy 2',
        'title_en' => 'Dummy Content Page 2',
        'content_id' => 'Konten tambahan untuk memastikan halaman dinamis lain dapat ditampilkan dengan benar.',
        'content_en' => 'Additional dummy content to ensure other dynamic pages render correctly.',
        'link' => 'dummy-page-2',
    ],
];

foreach ($pageItems as $item) {
    $pageNamaID = $mysqli->real_escape_string($item['id']);
    $check = $mysqli->query("SELECT pageId FROM f_page WHERE pageNamaID = '$pageNamaID' OR pageNamaEN = '$pageNamaID'");
    if ($check && $check->num_rows > 0) {
        echo "Skipped existing halaman: {$item['id']}\n";
        continue;
    }

    $stmt = $mysqli->prepare(
        "INSERT INTO f_page (pageNamaID, pageNamaEN, pageHeadID, pageHeadEN, pageJudulID, pageJudulEN, pageContentID, pageContentEN, pageSidebarID, pageSidebarEN, pageTagID, pageTagEN, pageDatetime, pageAuthor, pageUrut, pageLink, pageTemaId, pageIsParent, pageUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '', '', 'dummy', 'dummy', ?, 'seed-script', 0, ?, 1, 0, 'seed-script');"
    );
    $stmt->bind_param(
        'ssssssssss',
        $item['id'],
        $item['en'],
        $item['head_id'],
        $item['head_en'],
        $item['title_id'],
        $item['title_en'],
        $item['content_id'],
        $item['content_en'],
        $datetime,
        $item['link']
    );

    if ($stmt->execute()) {
        echo "Inserted halaman: {$item['id']}\n";
    } else {
        echo "Insert error for halaman {$item['id']}: " . $stmt->error . "\n";
    }
    $stmt->close();
}

$mysqli->close();
echo "Seeding complete.\n";
