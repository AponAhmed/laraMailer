<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  public $commonField = [
    "send_limit_per_hit",
    "send_limit_camp",
    "delay_between",
    "duplicate_send",
  ];

  function settings()
  {
    $module = ["title" => "Settings"];
    $settings = Setting::whereIn("name", $this->commonField)->get();
    $data = [];
    if ($settings->count() > 0) {
      foreach ($settings as $setting) {
        $data[$setting->name] = $setting->value;
      }
    }
    //dd($data);
    return view("settings")->with(["module" => $module, "data" => $data]);
  }

  /**
   * To Add a single setting
   *
   * @param string $name, Settings Name.
   * @param string $value, Settings Value.
   * @param int $user.
   * @return boolean.
   */

  public static function add_settings(
    string $name,
    string $value,
    int $user = null
  ) {
    $setting = Setting::where("name", "=", $name)
      ->where("user", "=", $user)
      ->first();

    if ($setting && $setting->count() > 0) {
      $setting->value = $value;
      return $setting->save(); //Update Existing Settings
    }

    $setting = new Setting();
    $setting->name = trim($name);
    $setting->value = $value;
    $setting->user = $user;
    return $setting->save();
  }

  /**
   * Store a set of Settings
   * @param Request
   * @return boolean
   */
  public function settingsStore(Request $request)
  {
    $serializeData = $request->request->get("fData"); //Get a post parameter
    $data = [];
    parse_str($serializeData, $data);
    $settings = $data["settings"];
    foreach ($settings as $name => $val) {
      $this->add_settings($name, $val);
    }
  }
}
