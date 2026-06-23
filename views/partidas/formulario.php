<?php

require_once '../../controllers/PartidaController.php';
require_once '../../controllers/EquipeController.php';

$partidaController = new PartidaController();
$equipeController = new EquipeController();

$equipes = $equipeController->listar();

/* =========================
   CARREGAR PARA EDIÇÃO
========================= */
$id = $_GET['id'] ?? null;
$jogo = null;

if ($id) {
    $jogo = $partidaController->buscarPorId($id);
}

/* =========================
   SALVAR (INSERT OU UPDATE)
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idPost = $_POST['id'] ?? null;

    if ($idPost) {
        $partidaController->atualizar(
            $idPost,
            $_POST['data_jogo'],
            $_POST['hora_jogo'],
            $_POST['mandante'],
            $_POST['visitante'],
            $_POST['local_jogo'],
            $_POST['resultado']
        );
    } else {
        $partidaController->inserir(
            $_POST['data_jogo'],
            $_POST['hora_jogo'],
            $_POST['mandante'],
            $_POST['visitante'],
            $_POST['local_jogo'],
            $_POST['resultado']
        );
    }

    header('Location: lista.php');
    exit;
}

require_once '../includes/header.php';
?>

<div class="container mt-4 d-flex justify-content-center">

    <div class="card shadow p-4" style="width: 600px;">

        <h2 class="text-center mb-4">
            <?= $id ? 'Editar Jogo' : 'Cadastro de Jogos' ?>
        </h2>

        <form method="POST">

            <!-- ID oculto (essencial para update) -->
            <input type="hidden" name="id" value="<?= $jogo['id_jogo'] ?? '' ?>">

            <!-- DATA -->
            <div class="mb-3">
                <label class="form-label">Data do Jogo</label>
                <input type="date" class="form-control" name="data_jogo"
                       value="<?= $jogo['data_jogo'] ?? '' ?>" required>
            </div>

            <!-- HORÁRIO -->
            <div class="mb-3">
                <label class="form-label">Horário</label>
                <input type="time" class="form-control" name="hora_jogo"
                       value="<?= $jogo['horario'] ?? '' ?>" required>
            </div>

            <!-- MANDANTE -->
            <div class="mb-3">
                <label class="form-label">Equipe Mandante</label>
                <select class="form-select" name="mandante" required>
                    <option value="">Selecione</option>

                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id_equipe'] ?>"
                            <?= (isset($jogo) && $jogo['equipe_mandante'] == $equipe['id_equipe']) ? 'selected' : '' ?>>
                            <?= $equipe['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- VISITANTE -->
            <div class="mb-3">
                <label class="form-label">Equipe Visitante</label>
                <select class="form-select" name="visitante" required>
                    <option value="">Selecione</option>

                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id_equipe'] ?>"
                            <?= (isset($jogo) && $jogo['equipe_visitante'] == $equipe['id_equipe']) ? 'selected' : '' ?>>
                            <?= $equipe['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- LOCAL -->
            <div class="mb-3">
                <label class="form-label">Local</label>
                <input type="text" class="form-control" name="local_jogo"
                       value="<?= $jogo['local_jogo'] ?? '' ?>" required>
            </div>

            <!-- RESULTADO -->
            <div class="mb-3">
                <label class="form-label">Resultado (opcional)</label>
                <input type="text" class="form-control" name="resultado"
                       value="<?= $jogo['resultado'] ?? '' ?>">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Salvar
            </button>

            <a href="lista.php" class="btn btn-secondary w-100 mt-2">
                Voltar
            </a>

        </form>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>