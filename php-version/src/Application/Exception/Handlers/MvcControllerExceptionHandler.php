<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

use Lazaro\StudentCrud\Request\Exceptions\HttpException;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

class MvcControllerExceptionHandler extends AbstractExceptionHandler{

    private ViewData $viewData;

    public function __construct(ViewData $viewData) {
        $this->viewData = $viewData;
    }

    public function execute($ex):void{
        switch($ex){
            case $ex instanceof HttpException:{
                $this->viewData->setView('../../../views/error/default-error-page.php');
                parent::execute($ex);
            }
            default: {
                $this->viewData->setView('../../../views/error/default-error-page.php');
                $this->viewData->setErrorMessage('500');
                $this->viewData->setData('description', 'internal server error!!');
                parent::execute($ex);
            }
        }
        
    }

}