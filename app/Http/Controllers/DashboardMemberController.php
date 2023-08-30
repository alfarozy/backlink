<?php

namespace App\Http\Controllers;

use App\Models\Backlink;
use App\Models\Category;
use App\Models\MemberBacklink;
use Illuminate\Http\Request;

class DashboardMemberController extends Controller
{
    public function index()
    {
        $data = [
            'total_backlink' => Backlink::count(),
            'total_member_backlink' => MemberBacklink::where('member_id', auth()->guard('member')->user()->id)->count()
        ];
        return view('member.index', $data);
    }
    public function listBacklink()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        if (request()->category) {
            $category = Category::where('slug', request('category'))->first();
            $data = Backlink::where('category_id', $category->id)->latest()->get();
        } else {
            $data = Backlink::whereNot('category_id', 9)->get();
        }
        return view('member.listBacklink', compact('data', 'categories'));
    }
    public function backlinkPremium()
    {
        $categories = Category::orderBy('id', 'desc')->get();

        if (request()->category) {
            $category = Category::where('slug', request('category'))->first();
            $data = MemberBacklink::whereHas('backlink', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })->get();
        } else {
            $data = MemberBacklink::get();
        }
        return view('member.backlinkPremium', compact('data', 'categories'));
    }
    public function memberBacklink()
    {
        $categories = Category::orderBy('id', 'desc')->get();

        if (request()->category) {
            $category = Category::where('slug', request('category'))->first();
            $data = MemberBacklink::whereHas('backlink', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })->get();
        } else {
            $data = MemberBacklink::get();
        }
        return view('member.memberBacklink', compact('data', 'categories'));
    }
    public function memberBacklinkCreate()
    {
        $data = Backlink::whereNot('category_id', 9)->get();
        return view('member.memberBacklinkCreate', compact('data'));
    }

    public function memberBacklinkStore(Request $request)
    {
        $attr = $request->validate([
            'backlink_id' => 'required|unique:member_backlinks',
            'url' => 'required|unique:member_backlinks'
        ], [
            '*required' => 'Bidang ini wajib',
            'unique.url' => 'Url Sudah tersedia',
            'unique.backlink_id' => 'Url Sudah tersedia',
        ]);

        $attr['member_id'] = auth()->guard('member')->user()->id;
        MemberBacklink::create($attr);
        return redirect()->route('dashboard.member.submit.backlink')->with('msg', 'Data berhasil disimpan');
    }

    public function memberBacklinkDelete($id)
    {
        $data = MemberBacklink::find($id);
        if (!$data) {
            return redirect()->route('dashboard.member.submit.backlink')->with('error', 'Data gagal dihapus');
        }
        $data->delete();
        return redirect()->route('dashboard.member.submit.backlink')->with('msg', 'Data berhasil dihapus');
    }
}
