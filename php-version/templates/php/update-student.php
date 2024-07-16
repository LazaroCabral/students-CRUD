<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php

            use Lazaro\StudentCrud\Controllers\Admin\UpdateStudent;
            use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
            use Lazaro\StudentCrud\Request\Utils\RequestUtils;
            use Lazaro\StudentCrud\Validators\Utils\Exceptions\InvalidInputException;

            require_once "../../vendor/autoload.php";

            function methodSelection(UpdateStudent $updateStudent){
                if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
                    $student=$updateStudent->GET($_GET);                    
                }
                if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
                    $updateStudent->POST($_POST);
                }
            }
            function printForm(UpdateStudent $updateStudentController){
                $data=$_REQUEST;
                $updateStudentController->GET($data);
            }
        ?>
    </head>
    <body>
        <div>
            <h1>Atualizar estudante</h1>
            <a href="./index.php">tela inicial</a>
            <?php 
                $updateStudentController=new UpdateStudent();
                try{
                    methodSelection($updateStudentController);
                } catch(mysqli_sql_exception){
                    printForm($updateStudentController);
                    echo "database error";
                } catch(InvalidInputException $ex){
                    printForm($updateStudentController);
                    echo $ex->getMessage();
                }
                ?>
        </div>
    </body>
</html>