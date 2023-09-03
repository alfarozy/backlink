<?php

namespace App\Http\Controllers;

use App\Models\PremiumPackage;
use Illuminate\Http\Request;

class PremiumPackageController extends Controller
{
    public function index()
    {
        $data = PremiumPackage::latest()->get();
        return view('backoffice.premium-package.index', compact('data'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        PremiumPackage::create($attr);
        return redirect()->route('premium-package.index')->with('msg', 'Data berhasil disimpan');
    }

    public function create()
    {
        return view('backoffice.premium-package.create');
    }
    public function edit($id)
    {
        $data = PremiumPackage::findOrFail($id);
        return view('backoffice.premium-package.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        $data = PremiumPackage::where('id', $id)->first();

        PremiumPackage::where('id', $id)->update($attr);
        return redirect()->route('premium-package.index')->with('msg', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = PremiumPackage::find($id);
        if (!$data) {
            return redirect()->route('premium-package.index')->with('error', 'Data gagal dihapus');
        }
        $data->delete();
        return redirect()->route('premium-package.index')->with('msg', 'Data berhasil dihapus');
    }
}
