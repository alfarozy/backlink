<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacklinkPremium extends Model
{
    use HasFactory;


    protected $fillable = ['backlink_id', 'member_id', 'content', 'title', 'keywords', 'website', 'website_backlink', 'status', 'type'];

    public function backlink()
    {
        return $this->belongsTo(Backlink::class, 'backlink_id', 'id');
    }

    public function tags()
    {
        return explode(',', $this->keywords);
    }
}
