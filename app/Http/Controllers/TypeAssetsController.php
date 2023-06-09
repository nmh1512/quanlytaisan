<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeAssetsRequest;
use App\Models\TypeAssets;
use App\Repositories\TypeAssets\TypeAssetsRepositoryInterface;
use App\Traits\QueryableTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TypeAssetsController extends Controller
{
    //
    use UploadFileTrait, QueryableTrait;
    
    protected $typeAssets;
    private $typeAssetsRepo;
    public function __construct(TypeAssetsRepositoryInterface $typeAssetsRepo, TypeAssets $typeAssets)
    {
        $this->typeAssets = $typeAssets;
        $this->typeAssetsRepo = $typeAssetsRepo;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->typeAssets;
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
            DB::beginTransaction();
            $this->typeAssetsRepo->create($dataInsert);
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
            DB::beginTransaction();
            $this->typeAssetsRepo->update($dataUpdate);
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
