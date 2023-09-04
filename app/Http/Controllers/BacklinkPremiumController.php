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
    public function show($id)
    {
        $data = BacklinkPremium::findOrFail($id);
        return view('backoffice.backlink-premium.show', compact('data'));
    }
    public function update(Request $request, $id)
    {



        $data = BacklinkPremium::where('id', $id)->first();
        $dataAttr = $request->validate([
            'website_backlink' => 'required',
        ], [
            '*required' => 'Bidang ini wajib',
        ]);
        if ($data->type == 0) {

            $dataAttr = $request->validate([
                'website_backlink' => 'required',
                'title' => 'required',
                'content' => 'required',
            ], [
                '*required' => 'Bidang ini wajib',
            ]);
            $attr['title'] = $request->title;
            $attr['content'] = $request->content;
        }

        $attr['website_backlink'] = $request->website_backlink;
        $attr['status'] = "SUCCESS";
        BacklinkPremium::where('id', $id)->update($attr);
        return redirect()->route('data-backlink-premium.index')->with('msg', 'Data berhasil disimpan');
    }
    public function store(Request $request)
    {

        $attr['status'] = "PROCESS";
        BacklinkPremium::where('id', $request->id)->update($attr);
        return redirect()->route('data-backlink-premium.index')->with('msg', 'Data berhasil disimpan');
    }
}
