<?php

namespace App\Http\Controllers;

use App\View\Components\DeleteModal;
use App\View\Components\FormTypeAssets;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function formData(Request $request) {
        if($request->ajax()) {
            try {
                $id = $request->id;
                $referrer = $request->referrer;
                $action = $request->action;
                // lay title va form
                $config = config('routetitle.config')[$referrer];
    
                // lay data: neu la chinh sua se find id
                $data = null;
                $title = $config['title'];
                if(!empty($id)) {
                    $data = app($config['model'])->find($id);
                }
                // lay form data tu component
                // check neu ko co action: ko phai la action xoa
                if(empty($action)) {
                    $formData = app($config['form_data'], ['title' => $title, 'data' => $data])->render(); // render ra 1 object View
                } else {
                    $formData = new DeleteModal($title, $data->name); // lay ra component delete
                    $formData = $formData->render(); // render ra 1 object View
                }
                
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
}
