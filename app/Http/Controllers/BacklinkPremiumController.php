<?php

namespace App\Http\Controllers;

use App\Models\BacklinkPremium;
use Illuminate\Http\Request;

class BacklinkPremiumController extends Controller
{
    public function index()
    {
        $data = BacklinkPremium::latest()->get();
        return view('backoffice.backlink-premium.index', compact('data'));
    }
}
