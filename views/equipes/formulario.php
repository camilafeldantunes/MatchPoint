<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <?php require_once '../includes/header.php'; ?>
</head>
<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">

        <div class="card shadow p-4" style="width: 500px;">

            <h2 class="text-center mb-4">
                🏐 Cadastro de Equipes
            </h2>

            <form>

                <div class="mb-3">
                    <label for="InputEquipe" class="form-label">
                        Nome da Equipe
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="InputEquipe">
                </div>

                <div class="mb-3">
                    <label for="inputEstado" class="form-label">
                        Estado
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="inputEstado">
                </div>

                <button
                    type="submit"
                    class="btn btn-primary w-100">
                    Cadastrar
                </button>

            </form>

        </div>

    </div>

</body>
<?php require_once '../includes/footer.php'; ?>
</html>
