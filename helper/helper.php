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
