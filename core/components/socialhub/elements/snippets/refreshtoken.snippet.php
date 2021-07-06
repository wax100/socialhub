<?php

if(!$provider ){
    echo 'Provider not set!';
    return ;
}

$token = $modx->getOption('socialhub.'.$provider.'_token');
if(!$token){
    echo 'Token not set!';
    return;
}

$request ='https://tokens.heibel.nl/assets/components/oauthprovider/refreshedtoken.php?token_id='.$token;
$response = json_decode(file_get_contents($request), 1);
if($response['status'] == 'ok'){
    $token = $response['message'];
    $opt= $modx->getObject('modSystemSetting', 'socialhub.facebook_token');
    $opt->set('value', $token);
    $opt->save();
    echo 'Token updated!';
}else{
    echo $response['message'];
}