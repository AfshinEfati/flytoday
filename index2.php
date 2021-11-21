<?php

$url = 'https://www.flytoday.ir/Content/Views/Global/js/waiting-dialog-search_flt_.js?V21.11.18.0216';
$url2 = 'https://www.flytoday.ir/';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($ch);
curl_close($ch);

include('simple_html_dom.php');
$dom = new simple_html_dom();
$dom->load($res);
$token = '';
foreach ($dom->find('form') as $key => $value) {
  foreach ($value->find('input') as $index => $val) {
    if ($index == 1) {
      $token = $val->value;
      break;
    }
  }
  if ($token != '') {
    # code...
    break;
  }
}

$params = array(
  'ReturnUrl' => '',
  '__RequestVerificationToken' => $token,
  'OriginLocationCodes[0]' => 'IKA',
  'DestinationLocationCodes[0]' => 'DXB',
  'DepartureDateTimes[0]' => '1400-09-01',
  'DepartureDateTimes_Lang[0]' => '',
  'AdultCount' => 1,
  'ChildCount' => 0,
  'InfantCount' => 0,
  'CabinType' => 1,
  'Foreign' => '',
  'Foreign_FlightType' => 1,
  'StepDays' => 0,
  'LastLoginUser' => ''
);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.flytodayir.com/flight/search/searchAjax',
  CURLOPT_RETURNTRANSFER  => true,
  CURLOPT_ENCODING        => '',
  CURLOPT_MAXREDIRS       => 10,
  CURLOPT_TIMEOUT         => 0,
  CURLOPT_FOLLOWLOCATION  => true,
  CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST   => 'POST',

  CURLOPT_POSTFIELDS      => $params,
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
