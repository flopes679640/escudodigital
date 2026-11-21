<?php
session_start();
require_once __DIR__ . '/config.php';

if (isset($_GET['sair'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

$erroLogin = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['senha'])) {
    if ($_POST['senha'] === ADMIN_PASS) {
        $_SESSION['escudo_admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $erroLogin = 'Senha incorreta.';
    }
}

$autenticado = !empty($_SESSION['escudo_admin']);
$acessos = [];
$feedbacks = [];
$mediaNotas = 0;
$totalQuizzes = 0;

if ($autenticado) {
    $pdo = getPDO();
    $acessos = $pdo->query('SELECT * FROM acessos ORDER BY data_hora_acesso DESC')->fetchAll();
    $feedbacks = $pdo->query('SELECT * FROM feedbacks ORDER BY data_hora DESC')->fetchAll();

    foreach ($acessos as $a) {
        if ($a['quiz_pontuacao'] !== null) $totalQuizzes++;
    }
    if (count($feedbacks) > 0) {
        $soma = array_sum(array_column($feedbacks, 'nota'));
        $mediaNotas = round($soma / count($feedbacks), 2);
    }
}

function e(?string $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Evidências – Escudo Digital</title>
    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: #f1f5f9;
            color: #0f172a;
            padding: 1.5rem;
        }

        .wrap {
            max-width: 1000px;
            margin: 0 auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .top h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #0f2942;
        }

        .btn {
            background: #0f2942;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-sec {
            background: #475569;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .kpi {
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 1rem 1.25rem;
        }

        .kpi small {
            color: #475569;
            font-weight: 600;
        }

        .kpi strong {
            display: block;
            font-size: 1.8rem;
            color: #0d9488;
            margin-top: 0.25rem;
        }

        .box {
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            overflow-x: auto;
        }

        .box h2 {
            margin-top: 0;
            font-size: 1.15rem;
            color: #0f2942;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.92rem;
        }

        th,
        td {
            text-align: left;
            padding: 0.65rem 0.75rem;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
        }

        .login-box {
            max-width: 380px;
            margin: 4rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
        }

        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #94a3b8;
            border-radius: 8px;
            margin: 0.5rem 0 1rem;
            box-sizing: border-box;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <?php if (!$autenticado): ?>
            <div class="login-box">
                <h2>🔒 Painel de Evidências</h2>
                <p>Digite a senha de administrador para consultar o fluxo de acessos e feedbacks.</p>
                <?php if ($erroLogin): ?>
                    <p style="color:#dc2626; font-weight:700;"><?= e($erroLogin) ?></p>
                <?php endif; ?>
                <form method="post">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" required autofocus>
                    <button type="submit" class="btn" style="width:100%;">Entrar</button>
                </form>
                <p style="text-align:center; margin-top:1rem; margin-bottom:0;">
                    <a href="./?novo=1" style="color:#0d9488; font-weight:600; text-decoration:none;">← Voltar para o Portal</a>
                </p>
            </div>
        <?php else: ?>
            <div class="top">
                <h1>🛡️ Escudo Digital – Relatório de Fluxo de Acessos e Feedbacks</h1>
                <div class="no-print" style="display:flex; gap:0.5rem;">
                    <a href="index.php?novo=1" class="btn btn-sec">Abrir Portal</a>
                    <button type="button" class="btn" onclick="window.print()">Imprimir / Salvar PDF</button>
                    <a href="?sair=1" class="btn btn-sec">Sair</a>
                </div>
            </div>

            <div class="cards">
                <div class="kpi">
                    <small>Total de Acessos (Pessoas Impactadas)</small>
                    <strong><?= count($acessos) ?></strong>
                </div>
                <div class="kpi">
                    <small>Quizzes Concluídos</small>
                    <strong><?= $totalQuizzes ?></strong>
                </div>
                <div class="kpi">
                    <small>Feedbacks Recebidos</small>
                    <strong><?= count($feedbacks) ?></strong>
                </div>
                <div class="kpi">
                    <small>Média das Avaliações</small>
                    <strong><?= $mediaNotas > 0 ? $mediaNotas . ' / 5' : '—' ?></strong>
                </div>
            </div>

            <div class="box">
                <h2>1. Fluxo de Dados – Acessos dos Usuários (Nome, Data e Horário)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome do Usuário</th>
                            <th>Faixa Etária</th>
                            <th>Data e Horário de Acesso</th>
                            <th>Pontuação no Quiz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$acessos): ?>
                            <tr>
                                <td colspan="5">Nenhum acesso registrado ainda.</td>
                            </tr>
                            <?php else: foreach ($acessos as $a): ?>
                                <tr>
                                    <td><?= (int)$a['id'] ?></td>
                                    <td><?= e($a['nome_usuario']) ?></td>
                                    <td><?= e($a['faixa_etaria']) ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($a['data_hora_acesso'])) ?></td>
                                    <td><?= $a['quiz_pontuacao'] !== null ? ((int)$a['quiz_pontuacao'] . ' / 5') : 'Não finalizado' ?></td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="box">
                <h2>2. Feedbacks da Comunidade</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome do Usuário</th>
                            <th>Nota</th>
                            <th>Comentário</th>
                            <th>Data e Horário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$feedbacks): ?>
                            <tr>
                                <td colspan="5">Nenhum feedback registrado ainda.</td>
                            </tr>
                            <?php else: foreach ($feedbacks as $f): ?>
                                <tr>
                                    <td><?= (int)$f['id'] ?></td>
                                    <td><?= e($f['nome_usuario']) ?></td>
                                    <td><?= str_repeat('★', (int)$f['nota']) ?> (<?= (int)$f['nota'] ?>/5)</td>
                                    <td><?= e($f['comentario'] ?: 'Sem comentário adicional') ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($f['data_hora'])) ?></td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>