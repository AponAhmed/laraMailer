<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group;

class ContactGroupController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth");
    //$this->middleware('loginCheck');
  }
  //VIEW Method

  public function contactGroup()
  {
    $data = [
      "title" => "Contacts Group",
      "addRoute" => route("contactGroup.new"),
      'ajaxAdd'=>true
    ];
    return view("contactgroup")->with(["module" => $data]);
  }

  function create_contact_group($id = false)
  {
    if ($id) {
      $data = group::find($id);
    } else {
      $data = new group();
    }

    return view("component.create_contact_group")->with(["data" => $data]);
  }

  function contactGroupStore(Request $req)
  {
    $data = $req->all();
    if (request()->filled("update")) {
      $id = $data["update"];
      unset($data["update"]);
      $contactGroup = group::find($id);
      $contactGroup->name = $data["name"];

      $contactGroup->save();
      return ["error" => false, "msg" => "Contact inserted"];
      //Update area
    } else {
      //insert area
      $contactGroup = new group();
      $contactGroup->name = $data["name"];
      $contactGroup->save();
      return ["error" => false, "msg" => "Contact inserted"];
    }
  }

  function contactGroupData()
  {
    return group::select("id", "name")->paginate(10);
  }
  function deletecontactGroup($id)
  {
    $contactGroup = group::find($id);
    return $contactGroup->delete();
  }
}
