<?php
echo '<pre>';
print_r($this->arrParams);
echo '</pre>';
$url = $this->items;
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
		if ($key == 15) break;
		$tmp1 = [];
		$tmp2 = [];

		preg_match('/src="([^"]*)"/i', $item['description'], $tmp1);
		$pattern = '.*br>(.*)';
		preg_match('/' . $pattern . '/', $item['description'], $tmp2);
		$defaultImg = $this->_dirImg . 'default.jpg';
		$image = $tmp1[1] ??  $defaultImg;
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
		$xhtml .= '
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

?>


<div class="container-fluid">
	<div class="row">
		<!-- Content -->

		<section id="content" class="bg-light">
			<div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
				<div class="container-fluid clearfix">
					<div class="heading-block border-bottom-0 center pt-4 mb-3">
						<h3>Tin tức</h3>
					</div>
					<!-- Posts -->
					<div class="row grid-container infinity-wrapper clearfix align-align-items-start">
						<?= $xhtml; ?>
					</div>
				</div>

			</div>
		</section> <!-- #content end -->

		<section class="right-side mb-4">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="box mt-4">
							<h3 class="mb-1">Giá vàng</h3>
							<div class="card card-body" data-url="<?= APPLICATION_URL . "{$this->arrParams['module']}/views/{$this->arrParams['controller']}/table-gold.php" ?>" id="box-gold">
								<!-- <?php require_once 'table-gold.php'; ?> -->
								<div class="text-center">
									<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
									</div>
								</div>
							</div>
						</div>
						<div class="box mt-4">
							<h3 class="mb-1">Giá coin</h3>
							<div class="card card-body" data-url="<?= APPLICATION_URL . "{$this->arrParams['module']}/views/{$this->arrParams['controller']}/table-coin.php" ?>" id="box-coin">

								<!-- <?php require_once 'table-coin.php'; ?> -->
								<div class="text-center">
									<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>