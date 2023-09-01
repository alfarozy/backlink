<?php

namespace App\Http\Controllers;

use App\Models\Backlink;
use App\Models\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class BacklinkController extends Controller
{
    public function index()
    {
        if (!($limit = request()->limit)) {
            $limit = 25;
        }
        $data = Backlink::latest()->get();
        $categories = Category::get();
        return view('backoffice.backlink.index', compact('data', 'categories'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'category_id' => 'required',
            'domain_rating' => 'required',
            'type' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        $check = Backlink::where('url', $attr['url'])->first();
        if ($check) {
            return redirect()->route('backlink.index')->with('error', 'Data gagal disimpan, Url sudah tersedia');
        }
        Backlink::create($attr);
        return redirect()->route('backlink.index')->with('msg', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = Backlink::findOrFail($id);
        $categories = Category::get();
        return view('backoffice.backlink.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'category_id' => 'required',
            'domain_rating' => 'required',
            'type' => 'required',
            'description' => 'sometimes|nullable',
        ]);
        $data = Backlink::where('id', $id)->first();
        $check = Backlink::where('url', $attr['url'])->first();
        if ($check) {
            if ($data->id != $check->id) {
                return redirect()->route('backlink.index')->with('error', 'Data gagal disimpan, Url sudah tersedia');
            }
        }
        Backlink::where('id', $id)->update($attr);
        return redirect()->route('backlink.index')->with('msg', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = Backlink::find($id);
        if (!$data) {
            return redirect()->route('backlink.index')->with('error', 'Data gagal dihapus');
        }
        $data->delete();
        return redirect()->route('backlink.index')->with('msg', 'Data berhasil dihapus');
    }
}
