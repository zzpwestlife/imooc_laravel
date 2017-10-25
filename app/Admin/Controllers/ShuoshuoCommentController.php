<?php

namespace App\Admin\Controllers;

use App\Shuoshuo;
use App\ShuoshuoComment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShuoshuoCommentController extends Controller
{
    public function index(Request $request)
    {
        $shuoshuoId = $request->input('shuoshuo_id', 0);
        if (empty($shuoshuoId)) {
            $shuoshuo = new \stdClass();
            $shuoshuoComments = new \stdClass();
        } else {
            $shuoshuo = Shuoshuo::find($shuoshuoId);
            $shuoshuoComments = ShuoshuoComment::where('shuoshuo_id',
                $shuoshuoId)->whereNull('deleted_at')->with('user')->with('shuoshuo')->orderBy('updated_at',
                'desc')->paginate();
        }
        return view('/admin/shuoshuo_comment/index', compact('shuoshuo', 'shuoshuoComments'));
    }

    public function create(Request $request, $id = 0)
    {
        if (empty($id)) {
            $shuoshuoComment = new ShuoshuoComment();
        } else {
            $shuoshuoComment = ShuoshuoComment::with('user')->with('shuoshuo')->find($id);
        }
        $users = User::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();
        $shuoshuos = Shuoshuo::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();

        return view('admin/shuoshuo_comment/create', compact('shuoshuoComment', 'users', 'shuoshuos'));
    }

    public function store(Request $request)
    {
        $id = request('id');

        $this->validate($request, [
            'content' => 'required|min:4|max:300'
        ]);
        if (empty($id)) {
            $new = ShuoshuoComment::create(request(['content', 'user_id', 'shuoshuo_id']));
        } else {
            $new = ShuoshuoComment::where('id', $id)->update(request(['content', 'user_id', 'shuoshuo_id']));
        }
        return redirect('/admin/shuoshuo_comments?shuoshuo_id=' . request('shuoshuo_id'));
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
            ShuoshuoComment::destroy($id);
            $returnData = [
                'error' => 0,
                'msg' => ''
            ];
        }

        return response()->json($returnData)->setCallback($request->input('callback'));
    }
}
