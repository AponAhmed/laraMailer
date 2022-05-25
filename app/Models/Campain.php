<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\group;

class Campain extends Model
{
    public $table = 'campaign';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public  $timestamps = true;

    use HasFactory;

    protected $hidden = ['group', "body"];

    public function group_ids()
    {
        return json_decode($this->group);
    }

    protected $appends = ["groupNames", "bodyExcerpt"];

    public function getgroupNamesAttribute()
    {
        $ids = $this->group_ids();
        $names = [];
        foreach ($ids as $id) {
            $g = group::find($id);
            $names[] = $g['name'];
        }

        return $this->groupName = implode(",", $names);
    }

    function getbodyExcerptAttribute()
    {
        $limit = 60;
        $bbody=strip_tags($this->body);
        if (strlen($bbody) > $limit) {

            return $this->bodyExcerpt = substr($bbody, 0, $limit) . "...";
        } else {
            return $this->bodyExcerpt = $bbody;
        }
    }
}
