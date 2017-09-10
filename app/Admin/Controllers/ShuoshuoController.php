<?php

namespace App\Admin\Controllers;

use App\Major;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Shuoshuo;

class ShuoshuoController extends Controller
{
    public function index()
    {
        $shuoshuos = Shuoshuo::whereNull('deleted_at')->with('user')->with('major')->orderBy('updated_at',
            'desc')->paginate();
//        dd($shuoshuos[0]->comment_count);
        return view('/admin/shuoshuo/index', compact('shuoshuos'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $shuoshuo = Shuoshuo::with('user')->with('major')->find($id);
        } else {
            $shuoshuo = new Shuoshuo();
        }
        dd($shuoshuo);
        return view('admin/shuoshuo/create', compact('shuoshuo'));
    }

    public function store(Request $request)
    {
        $id = request('id');
        $this->validate($request, [
            'name' => 'required|min:4|max:30|unique:shuoshuos,name'
        ]);

        if (empty($id)) {
            Shuoshuo::create(request(['name']));
        } else {
            Shuoshuo::where('id', $id)->update(request(['name']));
        }
        return redirect('/admin/shuoshuos');
    }

    public function delete(Shuoshuo $shuoshuo)
    {
        $shuoshuo->deleted_at = Carbon::now()->toDateTimeString();
        $shuoshuo->save();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
