<?php
require_once __DIR__ . '/../../controllers/JogadorController.php';
require_once __DIR__ . '/../../controllers/EquipeController.php';

$jogadorController = new JogadorController();
$equipeController  = new EquipeController();

if (isset($_GET['delete'])) {
    $jogadorController->excluir($_GET['delete']);
    header("Location: lista.php");
    exit;
}

$jogadores = $jogadorController->listar();
$equipes   = $equipeController->listar();

require_once __DIR__ . '/../includes/header.php';
?>

<style>
  .filtro-bar {
    display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 24px;
  }
  .filtro-btn {
    padding: 6px 16px; border-radius: 20px;
    border: 1.5px solid #e5e7eb;
    background: #fff; color: #374151;
    font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.15s;
  }
  .filtro-btn:hover { border-color: #1B2A6B; color: #1B2A6B; }
  .filtro-btn.ativo { background: #1B2A6B; color: #fff; border-color: #1B2A6B; }

  .jogadoras-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 20px;
  }
  .jogadora-card {
    background: #fff; border: 0.5px solid #e5e7eb;
    border-radius: 16px; overflow: hidden;
    display: flex; flex-direction: column;
    transition: transform 0.15s, box-shadow 0.15s;
  }
  .jogadora-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.09); }
  .jogadora-card.oculto { display: none; }

  .jogadora-foto img {
    width: 100%; height: 180px;
    object-fit: cover; object-position: top; display: block;
  }
  .jogadora-foto-placeholder {
    height: 180px;
    background: linear-gradient(135deg, #1B2A6B 60%, #2a3f9e);
    display: flex; align-items: center; justify-content: center;
    font-size: 52px; font-weight: 700; color: rgba(255,255,255,0.85);
  }

  .jogadora-body { padding: 14px 16px 10px; flex: 1; }
  .jogadora-nome { font-size: 15px; font-weight: 600; color: #111827; margin: 0 0 10px; }
  .jogadora-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 8px; }
  .tag-posicao { font-size: 11px; font-weight: 600; padding: 2px 9px; border-radius: 20px; background: #1B2A6B; color: #fff; }
  .tag-numero  { font-size: 11px; font-weight: 600; padding: 2px 9px; border-radius: 20px; background: #F5C518; color: #1a1a1a; }
  .jogadora-equipe { font-size: 12px; color: #6b7280; }

  .jogadora-acoes { display: grid; grid-template-columns: 1fr 1fr; border-top: 0.5px solid #e5e7eb; }
  .jogadora-acoes a { padding: 10px; font-size: 13px; font-weight: 500; text-align: center; text-decoration: none; transition: background 0.12s; }
  .btn-editar  { color: #92640a; background: #fdf3d7; border-right: 0.5px solid #e5e7eb; }
  .btn-editar:hover  { background: #fae8a0; }
  .btn-excluir { color: #991b1b; background: #fef2f2; }
  .btn-excluir:hover { background: #fecaca; }

  .sem-resultado { display: none; color: #6b7280; font-size: 14px; padding: 1rem 0; }
</style>

<div class="container mt-4">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h2 class="mb-0">Jogadoras</h2>
    <div class="d-flex gap-2">
      <a href="/MATCHPOINT/index.php" class="btn btn-secondary">Voltar</a>
      <a href="formulario.php" class="btn btn-primary">+ Nova Jogadora</a>
    </div>
  </div>

  <?php if (empty($jogadores)): ?>
    <div class="alert alert-info">Nenhuma jogadora cadastrada ainda.</div>
  <?php else: ?>

    <!-- FILTROS — gerados a partir das equipes do banco -->
    <div class="filtro-bar" id="filtros">
      <button class="filtro-btn ativo" data-equipe="todas">Todas</button>
      <?php foreach ($equipes as $equipe): ?>
        <button class="filtro-btn" data-equipe="<?= $equipe['id_equipe'] ?>">
          🛡️ <?= htmlspecialchars($equipe['nome']) ?>
        </button>
      <?php endforeach; ?>
    </div>

    <p class="sem-resultado" id="semResultado">
      Nenhuma jogadora encontrada para este time.
    </p>

    <div class="jogadoras-grid" id="grid">
      <?php foreach ($jogadores as $jogador):
        $palavras = explode(' ', trim($jogador['nome']));
        $iniciais = strtoupper(
          substr($palavras[0], 0, 1) .
          (isset($palavras[1]) ? substr($palavras[1], 0, 1) : '')
        );
      ?>
        <!-- data-equipe liga o card ao botão de filtro -->
        <div class="jogadora-card" data-equipe="<?= $jogador['id_equipe'] ?>">

          <?php if (!empty($jogador['foto'])): ?>
            <div class="jogadora-foto">
              <img src="<?= htmlspecialchars($jogador['foto']) ?>"
                   alt="<?= htmlspecialchars($jogador['nome']) ?>">
            </div>
          <?php else: ?>
            <div class="jogadora-foto-placeholder"><?= $iniciais ?></div>
          <?php endif; ?>

          <div class="jogadora-body">
            <p class="jogadora-nome"><?= htmlspecialchars($jogador['nome']) ?></p>
            <div class="jogadora-tags">
              <span class="tag-posicao"><?= htmlspecialchars($jogador['posicao']) ?></span>
              <span class="tag-numero">#<?= htmlspecialchars($jogador['numero']) ?></span>
            </div>
            <span class="jogadora-equipe">
              🛡️ <?= htmlspecialchars($jogador['nome_equipe'] ?? '—') ?>
            </span>
          </div>

          <div class="jogadora-acoes">
            <a href="formulario.php?id=<?= $jogador['id_jogador'] ?>" class="btn-editar">✏️ Editar</a>
            <a href="?delete=<?= $jogador['id_jogador'] ?>" class="btn-excluir"
               onclick="return confirm('Excluir <?= htmlspecialchars($jogador['nome']) ?>?')">
               🗑 Excluir
            </a>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  <?php endif; ?>

</div>

<script>
document.getElementById('filtros')?.addEventListener('click', e => {
  const btn = e.target.closest('.filtro-btn');
  if (!btn) return;

  document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('ativo'));
  btn.classList.add('ativo');

  const equipe = btn.dataset.equipe;
  const cards  = document.querySelectorAll('.jogadora-card');
  let visiveis = 0;

  cards.forEach(card => {
    const mostrar = equipe === 'todas' || card.dataset.equipe === equipe;
    card.classList.toggle('oculto', !mostrar);
    if (mostrar) visiveis++;
  });

  document.getElementById('semResultado').style.display =
    visiveis === 0 ? 'block' : 'none';
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>