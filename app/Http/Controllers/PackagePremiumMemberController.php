<?php

namespace App\Http\Controllers;

use App\Models\PackagePremiumMember;
use Illuminate\Http\Request;

class PackagePremiumMemberController extends Controller
{
    public function index()
    {
        // paket-member-premium
        $data = PackagePremiumMember::get();
        return view('backoffice.langganan.index', compact('data'));
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'month' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        PackagePremiumMember::create($attr);
        return redirect()->route('paket-member-premium.index')->with('msg', 'Data berhasil disimpan');
    }

    public function create()
    {
        return view('backoffice.langganan.create');
    }
    public function edit($id)
    {
        $data = PackagePremiumMember::findOrFail($id);
        return view('backoffice.langganan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'month' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        $data = PackagePremiumMember::where('id', $id)->first();

        PackagePremiumMember::where('id', $id)->update($attr);
        return redirect()->route('paket-member-premium.index')->with('msg', 'Data berhasil disimpan');
    }
    public function show($id)
    {
        return abort(404);
    }
}
