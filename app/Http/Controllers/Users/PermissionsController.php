<?php

namespace App\Http\Controllers\Users;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionsController extends Controller
{
    public function returnView($selected_role_id)
    {
        // NOTE: $roles are the total user roles except admin
        $roles = Role::where('name', '!=', 'admin')->get();

        $modules = Permission::where('group', 'master')->pluck('module_name')->all();
        $modules2 = Permission::where('group', 'facultative')->pluck('module_name')->all();
        $claim = Permission::where('group', 'claim')->pluck('module_name')->all();
        // $treaty = config('constants.Treaty');

        $module_names = [];
        foreach (Permission::all() as $per) {
            ${$per->module_name} =  Module::where(['module_name' => $per->module_name, 'role_id' => $selected_role_id])->first();
            array_push($module_names, (string)$per->module_name);
        }

        $route_active = 'permissions';
        return view(
            'crm.user.role_permissions',
            compact([
                'route_active',
                'roles',
                'selected_role_id',
                'modules',
                'modules2',
                'claim',
                $module_names,
            ])
        );
    }

    public function index()
    {
        // NOTE: selected role is the role, which is currently selected to show the permissions on the page. 
        $selected_role = Role::where('default_role', 'yes')->first();
        $selected_role_id = $selected_role->id;

        return $this->returnView($selected_role_id);
    }

    /**
     *  POST
     *  redirect to the permissions index page with the selected role ID,which is coming as POST
     */
    public function permissionsByUser(Role $role, Request $request)
    {
        // NOTE: selected role is the role, which is currently selected to show the permissions on the page. 
        $selected_role_id = $request->role_id;

        return $this->returnView($selected_role_id);
    }

    /**
     *  GET
     *  redirect to the permissions index page with the selected role ID
     */
    public function getPermissionsByUser(Role $role = NULL)
    {
        // NOTE: selected role is the role, which is currently selected to show the permissions on the page. 
        $selected_role_id = $role->id;

        return $this->returnView($selected_role_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Module::create([
            'module_name' => $request->module_name,
            'role_id' => $request->role_id,
            'create' => ($request->create == 'on') ? $request->create : 'off',
            'read' => ($request->read == 'on') ? $request->read : 'off',
            'update' => ($request->update == 'on') ? $request->update : 'off',
            'delete' => ($request->delete == 'on') ? $request->delete : 'off',
        ]);
        $notification = array(
            'message' => 'Role permissions added successfully!',
            'alert-type' => 'success'
        );
        // dd('Role permissions added successfully ');
        return redirect(route('permissions_role_id', $request->role_id))->with($notification);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Module $module, Request $request)
    {
        if ($request->create != null) {
            $module->create = (count($request->create) == 2) ? 'on' : 'off';
        }
        if ($request->read != null) {
            $module->read = (count($request->read) == 2) ? 'on' : 'off';
        }
        if ($request->update != null) {
            $module->update = (count($request->update) == 2) ? 'on' : 'off';
        }
        if ($request->delete != null) {
            $module->delete = (count($request->delete) == 2) ? 'on' : 'off';
        }
        if ($module->save()) {
            $notification = array(
                'message' => 'Role permissions updated successfully!',
                'alert-type' => 'success'
            );
            return redirect(route('permissions_role_id', $request->role_id))->with($notification);
        } else {
            $notification = array(
                'message' => 'Please refresh the page and try again!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
