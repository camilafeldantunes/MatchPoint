<?php
require_once '../../controllers/PartidaController.php';

$controller = new PartidaController();

if (isset($_GET['delete'])) {
    $controller->excluir($_GET['delete']);
    header("Location: lista.php");
    exit;
}

$partidas = $controller->listar();

require_once '../includes/header.php';
?>

<div class="container mt-4">

<h2 class="mb-4">Jogos Cadastrados</h2>
<a href="/MATCHPOINT/index.php" class="btn btn-secondary mb-4"> 
    Voltar
</a>

<a href="formulario.php" class="btn btn-success mb-4">
    Novo Jogo
</a>

<table class="table table-striped table-hover">

    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Mandante</th>
            <th>Visitante</th>
            <th>Local</th>
            <th>Resultado</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($partidas as $partida): ?>

        <tr>
            <td><?= $partida['id_jogo'] ?></td>

            <td>
                <?= date('d/m/Y', strtotime($partida['data_jogo'])) ?>
            </td>

            <td>
                <?= substr($partida['horario'], 0, 5) ?>
            </td>

            <td><?= htmlspecialchars($partida['mandante']) ?></td>

            <td><?= htmlspecialchars($partida['visitante']) ?></td>

            <td><?= htmlspecialchars($partida['local_jogo']) ?></td>

            <td>
                <?= $partida['resultado'] ?: '-' ?>
            </td>

            <td>
                <a href="formulario.php?id=<?= $partida['id_jogo'] ?>"
                class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="?delete=<?= $partida['id_jogo'] ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Deseja excluir esta partida?')">
                    Excluir
                </a>
            </td>
        </tr>

        <?php endforeach; ?>

        </tbody>

</table>


</div>

<?php require_once '../includes/footer.php'; ?>
