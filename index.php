<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-5">

    <div class="text-center mb-5">
        <h1>🏐 Liga de Vôlei Feminina</h1>
        <p class="lead">
            Sistema para gerenciamento de equipes, jogadoras e partidas.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Times</h5>
                    <p class="card-text">
                        Gerenciar equipes.
                    </p>
                    <a href="views\equipes\lista.php" class="btn btn-primary">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Jogadoras</h5>
                    <p class="card-text">
                        Gerenciar atletas.
                    </p>
                    <a href="#" class="btn btn-success">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Jogos</h5>
                    <p class="card-text">
                        Registrar partidas.
                    </p>
                    <a href="#" class="btn btn-warning">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Classificação</h5>
                    <p class="card-text">
                        Visualizar ranking.
                    </p>
                    <a href="#" class="btn btn-danger">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
<?php require_once 'views/includes/footer.php'; ?>
