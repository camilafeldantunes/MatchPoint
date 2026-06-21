<?php require_once '../includes/header.php'; ?>

<div class="container vh-100 d-flex justify-content-center align-items-center">

    <div class="card shadow p-4" style="width: 500px;">

        <h2 class="text-center mb-4">
            🏐 Cadastro de Jogadoras
        </h2>

        <form>

            <div class="mb-3">
                <label for="inputNome" class="form-label">
                    Nome da Jogadora
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="inputNome">
            </div>

            <div class="mb-3">
                <label for="inputPosicao" class="form-label">
                    Posição
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="inputPosicao">
            </div>

            <div class="mb-3">
                <label for="inputNumero" class="form-label">
                    Número da Camisa
                </label>

                <input
                    type="number"
                    class="form-control"
                    id="inputNumero">
            </div>

            <div class="mb-3">
                <label for="inputEquipe" class="form-label">
                    Equipe
                </label>

                <select class="form-select" id="inputEquipe">
                    <option>IFRS Vôlei</option>
                    <option>Asavolei</option>
                </select>
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100">
                Cadastrar
            </button>
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">
                Voltar
            </a>

        </form>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>