<?php
namespace App\Repositories\CategoryAssets;
    
use App\Repositories\BaseRepository;

class CategoryAssetsRepository extends BaseRepository implements CategoryAssetsRepositoryInterface
{   
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\CategoryAssets::class;
    }
}
