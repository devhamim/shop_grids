<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //
    public function index()
    {
        return view('admin.unit.index');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'unique:units',
            'code' => 'unique:units',
        ]);
        Unit::saveUnit($request);
        return back()->with('message','Unit Added Successfully');
    }
    public function manage()
    {
        return view('admin.unit.manage',[
            'units'=>Unit::get(),
        ]);
    }
    public function edit($id)
    {
        return view('admin.unit.edit',[
            'unit'=>Unit::find($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'unique:units',
            'code' => 'unique:units',
        ]);
        Unit::updateUnit($request,$id);
        return redirect()->route('unit.manage')->with('message','Unit info updated Successfully');
    }

    public function Delete($id)
    {
        Unit::deleteUnit($id);
        return redirect()->route('unit.manage')->with('message','Unit info Deleted Successfully');
    }

}
