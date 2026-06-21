<?php require_once '../includes/header.php'; ?>

<h2 class="mb-4">Jogadoras Cadastradas</h2>

<a href="formulario.php" class="btn btn-success mb-4">
    Nova Jogadora
</a>

<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">

            <img src="/MATCHPOINT/fotos/helena.jpg"
                class="card-img-top"
                alt="Helena"
                style="width: 150px; height: 150px; object-fit: cover;">

            <div class="card-body">

                <h5 class="card-title">Helena</h5>

                <p class="card-text">
                    <strong>Posição:</strong> Levantadora<br>
                    <strong>Número:</strong> 10<br>
                    <strong>Equipe:</strong> IFRS Vôlei
                </p>

            </div>

            <div class="card-footer bg-white border-0">
                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </div>

        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow">

            <div class="card-body">

                <h5 class="card-title">
                    Maria Souza
                </h5>

                <p class="card-text">
                    <strong>Posição:</strong> Ponteira<br>
                    <strong>Número:</strong> 7<br>
                    <strong>Equipe:</strong> Asavolei
                </p>

                <a href="#" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="#" class="btn btn-danger btn-sm">
                    Excluir
                </a>

            </div>

        </div>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>