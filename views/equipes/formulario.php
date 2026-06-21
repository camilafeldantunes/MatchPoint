<?php
require_once '../../controllers/EquipeController.php';

$controller = new EquipeController();

$id = $_GET['id'] ?? null;
$equipe = null;

if ($id) {
    $equipe = $controller->buscarPorId($id);
}

require_once '../includes/header.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $pais = $_POST['pais'];

    // =========================
    // UPLOAD DA FOTO
    // =========================
    $fotoPath = $equipe['foto'] ?? null;

    if (!empty($_FILES['foto']['name'])) {

        $nomeArquivo = time() . '_' . $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $pasta = "../../fotos/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $caminhoFisico = $pasta . $nomeArquivo;

        move_uploaded_file($tmp, $caminhoFisico);

        $fotoPath = "/MATCHPOINT/fotos/" . $nomeArquivo;
    }

    // =========================
    // INSERT OU UPDATE
    // =========================
    if ($id) {
        $controller->atualizar($id, $nome, $pais, $fotoPath);
    } else {
        $controller->inserir($nome, $pais, $fotoPath);
    }

    header("Location: lista.php");
    exit;
}
?>

<div class="container mt-4 d-flex justify-content-center">

    <div class="card p-4 shadow" style="width: 500px;">

        <h3 class="text-center mb-4">
            <?= $id ? 'Editar Equipe' : 'Nova Equipe' ?>
        </h3>

        <!-- IMPORTANTE PARA UPLOAD -->
        <form method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $equipe['id_equipe'] ?? '' ?>">

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control"
                       value="<?= $equipe['nome'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label>País</label>
                <input type="text" name="pais" class="form-control"
                       value="<?= $equipe['pais'] ?? '' ?>" required>
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