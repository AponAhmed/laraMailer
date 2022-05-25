<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Template;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
  public function index()
  {
    $module = [
      "title" => "Newsletter",
      "addRoute" => route("newsletter.create"),
      "ajaxAdd" => true,
    ];
    return view("newsletter")->with(["module" => $module]);
  }

  /**
   * Create new Data and Update Data form
   * @param Newsletter id if Update
   * @return JSON response
   */
  public function create($id = false)
  {
    if ($id) {
      $data = Newsletter::find($id);
    } else {
      $data = new Newsletter();
    }
    $templates = Template::select("id", "template_name")->get();
    return view("component.newsletter_create")->with([
      "data" => $data,
      "templates" => $templates,
    ]);
  }

  /**
   *Data api path with pagination
   */
  public function data()
  {
    return Newsletter::paginate(10);
  }

  /**
   * New data Store and Update existing Data by ID
   * @param Request
   * @return JSON response
   */
  public function store(Request $req)
  {
    $data = $req->all();
    if (request()->filled("update")) {
      $id = $data["update"];
      unset($data["update"]);
      $newsletter = Newsletter::find($id);
      $newsletter->name = $data["name"];
      $newsletter->subject = $data["subject"];
      $newsletter->body = $data["body"];
      $newsletter->template_id = $data["template_id"];
      $newsletter->save();
      return ["error" => false, "msg" => "Newsetter Updated"];
    } else {
      $newsletter = new Newsletter();
      $newsletter->name = $data["name"];
      $newsletter->subject = $data["subject"];

      $newsletter->body = $data["body"];
      $newsletter->template_id = $data["template_id"];
      $newsletter->save();
      return ["error" => false, "msg" => "Newsetter inserted"];
    }
  }

  /**
   * Delete Newsletter by ID
   * @param Newsletter ID
   */
  function delete($id)
  {
    $newsletter = Newsletter::find($id);
    return $newsletter->delete();
  }
}
