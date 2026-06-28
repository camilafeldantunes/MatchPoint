<?php

require_once __DIR__ . '/../config/conexao.php';

class Ranking
{
    public function calcular(): array
    {
        global $pdo;

        $sql = "SELECT j.resultado,
                       j.equipe_mandante,
                       j.equipe_visitante,
                       em.nome AS nome_mandante,
                       ev.nome AS nome_visitante
                FROM jogos j
                JOIN equipe em ON j.equipe_mandante = em.id_equipe
                JOIN equipe ev ON j.equipe_visitante = ev.id_equipe
                WHERE j.resultado IS NOT NULL
                  AND j.resultado != ''";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tabela = [];

        foreach ($jogos as $jogo) {

            preg_match('/(\d+)\s*[x\-]\s*(\d+)/i', $jogo['resultado'], $m);

            if (empty($m)) {
                continue;
            }

            $setsMandante  = (int)$m[1];
            $setsVisitante = (int)$m[2];

            $idM = $jogo['equipe_mandante'];
            $idV = $jogo['equipe_visitante'];

            foreach ([
                $idM => $jogo['nome_mandante'],
                $idV => $jogo['nome_visitante']
            ] as $id => $nome) {

                if (!isset($tabela[$id])) {
                    $tabela[$id] = [
                        'nome' => $nome,
                        'jogos' => 0,
                        'vitorias' => 0,
                        'derrotas' => 0,
                        'sets_pro' => 0,
                        'sets_contra' => 0,
                        'pontos' => 0
                    ];
                }
            }

            $tabela[$idM]['jogos']++;
            $tabela[$idV]['jogos']++;

            $tabela[$idM]['sets_pro'] += $setsMandante;
            $tabela[$idM]['sets_contra'] += $setsVisitante;

            $tabela[$idV]['sets_pro'] += $setsVisitante;
            $tabela[$idV]['sets_contra'] += $setsMandante;

            if ($setsMandante > $setsVisitante) {

                $tabela[$idM]['vitorias']++;
                $tabela[$idV]['derrotas']++;

                $tabela[$idM]['pontos'] += ($setsVisitante < 2) ? 3 : 2;
                $tabela[$idV]['pontos'] += ($setsVisitante == 2) ? 1 : 0;

            } else {

                $tabela[$idV]['vitorias']++;
                $tabela[$idM]['derrotas']++;

                $tabela[$idV]['pontos'] += ($setsMandante < 2) ? 3 : 2;
                $tabela[$idM]['pontos'] += ($setsMandante == 2) ? 1 : 0;
            }
        }

        usort($tabela, function ($a, $b) {

            if ($b['pontos'] != $a['pontos']) {
                return $b['pontos'] - $a['pontos'];
            }

            if ($b['vitorias'] != $a['vitorias']) {
                return $b['vitorias'] - $a['vitorias'];
            }

            $saldoA = $a['sets_pro'] - $a['sets_contra'];
            $saldoB = $b['sets_pro'] - $b['sets_contra'];

            return $saldoB - $saldoA;
        });

        return $tabela;
    }
}