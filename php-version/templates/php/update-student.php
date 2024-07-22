<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php

            use Lazaro\StudentCrud\Controllers\Admin\UpdateStudent;
            use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
            use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
            use Lazaro\StudentCrud\Request\Utils\RequestUtils;

            require_once "../../vendor/autoload.php";

            function methodSelection(UpdateStudent $updateStudent){
                if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
                    $student=$updateStudent->GET($_GET);                    
                }
                if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
                    $updateStudent->POST($_POST);
                }
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
                    echo "database error";
                } catch(InvalidInputException $ex){
                    echo $ex->getMessage();
                }
                ?>
        </div>
    </body>
</html>