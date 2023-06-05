<?php

namespace App\Http\Controllers;

use App\Models\TypeAssets;
use App\View\Components\DeleteModal;
use App\View\Components\Form;
use App\View\Components\FormTypeAssets;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    //
    public function __construct()
    {
    }
    public function formData(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $referrer = $request->referrer;
                $action = $request->action;
                // lay title va form
                $config = config('routetitle.config')[$referrer];

                // lay data: neu la chinh sua se find id
                $data = null;
                if (!empty($id)) {
                    $data = app($config['model'])->find($id);
                }
                $dataConfig = [
                    ...$config,
                    'model' => $data
                ];
                // check neu ko co action xoa thi noi dung cua modal se la xoa
                if (!empty($action) && ($action == 'delete' || $action == 'disable' || $action == 'enable')) {
                    $dataConfig['form_data'] = $action;
                }
                // lay form data tu component
                $formData = new Form(...$dataConfig);
                $formData = $formData->render(); // render ra 1 object View
                return response()->json([
                    'status' => 'success',
                    'data' => $formData->render() // render html tu object View
                ]);
            } catch (Exception $e) {
                Log::error("Error: " . $e->getMessage() . " at line: " . $e->getLine());

                return response()->json([
                    'status' => 'error'
                ], 500);
            }
        }
    }
    public function getTypeAssets($categoryAssetId)
    {
        $data = TypeAssets::where('category_asset_id', $categoryAssetId)->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
