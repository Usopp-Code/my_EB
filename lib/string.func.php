<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function buildRandomString($type=1,$length=4){
    if($type==1){
        $chars = implode("", range(0,9));
    }
    if($type==2){
        $chars = implode("", array_merge(range("a","z"),range("A","Z")));
    }
    if($type==3){
        $chars = implode("", array_merge(range("a","Z"),range("A","Z"),range(0,1)));
    }
    if($length>  strlen($chars))
        exit("字符串长度错误!");
    $chars = str_shuffle($chars);
    return substr($chars, 0,$length);
}
