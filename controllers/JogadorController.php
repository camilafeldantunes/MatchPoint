<?php

require_once __DIR__ . '/../config/conexao.php';

class JogadorController
{
    public function listar()
    {
        global $pdo;
        $sql = "SELECT j.*, e.nome AS nome_equipe 
                FROM jogadora j
                LEFT JOIN equipe e ON j.id_equipe = e.id_equipe";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $posicao, $numero, $id_equipe, $foto = null)
    {
        global $pdo;
        $sql = "INSERT INTO jogadora (nome, posicao, numero, id_equipe, foto)
                VALUES (:nome, :posicao, :numero, :id_equipe, :foto)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':posicao', $posicao);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $posicao, $numero, $id_equipe, $foto = null)
    {
        global $pdo;
        $sql = "UPDATE jogadora 
                SET nome = :nome, posicao = :posicao, numero = :numero,
                    id_equipe = :id_equipe, foto = :foto
                WHERE id_jogador = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':posicao', $posicao);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }

    public function excluir($id)
    {
        global $pdo;
        $sql = "DELETE FROM jogadora WHERE id_jogador = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        global $pdo;
        $sql = "SELECT * FROM jogadora WHERE id_jogador = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}