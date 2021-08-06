<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(E_ALL & ~E_NOTICE);
require_once 'admin/libs/Database.class.php';
require_once 'admin/connect.php';
require_once 'libs/functions.php';
session_start();



$query = "SELECT `link` FROM `rss` WHERE `status` = 'active' ORDER BY `ordering`";
$url = $database->listRecord($query);
$xhtml = '';
if (empty($url)) $url = [['link' => 'https://vnexpress.net/rss/tin-moi-nhat.rss']];

foreach ($url as $link) {
    $link = $link['link'];
    $source = parse_url($link, PHP_URL_HOST);
    $xml = simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);
    $xmlJson = json_encode($xml);
    $xmlArr = json_decode($xmlJson, true);
    $items  = $xmlArr['channel']['item'];
    $result = [];
    foreach ($items as $key => $item) {
        // if ($key == 15) break;
        $tmp1 = [];
        $tmp2 = [];

        preg_match('/src="([^"]*)"/i', $item['description'], $tmp1);
        $pattern = '.*br>(.*)';
        preg_match('/' . $pattern . '/', $item['description'], $tmp2);

        $image = $tmp1[1] ??  'images/default.jpg';
        $description = $tmp2[1] ?? $item['description'];

        $result[] = [
            'title'     => $item['title'],
            'description' => $description,
            'pubDate' => date('d/m/Y H:i:s', strtotime($item['pubDate'])),
            'link' => $item['link'],
            'image' => $image,
        ];
    }

    foreach ($result as $value) {
        $xhtml .='
        <div class="col-md-6 col-lg-4 p-3 box">
            <div class="entry mb-1 clearfix">
                <div class="entry-image mb-3">
                    <a href="' . $value['image'] . '"
                        data-lightbox="image"
                        style="background: url(' . $value['image'] . ') no-repeat center center; background-size: cover; height: 278px;"></a>
                </div>
                <div class="entry-title">
                    <h3><a href="' . $value['link'] . '"
                            target="_blank"><span>' . $value['title'] . '</span></a>
                    </h3>
                </div>
                <div class="entry-content description"><p>
                ' . $value['description'] . '</p>
                </div>
                <div class="entry-meta no-separator nohover">
                    <ul class="justify-content-between mx-0">
                        <li><i class="icon-calendar2"></i> ' . $value['pubDate'] . '</li>
                        <li> ' . $source . '</li>
                    </ul>
                </div>
                <div class="entry-meta no-separator hover">
                    <ul class="mx-0">
                        <li><a href="' . $value['link'] . '"
                                target="_blank">Xem &rarr;</a></li>
                    </ul>
                </div>
            </div>
        </div>';
    };
}
echo $xhtml;
