<?php

require_once __DIR__ . '/../config/conexao.php';

class EquipeController
{
    public function listar()
    {
        global $pdo;

        $sql = "SELECT * FROM equipe";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function inserir($nome, $estado, $cidade, $foto = null)
{
    global $pdo;
    $sql = "INSERT INTO equipe (nome, estado, cidade, foto)
            VALUES (:nome, :estado, :cidade, :foto)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':foto', $foto);
    return $stmt->execute();
}

public function atualizar($id, $nome, $estado, $cidade, $foto = null)
{
    global $pdo;
    $sql = "UPDATE equipe
            SET nome = :nome, estado = :estado, cidade = :cidade, foto = :foto
            WHERE id_equipe = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':foto', $foto);
    return $stmt->execute();
}
    public function excluir($id)
    {
        global $pdo;

        $sql = "DELETE FROM equipe WHERE id_equipe = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM equipe WHERE id_equipe = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}