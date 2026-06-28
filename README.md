# MatchPoint - Sistema de Gerenciamento de Campeonato de Voleibol

## Descrição

O **MatchPoint** é um sistema web desenvolvido em PHP utilizando a arquitetura **MVC (Model-View-Controller)** e banco de dados **MySQL**. O sistema foi criado para auxiliar na organização de campeonatos de voleibol, permitindo o gerenciamento de equipes, jogadoras, partidas e a geração automática da classificação (ranking).

---

## Funcionalidades

* Cadastro de equipes

  * Inserção
  * Edição
  * Exclusão
  * Listagem

* Cadastro de jogadoras

  * Inserção
  * Edição
  * Exclusão
  * Associação com equipes

* Gerenciamento de partidas

  * Cadastro de jogos
  * Alteração dos resultados
  * Exclusão de partidas
  * Consulta de jogos cadastrados

* Ranking automático

  * Cálculo dos pontos das equipes
  * Número de vitórias
  * Número de derrotas
  * Sets pró
  * Sets contra
  * Ordenação automática da classificação

---

## Tecnologias utilizadas

* PHP
* PHP My Admin (do XAMPP)
* HTML5
* CSS3
* Bootstrap
* JavaScript

---

## Estrutura do projeto

```
MATCHPOINT
│
├── config/
│   ├── conexao.php
│   ├── database.php
│   └──  upload.php
│
├── controllers/
│   ├── EquipeController.php
│   ├── JogadorController.php
│   ├── PartidaController.php
│   └── RankingController.php
│
├── models/
│   ├── Equipes.php
│   ├── Jogadores.php
│   ├── Partida.php
│   └── Ranking.php
│
├── views/
│   ├── equipes/
│   ├── jogadores/
│   ├── partidas/
│   ├── ranking/
│   └── includes/
│
├── assets/
│   └── css/
│
├── index.php
└── README.md
```

---

## Arquitetura MVC

O projeto segue o padrão **Model-View-Controller**, onde:

### Model

Responsável pelo acesso ao banco de dados.

Exemplos:

* Inserção de registros
* Consultas
* Atualizações
* Exclusões

### Controller

Intermedia a comunicação entre a View e o Model.

Responsável por:

* Receber os dados enviados pelos formulários
* Chamar os métodos do Model
* Retornar os resultados para a View

### View

Responsável pela interface do sistema.

Contém:

* Formulários
* Tabelas
* Botões
* Layout do sistema

---

## Banco de Dados

O sistema utiliza o MySQL.

Principais tabelas:

* equipe
* jogadora
* jogos

Relacionamentos:

* Uma equipe possui várias jogadoras.
* Uma partida possui uma equipe mandante e uma equipe visitante.
* O ranking é calculado a partir dos resultados registrados na tabela de jogos.

---

## Regras do Ranking

A classificação segue o sistema de pontuação do voleibol.

Pontuação:

| Resultado | Pontos do vencedor | Pontos do perdedor |
| --------- | -----------------: | -----------------: |
| 3 x 0     |                  3 |                  0 |
| 3 x 1     |                  3 |                  0 |
| 3 x 2     |                  2 |                  1 |

Critérios de desempate:

1. Maior número de pontos.
2. Maior número de vitórias.
3. Melhor saldo de sets.

---

## Como executar

1. Clone o repositório.

```
git clone <url-do-repositorio>
```

2. Coloque o projeto dentro da pasta `htdocs` do XAMPP.

3. Rode o MySQL que está dentro do XAMPP.

4. Execute o script SQL para criação das tabelas.

5. Configure os dados de conexão em:

```
config/conexao.php
```

6. Inicie o Apache.

7. Acesse no navegador:

```
http://localhost/MATCHPOINT
```

---

## Desenvolvido por

* Andressa Fouchy Schons
* Camila Feldkircher Antunes

