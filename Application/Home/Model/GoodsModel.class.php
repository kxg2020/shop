<?php
namespace Home\Model;

use Think\Model;

class GoodsModel extends Model
{
    public function SubtractStock($items){
        foreach ($items as $item){
            $result = $this->where([
                'id' => $item['goods_id']
            ])->save([
                // stock = stock-1;
                'stock' => ['exp', 'stock-'.$item['amount']],
            ]);
            if(!$result){
                return false;
            }
        }
        return true;
    }
}