<?php

require_once __DIR__ . '/../models/Jogadores.php';

class JogadorController
{
    private $model;

    public function __construct()
    {
        $this->model = new Jogadora();
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function buscarPorId($id)
    {
        return $this->model->buscarPorId($id);
    }

    public function inserir($nome, $posicao, $numero, $id_equipe, $foto)
    {
        return $this->model->inserir($nome, $posicao, $numero, $id_equipe, $foto);
    }

    public function atualizar($id, $nome, $posicao, $numero, $id_equipe, $foto)
    {
        return $this->model->atualizar($id, $nome, $posicao, $numero, $id_equipe, $foto);
    }

    public function excluir($id)
    {
        return $this->model->excluir($id);
    }
}