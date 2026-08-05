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
        'body_id' => 'Ini adalah berita dummy untuk pengujian tampilan. Pastikan detail dapat ditampilkan tanpa error.',
        'body_en' => 'This is a dummy news item for testing the layout. Ensure the detail page renders without errors.',
    ],
    [
        'id' => 'dummy-berita-2',
        'en' => 'dummy-news-2',
        'title_id' => 'Berita Uji Coba 2',
        'title_en' => 'Dummy News 2',
        'body_id' => 'Konten dummy kedua digunakan untuk memastikan pagination dan daftar kartu bekerja dengan benar.',
        'body_en' => 'The second dummy content item is used to verify pagination and card list rendering.',
    ],
    [
        'id' => 'dummy-berita-3',
        'en' => 'dummy-news-3',
        'title_id' => 'Berita Uji Coba 3',
        'title_en' => 'Dummy News 3',
        'body_id' => 'Berita ini membantu melihat jarak antar kartu dan responsivitas pada halaman daftar berita.',
        'body_en' => 'This news helps validate spacing between cards and responsive behavior on the news list page.',
    ],
    [
        'id' => 'dummy-berita-4',
        'en' => 'dummy-news-4',
        'title_id' => 'Berita Uji Coba 4',
        'title_en' => 'Dummy News 4',
        'body_id' => 'Gunakan beberapa berita dummy untuk memastikan detail dan artikel terkait muncul dengan benar.',
        'body_en' => 'Use multiple dummy news items to ensure related content and detail pages display correctly.',
    ],
    [
        'id' => 'dummy-berita-5',
        'en' => 'dummy-news-5',
        'title_id' => 'Berita Uji Coba 5',
        'title_en' => 'Dummy News 5',
        'body_id' => 'Uji apakah label, tanggal, dan penulis tampil dengan nilai dummy pada halaman berita.',
        'body_en' => 'Check whether labels, dates, and author values display with dummy values on the news page.',
    ],
    [
        'id' => 'dummy-berita-6',
        'en' => 'dummy-news-6',
        'title_id' => 'Berita Uji Coba 6',
        'title_en' => 'Dummy News 6',
        'body_id' => 'Dummy content ekstra untuk membantu melihat apakah pagination dan jumlah item berfungsi.',
        'body_en' => 'Extra dummy content to help verify pagination and item count behavior.',
    ],
];

foreach ($newsItems as $item) {
    $kontenNamaID = $mysqli->real_escape_string($item['id']);
    $check = $mysqli->query("SELECT kontenId FROM f_konten WHERE kontenNamaID = '$kontenNamaID' OR kontenNamaEN = '$kontenNamaID'");
    if ($check && $check->num_rows > 0) {
        echo "Skipped existing berita: {$item['id']}\n";
        continue;
    }

    $stmt = $mysqli->prepare(
        "INSERT INTO f_konten (kontenNamaID, kontenNamaEN, kontenJudulID, kontenJudulEN, kontenIsiID, kontenIsiEN, kontenTagID, kontenTagEN, kontenKategoriId, kontenAuthor, kontenBanner, kontenIsDisplay, kontenDatetime, kontenTemaId, kontenIsPin, kontenUnitApprov, kontenUserNama, kontenUrut, kontenTanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', '1', ?, 1, '0', '1', 'seed-script', '0', ?);"
    );
    $tagId = 'dummy,berita';
    $tagEn = 'dummy,news';
    $kategoriId = 2;
    $author = 'Admin Dummy';
    $datetime = $now;
    $date = $today;
    $stmt->bind_param(
        'ssssssssisss',
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
