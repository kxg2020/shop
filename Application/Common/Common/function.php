<?php
function getRedis(){
    // 实例化一个redis对象
    $redis = new Redis();
    $redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));
    return $redis;
}