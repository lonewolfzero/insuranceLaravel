<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeOfCoveragePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $module = Module::select(['read', 'create', 'update', 'delete'])->where(['module_name' => 'type_of_coverage_module', 'role_id' => $user->role->id])->first();
        if ($module->create == 'on' || $module->read == 'on' || $module->update == 'on' || $module->delete == 'on') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SlipTable  $slipTable
     * @return mixed
     */
    public function view(User $user)
    {
        $module = Module::select(['read'])->where(['module_name' => 'type_of_coverage_module', 'role_id' => $user->role->id])->first();
        return $module->read == 'on';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $module = Module::select(['create'])->where(['module_name' => 'type_of_coverage_module', 'role_id' => $user->role->id])->first();
        return $module->create == 'on';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SlipTable  $slipTable
     * @return mixed
     */
    public function update(User $user)
    {
        $module = Module::select(['update'])->where(['module_name' => 'type_of_coverage_module', 'role_id' => $user->role->id])->first();
        return $module->update == 'on';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SlipTable  $slipTable
     * @return mixed
     */
    public function delete(User $user)
    {
        $module = Module::select(['delete'])->where(['module_name' => 'type_of_coverage_module', 'role_id' => $user->role->id])->first();
        return $module->delete == 'on';
    }
}
