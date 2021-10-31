<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Bank Master';
        $search = @$request->input('search');

        if (empty($search)) {
            $bank = Bank::orderby('id')->get();
            $lastid = count($bank);
            $bank_ids = response()->json($bank->modelKeys());

            return view('crm.master.bank', compact('user', 'bank', 'route_active', 'bank_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            $bank = Bank::where('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            $bank_ids = response()->json($bank->modelKeys());
            return view('crm.master.bank', compact('user', 'bank', 'route_active', 'bank_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function show(Bank $bank)
    {
        return $bank;
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'id_lnkb' => 'required',
            'name' => 'required',
            'group' => 'required',
        ]);

        if ($validator) {
            Bank::create([
                'id_lnkb' => $request->id_lnkb,
                'name' => $request->name,
                'group' => $request->group
            ]);

            $notification = array(
                'message' => 'Bank added successfully!',
                'alert-type' => 'success'
            );
            // return $notification
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function update(Request $request, Bank $bank)
    {
        $validator = $request->validate([
            'id_lnkb' => 'required',
            'name' => 'required',
            'group' => 'required',
        ]);

        if ($validator) {
            $data = $request->all();
            $bank->update($data);

            $notification = array(
                'message' => 'Bank updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function destroy(Bank $bank)
    {
        if ($bank->delete()) {
            $notification = array(
                'message' => 'Bank deleted successfully!',
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
