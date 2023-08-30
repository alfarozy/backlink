<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class ManageMemberController extends Controller
{
    public function index()
    {
        $data = Member::get();
        return view('backoffice.member.index', compact('data'));
    }
}
