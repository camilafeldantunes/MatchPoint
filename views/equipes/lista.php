<?php
require_once __DIR__ . '/../../controllers/EquipeController.php';

$controller = new EquipeController();

if (isset($_GET['delete'])) {
    $controller->excluir($_GET['delete']);
    header("Location: lista.php");
    exit;
}

$equipes = $controller->listar();

require_once __DIR__ . '/../includes/header.php';
?>

<style>
  .times-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 20px;
  }

  .time-card {
    background: #fff;
    border: 0.5px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.15s, box-shadow 0.15s;
  }
  .time-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.09);
  }

  .time-foto img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    display: block;
  }

  .time-foto-placeholder {
    height: 160px;
    background: linear-gradient(135deg, #1B2A6B 60%, #2a3f9e);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: 700;
    color: rgba(255,255,255,0.85);
    letter-spacing: -1px;
  }

  .time-body {
    padding: 14px 16px 10px;
    flex: 1;
  }

  .time-nome {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 8px;
  }

  .time-badge-uf {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 9px;
    border-radius: 20px;
    background: #1B2A6B;
    color: #fff;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
  }

  .time-cidade {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    display: block;
  }

  .time-acoes {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-top: 0.5px solid #e5e7eb;
  }

  .time-acoes a {
    padding: 10px;
    font-size: 13px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: background 0.12s;
  }

  .time-acoes .btn-editar {
    color: #92640a;
    background: #fdf3d7;
    border-right: 0.5px solid #e5e7eb;
  }
  .time-acoes .btn-editar:hover { background: #fae8a0; }

  .time-acoes .btn-excluir {
    color: #991b1b;
    background: #fef2f2;
  }
  .time-acoes .btn-excluir:hover { background: #fecaca; }
</style>

<div class="container mt-4">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h2 class="mb-0">Times</h2>
    <div class="d-flex gap-2">
      <a href="/MATCHPOINT/index.php" class="btn btn-secondary">Voltar</a>
      <a href="formulario.php" class="btn btn-primary">+ Novo Time</a>
    </div>
  </div>

  <?php if (empty($equipes)): ?>
    <div class="alert alert-info">Nenhuma equipe cadastrada ainda.</div>
  <?php else: ?>

    <div class="times-grid">
      <?php foreach ($equipes as $equipe):
        $palavras = explode(' ', trim($equipe['nome']));
        $iniciais = strtoupper(substr($palavras[0], 0, 1) . (isset($palavras[1]) ? substr($palavras[1], 0, 1) : ''));
      ?>
        <div class="time-card">

          <?php if (!empty($equipe['foto'])): ?>
            <div class="time-foto">
              <img src="<?= htmlspecialchars($equipe['foto']) ?>"
                   alt="<?= htmlspecialchars($equipe['nome']) ?>">
            </div>
          <?php else: ?>
            <div class="time-foto-placeholder"><?= $iniciais ?></div>
          <?php endif; ?>

          <div class="time-body">
            <p class="time-nome"><?= htmlspecialchars($equipe['nome']) ?></p>
            <span class="time-badge-uf"><?= htmlspecialchars($equipe['estado'] ?? '—') ?></span>
            <span class="time-cidade"><?= htmlspecialchars($equipe['cidade'] ?? '—') ?></span>
          </div>

          <div class="time-acoes">
            <a href="formulario.php?id=<?= $equipe['id_equipe'] ?>" class="btn-editar">
              ✏️ Editar
            </a>
            <a href="?delete=<?= $equipe['id_equipe'] ?>" class="btn-excluir"
               onclick="return confirm('Excluir <?= htmlspecialchars($equipe['nome']) ?>?')">
              🗑 Excluir
            </a>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>