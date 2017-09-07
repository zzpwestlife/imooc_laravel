<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::whereNull('deleted_at')->orderBy('updated_at', 'desc')->paginate();
        return view('/admin/school/index', compact('schools'));
    }

    public function create(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $school = School::find($id);
        } else {
            $school = new School();
        }
        return view('admin/school/create', compact('school'));
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
        return redirect('/admin/school');
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
