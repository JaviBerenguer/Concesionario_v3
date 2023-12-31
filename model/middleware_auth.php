<?php
include($_SERVER['DOCUMENT_ROOT'] . "/5-MVC/Concesionario_v3/model/JWT.php");

function decode_token($token){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3/model/jwt.ini');
    $secret = $jwt['secret'];

    $JWT = new JWT;
    $token_dec = $JWT->decode($token, $secret);
    $rt_token = json_decode($token_dec, TRUE);
    return $rt_token;
}

function create_token($username){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3/model/jwt.ini');
    $header = $jwt['header'];
    $secret = $jwt['secret'];

    $payload = '{"iat":"' . time() . '","exp":"' . time() + (600) . '","username":"' . $username . '"}';

    $JWT = new JWT;
    $token = $JWT->encode($header, $payload, $secret);
    return $token;
}
