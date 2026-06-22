<?php
require_once __DIR__ . '/../../controllers/EquipeController.php';

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

    $fotoPath = $equipe['foto'] ?? null;

    if (!empty($_FILES['foto']['name'])) {
        $nomeArquivo = time() . '_' . $_FILES['foto']['name'];
        $pasta = __DIR__ . '/../../fotos/';
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);
        move_uploaded_file($_FILES['foto']['tmp_name'], $pasta . $nomeArquivo);
        $fotoPath = "/MATCHPOINT/fotos/" . $nomeArquivo;
    }

    if ($id) {
        $controller->atualizar($id, $nome, $estado, $cidade, $fotoPath);
    } else {
        $controller->inserir($nome, $estado, $cidade, $fotoPath);
    }

    header("Location: lista.php");
    exit;
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
                    <select name="estado" id="estado" class="form-select" required
                            onchange="carregarCidades()">
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
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

        </form>
    </div>
</div>

<script>
async function carregarCidades() {
    const uf   = document.getElementById('estado').value;
    const sel  = document.getElementById('cidade');
    const spin = document.getElementById('spin');

    if (!uf) {
        sel.innerHTML = '<option value="">Selecione o estado primeiro</option>';
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

        sel.disabled = false;
    } catch (e) {
        sel.innerHTML = '<option value="">Erro ao carregar cidades</option>';
    }

    spin.style.display = 'none';
}

window.addEventListener('DOMContentLoaded', () => {
    const estadoAtual  = "<?= $equipe['estado'] ?? '' ?>";
    const cidadeAtual  = "<?= $equipe['cidade'] ?? '' ?>";

    if (estadoAtual) {
        carregarCidades().then(() => {
            const sel = document.getElementById('cidade');
            for (let opt of sel.options) {
                if (opt.value === cidadeAtual) {
                    opt.selected = true;
                    break;
                }
            }
        });
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>