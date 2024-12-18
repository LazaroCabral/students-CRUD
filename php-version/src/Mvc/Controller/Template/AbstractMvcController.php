<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Template;

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

}