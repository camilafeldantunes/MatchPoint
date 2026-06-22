<?php require_once __DIR__ . '/../../controllers/JogadorController.php';

$controller = new JogadorController();

if (isset($_GET['delete'])) {
    $controller->excluir($_GET['delete']);
    header("Location: lista.php");
    exit;
}

$jogadores = $controller->listar();

require_once __DIR__ . '/../includes/header.php';
?>

<h2 class="mb-4">Jogadoras Cadastradas</h2>

<a href="formulario.php" class="btn btn-success mb-4">
    Nova Jogadora
</a>

<div class="row">

     <?php foreach ($jogadores as $jogador): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">

                    <?php if (!empty($jogador['foto'])): ?>
                        <img src="<?= $jogador['foto'] ?>"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= $jogador['nome'] ?></h5>
                        <p class="card-text">
                            <strong>Posição:</strong> <?= $jogador['posicao'] ?><br>
                            <strong>Número:</strong> <?= $jogador['numero'] ?><br>
                            <strong>Equipe:</strong> <?= $jogador['nome_equipe'] ?? '—' ?>
                        </p>
                    </div>

                    <div class="card-footer bg-white border-0 d-flex gap-2">
                        <a href="formulario.php?id=<?= $jogador['id_jogador'] ?>"
                           class="btn btn-warning btn-sm w-50">Editar</a>
                        <a href="lista.php?delete=<?= $jogador['id_jogador'] ?>"
                           class="btn btn-danger btn-sm w-50"
                           onclick="return confirm('Tem certeza?')">Excluir</a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>