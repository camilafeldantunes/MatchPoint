<?php
require_once __DIR__ . '/../../controllers/EquipeController.php';
require_once __DIR__ . '/../../config/upload.php';

$controller = new EquipeController();

$id     = $_GET['id'] ?? null;
$equipe = null;

if ($id) {
    $equipe = $controller->buscarPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = $_POST['id']     ?? null;
    $nome   = $_POST['nome'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];

    $pasta    = __DIR__ . '/../../fotos/';
    $resultado = processarUploadImagem($_FILES['foto'], $pasta, $equipe['foto'] ?? null);

    if (!$resultado['sucesso']) {
        $erroUpload = $resultado['erro'];
    } else {
        $fotoPath = $resultado['caminho'];

        if ($id) {
            $controller->atualizar($id, $nome, $estado, $cidade, $fotoPath);
        } else {
            $controller->inserir($nome, $estado, $cidade, $fotoPath);
        }

        header("Location: lista.php");
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 d-flex justify-content-center">
    <div class="card p-4 shadow" style="width: 500px;">

        <h3 class="text-center mb-4">
            <?= $id ? 'Editar Equipe' : 'Nova Equipe' ?>
        </h3>

        <form method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $equipe['id_equipe'] ?? '' ?>">

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control"
                       value="<?= $equipe['nome'] ?? '' ?>" required>
            </div>

            <div class="row g-3 mb-3">

                <div class="col-6">
                    <label>Estado (UF)</label>
                   <select name="estado" id="estado" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php
                        $ufs = ['AC','AL','AM','AP','BA','CE','DF','ES','GO','MA',
                                'MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN',
                                'RO','RR','RS','SC','SE','SP','TO'];
                        foreach ($ufs as $uf):
                            $sel = ($equipe['estado'] ?? '') === $uf ? 'selected' : '';
                        ?>
                            <option value="<?= $uf ?>" <?= $sel ?>><?= $uf ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6">
                    <label>
                        Cidade
                        <span id="spin" style="font-size:12px; color:#888; display:none;">
                            carregando…
                        </span>
                    </label>
                    <select name="cidade" id="cidade" class="form-select" required>
                        <?php if (!empty($equipe['cidade'])): ?>
                            <option value="<?= $equipe['cidade'] ?>" selected>
                                <?= $equipe['cidade'] ?>
                            </option>
                        <?php else: ?>
                            <option value="">Selecione o estado primeiro</option>
                        <?php endif; ?>
                    </select>
                </div>

            </div>

            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <?php if (!empty($equipe['foto'])): ?>
                <div class="mb-3 text-center">
                    <img src="<?= $equipe['foto'] ?>" width="120" style="border-radius: 8px;">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary w-100">Salvar</button>
            <?php if (!empty($erroUpload)): ?>
                <div class="alert alert-danger"><?= $erroUpload ?></div>
            <?php endif; ?>
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

        </form>
    </div>
</div>

<script>
async function carregarCidades(manterCidade = null) {
    const uf   = document.getElementById('estado').value;
    const sel  = document.getElementById('cidade');
    const spin = document.getElementById('spin');

    if (!uf) {
        sel.innerHTML = '<option value="">Selecione o estado primeiro</option>';
        sel.disabled = true;
        return;
    }

    spin.style.display = 'inline';
    sel.disabled = true;
    sel.innerHTML = '<option>Carregando cidades…</option>';

    try {
        const res = await fetch(
            `https://brasilapi.com.br/api/ibge/municipios/v1/${uf}?providers=dados-abertos-br,gov,wikipedia`
        );
        const cidades = await res.json();

        sel.innerHTML = '<option value="">Selecione a cidade</option>' +
            cidades.map(c =>
                `<option value="${c.nome}">${c.nome}</option>`
            ).join('');

        // Restaura a cidade salva se foi passada e o estado não mudou
        if (manterCidade) {
            for (let opt of sel.options) {
                if (opt.value.toUpperCase() === manterCidade.toUpperCase()) {
                    opt.selected = true;
                    break;
                }
            }
        }

        sel.disabled = false;
    } catch (e) {
        sel.innerHTML = '<option value="">Erro ao carregar cidades</option>';
    }

    spin.style.display = 'none';
}

// Ao carregar a página em modo edição: carrega cidades e mantém a cidade salva
window.addEventListener('DOMContentLoaded', () => {
    const estadoAtual = "<?= htmlspecialchars($equipe['estado'] ?? '') ?>";
    const cidadeAtual = "<?= htmlspecialchars($equipe['cidade'] ?? '') ?>";

    if (estadoAtual) {
        // Passa a cidade para ser restaurada após carregar
        carregarCidades(cidadeAtual);
    }
});

// Ao trocar o estado manualmente: carrega cidades SEM manter cidade anterior
document.getElementById('estado').addEventListener('change', () => {
    carregarCidades(null);
});
</script><script>
async function carregarCidades(manterCidade = null) {
    const uf   = document.getElementById('estado').value;
    const sel  = document.getElementById('cidade');
    const spin = document.getElementById('spin');

    if (!uf) {
        sel.innerHTML = '<option value="">Selecione o estado primeiro</option>';
        sel.disabled = true;
        return;
    }

    spin.style.display = 'inline';
    sel.disabled = true;
    sel.innerHTML = '<option>Carregando cidades…</option>';

    try {
        const res = await fetch(
            `https://brasilapi.com.br/api/ibge/municipios/v1/${uf}?providers=dados-abertos-br,gov,wikipedia`
        );
        const cidades = await res.json();

        sel.innerHTML = '<option value="">Selecione a cidade</option>' +
            cidades.map(c =>
                `<option value="${c.nome}">${c.nome}</option>`
            ).join('');

        // Restaura a cidade salva se foi passada e o estado não mudou
        if (manterCidade) {
            for (let opt of sel.options) {
                if (opt.value.toUpperCase() === manterCidade.toUpperCase()) {
                    opt.selected = true;
                    break;
                }
            }
        }

        sel.disabled = false;
    } catch (e) {
        sel.innerHTML = '<option value="">Erro ao carregar cidades</option>';
    }

    spin.style.display = 'none';
}

// Ao carregar a página em modo edição: carrega cidades e mantém a cidade salva
window.addEventListener('DOMContentLoaded', () => {
    const estadoAtual = "<?= htmlspecialchars($equipe['estado'] ?? '') ?>";
    const cidadeAtual = "<?= htmlspecialchars($equipe['cidade'] ?? '') ?>";

    if (estadoAtual) {
        // Passa a cidade para ser restaurada após carregar
        carregarCidades(cidadeAtual);
    }
});

// Ao trocar o estado manualmente: carrega cidades SEM manter cidade anterior
document.getElementById('estado').addEventListener('change', () => {
    carregarCidades(null);
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>