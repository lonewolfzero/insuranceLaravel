<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TypeOfMindep;
use Illuminate\Support\Facades\Auth;

class TypeOfMindepController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Type Of Mindep Master';
        $search = @$request->input('search');

        if (empty($search)) {
            $typeOfMindep = TypeOfMindep::orderby('id')->get();
            $lastid = count($typeOfMindep);
            $typeOfMindep_ids = response()->json($typeOfMindep->modelKeys());

            return view('crm.master.typeofmindep', compact('user', 'typeOfMindep', 'route_active', 'typeOfMindep_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            $typeOfMindep = TypeOfMindep::where('description', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            $typeOfMindep_ids = response()->json($typeOfMindep->modelKeys());
            return view('crm.master.typeofmindep', compact('user', 'typeOfMindep', 'route_active', 'typeOfMindep_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function show(TypeOfMindep $typeOfMindep)
    {
        return $typeOfMindep;
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        if ($validator) {
            TypeOfMindep::create([
                'code' => $request->code,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Type Of Mindep added successfully!',
                'alert-type' => 'success'
            );
            // return $notification
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function update(Request $request, TypeOfMindep $typeOfMindep)
    {
        $validator = $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        if ($validator) {
            $data = $request->all();
            $typeOfMindep->update($data);

            $notification = array(
                'message' => 'Type Of Mindep updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function destroy(TypeOfMindep $typeOfMindep)
    {
        if ($typeOfMindep->delete()) {
            $notification = array(
                'message' => 'Type Of Mindep deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
