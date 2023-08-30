<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberBacklink extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'backlink_id', 'url'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function backlink()
    {
        return $this->belongsTo(Backlink::class, 'backlink_id', 'id');
    }

    public function domain()
    {
        $parsedUrl = parse_url($this->url);
        return $parsedUrl['host'];
    }
}
