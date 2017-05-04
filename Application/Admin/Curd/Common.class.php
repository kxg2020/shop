<?php
namespace Admin\Curd;

class Common
{
    public function showLists($modelName, $where=[]){
        $model = M($modelName);
        $lists = $model->where($where)->select();
        return $lists;
    }
}