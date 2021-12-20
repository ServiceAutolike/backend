<?php
function activeMenu($route = '') {
    $active = '';
    if (Request::route()->getName() == $route) {
        $active = 'active';
    }
    return $active;
}

function responseApi($service_code) {
    $urlApi = Config::get('api.urlRequest.services');
    $param = array(
        'service_code' => $service_code
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $urlApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($param),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json;charset=UTF-8',
            'Token: '. Config::get('api.key.token'),
            'agency-secret-key:'. Config::get('api.key.agency')
        ),
    ));
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result);
    return $result;
}


function convertTime($timestamp){
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;

    $minutes = round($seconds / 60); // value 60 is seconds
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800); // 7*24*60*60;
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

    if ($seconds <= 60){

        return "Ngay bây giờ";

    } else if ($minutes <= 60){

        if ($minutes == 1){

            return "1 phút trước";

        } else {

            return "$minutes phút trước";

        }

    } else if ($hours <= 24){

        if ($hours == 1){

            return "1 giờ trước";

        } else {

            return "$hours giờ trước";

        }

    } else if ($days <= 7){

        if ($days == 1){

            return "Hôm qua";

        } else {

            return "$days ngày trước";

        }

    } else if ($weeks <= 4.3){

        if ($weeks == 1){

            return "1 tuần trước";

        } else {

            return "$weeks tuần trước";

        }

    } else if ($months <= 12){

        if ($months == 1){

            return "1 tháng trước";

        } else {

            return "$months tháng trước";

        }

    } else {

        if ($years == 1){

            return "1 năm trước";

        } else {

            return "$years năm trước";

        }
    }
}
