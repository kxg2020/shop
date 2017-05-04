<?php
/**
 * @param $id
 * @param $menus
 * 判断在menus中，id是否具有下级分类
 */
function checkHasChild($id, $menus){
    foreach ($menus as $m){
        if($m['parent_id'] == $id){
            return true;
        }
    }
    return false;
}