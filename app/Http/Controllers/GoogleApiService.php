<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Gmail;
use Exception;
use Illuminate\Http\Request;

class GoogleApiService extends Controller
{
  //
  var $token = [];
  public function __construct($department)
  {
    $this->department = $department;
    $this->credentials = config_path("credentials.json");
    if (!empty($this->department->auth_token)) {
      $this->token = json_decode($this->department->auth_token, true);
    }
    $this->client = $this->create_client();
  }

  public function get2Redirect()
  {
    if (isset($_GET["code"])) {
      return true;
    }
    return false;
  }

  public function create_client()
  {
    $client = new Google_Client();
    $client->setApplicationName("BulkMailer");
    $client->setScopes(Google_Service_Gmail::MAIL_GOOGLE_COM);
    $client->setAuthConfig($this->credentials);
    $client->setAccessType("offline");
    $client->setPrompt("select_account consent");

    //$client->setRedirectUri("http://localhost/GmailApi"); // Must Match with credential's redirect URL

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    //$tokenPath = 'token.json';
    if ($this->token) {
      // $accessToken = json_decode(file_get_contents($this->tokenPath), true);
      $client->setAccessToken($this->token);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
      // Refresh the token if possible, else fetch a new one.
      if ($client->getRefreshToken()) {
        try {
          $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } catch (Exception $e) {
          //echo $e;
          $this->department->auth_token = "";
          $this->department->save();
          $this->is_connected = false;
          return $client;
        }
      } elseif ($this->get2Redirect()) {
        $authCode = $_GET["code"];
        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

        // Check to see if there was an error.
        if (array_key_exists("error", $accessToken)) {
          throw new Exception(join(", ", $accessToken));
        }
      } else {
        $this->is_connected = false;
        return $client;
      }
      $this->department->auth_token = $client->getAccessToken();
      $this->department->save();
    } else {
      //echo "<p>not expired</p>";
    }

    $this->is_connected = true;
    return $client;
  }
}
