<?php

require_once __DIR__ . '/../models/Partida.php';

class PartidaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Partida();
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function buscarPorId($id)
    {
        return $this->model->buscarPorId($id);
    }

    public function inserir(
        $data_jogo,
        $horario,
        $equipe_mandante,
        $equipe_visitante,
        $local_jogo,
        $resultado = null
    ) {
        return $this->model->inserir(
            $data_jogo,
            $horario,
            $equipe_mandante,
            $equipe_visitante,
            $local_jogo,
            $resultado
        );
    }

    public function atualizar(
        $id,
        $data_jogo,
        $horario,
        $equipe_mandante,
        $equipe_visitante,
        $local_jogo,
        $resultado = null
    ) {
        return $this->model->atualizar(
            $id,
            $data_jogo,
            $horario,
            $equipe_mandante,
            $equipe_visitante,
            $local_jogo,
            $resultado
        );
    }

    public function excluir($id)
    {
        return $this->model->excluir($id);
    }
}