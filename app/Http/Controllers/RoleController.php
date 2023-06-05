<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    //
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->role->query();
            return DataTables::of($data)
                    ->addColumn('actions', ['edit', 'delete'])
                    ->make(true);
        }
        return view('main.roles');
    }

    public function create(Role $request) {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
            ];
            // tao don hang
            $this->role->create($dataInsert);
            
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

    public function update(Role $request, $id) {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
            ];

            $this->role->findOrFail($id)->update($dataUpdate);

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
}
