<?php

require_once __DIR__ . '/../config/conexao.php';

class PartidaController
{
    public function listar()
    {
        global $pdo;

        $sql = "
            SELECT
                p.*,
                em.nome AS mandante,
                ev.nome AS visitante
            FROM jogos p
            INNER JOIN equipe em
                ON p.equipe_mandante = em.id_equipe
            INNER JOIN equipe ev
                ON p.equipe_visitante = ev.id_equipe
            ORDER BY p.data_jogo, p.horario
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir(
        $data_jogo,
        $horario,
        $equipe_mandante,
        $equipe_visitante,
        $local_jogo,
        $resultado = null
    ) {
        global $pdo;

        $sql = "INSERT INTO jogos
                (data_jogo, horario, equipe_mandante,
                 equipe_visitante, local_jogo, resultado)
                VALUES
                (:data_jogo, :horario, :equipe_mandante,
                 :equipe_visitante, :local_jogo, :resultado)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':data_jogo', $data_jogo);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':equipe_mandante', $equipe_mandante);
        $stmt->bindParam(':equipe_visitante', $equipe_visitante);
        $stmt->bindParam(':local_jogo', $local_jogo);
        $stmt->bindParam(':resultado', $resultado);

        return $stmt->execute();
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
        global $pdo;

        $sql = "UPDATE jogos
                SET
                    data_jogo = :data_jogo,
                    horario = :horario,
                    equipe_mandante = :equipe_mandante,
                    equipe_visitante = :equipe_visitante,
                    local_jogo = :local_jogo,
                    resultado = :resultado
                WHERE id_jogo = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':data_jogo', $data_jogo);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':equipe_mandante', $equipe_mandante);
        $stmt->bindParam(':equipe_visitante', $equipe_visitante);
        $stmt->bindParam(':local_jogo', $local_jogo);
        $stmt->bindParam(':resultado', $resultado);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        global $pdo;

        $sql = "DELETE FROM jogos WHERE id_jogo = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM jogos WHERE id_jogo = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}