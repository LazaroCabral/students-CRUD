<?php
 namespace Lazaro\StudentCrud\View\Data;

 class SetViewData{

    //public static $t="del,mdfdf";
    //public static array $viewData=array("vdsvd"=>"vcv");
    //public static array $renderFunctions=array(null);

    public function __construct() {

    }

    public static function setRenderFunction(string $name, $function){
        //self::$renderFunctions[$name]=$function;
        $GLOBALS["viewData"]["renderFunctions"][$name]=$function;
    }

    public static function setErrorMessage($message){
        //self::$viewData["errorMessage"]=$message;
        $GLOBALS["viewData"]["errorMessage"]=$message;
    }

    public static function setData(string $name,$data){
        //array_push(SetViewData::$viewData,array($name=>$data));
        //SetViewData::$viewData=array($name=>$data);
        //$GLOBALS["view"]=array($name => $data);
        $GLOBALS["viewData"][$name]=$data;
    }
}