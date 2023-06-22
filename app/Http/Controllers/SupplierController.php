<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Traits\QueryableTrait;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    //
    use QueryableTrait;
    private $supplier;
    private $supplierRepo;
    public function __construct(SupplierRepositoryInterface $supplierRepo , Supplier $supplier)
    {
        $this->supplierRepo = $supplierRepo;
        $this->supplier = $supplier;
    }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->supplier->query();

            $actionsColumn = [];
            if($request->user()->can('suppliers edit')) {
                $actionsColumn[] = 'edit';
            }
            if($request->user()->can('suppliers delete')) {
                $actionsColumn[] = 'delete';
            }

            return DataTables::of($data)
                    ->addColumn('actions', $actionsColumn)
                    ->make(true);
        }

        return view('main.suppliers');
    }
    public function create(SupplierRequest $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'tax_code' => $request->tax_code,
                'representative' => $request->representative,
            ];
            DB::beginTransaction();
            $this->supplierRepo->create($dataInsert);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);

        } catch(Exception $e) {
            Log::error('Error: '. $e->getMessage(). ' at line '. $e->getLine());
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }

    public function update(SupplierRequest $request, $id) {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'tax_code' => $request->tax_code,
                'representative' => $request->representative,
            ];
            DB::beginTransaction();
            $this->supplierRepo->update($id, $dataUpdate);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);

        } catch(Exception $e) {
            Log::error('Error: '. $e->getMessage(). ' at line '. $e->getLine());
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }

    public function delete($id) {
        return $this->deleteData($this->supplier, $id);
    }
}
