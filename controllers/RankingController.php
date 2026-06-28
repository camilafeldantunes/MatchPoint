<?php

require_once __DIR__ . '/../models/Ranking.php';

class RankingController
{
    private $model;

    public function __construct()
    {
        $this->model = new Ranking();
    }

    public function calcular(): array
    {
        return $this->model->calcular();
    }
}