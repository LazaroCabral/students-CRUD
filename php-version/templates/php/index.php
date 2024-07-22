<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <?php

            use Lazaro\StudentCrud\Controllers\Admin\ShowStudents;

            require_once "../../vendor/autoload.php";

            $showStudentsController=new ShowStudents();
        ?>
    </head>
    <body>
        <div>
            <h1>Lista de estudantes</h1>
            <div>
                <a href="./add-student.php">adicionar aluno</a>
            </div>
            <table>
                <thead>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>STATUS</th>
                </thead>
                <tbody>
                    <?php
                    try{
                        $showStudentsController->GET();
                    } catch(mysqli_sql_exception){
                        echo "database error";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="../scripts/update-student/update-student-status.js"></script>
    </body>
</html>