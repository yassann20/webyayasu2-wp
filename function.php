<?php
//値が入力されているか確認
function postcheck($date){
    $error = false;
    if( isset($date) == true && $date == "" ){
        $error = true;
    }else{

    }
    return $error;
}

//メールを送信
?>