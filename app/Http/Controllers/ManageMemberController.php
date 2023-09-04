<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\PackagePremiumMember;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageMemberController extends Controller
{
    public function index()
    {
        $data = Member::get();
        return view('backoffice.member.index', compact('data'));
    }
    public function show($id)
    {
        $data = Member::findOrFail($id);
        $packages = PackagePremiumMember::get();
        return view('backoffice.member.show', compact('data', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'package_id' => 'required',
        ]);

        $package = PackagePremiumMember::find($attr['package_id']);
        if (!$package) {
            return abort(404);
        }

        $sekarang = Carbon::now();
        $payload = [
            'expired_date' => $sekarang->addMonths($package->month),
            'type' => Member::TYPE_PREMIUM
        ];
        Member::where('id', $id)->update($payload);
        return redirect()->back()->with('msg', 'Data berhasil disimpan');
    }
}
