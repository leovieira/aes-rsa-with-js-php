<?php

header("Content-Type: application/json; charset=UTF-8");

$response = new stdClass();

function print_json($content) {
  echo json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

if ($_SERVER["REQUEST_METHOD"] != "GET") {
  $response->error = true;
  $response->msg = "Requested HTTP method not allowed.";

  print_json($response);
  die();
}

$public_key = file_get_contents("public.pem");

if (!$public_key) {
  $response->error = true;
  $response->msg = "public.pem file not found.";

  print_json($response);
  die();
}

$public_key = explode("-----BEGIN PUBLIC KEY-----", $public_key);
$public_key = explode("-----END PUBLIC KEY-----", $public_key[1]);
$public_key = $public_key[0];

// windows line break (carriage return and line feed - crlf)
$public_key = str_replace("\r\n", "", $public_key);

// mac line break (carriage return - cr)
$public_key = str_replace("\r", "", $public_key);

// linux line break (line feed - lf)
$public_key = str_replace("\n", "", $public_key);

$public_key = trim($public_key);

$response->error = false;
$response->msg = "OK";
$response->public_key = $public_key;

print_json($response);
