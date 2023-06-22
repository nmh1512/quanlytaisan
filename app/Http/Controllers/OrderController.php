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
use App\Repositories\Order\OrderRepositoryInterface;
class OrderController extends Controller
{
    //
    use QueryableTrait;
    private $order;
    private $user;
    private $orderRepo;
    public function __construct(OrderRepositoryInterface $orderRepo, Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
        $this->orderRepo = $orderRepo;
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
    public function show($id) {
        $order = $this->orderRepo->orderDetail($id);
        return view('main.order-detail', compact('order'));
    }
    public function create(OrderRequest $request) {
        try {
            $dataInsert = [
                'code' => $request->code,
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'payment_methods' => $request->payment_methods,
                'user_create' => auth()->id()
            ];

            $typeAssetsId = $request->type_asset_id;
            $prices = $request->price;
            $quantities = $request->quantity;
            
            //tao 1 mang chua thong tin cua chung loai tai san
            $typeAssets = [];
            foreach($typeAssetsId as $index => $item) {
                $typeAssets[$item] = [
                    'price' => $prices[$index],
                    'quantity' => $quantities[$index],
                ];
            }
            DB::beginTransaction();
            // tao don hang
            $order = $this->orderRepo->create($dataInsert);
            // tao chi tiet don hang gom cac chung loai tai san
            $order->typeAssetsInOrder()->attach($typeAssets);
            //gui thong bao cho nguoi co quyen duyet
            $userReview = $this->user->permission('orders review')->get();

            if(!empty($userReview)) {
                $notification = new OrderCreated(Auth::user(), $order);
                Notification::send($userReview, $notification);
            }

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
            $dataUpdate = [
                'code' => $request->code,
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'payment_methods' => $request->payment_methods,
                'user_create' => auth()->id()
            ];
            $typeAssetsId = $request->type_asset_id;
            $prices = $request->price;
            $quantities = $request->quantity;
            
            //tao 1 mang chua thong tin cua chung loai tai san
            $typeAssets = [];
            foreach($typeAssetsId as $index => $item) {
                $typeAssets[$item] = [
                    'price' => $prices[$index],
                    'quantity' => $quantities[$index],
                ];
            }
            // tao don hang
            DB::beginTransaction();
            $order = $this->orderRepo->update($id, $dataUpdate);
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

    public function review(Request $request, $id) {
        try {
            $status = $request->order_review;
            $order = $this->orderRepo->find($id);
            if(!empty($status)) {
                if($status == 'reject') {
                    $order->status = 'CREATED';
                } else {
                    $order->status = strtoupper($status);
                }
                $order->save();
                return response()->json([
                    'status' => 'success'
                ]);
            } 
            return response()->json([
                'status' => 'error'
            ], 500);
        } catch (Exception $e) {
            Log::error('Error: '.$e->getMessage().' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ],500);
        }
    }
}
