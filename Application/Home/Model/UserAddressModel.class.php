<?php
namespace Home\Model;

use Think\Model;

class UserAddressModel extends Model
{
    //........
    protected $_validate = [
        ['name', 'require', '收货人姓名必须填写', 1],
        ['phone', 'require', '收货人电话必须填写', 1],
        ['phone', '/^1[34578]\d{9}$/', '收货人电话格式错误', 1],
        ['address', 'require', '收货人地址必须填写', 1],
        ['p_id', 'require', '请选择省份', 1],
        ['c_id', 'require', '请选择市/区', 1],
        ['a_id', 'require', '请选择区/县/街道', 1],
    ];

    protected $_auto = [
        ['create_time', 'time', 1, 'function'],
        ['status', 0, 1],
    ];

    /**
     * @param $id
     * @param $userId
     * @return mixed
     * 通过用户收货地址的ID查询出详细信息
     */
    public function getUserAddressById($id, $userId){
        // data中需要的字段 name, phone, province_name, city_name, area_name, detail_address
        $userAddress = M('UserAddress as a')
            ->field('a.name, a.phone, a.address detail_address, b.name province_name, c.name city_name, d.name area_name')
            ->join('shop_locations as b on b.id=a.p_id') // 省份
            ->join('shop_locations as c on c.id=a.c_id') // 市
            ->join('shop_locations as d on d.id=a.a_id') // 区
            ->where(['a.user_id' => $userId, 'a.id' => $id])
            ->find();
        return $userAddress;
    }
}