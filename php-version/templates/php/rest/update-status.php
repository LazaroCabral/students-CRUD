<?php

use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\Rest\Controllers\Admin\UpdateStudentStatus;

require_once "../../../vendor/autoload.php";

if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
    $updateStatusController=new UpdateStudentStatus();
    $updateStatusController->POST();
}