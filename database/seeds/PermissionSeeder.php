<?php

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{

    public function createModule($role, $module, $toggle)
    {
        Module::create([
            'role_id' => $role,
            'module_name' => $module,
            'create' => $toggle,
            'read' => $toggle,
            'update' => $toggle,
            'delete' => $toggle,
        ]);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master = config('constants.MODULES');
        $facultative = config('constants.MODULES2');
        $claim = config('constants.Claim');
        // $treaty = config('constants.Treaty');
        // $retro = config('constants.Retro');
        $modules = array_merge($master, $facultative, $claim);
        Module::truncate();
        Permission::truncate();
        $roles = Role::all();

        foreach ($master as $module) {
            Permission::create([
                'module_name' => $module,
                'group' => 'master',
            ]);
        }

        foreach ($facultative as $module) {
            Permission::create([
                'module_name' => $module,
                'group' => 'facultative',
            ]);
        }

        foreach ($claim as $module) {
            Permission::create([
                'module_name' => $module,
                'group' => 'claim',
            ]);
        }

        foreach ($roles as $role) {
            if (in_array($role->name, ['admin', 'nasre'])) {
                foreach ($modules as $module) {
                    if ($role->name == 'nasre' && in_array($module, ['user_module', 'role_module', 'permission_module'])) {
                        $this->createModule($role->id, $module, 'off');
                    } else {
                        $this->createModule($role->id, $module, 'on');
                    }
                }
            } elseif ($role->name == 'claim') {
                foreach ($modules as $module) {
                    if (str_contains($module, 'claim')) {
                        $this->createModule($role->id, $module, 'on');
                    } else {
                        $this->createModule($role->id, $module, 'off');
                    }
                }
            } elseif ($role->name == 'Facultative') {
                foreach ($modules as $module) {
                    if (str_contains($module, 'slip')) {
                        $this->createModule($role->id, $module, 'on');
                    } else {
                        $this->createModule($role->id, $module, 'off');
                    }
                }
            } else {
                foreach ($modules as $module) {
                    $this->createModule($role->id, $module, 'off');
                }
            }
        }
    }
}
