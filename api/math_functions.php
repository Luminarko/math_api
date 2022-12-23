<?php


function sum(array $nums){
    $sum = array_sum($nums);
    return $sum;
}
function sub(array $nums){
    $sub = $nums[0];
    for($i=1; $i < count($nums); $i++){
        $sub -= $nums[$i];
    }
    return $sub;
}
function div(array $nums){   
        $div = $nums[0];
        for($i=1; $i < count($nums); $i++){
            if($nums[$i] != 0){
                $div = $div / $nums[$i];
            }break;
        }
        return $div;
}
function multi(array $nums){
    $mult = $nums[0];
    for($i=1; $i < count($nums); $i++){
        $mult = $mult * $nums[$i];
    }
    return $mult;
}
function power(array $nums){
    $num = $nums[0];
    $pow = $nums[1];
    $power = pow($num, $pow);
    return $power;
}
function sqroot(array $nums){
    $num = $nums[0];
    $sqrt = sqrt($num);
    return $sqrt;
}