<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
  use HasFactory;
  protected $appends = ["styles"];
  protected $fillable = [
    "template_name",
    "template_style",
    "header_text",
    "custom_style",
    "footer_text",
  ];

  public function getstylesAttribute()
  {
    return $this->styles = json_decode($this->template_style);
  }
}
