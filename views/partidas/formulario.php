<?php require_once '../includes/header.php'; ?>

<div class="container mt-4 d-flex justify-content-center">
    

    <div class="card shadow p-4" style="width: 600px;">
        

        <h2 class="text-center mb-4">Cadastro de Jogos</h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Data do Jogo</label>
                <input type="date" class="form-control" name="data_jogo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Horário</label>
                <input type="time" class="form-control" name="hora_jogo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipe Mandante</label>
                <select class="form-select" name="mandante" required>
                    <option value="">Selecione</option>
                    <option value="1">IFRS Vôlei</option>
                    <option value="2">Asavolei</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipe Visitante</label>
                <select class="form-select" name="visitante" required>
                    <option value="">Selecione</option>
                    <option value="1">IFRS Vôlei</option>
                    <option value="2">Asavolei</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Local</label>
                <input type="text" class="form-control" name="local_jogo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Resultado (opcional)</label>
                <input type="text" class="form-control" name="resultado" placeholder="Ex: 3 x 1">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Cadastrar
            </button>
            <a href="lista.php" class="btn btn-secondary w-100 mt-2">
                Voltar
            </a>
            


        </form>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>