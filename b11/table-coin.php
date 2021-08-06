<?php 
use function PHPSTORM_META\type;
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '10',
    'convert' => 'USD'
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: d02c90bc-96bb-4aa6-8b9e-5374aa1ab93c'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
$response = json_decode(($response), true);
$result=[];
foreach ($response['data'] as $key => $value) {
  
    $name       = $response['data'][$key]['name'];
    $price      = number_format($response['data'][$key]['quote']['USD']['price'],2);
    $change24h  =  (float)(number_format($response['data'][$key]['quote']['USD']['percent_change_24h'],2));
    $result[]=[
        'name'=>$name,
        'price'=>$price,
        'change24h'=>$change24h,
    ];
}
curl_close($curl); // Close request
$xhtml ='';
foreach($result as $value){
    $class = "text-success";
    if($value['change24h'] < 0)  $class = "text-danger";
    $xhtml .='<tr>
                <td>'.$value['name'].'</td>
                <td>'.$value['price'].'</td>
                <td><span class="'.$class.'">'.$value['change24h'].'%</span></td>
            </tr>';
}
?>
<table class="table table-sm">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Price (USD)</b></th>
            <th><b>Change (24h)</b></th>
        </tr>
    </thead>
    <tbody>
        <?= $xhtml; ?>
    </tbody>
</table>