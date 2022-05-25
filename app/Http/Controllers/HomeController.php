<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campain;
use App\Models\Contact;
use App\Models\group;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  public function __construct()
  {
    $this->middleware("auth");
  }
  public function homeIndex()
  {
    $TotalGroup = group::count();
    $TotalContact = Contact::count();
    $TotalCampain = Campain::count();

    return view("home", [
      "TotalGroup" => $TotalGroup,
      "TotalContact" => $TotalContact,
      "TotalCampain" => $TotalCampain,
    ]);
  }
}
