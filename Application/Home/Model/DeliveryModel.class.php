<?php
namespace Home\Model;

use Think\Model;

class DeliveryModel extends Model
{
    public function getDeliveryById($id){
        return $this->field('id delivery_id, name delivery_name, price delivery_price')->find($id);
    }
}