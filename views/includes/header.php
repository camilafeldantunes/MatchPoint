<?php
    $paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga de Vôlei Feminina</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/MATCHPOINT/assets/style.css">
<style>
    .navbar .nav-link.active {
        font-weight: bold;
        border-bottom: 3px solid #fff;
        color: #fff !important;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">


    <a class="navbar-brand fw-bold" href="/MATCHPOINT/index.php">
        🏐 Liga de Vôlei Feminina
    </a>

    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
                <a class="nav-link <?= $paginaAtual == 'lista.php' && str_contains($_SERVER['PHP_SELF'], '/equipes/') ? 'active fw-bold' : '' ?>"
                href="/MATCHPOINT/views/equipes/lista.php">
                    Times
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $paginaAtual == 'lista.php' && str_contains($_SERVER['PHP_SELF'], '/jogadores/') ? 'active fw-bold' : '' ?>"
                href="/MATCHPOINT/views/jogadores/lista.php">
                    Jogadoras
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $paginaAtual == 'lista.php' && str_contains($_SERVER['PHP_SELF'], '/partidas/') ? 'active fw-bold' : '' ?>"
                href="/MATCHPOINT/views/partidas/lista.php">
                    Jogos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $paginaAtual == 'lista.php' && str_contains($_SERVER['PHP_SELF'], '/ranking/') ? 'active fw-bold' : '' ?>"
                href="/MATCHPOINT/views/ranking/lista.php">
                    Classificação
                </a>
            </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">