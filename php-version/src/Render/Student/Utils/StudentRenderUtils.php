<?php

namespace Lazaro\StudentCrud\Render\Student\Utils;

class StudentRenderUtils{

    public static function hasProperties($arrayProperties): string{
        if($arrayProperties != null){
            return " ".implode(" ",$arrayProperties);
        }
        return "";
    } 

    public static function studentStatusIsActive($status,$arrayProperties): string{
        $properties=StudentRenderUtils::hasProperties($arrayProperties);
        if($status == 1){
            return"<input".$properties." checked>";
        } else {
            return "<input".$properties.">";
        }
    }
}