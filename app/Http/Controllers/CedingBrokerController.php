<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\CedingBroker;
use App\Models\CompanyType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\Datatables\Datatables;

class CedingBrokerController extends Controller
{   

    public function index(Request $request)
    {
         $user = Auth::user();
         $route_active = 'Ceding / Broker';   
         $mydate = date("Y").date("m").date("d");
         $search = @$request->input('search');

         //$cedingbroker = CedingBroker::orderby('code')->paginate(10);
         //$cedingbroker_ids = response()->json($cedingbroker->modelKeys());
         $country = Country::orderby('id','asc')->get();
         $companytype = CompanyType::orderby('id','asc')->get();

         if(request()->ajax())
         {
            
            $data = CedingBroker::with(['countryside', 'companytype'])->get();
            $cedingbroker_ids = response()->json($data->modelKeys());
            return datatables()->of($data)
                ->addColumn('actions', function($data)
                {
                    //if ( (Gate::allows('roles.update') || Gate::allows('roles.delete')) || Gate::allows('roles.give_permission') ){
                    if (true)
                    {
                        if ( $data->id <= auth()->user()->role_id ) 
                        {
                            return "";
                        }

                           $companytypelist='';
                           $companytype = CompanyType::orderby('id','asc')->get();
                           foreach($companytype as $ct)
                           {
                                if($data->type  == $ct->id)
                                {
                                 $companytypelist.='<option value="'.$ct->id.'" selected>'.$ct->name.'</option>';
                                }
                                else
                                {
                               
                                 $companytypelist.='<option value="'.$ct->id.'">'.$ct->name.'</option>';
                                }                           
                           }

                           $countrylist='';
                           $country = Country::orderby('id','asc')->get();
                           foreach($country as $cty)
                           {
                                if($data->country  == $cty->id)
                                {
                                 $countrylist.='<option value="'.$cty->id.'" selected>'.$cty->id.' - '.$ct->name.'</option>';
                                }
                                else
                                {
                               
                                 $countrylist.='<option value="'.$cty->id.'">'.$cty->id.' - '.$cty->name.'</option>';
                                }                           
                           }

                            $html = '                      
                                    <button class="btn btn-info btn-round btn-sm mb-1" data-toggle="modal" data-target="#updatecedingbroker'.$data->id.'">
                                      <i class="fas fa-edit"> Update </i>
                                    </button>
                                   
                                    <div class="modal fade" id="updatecedingbroker'.$data->id.'" tabindex="-1" user="dialog" aria-labelledby="updatecedingbroker{{$ceding->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog" user="document">
                                    <div class="modal-content bg-light-gray">
                                        <div class="modal-header bg-gray">
                                        <h5 class="modal-title" id="updatecedingbroker'.$data->id.'Label">Update Ceding Broker</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form action="'.url('master-data/cedingbroker/update',$data->id).'" method="POST">
                                            <div class="modal-body">
                                                ' . csrf_field() . '
                                               
                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">Code</label>
                                                    <input type="text" name="code" class="form-control" value="'.$data->code.'" required readonly/>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">Type</label><br>
                                                        <select name="type" class="e1 form-control form-control-sm ">
                                                        '.$companytypelist.'
                                                        </select> 
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">name</label>
                                                    <input type="text" name="name" class="form-control" value="'.$data->name.'" required/>
                                                    </div>
                                                </div>
                                                </div>

                                                
                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control" value="'.$data->company_name.'" required/>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="address" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" required/>'.$data->address.'</textarea>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                    <div class="form-group">
                                                    <label for="">Country</label><br>
                                                        <select name="country"  class="e1 form-control form-control-sm ">
                                                        '.$countrylist.'
                                                        </select>
                                                    </div>
                                                </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-info" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>';

                        $html .= '
                                 <br>
                                 <a href="#" data-toggle="tooltip" data-title="'.$data->created_at->toDayDateTimeString().'" class="mr-3">
                                    <i class="fas fa-clock text-info">'.$data->created_at->toDayDateTimeString().'</i>
                                 </a>

                                <a href="#" data-toggle="tooltip" data-title="'.$data->updated_at->toDayDateTimeString().'" class="mr-3">
                                    <i class="fas fa-history text-primary">'.$data->updated_at->toDayDateTimeString().'</i>
                                </a>
                                <br>
                                
                                <form action="' . url('master-data/cedingbroker/destroy', ['id' => $data->id]). '" method="POST">' . csrf_field() . '
                                    <button class="btn btn-danger btn-round btn-sm mb-1 destroy" data-ceding="' . $data->id . '" type="submit" ><i class="ti-trash"></i>' . __('Delete') . '</button>
                                 </form>';
                        
                    }
                    else {
                       

                        

                        $html .= '
                                <a href="#" data-toggle="tooltip" data-title="'.$data->created_at->toDayDateTimeString().'" class="mr-3">
                                    <i class="fas fa-clock text-info">'.$data->created_at->toDayDateTimeString().'</i>
                                </a>

                                <a href="#" data-toggle="tooltip" data-title="'.$data->updated_at->toDayDateTimeString().'" class="mr-3">
                                    <i class="fas fa-history text-primary">'.$data->updated_at->toDayDateTimeString().'</i>
                                </a>
                        
                                <form action="' . url('master-data/cedingbroker/destroy', ['id' => $data->id]). '" method="POST">' . csrf_field() . '
                                    <button class="btn btn-danger btn-round btn-sm mb-1 destroy" data-ceding="' . $data->id . '" type="submit" ><i class="ti-trash"></i>' . __('Delete') . '</button>
                                 </form>';
                        
                    }
                        
                    return $html;

                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }

        $title = "Ceding / Broker";
        return view('crm.master.cedingbroker', compact('title','user','companytype','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);

        /*
         if(empty($search))
         {
          //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
          $cedingbroker = CedingBroker::orderby('code')->paginate(10);
          $cedingbroker_ids = response()->json($cedingbroker->modelKeys());
          $country = Country::orderby('id','asc')->get();
          $companytype = CompanyType::orderby('id','asc')->get();
         

          return view('crm.master.cedingbroker', compact('user','companytype','cedingbroker','route_active','cedingbroker_ids','country'))->with('i', ($request->input('page', 1) - 1) * 10);
         }
         else
         {
          //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);
          $cedingbroker=CedingBroker::where('code', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->paginate(10);
          $cedingbroker_ids = response()->json($cedingbroker->modelKeys());
          $country = Country::orderby('id','asc')->get();
          $companytype = CompanyType::orderby('id','asc')->get();
         

          return view('crm.master.cedingbroker', compact('user','companytype','cedingbroker','route_active','cedingbroker_ids','country'))->with('i', ($request->input('page', 1) - 1) * 10);
         }
         */
    }

    public function generatecode()
    {
        $cedingbroker = CedingBroker::orderby('id','desc')->get();

        $lastid = count($cedingbroker);

        if($lastid != null){
              if($lastid < 10){
                  $code_ceding = '00000' . strval($lastid + 1);
              }elseif($lastid > 9 && $lastid < 100){
                  $code_ceding = '0000' . strval($lastid + 1);
              }elseif($lastid > 99 && $lastid < 1000){
                  $code_ceding = '000' . strval($lastid + 1);
              }elseif($lastid > 999 && $lastid < 10000){
                  $code_ceding = '00' . strval($lastid + 1);
              }elseif($lastid > 9999 && $lastid < 100000){
                  $code_ceding = '0' . strval($lastid + 1);
              }elseif($lastid > 99999){
                $code_ceding =  strval($lastid + 1);
            }
              
          }
          else{
              $code_ceding = '00000' . strval(1);
          }

          

          return response()->json(
            [
                'autocode' => $code_ceding
            ]
        );

    }


    public function store(Request $request)
    {
        $validator = $request->validate([
            'codebroker'=>'required|max:12',
            'name'=>'required',
            'companyname'=>'required',
            'address'=>'required',
            'crccountry'=>'required',
            'type'=>'required'
        ]);
        
        if($validator)
        {
            $user = Auth::user();
            CedingBroker::create([
                'code'=>$request->codebroker,
                'name' => $request->name,
                'company_name'=>$request->companyname,
                'address'=>$request->address,
                'country'=>$request->crccountry,
                'type'=>$request->type
            ]);
            $notification = array(
                'message' => 'Ceding broker added successfully!',
                'alert-type' => 'success'
            );
            //return back()->with($notification);
           
            return redirect('/master-data/cedingbroker')->with($notification);
        }
        else
        {
           
            //return back()->with($validator)->withInput();
            return redirect('/master-data/cedingbroker')->with($validator)->withInput();
        }
    }


    public function update(Request $request, $broker)
    {
        $validator = $request->validate([
            'code'=>'required|max:12|unique:currencies,code',
            'name'=>'required',
            'company_name'=>'required',
            'address'=>'required',
            'country'=>'required',
            'type'=>'required'
        ]);
        if($validator){

            /*
            $broker->code = $request->codebroker;
            $broker->name = $request->namebroker;
            $broker->company_name = $request->companynamebroker;
            $broker->address = $request->addressbroker;
            $broker->country = $request->crccountrybroker;
            $broker->type = $request->typebroker;
            $broker->save();
            */

            $data=$request->all();
            $brokers = CedingBroker::find($broker);
            $brokers->update($data);


            $notification = array(
                'message' => 'Ceding Broker updated successfully!',
                'alert-type' => 'success'
            );
            
            //return back()->with($notification);
            
            return redirect('/master-data/cedingbroker')->with($notification);
        
        }else{
            //return back()->with($validator)->withInput();
            return redirect('/master-data/cedingbroker')->with($validator)->withInput();
        }
    }


    public function destroy($id)
    {
      $cedingbrokers = CedingBroker::find($id);
      
      if($cedingbrokers->delete())
      {
          $notification = array(
              'message' => 'Ceding Broker deleted successfully!',
              'alert-type' => 'success'
          );
          //return back()->with($notification);
          return redirect('/master-data/cedingbroker')->with($notification);
      }
      else
      {
          $notification = array(
              'message' => 'Contact admin!',
              'alert-type' => 'error'
          );
          //return back()->with($notification);
          return redirect('/master-data/cedingbroker')->with($notification);
      }
      
    }

    public function destroy2(CedingBroker $cedingbroker)
    {
        if($cedingbroker->delete())
        {
            $notification = array(
                'message' => 'Ceding Broker deleted successfully!',
                'alert-type' => 'success'
            );
            //return back()->with($notification);
            return redirect('/master-data/cedingbroker')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            //return back()->with($notification);
            return redirect('/master-data/cedingbroker')->with($notification);
        }
    }

    
}