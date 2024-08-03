<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <?php
            $viewData=@$GLOBALS["viewData"];
            $printRowsTable=@$viewData["renderFunctions"]["printRowsTable"];
        ?>
    </head>
    <body>
        <div>
            <h1>Lista de estudantes</h1>
            <div>
                <a href="add-student.php">adicionar aluno</a>
            </div>
            <table>
                <thead>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>STATUS</th>
                </thead>
                <tbody>
                    <?php if(is_callable($printRowsTable)) $printRowsTable()?>
                </tbody>
            </table>
            <p><?php if(@$viewData["errorMessage"]!=null) echo @$viewData["errorMessage"]?></p>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="../../static/scripts/update-student//update-student-status.js"></script>
    </body>
</html>