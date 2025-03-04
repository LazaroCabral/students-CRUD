<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
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
                break;
            }
            case $ex instanceof InvalidInputException:{
                $this->viewData->setErrorMessage($ex->getMessage());
                break;
            };
            default: {
                $this->viewData->setView('../../../views/error/default-error-page.php');
                $this->viewData->setErrorMessage('500');
                $this->viewData->setErrorDescription('internal server error!!');
                http_response_code(500);
            }
            parent::execute($ex);
        }
        
    }

}