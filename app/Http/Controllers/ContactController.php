<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\group;

class ContactController extends Controller
{
  public function __construct()
  {
    //$this->middleware('loginCheck');
    $this->middleware("auth");
  }
  public function contact()
  {
    $data = ["title" => "Contacts", "addRoute" => route("contact.new"),'ajaxAdd'=>true];
    return view("contact")->with(["module" => $data]);
  }
  function create_contact($id = false)
  {
    if ($id) {
      $data = Contact::find($id);
    } else {
      $data = new Contact();
    }
    $group = group::select("id", "name")->get();

    return view("component.create_contact")->with([
      "data" => $data,
      "contactGroup" => $group,
    ]);
  }
  function contactData()
  {
    return Contact::select("id", "group", "email", "created_at")->paginate(10);
  }
  function contactStore(Request $req)
  {
    $data = $req->all();
    if (request()->filled("update")) {
      $id = $data["update"];
      unset($data["update"]);
      $contact = Contact::find($id);

      $contact->email = $data["email"];
      $contact->group = $data["group"];

      $contact->save();
      return ["error" => false, "msg" => "Contact inserted"];

      //Update area
    } else {
      //insert area

      $e = $data["email"];

      $pattern = "/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i";
      preg_match_all($pattern, $e, $matches);
      $emails = $matches[0];

      $total = count($emails);
      $n = 0;
      foreach ($emails as $email) {
        $contact = new Contact();
        $contact->email = $email;
        $contact->group = $data["group"];
        if ($contact->save()) {
          $n++;
        }
      }
      return ["error" => false, "msg" => "Contact inserted $n from $total"];
    }
  }
  function deletecontact($id)
  {
    $Contact = Contact::find($id);
    return $Contact->delete();
  }
  function deleteAll(Request $req)
  {
    $ids = $req->ids;
    $i = 0;
    foreach ($ids as $id) {
      $Contact = Contact::find($id);

      if ($Contact->delete()) {
        $i++;
      }
    }
    return $i;
  }
}
