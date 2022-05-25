<?php
/*Helper Functions for Mailer*/
use App\Http\Controllers\SettingsController;

/**
 * To Add a custom Settings
 *
 * @param string $name, Settings Name.
 * @param string $value, Settings Value.
 * @param int $user.
 * @return bolean.
 */
function add_setting(string $name, string $value, int $user)
{
  return SettingsController::add_settings($name, $value, $user);
}
