<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Lazaro\StudentCrud\Request\Exceptions\HttpException;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

abstract class AbstractMvcController extends AbstractController{

    protected ViewData $viewData;

    public function __construct() {
        $this->viewData=ViewData::getInstance();
        parent::__construct($this->viewData);
    }

    public function execute(): void{
        parent::execute();
        if($this->viewData->getView() != null){
            require $this->viewData->getView();
        }
    }

    #[\Override()]
    public function exceptionHandler(\Exception $ex): void{
        switch($ex){
            case $ex instanceof HttpException:{
                $this->viewData->setView('../../../views/error/default-error-page.php');
            }
        }
        parent::exceptionHandler($ex);
    }

}