<?php
require_once __DIR__ . '/../../controllers/EquipeController.php'; 

$controller = new EquipeController();

/* DELETE AQUI */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $controller->excluir($id);

    header("Location: lista.php");
    exit;
}

$equipes = $controller->listar();
   
?>



<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <h2 class="mb-4">Equipes Cadastradas</h2>
        
        <a href="/MATCHPOINT/index.php" class="btn btn-secondary mb-4"> 
            Voltar
        </a>
    

    <a href="formulario.php" class="btn btn-success mb-4">
        Nova Equipe
    </a>

    <div class="row">

        <?php foreach ($equipes as $equipe): ?>

            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">

                    <div class="card-body">
                        <?php if (!empty($equipe['foto'])): ?>

                            <img src="<?= $equipe['foto'] ?>"
                                class="img-fluid mb-3"
                                style="height: 150px; object-fit: cover; border-radius: 8px;">

                        <?php endif; ?>

                        <h5 class="card-title">
                            <?= $equipe['nome'] ?>
                        </h5>
                        <p class="card-text">
                            <strong>Estado:</strong> <?= $equipe['estado'] ?? '—' ?>
                        </p>
                        <p class="card-text">
                            <strong>Cidade:</strong> <?= $equipe['cidade'] ?? '—' ?>
                        </p>

                        <div class="d-flex gap-2">

                            <!-- EDITAR (leva o ID para o formulário) -->
                            <a href="formulario.php?id=<?= $equipe['id_equipe'] ?>"
                               class="btn btn-warning btn-sm w-50">
                                Editar
                            </a>

                            <!-- EXCLUIR (depois você liga no controller) -->
                            <a href="lista.php?delete=<?= $equipe['id_equipe'] ?>"
                                class="btn btn-danger btn-sm w-50"
                                onclick="return confirm('Tem certeza?')">
                                    Excluir
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>