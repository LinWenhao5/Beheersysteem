<?php

namespace user;
use Connection;
include('database.class.php');


class user extends Connection
{
        function check($username, $password) {
             $data = $this->get_user();
             $len = count($data) - 1;
             for ($i = 0; $i <= $len; $i++) {
                 if ($username == $data[$i]['username'] && $password == $data[$i]['password']) {
                     header('location:homepage.php');
                     $key = $this->GetRandStr(10);
                     $this->update_key($data[$i]['user'], $key);
                     $_SESSION['key'] = $key;
                 } else {
                     $this->update_key($data[$i]['user'], 0);
                 }
             }
        }

        function GetRandStr($length){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str)-1;
        $randstr = '';
        for ($i=0;$i<$length;$i++) {
            $num=mt_rand(0,$len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
}
?>