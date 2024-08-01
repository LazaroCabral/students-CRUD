<!DOCTYPE html>
<html>
    <head>
        <?php 
            $viewData=@$GLOBALS["viewData"];
        ?>
    </head>
    <body>
        <div>
        <h1>Adicionar estudante</h1>
        <a href="show-students.php">tela inicial</a>
            <form action="" method="post">
                <label for="name">Nome</label>
                <input type="text" name="name">
                <label for="email">E-mail</label>
                <input type="text" name="email">
                <label for="phone">Telefone</label>
                <input type="text" name="phone">
                <label for="value_per_month">Valor por mês</label>
                <input type="text" name="value_per_month">
                <label for="password">Senha</label>
                <input type="text" name="password">
                <label for="status">Status</label>
                <input type="checkbox" name="status">
                <label for="observation">Observação</label>
                <input type="text-area" name="observation">
                <button type="submit">enviar</button>
            </form>
        </div>
        <?php if(@$viewData["errorMessage"]!=null) echo $viewData["errorMessage"]?>
    </body>
</html>