<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumMember extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price'];
}
