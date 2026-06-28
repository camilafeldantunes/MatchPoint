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
<style>
    
    .jogo-acoes {
    display: grid; grid-template-columns: 1fr 1fr;
    border-top: 0.5px solid #e5e7eb;
  }
  .jogo-acoes a {
    padding: 10px; font-size: 13px; font-weight: 500;
    text-align: center; text-decoration: none;
    transition: background 0.12s;
  }
  .btn-editar  { color: #92640a; }
  .btn-editar:hover  { background: #fae8a0; }
  .btn-excluir { color: #991b1b; }
  .btn-excluir:hover { background: #fecaca; }
</style>

<div class="container mt-4">

<div class="d-flex align-items-center justify-content-between mb-4">
    <h2 class="mb-0">Jogos</h2>
    <div class="d-flex gap-2">
      <a href="/MATCHPOINT/index.php" class="btn btn-secondary">Voltar</a>
      <a href="formulario.php" class="btn btn-primary">+ Novo Jogo</a>
    </div>
  </div>

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

            <td class="jogo-acoes">
                <a href="formulario.php?id=<?= $partida['id_jogo'] ?>" class="btn-editar">
                ✏️ Editar
                </a>
                <a href="?delete=<?= $partida['id_jogo'] ?>" class="btn-excluir"
                onclick="return confirm('Excluir este jogo?')">
                🗑 Excluir
                </a>
                
            </td>
          </div>
        </tr>

        <?php endforeach; ?>

        </tbody>

</table>


</div>

<?php require_once '../includes/footer.php'; ?>
