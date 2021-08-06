<?php
$url = 'https://www.sjc.com.vn/xml/tygiavang.xml';
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$data = file_get_contents($url, false, stream_context_create($arrContextOptions));
$xml = new SimpleXMLElement($data);
$xmlJson = json_encode($xml);
$xmlArr = json_decode($xmlJson, true);
$xmlItem = $xmlArr['ratelist']['city'][0]['item'];

$result = [];
foreach ($xmlItem as $value) {
    $buy = $value['@attributes']['buy'];
    $sell = $value['@attributes']['sell'];
    $type = $value['@attributes']['type'];
    $result[]=[
        'buy' => $buy,
        'sell' => $sell,
        'type' => $type,

    ];
}

$xhtml = '';
foreach($result as $value){
    $xhtml     .=  '<tr>
                        <td>' . $value['type'] . '</td>
                        <td>' . $value['buy'] . '</td>
                        <td>' . $value['sell'] . '</td>
                    </tr>';
}

?>
<table class="table table-sm">
    <thead>
        <tr>
            <th><b>Loại vàng</b></th>
            <th><b>Mua vào</b></th>
            <th><b>Bán ra</b></th>
        </tr>
    </thead>
    <tbody>
        <?= $xhtml; ?>
    </tbody>
</table>