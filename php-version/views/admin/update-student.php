<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php 
            $errorMessage=@$GLOBALS["viewData"]["errorMessage"];
            $printForm=@$GLOBALS["viewData"]["renderFunctions"]["printForm"];
        ?>
    </head>
    <body>
        <div>
            <h1>Atualizar estudante</h1>
            <a href="./index.php">tela inicial</a>
            <?php if(is_callable($printForm)) $printForm();?>
            <p><?php if($errorMessage!=null) echo $errorMessage;?></p>
        </div>
    </body>
</html>