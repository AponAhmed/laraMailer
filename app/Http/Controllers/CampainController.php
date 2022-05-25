<?php

namespace App\Http\Controllers;

use App\Models\Campain;
use Illuminate\Http\Request;
use App\Models\group;

class CampainController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth");
  }
  
  public function campain()
  {
    $data = ["title" => "Campaign", "addRoute" => route("campain.new"),'ajaxAdd'=>true];
    return view("campain")->with(["module" => $data]);
  }

  function create_campain($id = false)
  {
    if ($id) {
      $data = Campain::find($id);
    } else {
      $data = new Campain();
    }
    $group = group::select("id", "name")->get();

    return view("component.create_campaign")->with([
      "data" => $data,
      "contactGroup" => $group,
    ]);
  }

  function campaignStore(Request $req)
  {
    $data = $req->all();

    if (request()->filled("update")) {
      $id = $data["update"];
      unset($data["update"]);
      $campaign = Campain::find($id);
      $campaign->campaign_name = $data["campaign_name"];
      $campaign->subject = $data["subject"];
      $campaign->body = $data["body"];
      $campaign->group = json_encode($data["group"]);

      $campaign->save();
      return ["error" => false, "msg" => "Contact inserted"];
      //Update area
    } else {
      //insert area
      $campaign = new Campain();
      $campaign->campaign_name = $data["campaign_name"];
      $campaign->subject = $data["subject"];

      $campaign->body = $data["body"];
      $campaign->group = json_encode($data["group"]);
      $campaign->save();
      return ["error" => false, "msg" => "Campaign inserted "];
    }
  }
  function campaignData()
  {
    return Campain::orderBy("created_at", "DESC")->paginate(10);
  }

  function deletecampaign($id)
  {
    $campaign = Campain::find($id);
    return $campaign->delete();
  }
}
