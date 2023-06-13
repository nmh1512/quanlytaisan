<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeAssetsRequest;
use App\Models\TypeAssets;
use App\Traits\HasUserCreatedTrait;
use App\Traits\QueryableTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TypeAssetsController extends Controller
{
    //
    use UploadFileTrait, QueryableTrait;
    
    protected $typeAssets;
    public function __construct(TypeAssets $typeAssets)
    {
        $this->typeAssets = $typeAssets;
    }
    public function index(Request $request)
    {
        $data = $this->typeAssets;
        if ($request->ajax()) {

            $actionsColumn = [];
            if($request->user()->can('type assets edit')) {
                $actionsColumn[] = 'edit';
            }
            if($request->user()->can('type assets delete')) {
                $actionsColumn[] = 'delete';
            }

            return DataTables::of($data->with(['userCreated', 'categoryAsset']))
            ->addColumn('actions', $actionsColumn)
            ->make(true);
        }
        return view('main.type-assets');
    }
    public function create(TypeAssetsRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'category_asset_id' => $request->category_asset_id,
                'model' => $request->model,
                'brand' => $request->brand,
                'year_create' => $request->year,
                'unit' => $request->unit,
                'user_create' => auth()->id()
            ];
            
            if ($request->hasFile('image')) {
                $file = $this->uploadFile($request->image, 'typeassets', 800, 800);
                $dataInsert['image'] = $file['file_path'];
                $dataInsert['image_origin_name'] = $file['file_name'];
            }
            $this->typeAssets->create($dataInsert);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: " . $e->getMessage() . " at line: " . $e->getLine());

            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
    public function update(TypeAssetsRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'category_asset_id' => $request->category_asset_id,
                'model' => $request->model,
                'brand' => $request->brand,
                'year_create' => $request->year,
                'unit' => $request->unit
            ];
            
            if ($request->hasFile('image')) {
                $file = $this->uploadFile($request->image, 'typeassets', 800, 800);
                $dataUpdate['image'] = $file['file_path'];
                $dataUpdate['image_origin_name'] = $file['file_name'];
            } else {
                if(empty($request->image_old)) {
                    $dataUpdate['image'] = '';
                    $dataUpdate['image_origin_name'] = '';
                }
            }
            $this->typeAssets->find($id)->update($dataUpdate);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: " . $e->getMessage() . " at line: " . $e->getLine());

            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
    public function delete($id) {
       return $this->deleteData($this->typeAssets, $id);
    }
}
