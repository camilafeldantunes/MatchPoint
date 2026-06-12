<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipes</title>
</head>
<body>
    <?php require_once '../includes/header.php'; ?>

<h2 class="mb-4">Equipes Cadastradas</h2>

<a href="formulario.php" class="btn btn-success mb-3">
    Nova Equipe
</a>

<table class="table table-striped table-hover">

    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>IFRS Vôlei</td>
            <td>RS</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </td>
        </tr>

        <tr>
            <td>2</td>
            <td>Asavolei</td>
            <td>RS</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </td>
        </tr>

    </tbody>

</table>

<?php require_once '../includes/footer.php'; ?>
</body>
</html>