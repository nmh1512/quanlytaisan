<?php
namespace App\Repositories\Supplier;
    
use App\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{   
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Supplier::class;
    }
}
