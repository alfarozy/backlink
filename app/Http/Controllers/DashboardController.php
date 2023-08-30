<?php

namespace App\Http\Controllers;

use App\Models\Backlink;
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
            'total_member_backlink' => MemberBacklink::count()
        ];
        return view('backoffice.index', $data);
    }
}
