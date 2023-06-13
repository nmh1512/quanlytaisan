<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryAssetsRequest;
use App\Models\CategoryAssets;
use App\Models\User;
use App\Traits\QueryableTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use DataTables;

class CategoryAssetsController extends Controller
{
    //
    use QueryableTrait;
    protected $categoryAssets;

    public function __construct(CategoryAssets $categoryAssets)
    {
        $this->categoryAssets = $categoryAssets;
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = $this->categoryAssets->with('userCreated');

            $actionsColumn = [];
            if($request->user()->can('category assets edit')) {
                $actionsColumn[] = 'edit';
            }
            if($request->user()->can('category assets delete')) {
                $actionsColumn[] = 'delete';
            }

            return DataTables::of($data)
                    ->addColumn('actions', $actionsColumn)
                    ->make(true);
        }
        // render data vào bảng danh mục
        return view('main.category-assets');
    }

    public function create(CategoryAssetsRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataInsert = [
                'name' => $request->name,
                'user_create' => Auth::user()->id
            ];
            $this->categoryAssets->create($dataInsert);

            DB::commit();

            //render lai table
            // $tableReRender = $this->reRenderData();

            return response()->json([
                'status' => 'success',
                // 'table' => $tableReRender
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: " . $e->getMessage() . " at line: " . $e->getLine());

            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }

    public function update(CategoryAssetsRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $dataUpdate = [
                'name' => $request->name,
            ];
            $this->categoryAssets->find($id)->update($dataUpdate);

            DB::commit();

            //render lai table
            // $tableReRender = $this->reRenderData();

            return response()->json([
                'status' => 'success',
                // 'table' => $tableReRender
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
        return $this->deleteData($this->categoryAssets, $id);
    }
   
}
