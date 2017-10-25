<?php

namespace App\Admin\Controllers;

use App\Forum;
use App\Major;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Shuoshuo;

class ShuoshuoController extends Controller
{
    public function index()
    {
        $shuoshuos = Shuoshuo::whereNull('deleted_at')->with('user')->with('forum')->orderBy('updated_at',
            'desc')->paginate();
//        dd($shuoshuos[0]->comment_count);
        return view('/admin/shuoshuo/index', compact('shuoshuos'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $shuoshuo = Shuoshuo::with('user')->with('forum')->find($id);
        } else {
            $shuoshuo = new Shuoshuo();
        }
        $users = User::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();
        $forums = Forum::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();

        return view('admin/shuoshuo/create', compact('shuoshuo', 'users', 'forums'));
    }

    public function store(Request $request)
    {
        $id = request('id');
        $this->validate($request, [
            'content' => 'required|min:4|max:300'
        ]);

        if (empty($id)) {
            Shuoshuo::create(request(['content', 'user_id', 'forum_id']));
        } else {
            Shuoshuo::where('id', $id)->update(request(['content', 'user_id', 'forum_id']));
        }
        return redirect('/admin/shuoshuos');
    }

    public function delete(Request $request)
    {

        $id = $request->input('id', 0);
        if (empty($id)) {
            $returnData = [
                'error' => 1,
                'msg' => '说说 id 不能为空'
            ];
        } else {
            Shuoshuo::destroy($id);
            $returnData = [
                'error' => 0,
                'msg' => ''
            ];
        }

        return response()->json($returnData)->setCallback($request->input('callback'));
    }
}
