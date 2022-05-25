<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleAccount;

class GoogleAccountController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth");
    //$this->middleware('loginCheck');
    //dd(session('GaIDAuth'));
  }
  public function googleAccount()
  {
    if (isset($_GET["code"])) {
      $code = trim($_GET["code"]);
      if (session()->has("OAuthLogin")) {
        $id = session()->get("OAuthLogin");
        session()->forget("OAuthLogin");
        new GoogleApiService(GoogleAccount::find($id));
        return redirect()->route("googleAccount");
      }
    }
    $data = [
      "title" => "Google Accounts",
      "addRoute" => route("googleAccount.new"), //Data Insert Form Route
      'ajaxAdd'=>true
    ];
    return view("googleAccount")->with(["module" => $data]);
    //return view('googleAccount');
  }

  public function create_googleAccount($id = false)
  {
    if ($id) {
      $data = GoogleAccount::find($id);
    } else {
      $data = new GoogleAccount();
    }

    return view("component.create_google_account")->with(["data" => $data]);
  }

  public function googleAccountStore(Request $req)
  {
    $data = $req->all();
    if (request()->filled("update")) {
      $id = $data["update"];
      unset($data["update"]);
      $googleAccount = GoogleAccount::find($id);
      $googleAccount->email = $data["email"];
      $googleAccount->daily_limit = $data["daily_limit"];
      $googleAccount->hourly_limit = $data["hourly_limit"];

      $googleAccount->save();
      return ["error" => false, "msg" => "Contact inserted"];
      //Update area
    } else {
      //insert area
      $googleAccount = new GoogleAccount();
      $googleAccount->email = $data["email"];
      $googleAccount->daily_limit = $data["daily_limit"];
      $googleAccount->hourly_limit = $data["hourly_limit"];

      $googleAccount->save();
      return ["error" => false, "msg" => "Contact inserted"];
    }
  }

  function googleAccountData()
  {
    return GoogleAccount::paginate(10);
  }

  function deletecontactGroup($id)
  {
    $googleAccount = GoogleAccount::find($id);
    return $googleAccount->delete();
  }

  public function getOauthLink($id)
  {
    session()->put("OAuthLogin", $id);
    $Ga = GoogleAccount::find($id);
    $service = new GoogleApiService(GoogleAccount::find($Ga));
    $link = $service->client->createAuthUrl();
    return $link;
    //dd($req->session()->get('GaIDAuth'));

    /*
       $accessToken = $service->client->fetchAccessTokenWithAuthCode('4/0AX4XfWggbA1DKK0vp4tLUzTlRgvPC8vDPu4Z1dvJaVsPT7I6ojdGtHtZnGKCCPe6FqR0ow');
       $Ga->auth_token = json_encode($accessToken);
        $Ga->save(); */
  }
}
