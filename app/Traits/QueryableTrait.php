<?php
namespace App\Traits;

trait QueryableTrait
{
    public function getDataAccess($model, $eagerName, $itemPerPage) {
        return $model->with($eagerName)->orderBy('id', 'DESC')->paginate($itemPerPage);
    }
}

?>