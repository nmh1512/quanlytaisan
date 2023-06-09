<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    private $role;
    private $roleRepo;
    public function __construct(RoleRepositoryInterface $roleRepo, Role $role)
    {
        $this->role = $role;
        $this->roleRepo = $roleRepo;
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->role->query();
            $actionsColumn = [];
            if($request->user()->can('roles edit')) {
                $actionsColumn[] = 'edit';
            }
            if($request->user()->can('roles delete')) {
                $actionsColumn[] = 'delete';
            }
            return DataTables::of($data)
                    ->addColumn('actions', $actionsColumn)
                    ->make(true);
        }
        return view('main.roles');
    }

    public function create(Request $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
            ];
            DB::beginTransaction();
            // tao don hang
            $this->roleRepo->create($dataInsert);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }

    public function update(Request $request, Role $role) {
        try {
            DB::beginTransaction();
            $role->name = $request->name;   
            $permissions = $request->permissions;

            if(!empty($permissions)) {
                foreach($permissions as $permission) {
                    Permission::findOrCreate($permission);
                }
                $role->syncPermissions($request->permissions);
            }
            $role->save();

            session()->flash('permissions_role', ['status' => 200, 'message' => 'Phân quyền chức năng thành công']);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ],500);
        }
    }

    public function delete($id) {
        return $this->deleteData($this->role, $id);
       
    }
    public function setRole(Request $request, User $user) {

        try {
            $role = $this->roleRepo->find($request->role_id);
            $user->syncRoles($role);
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            Log::error('Error: '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ],500);
        }
    }
}
