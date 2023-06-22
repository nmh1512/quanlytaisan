<?php
namespace App\Repositories\TypeAssets;
    
use App\Repositories\BaseRepository;

class TypeAssetsRepository extends BaseRepository implements TypeAssetsRepositoryInterface
{   
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\TypeAssets::class;
    }
}
