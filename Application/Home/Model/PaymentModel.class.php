<?php
namespace Home\Model;

use Think\Model;

class PaymentModel extends Model
{
    public function paymentById($id){
        return $this->field('id pay_type_id, name pay_type_name')->find($id);
    }
}