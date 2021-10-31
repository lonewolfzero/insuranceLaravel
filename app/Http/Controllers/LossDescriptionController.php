<?php

namespace App\Http\Controllers;

use App\Models\LossDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LossDescriptionController extends Controller
{
    public function index(Request $request)
    {
        // return LossDescription::all();

        $user = Auth::user();
        $route_active = 'Claim Description Fee Master';
        $mydate = date("Y") . date("m") . date("d");
        $search = @$request->input('search');

        if (empty($search)) {
            //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            $lossdesc = LossDescription::orderby('id')->get();
            $lastid = count($lossdesc);
            $lossdesc_ids = response()->json($lossdesc->modelKeys());

            if ($lastid != null) {

                if ($lastid < 9) {
                    $number_lossdesc = '0' . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $number_lossdesc = strval($lastid + 1);
                }
            } else {
                $number_lossdesc = '0' . strval(1);
            }

            return view('crm.master.lossdesc', compact('user', 'lossdesc', 'route_active', 'number_lossdesc', 'lossdesc_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            $lossdesc = LossDescription::where('number', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            $lossdescparent = LossDescription::where('id', '')->orderby('number', 'desc')->get();
            $lossdesc_ids = response()->json($lossdesc->modelKeys());
            return view('crm.master.lossdesc', compact('user', 'lossdesc', 'route_active', 'number_lossdesc', 'lossdesc_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function show(LossDescription $masterClaimDesc)
    {
        return $masterClaimDesc;
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'desc_name' => 'required',
            'factor' => 'required',
        ]);

        if ($validator) {
            LossDescription::create([
                'desc_name' => $request->desc_name,
                'factor' => $request->factor
            ]);

            $notification = array(
                'message' => 'Loss description added successfully!',
                'alert-type' => 'success'
            );
            // return $notification
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function update(Request $request, LossDescription $masterClaimDesc)
    {
        $validator = $request->validate([
            'desc_name' => 'required'
        ]);

        if ($validator) {
            $data = $request->all();
            $masterClaimDesc->update($data);

            $notification = array(
                'message' => 'Loss description updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function destroy(LossDescription $masterClaimDesc)
    {
        if ($masterClaimDesc->delete()) {
            $notification = array(
                'message' => 'Loss description deleted successfully!',
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
