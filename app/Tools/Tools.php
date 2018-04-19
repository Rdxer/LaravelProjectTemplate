<?php
/**
 * Created by IntelliJ IDEA.
 * User: Rdxer
 * Date: 2018/1/28
 * Time: 下午10:09
 */

namespace App\Tools;


class Tools
{
    static function rand_word($num=16){
        $re='';
        $list="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $list=str_split($list);
        $key=array_rand($list,$num);
        foreach($key as $value){
            $re .= $list[$value];
        }
        return $re;
    }

    /**
     * 字符串 添加掩码
     * @param $str
     * @param int $start
     * @param int $end
     * @return string
     */
    static function maskCode($str,$start=3,$end=2){
        $re='';

        if ($str == null) return null;

        $strList = str_split($str,1);
        $count = count($strList);

        for ($i=0; $i<$count; $i++)
        {

            $item = $strList[$i];

            if ($i < $start){
                $re = $re.$item;
            }else if ($i > ($count - $end - 1)){
                $re = $re.$item;
            }else{
                $re = $re.'*';
            }
        }

        return $re;
    }
}