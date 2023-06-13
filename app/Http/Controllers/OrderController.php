<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreated;
use App\Traits\QueryableTrait;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    //
    use QueryableTrait;
    private $order;
    private $user;
    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->order->with(['supplier', 'userCreated']);
            
            return DataTables::of($data)
                    ->addColumn('actions', function($order) use ($request) {
                        $actionsColumn = [];
                        if($request->user()->can('update', $order)) {
                            $actionsColumn[] = 'edit';
                        }
                        if($request->user()->can('delete', $order)) {
                            $actionsColumn[] = 'delete';
                        }
                        return $actionsColumn;
                    })
                    ->make(true);
        }
        return view('main.orders');
    }
    public function create(OrderRequest $request) {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'code' => $request->code,
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'payment_methods' => $request->payment_methods,
                'user_create' => auth()->id()
            ];
            // tao don hang
            $order = $this->order->create($dataInsert);
            
            $typeAssetsId = $request->type_asset_id;
            $prices = $request->price;
            $quantities = $request->quantity;
            
            //tao 1 mang chua thong tin cua chung loai tai san
            $typeAssets = [];
            foreach($typeAssetsId as $id => $item) {
                $typeAssets[$item] = [
                    'price' => $prices[$id],
                    'quantity' => $quantities[$id],
                ];
            }
            // tao chi tiet don hang gom cac chung loai tai san
            $order->typeAssetsInOrder()->attach($typeAssets);

            //gui thong bao cho tong giam doc
            $superAdmins = $this->user->role('Tổng giám đốc')->get();
            $notification = new OrderCreated(Auth::user(), $order);
            Notification::send($superAdmins, $notification);

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

    public function update(OrderRequest $request, $id) {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'code' => $request->code,
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'payment_methods' => $request->payment_methods,
                'user_create' => auth()->id()
            ];
            // tao don hang
            $order = $this->order->find($id);
            $order->update($dataUpdate);

            $typeAssetsId = $request->type_asset_id;
            $prices = $request->price;
            $quantities = $request->quantity;
            
            //tao 1 mang chua thong tin cua chung loai tai san
            $typeAssets = [];
            foreach($typeAssetsId as $id => $item) {
                $typeAssets[$item] = [
                    'price' => $prices[$id],
                    'quantity' => $quantities[$id],
                ];
            }
            // tao chi tiet don hang gom cac chung loai tai san
            $order->typeAssetsInOrder()->sync($typeAssets);

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

    public function destroy($id) {
        return $this->deleteData($this->order, $id);
       
    }
}
