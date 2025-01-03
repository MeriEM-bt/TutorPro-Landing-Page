<?php
if (!defined("ABSPATH")) {
  exit();
}

/*
|--------------------------------------------------------------------------
| WordPress Readonly - HackGuardian
|--------------------------------------------------------------------------
|
|
*/

function setHackGuardian(bool $enabled)
{
  if (defined('WP_CLI') && WP_CLI) {
    // WP-CLI is in use, skip the getenv() checks
    return;
  }

  $jwt_token = easywpJWT()->token;

  if (!$jwt_token) {
    error_log("JWT_TOKEN not set");
    return;
  }

  $data = ["oldReadonly" => !$enabled, "newReadonly" => $enabled];
  $data_string = json_encode($data);
  $website_webhook_url = getenv("WEBSITE_WEBHOOK_URL");

  if (!$website_webhook_url) {
    error_log("WEBSITE_WEBHOOK_URL not set");
    return;
  }

  // YAML config
  $api_route = wpbones_flags()->flags('hackguardian.route', '/v1/readonly');
  $timeout = intval(wpbones_flags()->flags('hackguardian.timeout', 0));

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "{$website_webhook_url}{$api_route}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => $timeout,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HTTPHEADER => ["Content-Type: application/json", "authorization: " . $jwt_token],
    CURLOPT_POSTFIELDS => $data_string,
  ]);

  $response = curl_exec($curl);

  curl_close($curl);

  return $response;
}

function useHackGuardian()
{
  $hack_guardian_enabled = getenv("EASYWP_READONLY");

  return $hack_guardian_enabled === "true";
}
