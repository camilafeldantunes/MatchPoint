<?php
require_once __DIR__ . '/../../controllers/JogadorController.php';
require_once __DIR__ . '/../../controllers/EquipeController.php';

$jogadorController = new JogadorController();
$equipeController  = new EquipeController();

$id      = $_GET['id'] ?? null;
$jogador = null;

if ($id) {
    $jogador = $jogadorController->buscarPorId($id);
}

$equipes = $equipeController->listar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = $_POST['id'] ?? null;
    $nome      = $_POST['nome'];
    $posicao   = $_POST['posicao'];
    $numero    = $_POST['numero'];
    $id_equipe = $_POST['id_equipe'];

    $fotoPath = $jogador['foto'] ?? null;

    if (!empty($_FILES['foto']['name'])) {
        $nomeArquivo  = time() . '_' . $_FILES['foto']['name'];
        $pasta        = __DIR__ . '/../../fotos/';
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }
        move_uploaded_file($_FILES['foto']['tmp_name'], $pasta . $nomeArquivo);
        $fotoPath = "/MATCHPOINT/fotos/" . $nomeArquivo;
    }

    if ($id) {
        $jogadorController->atualizar($id, $nome, $posicao, $numero, $id_equipe, $fotoPath);
    } else {
        $jogadorController->inserir($nome, $posicao, $numero, $id_equipe, $fotoPath);
    }

    header("Location: lista.php");
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 d-flex justify-content-center">
    <div class="card p-4 shadow" style="width: 500px;">

        <h3 class="text-center mb-4">
            <?= $id ? 'Editar Jogadora' : 'Nova Jogadora' ?>
        </h3>

        <form method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $jogador['id_jogador'] ?? '' ?>">

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control"
                       value="<?= $jogador['nome'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label>Posição</label>
                <input type="text" name="posicao" class="form-control"
                       value="<?= $jogador['posicao'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label>Número da Camisa</label>
                <input type="number" name="numero" class="form-control"
                       value="<?= $jogador['numero'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label>Equipe</label>
                <select name="id_equipe" class="form-select" required>
                    <option value="">Selecione uma equipe</option>
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id_equipe'] ?>"
                            <?= ($jogador['id_equipe'] ?? '') == $equipe['id_equipe'] ? 'selected' : '' ?>>
                            <?= $equipe['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <?php if (!empty($jogador['foto'])): ?>
                <div class="mb-3 text-center">
                    <img src="<?= $jogador['foto'] ?>" width="120" style="border-radius: 8px;">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary w-100">Salvar</button>
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>