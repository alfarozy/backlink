<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlink extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'title', 'url', 'description', 'domain_rating', 'type'];

    const TYPE_NOFOLLOW = 'NOFOLLOW';
    const TYPE_DOFOLLOW = 'DOFOLLOW';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function domain()
    {
        $parsedUrl = parse_url($this->url);
        return $parsedUrl['host'];
    }
}
