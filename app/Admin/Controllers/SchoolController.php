<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use \App\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::where('status', 0)->orderBy('updated_at', 'desc')->paginate();
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
        $school->status = -1;
        $school->save();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
