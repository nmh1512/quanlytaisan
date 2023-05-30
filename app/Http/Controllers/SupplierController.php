<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
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
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->supplier->query();
            return DataTables::of($data)->make(true);
        }

        return view('main.suppliers');
    }
    public function create(SupplierRequest $request) {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'tax_code' => $request->tax_code,
                'representative' => $request->representative,
            ];
            $this->supplier->create($dataInsert);
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
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'tax_code' => $request->tax_code,
                'representative' => $request->representative,
            ];
            $this->supplier->find($id)->update($dataUpdate);
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
