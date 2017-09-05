<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use \App\School;

class SchoolController extends Controller
{
    public function index()
    {
        \DB::enableQueryLog();
        $schools = School::whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate();

//        dd(\DB::getQueryLog());
        return view('/admin/school/index', compact('schools'));
    }

    public function create()
    {
        return view('admin/school/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3'
        ]);

        School::create(request(['name']));
        return redirect('/admin/school/index');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return [
            'error' => 0,
            'msg' => '',
        ];
    }
}
