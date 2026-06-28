<?php
require_once __DIR__ . '/../../controllers/PartidaController.php';
require_once __DIR__ . '/../../controllers/EquipeController.php';

$partidaController = new PartidaController();
$equipeController  = new EquipeController();

$equipes = $equipeController->listar();

$id   = $_GET['id'] ?? null;
$jogo = null;

if ($id) {
    $jogo = $partidaController->buscarPorId($id);
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idPost     = $_POST['id']         ?? null;
    $data_jogo  = $_POST['data_jogo']  ?? '';
    $hora_jogo  = $_POST['hora_jogo']  ?? '';
    $mandante   = $_POST['mandante']   ?? '';
    $visitante  = $_POST['visitante']  ?? '';
    $local_jogo = $_POST['local_jogo'] ?? '';
    $resultado  = trim($_POST['resultado'] ?? '');

    if ($mandante && $visitante && $mandante === $visitante) {
        $erros[] = 'A equipe mandante e visitante não podem ser a mesma.';
    }

    $dataPassada = $data_jogo && strtotime($data_jogo) < strtotime(date('Y-m-d'));

    if ($dataPassada && $resultado === '') {
        $erros[] = 'O resultado é obrigatório para jogos com data anterior a hoje.';
    }

    if ($resultado !== '' && !preg_match('/^\d+\s*[x\-]\s*\d+$/i', $resultado)) {
        $erros[] = 'Formato de resultado inválido. Use o formato: 3x1 ou 3-2';
    }

    if (empty($erros)) {
        if ($idPost) {
            $partidaController->atualizar($idPost, $data_jogo, $hora_jogo, $mandante, $visitante, $local_jogo, $resultado);
        } else {
            $partidaController->inserir($data_jogo, $hora_jogo, $mandante, $visitante, $local_jogo, $resultado);
        }

        header('Location: lista.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow p-4" style="width: 600px;">

        <h2 class="text-center mb-4">
            <?= $id ? 'Editar Jogo' : 'Cadastro de Jogos' ?>
        </h2>

        <?php if (!empty($erros)): ?>
            <div class="alert alert-danger">
                <?php foreach ($erros as $erro): ?>
                    <div><?= $erro ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="formJogo">

            <input type="hidden" name="id" value="<?= $jogo['id_jogo'] ?? '' ?>">

            <div class="mb-3">
                <label class="form-label">Data do Jogo</label>
                <input type="date" class="form-control" name="data_jogo" id="data_jogo"
                       value="<?= $jogo['data_jogo'] ?? '' ?>"
                       onchange="verificarData()" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Horário</label>
                <input type="time" class="form-control" name="hora_jogo"
                       value="<?= $jogo['horario'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipe Mandante</label>
                <select class="form-select" name="mandante" required>
                    <option value="">Selecione</option>
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id_equipe'] ?>"
                            <?= ($jogo['equipe_mandante'] ?? '') == $equipe['id_equipe'] ? 'selected' : '' ?>>
                            <?= $equipe['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipe Visitante</label>
                <select class="form-select" name="visitante" required>
                    <option value="">Selecione</option>
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id_equipe'] ?>"
                            <?= ($jogo['equipe_visitante'] ?? '') == $equipe['id_equipe'] ? 'selected' : '' ?>>
                            <?= $equipe['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Local</label>
                <input type="text" class="form-control" name="local_jogo"
                       value="<?= $jogo['local_jogo'] ?? '' ?>" required>
            </div>

            <div class="mb-3" id="campo_resultado">
                <label class="form-label" id="label_resultado">
                    Resultado
                    <span id="badge_obrigatorio" class="badge bg-danger ms-1" style="display:none;">
                        obrigatório
                    </span>
                </label>
                <input type="text" class="form-control" name="resultado"
                       id="resultado"
                       placeholder="Ex: 3x1"
                       value="<?= $jogo['resultado'] ?? '' ?>">
                <div class="form-text" id="dica_resultado" style="display:none;">
                    Jogo já realizado — informe o resultado no formato 3x1 ou 3-2.
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar</button>
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

        </form>
    </div>
</div>

<script>
function verificarData() {
    const input     = document.getElementById('data_jogo').value;
    const resultado = document.getElementById('resultado');
    const badge     = document.getElementById('badge_obrigatorio');
    const dica      = document.getElementById('dica_resultado');

    if (!input) return;

    const hoje      = new Date(); hoje.setHours(0,0,0,0);
    const dataJogo  = new Date(input + 'T00:00:00');
    const passada   = dataJogo < hoje;

    resultado.required = passada;
    badge.style.display = passada ? 'inline' : 'none';
    dica.style.display  = passada ? 'block'  : 'none';
}

document.addEventListener('DOMContentLoaded', verificarData);
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>