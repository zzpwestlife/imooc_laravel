<?php

namespace App\Admin\Controllers;

use App\Forum;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::whereNull('deleted_at')->orderBy('updated_at', 'desc')->paginate();
        return view('/admin/forum/index', compact('forums'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $forum = Forum::find($id);
        } else {
            $forum = new Forum();
        }
        return view('admin/forum/create', compact('forum'));
    }

    public function store(Request $request)
    {
        $id = request('id');

        if (empty($id)) {
            $this->validate($request, [
                'name' => 'required|min:4|max:30|unique:forums,name'
            ]);
            Forum::create(request(['name', 'alias']));
        } else {
            $this->validate($request, [
                'name' => 'required|min:4|max:30'
            ]);
            Forum::where('id', $id)->update(request(['name', 'alias']));
        }
        return redirect('/admin/forums');
    }

    public function delete(Request $request)
    {

        $id = $request->input('id', 0);
        if (empty($id)) {
            $returnData = [
                'error' => 1,
                'msg' => '论坛 id 不能为空'
            ];
        } else {
            Forum::destroy($id);
            $returnData = [
                'error' => 0,
                'msg' => ''
            ];
        }

        return response()->json($returnData)->setCallback($request->input('callback'));
    }
}
