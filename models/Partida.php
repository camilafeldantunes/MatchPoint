<?php

require_once __DIR__ . '/../config/conexao.php';

class Partida
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

    public function buscarPorId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM jogos WHERE id_jogo = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir(
        $data_jogo,
        $horario,
        $equipe_mandante,
        $equipe_visitante,
        $local_jogo,
        $resultado
    ) {
        global $pdo;

        $sql = "INSERT INTO jogos
                (data_jogo, horario, equipe_mandante,
                 equipe_visitante, local_jogo, resultado)
                VALUES
                (:data_jogo, :horario, :equipe_mandante,
                 :equipe_visitante, :local_jogo, :resultado)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":data_jogo" => $data_jogo,
            ":horario" => $horario,
            ":equipe_mandante" => $equipe_mandante,
            ":equipe_visitante" => $equipe_visitante,
            ":local_jogo" => $local_jogo,
            ":resultado" => $resultado
        ]);
    }

    public function atualizar(
        $id,
        $data_jogo,
        $horario,
        $equipe_mandante,
        $equipe_visitante,
        $local_jogo,
        $resultado
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

        return $stmt->execute([
            ":id" => $id,
            ":data_jogo" => $data_jogo,
            ":horario" => $horario,
            ":equipe_mandante" => $equipe_mandante,
            ":equipe_visitante" => $equipe_visitante,
            ":local_jogo" => $local_jogo,
            ":resultado" => $resultado
        ]);
    }

    public function excluir($id)
    {
        global $pdo;

        $sql = "DELETE FROM jogos WHERE id_jogo = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}