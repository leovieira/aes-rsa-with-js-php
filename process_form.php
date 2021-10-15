<?php

header("Content-Type: application/json; charset=UTF-8");

$response = new stdClass();

function print_json($content) {
  echo json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  $response->error = true;
  $response->msg = "Requested HTTP method not allowed.";

  print_json($response);
  die();
}

$request = json_decode(file_get_contents("php://input"));

if (
  !isset($request->data) or
  !isset($request->key) or
  !isset($request->iv)
) {
  $response->error = true;
  $response->msg = "Not all parameters were passed.";

  print_json($response);
  die();
}

$private_key = file_get_contents("private.pem");

if (!$private_key) {
  $response->error = true;
  $response->msg = "private.pem file not found.";

  print_json($response);
  die();
}

$key_dec = null;

$rs = openssl_private_decrypt(
  base64_decode($request->key),
  $key_dec,
  $private_key,
);

if (!$rs) {
  $response->error = true;
  $response->msg = "Unable to decrypt key with RSA.";

  print_json($response);
  die();
}

$data_dec = openssl_decrypt(
  base64_decode($request->data),
  "aes-256-cbc",
  hex2bin($key_dec),
  OPENSSL_RAW_DATA,
  hex2bin($request->iv)
);

if (!$data_dec) {
  $response->error = true;
  $response->msg = "Unable to decrypt data with AES.";

  print_json($response);
  die();
}

$data = json_decode($data_dec);

if (
  !isset($data->fname) or
  !isset($data->lname) or
  !isset($data->email) or
  !isset($data->phone) or
  !isset($data->message)
) {
  $response->error = true;
  $response->msg = "Expected to find all fields.";

  print_json($response);
  die();
}

if (
  empty($data->fname) or
  empty($data->lname) or
  empty($data->email) or
  empty($data->phone)
) {
  $response->error = true;
  $response->msg = "Fields with (*) are required.";

  print_json($response);
  die();
}

$response->error = false;
$response->msg = "OK";
$response->data = $data;

print_json($response);
