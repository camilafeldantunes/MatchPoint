<?php

require_once __DIR__. '/../models/Equipes.php';

class EquipeController
{
    private $model;

    public function __construct()
    {
        $this->model = new Equipe();
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function buscarPorId($id)
    {
        return $this->model->buscarPorId($id);
    }

    public function inserir($nome,$estado,$cidade,$foto)
    {
        return $this->model->inserir($nome,$estado,$cidade,$foto);
    }
    public function atualizar($id, $nome, $estado, $cidade, $foto = null)
    {
        return $this->model->atualizar($id, $nome, $estado, $cidade, $foto);
    }

    public function excluir($id)
    {
        return $this->model->excluir($id);
    }
}