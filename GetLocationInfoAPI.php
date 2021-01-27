<?php
header("Content-type: text/css; charset=utf-8");

$longitude = $_GET['lng'];
$latitude = $_GET['lat'];

//$longitude = 118.79213;
//$latitude = 31.938268;

if ($longitude != null & $latitude != null) {
    $geo_response = curl_get_https('https://restapi.amap.com/v3/geocode/regeo?key=729923f88542d91590470f613adb27b5&s=rsv3&location=' . '' . $longitude . ',' . $latitude);
//    echo $geo_response;
    $geo_info = json_decode($geo_response);
    $geo_api_info = array(
        'type' => 'complete',
        'info' => 'SUCCESS',
        'status' => 1,
        'position' => array(
            'Q' => $latitude,
            'R' => $longitude,
            'lng' => $longitude,
            'lat' => $latitude
        ),
        'message' => 'Get ipLocation failed.Get geolocation success.Convert Success.Get address success.',
        'accuracy' => 100,
        'isConverted' => 'true',
        'addressComponent' => array(
            'citycode' => $geo_info->regeocode->addressComponent->citycode,
            'adcode' => $geo_info->regeocode->addressComponent->adcode,
            'businessAreas' => [],
            'neighborhoodType' => '',
            'neighborhood' => '',
            'building' => '',
            'buildingType' => '',
            'street' => $geo_info->regeocode->addressComponent->streetNumber->street,
            'streetNumber' => $geo_info->regeocode->addressComponent->streetNumber->number,
            'country' => $geo_info->regeocode->addressComponent->country,
            'province' => $geo_info->regeocode->addressComponent->province,
            'city' => $geo_info->regeocode->addressComponent->city,
            'district' => $geo_info->regeocode->addressComponent->district,
            'township' => $geo_info->regeocode->addressComponent->township
        ),
        'formattedAddress' => $geo_info->regeocode->formatted_address,
        'roads' => [],
        'crosses' => [],
        'pois' => []
    );
    $address = $geo_info->regeocode->formatted_address;
    $province = $geo_info->regeocode->addressComponent->province;
    $city = $geo_info->regeocode->addressComponent->city;
    if (empty($city)) {
        $area = $province . ' '.$geo_info->regeocode->addressComponent->district;
    } else {
        $area = $province . ' '.$city .' '.$geo_info->regeocode->addressComponent->district;
    }
    
    // echo "<pre>";
    print_r('address:'.json_encode($address,JSON_UNESCAPED_UNICODE));
    echo PHP_EOL;
    print_r('area:'.json_encode($area,JSON_UNESCAPED_UNICODE));
    echo PHP_EOL;
    print_r('province:'.json_encode($province,JSON_UNESCAPED_UNICODE));
    echo PHP_EOL;
    print_r('city:'.json_encode($city,JSON_UNESCAPED_UNICODE));
    echo PHP_EOL;
    print_r('geo_api_info:'.json_encode($geo_api_info,JSON_UNESCAPED_UNICODE));
    
} else {
    print_r('地址获取失败，请检查经纬度信息');
}

function curl_get_https($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36");
    $tmpInfo = curl_exec($curl);
    curl_close($curl);
    return $tmpInfo;
}