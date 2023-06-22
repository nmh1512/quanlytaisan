<?php
namespace App\Repositories\Order;
    
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{   
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Order::class;
    }
    public function orderDetail($id) {
        try {
            return $this->model->with(['supplier', 'typeAssetsInOrder', 'userCreated'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Không tồn tại đơn hàng '. $id);
        }
    }
}
