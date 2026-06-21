<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

<h2 class="mb-4">Jogos Cadastrados</h2>

<a href="formulario.php" class="btn btn-success mb-3">
    Novo Jogo
</a>

<table class="table table-striped table-hover">

    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Mandante</th>
            <th>Visitante</th>
            <th>Local</th>
            <th>Resultado</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>1</td>
            <td>25/06/2026</td>
            <td>19:00</td>
            <td>IFRS Vôlei</td>
            <td>Asavolei</td>
            <td>Ginásio IFRS</td>
            <td>3 x 1</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </td>
        </tr>

        <tr>
            <td>2</td>
            <td>28/06/2026</td>
            <td>20:00</td>
            <td>UPF Vôlei</td>
            <td>IFRS Vôlei</td>
            <td>Ginásio Municipal</td>
            <td>2 x 3</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td>05/07/2026</td>
            <td>18:30</td>
            <td>Asavolei</td>
            <td>UPF Vôlei</td>
            <td>Ginásio Asavolei</td>
            <td>-</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </td>
        </tr>

    </tbody>

</table>


</div>

<?php require_once '../includes/footer.php'; ?>
