<?php

namespace App\Admin\Controllers;

use App\Major;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\School;
use JavaScript;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::whereNull('deleted_at')->with('school')->orderBy('updated_at', 'desc')->paginate();
        return view('/admin/major/index', compact('majors'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $major = Major::with('school')->find($id);
        } else {
            $major = new Major();
        }

        $schools = School::whereNull('deleted_at')->orderBy('updated_at', 'desc')->get();

        return view('admin/major/create', compact('major', 'schools'));
    }

    public function store(Request $request)
    {
        $id = request('id');
        $this->validate($request, [
            'name' => 'required|min:4|max:30|unique:schools,name'
        ]);

        if (empty($id)) {
            School::create(request(['name']));
        } else {
            School::where('id', $id)->update(request(['name']));
        }
        return redirect('/admin/major');
    }

    public function delete(School $school)
    {
        $school->deleted_at = Carbon::now()->toDateTimeString();
        $school->save();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
