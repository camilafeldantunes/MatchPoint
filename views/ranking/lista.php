<?php
require_once __DIR__ . '/../../controllers/RankingController.php';

$controller = new RankingController();
$tabela     = $controller->calcular();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Classificação</h2>
        <div class="d-flex gap-2">
        <a href="/MATCHPOINT/index.php" class="btn btn-secondary">Voltar</a>
        
        </div>
    </div>

    <?php if (empty($tabela)): ?>
        <div class="alert alert-info">
            Nenhum jogo com resultado registrado ainda.
        </div>
    <?php else: ?>

        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Equipe</th>
                    <th class="text-center">J</th>
                    <th class="text-center">V</th>
                    <th class="text-center">D</th>
                    <th class="text-center">Sets Pró</th>
                    <th class="text-center">Sets Contra</th>
                    <th class="text-center">Saldo</th>
                    <th class="text-center">Pts</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabela as $pos => $equipe): ?>
                    <tr <?= $pos === 0 ? 'class="table-warning fw-bold"' : '' ?>>
                        <td><?= $pos + 1 ?></td>
                        <td><?= htmlspecialchars($equipe['nome']) ?></td>
                        <td class="text-center"><?= $equipe['jogos'] ?></td>
                        <td class="text-center"><?= $equipe['vitorias'] ?></td>
                        <td class="text-center"><?= $equipe['derrotas'] ?></td>
                        <td class="text-center"><?= $equipe['sets_pro'] ?></td>
                        <td class="text-center"><?= $equipe['sets_contra'] ?></td>
                        <td class="text-center"><?= $equipe['sets_pro'] - $equipe['sets_contra'] ?></td>
                        <td class="text-center"><?= $equipe['pontos'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="text-muted small">
            Pontuação: vitória 3x0 ou 3x1 = 3pts &nbsp;|&nbsp; vitória 3x2 = 2pts &nbsp;|&nbsp; derrota 2x3 = 1pt &nbsp;|&nbsp; demais derrotas = 0pts
        </p>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>