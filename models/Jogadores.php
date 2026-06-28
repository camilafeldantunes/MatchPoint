<?php

require_once __DIR__ . '/../config/conexao.php';

class Jogadora
{
    public function listar()
    {
        global $pdo;

        $sql = "SELECT j.*, e.nome AS nome_equipe
                FROM jogadora j
                LEFT JOIN equipe e ON j.id_equipe = e.id_equipe";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM jogadora WHERE id_jogador = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $posicao, $numero, $id_equipe, $foto)
    {
        global $pdo;

        $sql = "INSERT INTO jogadora(nome, posicao, numero, id_equipe, foto)
                VALUES(:nome, :posicao, :numero, :id_equipe, :foto)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":nome" => $nome,
            ":posicao" => $posicao,
            ":numero" => $numero,
            ":id_equipe" => $id_equipe,
            ":foto" => $foto
        ]);
    }

    public function atualizar($id, $nome, $posicao, $numero, $id_equipe, $foto)
    {
        global $pdo;

        $sql = "UPDATE jogadora
                SET nome = :nome,
                    posicao = :posicao,
                    numero = :numero,
                    id_equipe = :id_equipe,
                    foto = :foto
                WHERE id_jogador = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nome" => $nome,
            ":posicao" => $posicao,
            ":numero" => $numero,
            ":id_equipe" => $id_equipe,
            ":foto" => $foto
        ]);
    }

    public function excluir($id)
    {
        global $pdo;

        $sql = "DELETE FROM jogadora WHERE id_jogador = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}