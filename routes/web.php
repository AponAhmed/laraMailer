<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactGroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CampainController;
//use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleAccountController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TemplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
  "register" => false,
  "login" => true,
]);

// Home Page View Route
Route::get("/", [HomeController::class, "homeIndex"])->name("homeIndex");

/* ContactGroup Route Group  */

Route::prefix("contactGroup")->group(function () {
  Route::get("/", [ContactGroupController::class, "contactGroup"])->name(
    "ContactGroup"
  );

  Route::get("/new", [
    ContactGroupController::class,
    "create_contact_group",
  ])->name("contactGroup.new");
  Route::post("/store", [
    ContactGroupController::class,
    "contactGroupStore",
  ])->name("contactGroup.store");
  Route::get("/data", [
    ContactGroupController::class,
    "contactGroupData",
  ])->name("contactGroup.data");
  Route::get("/edit/{id}", [
    ContactGroupController::class,
    "create_contact_group",
  ])->name("create_contact_group.edit");

  Route::get("/delete/{id}", [
    ContactGroupController::class,
    "deletecontactGroup",
  ])->name("contactGroup.delete");
});

/* ContactGroup Route Group --------------------------------------------------------------------------------------------  End */

/* Contact Route Group ---------------------------------------START */

Route::prefix("contact")->group(function () {
  Route::get("/", [ContactController::class, "contact"])->name("contact");
  Route::get("/new", [ContactController::class, "create_contact"])->name(
    "contact.new"
  );
  Route::get("/data", [ContactController::class, "contactData"])->name(
    "contact.data"
  );
  Route::post("/store", [ContactController::class, "contactStore"])->name(
    "contact.store"
  );
  Route::get("/edit/{id}", [ContactController::class, "create_contact"])->name(
    "contact.edit"
  );

  Route::get("/delete/{id}", [ContactController::class, "deletecontact"])->name(
    "contact.delete"
  );
  Route::post("/deleteAll", [ContactController::class, "deleteAll"]);
});
/* Contact Route Group ---------------------------------------End */

/* Camaign Route Group  ---------------------------------------------------------------------Start */
Route::prefix("campain")->group(function () {
  Route::get("/", [CampainController::class, "campain"])->name("campain");
  Route::get("/new", [CampainController::class, "create_campain"])->name(
    "campain.new"
  );
  Route::post("/store", [CampainController::class, "campaignStore"])->name(
    "campain.store"
  );
  Route::get("/data", [CampainController::class, "campaignData"])->name(
    "campain.data"
  );
  Route::get("/edit/{id}", [CampainController::class, "create_campain"])->name(
    "campain.edit"
  );

  Route::get("/delete/{id}", [
    CampainController::class,
    "deletecampaign",
  ])->name("campain.delete");
});
/* Camaign Route Group  End */

/* Login Route   Start */
//Route::get("/Login", [LoginController::class, "login"]);
//Route::post("/onLogin", [LoginController::class, "onLogin"]);
//Route::get("/onLogout", [LoginController::class, "onLogout"])->name("logout");

/* Login Route   End */

/* Google Account Route Group  ---------------------------------------------------------------------Start */
Route::prefix("google-account")->group(function () {
  Route::get("/", [GoogleAccountController::class, "googleAccount"])->name(
    "googleAccount"
  );
  Route::get("/new", [
    GoogleAccountController::class,
    "create_googleAccount",
  ])->name("googleAccount.new");
  Route::post("/store", [
    GoogleAccountController::class,
    "googleAccountStore",
  ])->name("googleAccount.store");
  Route::get("/data", [
    GoogleAccountController::class,
    "googleAccountData",
  ])->name("googleAccount.data");
  Route::get("/edit/{id}", [
    GoogleAccountController::class,
    "create_googleAccount",
  ])->name("googleAccount.edit");

  Route::get("/delete/{id}", [
    GoogleAccountController::class,
    "deletecontactGroup",
  ])->name("googleAccount.delete");
  Route::get("/get-oauth-link/{id}", [
    GoogleAccountController::class,
    "getOauthLink",
  ])->name("getOauthLink");
});
/* Google Account Route Group  ---------------------------------------------------------------------Start */

/* Settings Route  ---------------------------------------------------------------------Start */
Route::prefix("settings")->group(function () {
  Route::get("/", [SettingsController::class, "settings"])->name("settings");
  Route::post("/store", [SettingsController::class, "settingsStore"])->name(
    "settings.store"
  );
});
/* Template  Route Group  ---------------------------------------------------------------------Start */
Route::prefix("template")->group(function () {
  Route::get("/", [TemplateController::class, "index"])->name("template");
  Route::post("/store", [TemplateController::class, "store"])->name(
    "template.store"
  );
  Route::get("/new", [TemplateController::class, "create"])->name(
    "template.create"
  );
  Route::get("/data", [TemplateController::class, "data"])->name(
    "template.data"
  );
  Route::get("/edit/{id}", [TemplateController::class, "create"])->name(
    "template.edit"
  );
  Route::get("/delete/{id}", [TemplateController::class, "delete"])->name(
    "template.delete"
  );
});

Route::prefix("newsletter")->group(function () {
  Route::get("/", [NewsletterController::class, "index"])->name("newsletter");
  Route::post("/store", [NewsletterController::class, "store"])->name(
    "newsletter.store"
  );
  Route::get("/new", [NewsletterController::class, "create"])->name(
    "newsletter.create"
  );
  Route::get("/data", [NewsletterController::class, "data"])->name(
    "newsletter.data"
  );
  Route::get("/edit/{id}", [NewsletterController::class, "create"])->name(
    "newsletter.edit"
  );
  Route::get("/delete/{id}", [NewsletterController::class, "delete"])->name(
    "newsletter.delete"
  );
});
