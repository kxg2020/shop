<?php
class Obj{
    private $where;
    public function where($where){
        $this->where = $where;
        return $this;
    }

    public function select(){
        echo $this->where;
    }
}

$obj = new Obj();
$obj->where('1111')->select();