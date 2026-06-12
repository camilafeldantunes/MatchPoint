<?php require_once '../includes/header.php'; ?>

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

<?php require_once '../includes/footer.php'; ?>

