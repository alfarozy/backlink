<?php

namespace App\Http\Controllers;

use App\Models\Backlink;
use App\Models\BacklinkPremium;
use App\Models\Member;
use App\Models\MemberBacklink;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_member' => Member::count(),
            'total_backlink' => Backlink::count(),
            'total_member_backlink' => BacklinkPremium::where('member_id', auth()->guard('member')->user()->id)->count()
        ];
        return view('backoffice.index', $data);
    }
}
