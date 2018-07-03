<?php
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

//递归算法
function tree(&$data,$pid=null){
    $tree=[];
    foreach ($data as $key=>$vo){
        if ($vo['parent_id']==$pid){
            $tree[]=$vo;
            $tree=array_merge($tree,tree($data,$vo['id']));
        }
    }
    return $tree;
}
//无线级查找子集
function tree_son($data,$pid=null){
    $son=[];
    foreach ( $data as $key=>$vo){
        if ($vo['parent_id']==$pid){
            $vo['children']=tree_son($data, $vo['id']);
            $son[]=$vo;
        }
    }
    return $son;
}