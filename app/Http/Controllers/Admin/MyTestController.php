<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MyTest;
use Illuminate\Http\Request;

class MyTestController extends Controller
{
    public function index()
    {
        $tests = MyTest::all();
        return view('admin.tests.index', compact('tests'));
    }

    public function store(Request $request)
    {
        $test = MyTest::create($request->all());
        return response()->json($test);
    }

    public function update(Request $request, $id)
    {
        $test = MyTest::findOrFail($id);
        $test->update($request->all());
        return response()->json($test);
    }

    public function destroy($id)
    {
        MyTest::destroy($id);
        return response()->json(['success' => true]);
    }
}