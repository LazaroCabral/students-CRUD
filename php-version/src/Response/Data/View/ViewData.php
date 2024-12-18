<?php
 namespace Lazaro\StudentCrud\Response\Data\View;

 use Lazaro\StudentCrud\Response\Data\AbstractResponseData;
 use Override;

 class ViewData extends AbstractResponseData{
    private static ViewData | null $viewData=null;

    private string | null $view=null;

    private function __construct() {
        parent::__construct('viewData');
    }

    public static function getInstance(): ViewData{
        if(self::$viewData == null){
            self::$viewData=new ViewData();
        }
        return self::$viewData;
    }

    public function setRenderFunction(string $name, $function): void{
        $GLOBALS[$this->prefix]["renderFunctions"][$name]=$function;
    }

    public function setView(string $view): void{
        $this->view=$view;
    }

    public function getView(): string | null{
        return $this->view;
    } 

}