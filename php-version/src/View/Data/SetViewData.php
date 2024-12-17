<?php
 namespace Lazaro\StudentCrud\View\Data;

 class SetViewData{

    private static string | null $view=null;

    private function __construct() {}

    public static function setRenderFunction(string $name, $function): void{
        $GLOBALS["viewData"]["renderFunctions"][$name]=$function;
    }

    public static function setErrorMessage($message): void{
        $GLOBALS["viewData"]["errorMessage"]=$message;
    }

    public static function setData(string $name,$data): void{
        $GLOBALS["viewData"][$name]=$data;
    }

    public static function setView(string $view): void{
        SetViewData::$view=$view;
    }

    public static function getView(): string | null{
        return SetViewData::$view;
    } 

}