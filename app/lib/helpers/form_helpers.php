<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 20.08.19
 * Time: 17:33
 */

function inputBlok($type, $label, $name, $value='', $inputAttrs=[], $divAttes=[]){
    $divString  = stringifyAttrs($divAttes);
    $inputString = stringifyAttrs($inputAttrs);
    $html='<div'. $divString. '>';
    $html.='<inpuat type="'.$type.'"name="'.$name.'" value="'.$value.'"'.$inputString.'/>';
    $html .='</div>';
    return $html;
}

function stringifyAttrs($attrs){
    $string = '';
    foreach ($attrs as $key=> $val){
        $string ='="'. $val.'"';
    }
    return $string;
}