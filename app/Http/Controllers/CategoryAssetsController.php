<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryAssetsRequest;
use App\Models\CategoryAssets;
use App\Traits\QueryableTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoryAssetsController extends Controller
{
    //
    use QueryableTrait;
    protected $categoryAssets;

    public function __construct(CategoryAssets $categoryAssets)
    {
        $this->categoryAssets = $categoryAssets;
    }
    public function index(): View
    {

        $itemPerPage = 20;
        $categoryAssetsList = $this->getDataAccess($this->categoryAssets, 'userCreated', $itemPerPage);

        // render data vào bảng danh mục
        $table = view('render.table-category-assets', compact('categoryAssetsList'))->render();

        return view('category_assets.index', compact('table'));
    }

    public function create(CategoryAssetsRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataInsert = [
                'name' => $request->category_asset_name,
                'user_create' => Auth::user()->id
            ];
            $this->categoryAssets->create($dataInsert);

            DB::commit();

            $itemPerPage = 20;
            $categoryAssetsList = $this->getDataAccess($this->categoryAssets, 'userCreated', $itemPerPage);
            //render lai table
            $tableReRender = view('render.table-category-assets', compact('categoryAssetsList'))->render();

            return response()->json([
                'status' => 'success',
                'table' => $tableReRender
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
                'name' => $request->category_asset_name,
            ];
            $this->categoryAssets->find($id)->update($dataUpdate);

            DB::commit();

            $itemPerPage = 20;
            $categoryAssetsList = $this->getDataAccess($this->categoryAssets, 'userCreated', $itemPerPage);
            //render lai table
            $tableReRender = view('render.table-category-assets', compact('categoryAssetsList'))->render();

            return response()->json([
                'status' => 'success',
                'table' => $tableReRender
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
