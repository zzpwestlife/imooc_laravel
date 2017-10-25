<?php

namespace App\Admin\Controllers;

use App\File;
use App\Major;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\School;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use JavaScript;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $files = File::whereNull('deleted_at')->with('major')->with('user')->orderBy('updated_at', 'desc')->paginate();
        return view('/admin/file/index', compact('files'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $file = File::with('major')->with('user')->find($id);
        } else {
            $file = new File();
        }

        $majors = Major::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();
        $users = User::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();

        $courseTypes = File::$courseTypes;
        $fileTypes = File::$fileTypes;
//        dd($fileTypes);
        return view('admin/file/create', compact('file', 'majors', 'users', 'courseTypes', 'fileTypes'));
    }

    public function store(Request $request)
    {
        $id = request('id');
        $this->validate($request, [
            'name' => 'required|min:4|max:30|unique:schools,name',
            'school_id' => 'required|min:1'
        ]);


        $data = request(['school_id', 'department', 'name']);
        if (empty($id)) {
            File::create($data);
        } else {
            File::where('id', $id)->update($data);
        }
        return redirect('/admin/files');
    }

    public function delete(Request $request)
    {

        $id = $request->input('id', 0);
        if (empty($id)) {
            $returnData = [
                'error' => 1,
                'msg' => '文件 id 不能为空'
            ];
        } else {
            File::destroy($id);
            $returnData = [
                'error' => 0,
                'msg' => ''
            ];
        }

        return response()->json($returnData)->setCallback($request->input('callback'));
    }
}
