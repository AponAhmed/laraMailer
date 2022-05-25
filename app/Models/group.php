<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $table='contact_group';
    public $primaryKey='id';
    public $incrementing=true;
    protected $keyType='int';
    public  $timestamps=true;
    use HasFactory;
}
