<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\group;
class Contact extends Model
{

    protected $table='contact';
    public $primaryKey='id';
    public $incrementing=true;
    protected $keyType='int';
    public  $timestamps=true;
    use HasFactory;

    protected $hidden=['group'];

    public function group(){
        return $this->hasOne(group::class,"id",'group');
    }

    protected $appends = ["groupName"];

    public function getgroupNameAttribute()
    {
        $group=$this->group()->first();
        return $this->groupName=$group['name'];
    }
}
