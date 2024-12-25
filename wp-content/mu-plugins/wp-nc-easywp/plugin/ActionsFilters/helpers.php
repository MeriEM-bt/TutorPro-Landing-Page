<?php
if (!defined("ABSPATH")) {
  exit();
}

use WPNCEasyWP\Http\Support\JWT;

function easywpJWT($jwt_token = false)
{
  return new JWT($jwt_token);
}
