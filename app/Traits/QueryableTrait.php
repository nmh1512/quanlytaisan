<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait QueryableTrait
{
    public function getDataAccess($model, $eagerName, $itemPerPage) {
        return $model->with($eagerName)->latest()->paginate($itemPerPage);
    }
    public function deleteData($model, $id) {
        try {
            DB::beginTransaction();
            $model->find($id)->delete();
            DB::commit();

            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: " . $e->getMessage() . " at line: " . $e->getLine());

            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
}


?>