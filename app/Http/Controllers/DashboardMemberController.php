<?php

namespace App\Http\Controllers;

use App\Models\Backlink;
use App\Models\BacklinkPremium;
use App\Models\Category;
use App\Models\Member;
use App\Models\MemberBacklink;
use Illuminate\Http\Request;

class DashboardMemberController extends Controller
{
    public function index()
    {
        $data = [
            'total_backlink' => Backlink::count(),
            'total_member_backlink' => BacklinkPremium::where('member_id', auth()->guard('member')->user()->id)->count()
        ];
        return view('member.index', $data);
    }
    public function listBacklink()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        if (request()->category) {
            $category = Category::where('slug', request('category'))->first();
            if (Auth()->guard('member')->user()->type == Member::TYPE_PREMIUM) {
                $data = Backlink::where('category_id', $category->id)->latest()->get();
            } else {
                $data = Backlink::where('category_id', $category->id)->limit(5)->get();
            }
        } else {
            if (Auth()->guard('member')->user()->type == Member::TYPE_PREMIUM) {
                $data = Backlink::whereNot('category_id', 9)->get();
            } else {
                $data = Backlink::whereNot('category_id', 9)->limit(40)->get();
            }
        }
        $totalbacklink = Backlink::count();
        return view('member.listBacklink', compact('data', 'categories', 'totalbacklink'));
    }
    public function backlinkPremium()
    {

        $data = BacklinkPremium::where('member_id', auth()->guard('member')->id())->get();
        return view('member.backlinkPremium', compact('data'));
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
    public function memberBacklinkCreate($id)
    {
        if (!$id) {
            return abort(404);
        }
        return view('member.memberBacklinkCreate');
    }

    public function memberBacklinkStore(Request $request, $id)
    {


        $attr = $request->validate([
            'keywords' => 'required',
            'website' => 'required',
            'type' => 'required',
        ], [
            '*required' => 'Bidang ini wajib',
        ]);
        if ($request->type == 1) {
            $dataAttr = $request->validate([
                'title' => 'required',
                'content' => 'required',
            ], [
                '*required' => 'Bidang ini wajib',
            ]);
            $attr['title'] = $request->title;
            $attr['content'] = $request->content;
        }

        $attr['member_id'] = auth()->guard('member')->user()->id;
        $attr['backlink_id'] = $request->id;
        BacklinkPremium::create($attr);
        return redirect()->back()->with('msg', 'Data berhasil disimpan');
    }

    public function memberBacklinkShow($id)
    {
        $data = backlinkPremium::find($id);
        return view('member.memberBacklinkShow', compact('data'));
    }
}
