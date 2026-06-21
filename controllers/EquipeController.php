<?php

require_once '../../config/conexao.php';

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


    public function inserir($nome, $pais, $foto = null)
    {
        global $pdo;

        $sql = "INSERT INTO equipe (nome, pais, foto)
                VALUES (:nome, :pais, :foto)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':foto', $foto);

        return $stmt->execute();
    }

    public function atualizar($id, $nome, $pais, $foto = null)
    {
        global $pdo;

        $sql = "UPDATE equipe
                SET nome = :nome,
                    pais = :pais,
                    foto = :foto
                WHERE id_equipe = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':pais', $pais);
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