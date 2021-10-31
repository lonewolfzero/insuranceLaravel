<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TypeOfCoverage;
use Illuminate\Support\Facades\Auth;

class TypeOfCoverageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Type Of Coverage Master';
        $search = @$request->input('search');

        if (empty($search)) {
            $typeOfCoverage = TypeOfCoverage::orderby('id')->get();
            $lastid = count($typeOfCoverage);
            $typeOfCoverage_ids = response()->json($typeOfCoverage->modelKeys());

            return view('crm.master.typeofcoverage', compact('user', 'typeOfCoverage', 'route_active', 'typeOfCoverage_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            $typeOfCoverage = TypeOfCoverage::where('description', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            $typeOfCoverage_ids = response()->json($typeOfCoverage->modelKeys());
            return view('crm.master.typeofcoverage', compact('user', 'typeOfCoverage', 'route_active', 'typeOfCoverage_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function show(TypeOfCoverage $typeOfCoverage)
    {
        return $typeOfCoverage;
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        if ($validator) {
            TypeOfCoverage::create([
                'code' => $request->code,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Type Of Coverage added successfully!',
                'alert-type' => 'success'
            );
            // return $notification
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function update(Request $request, TypeOfCoverage $typeOfCoverage)
    {
        $validator = $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        if ($validator) {
            $data = $request->all();
            $typeOfCoverage->update($data);

            $notification = array(
                'message' => 'Type Of Coverage updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function destroy(TypeOfCoverage $typeOfCoverage)
    {
        if ($typeOfCoverage->delete()) {
            $notification = array(
                'message' => 'Type Of Coverage deleted successfully!',
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
