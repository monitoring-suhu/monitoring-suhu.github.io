<?php

if(isset($_POST['app_id'])){
    $app_id = $_POST['app_id'];
    
function sendMessage($id){
    $content = array(
        "en" => 'Suhu Ruangan melebihi 40 °C',
        );
    $headings = array(
        'en' => 'SUHU RUANGAN OVERHEAT'
    );
    $fields = array(
        'app_id' ==> $id,
        'included_segments' => array('All'),
        'data' =&gt; array("foo" => "bar"),
        'large_icon' => "ic_launcher_round.png",
        'contents' => $content,
        'headings' => $headings
        
    );

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic ZDNhZWUxNjYtZDQwZS00MmExLTlmNDEtNzAxOGM2MGQ2MGQ3'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage($app_id);
$return["allresponses"] = $response;
$return = json_encode( $return);
print("\n\nJSON received:\n");
print($return);
print("\n");
}
