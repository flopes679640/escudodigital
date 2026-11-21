<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'erro' => 'Método não permitido.']);
    exit;
}

$dados = json_decode(file_get_contents('php://input'), true);
if (!is_array($dados) || empty($dados['acao'])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'erro' => 'Requisição inválida.']);
    exit;
}

$acao = $dados['acao'];
$agora = date('Y-m-d H:i:s');

try {
    $pdo = getPDO();

    if ($acao === 'registrar_acesso') {
        $nome = trim((string)($dados['nome'] ?? ''));
        $faixa = trim((string)($dados['faixa_etaria'] ?? 'Não informada'));

        if (mb_strlen($nome) < 2) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'erro' => 'Informe seu nome para continuar.']);
            exit;
        }

        $nome = mb_substr($nome, 0, 120);
        $faixa = mb_substr($faixa ?: 'Não informada', 0, 40);

        $stmt = $pdo->prepare(
            'INSERT INTO acessos (nome_usuario, faixa_etaria, data_hora_acesso) VALUES (?, ?, ?)'
        );
        $stmt->execute([$nome, $faixa, $agora]);

        echo json_encode([
            'ok' => true,
            'acesso_id' => (int)$pdo->lastInsertId(),
            'nome' => $nome,
            'data_hora' => date('d/m/Y H:i:s', strtotime($agora))
        ]);
        exit;
    }

    if ($acao === 'salvar_quiz') {
        $acessoId = (int)($dados['acesso_id'] ?? 0);
        $pontuacao = (int)($dados['pontuacao'] ?? -1);

        if ($acessoId <= 0 || $pontuacao < 0 || $pontuacao > 5) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'erro' => 'Dados do quiz inválidos.']);
            exit;
        }

        $stmt = $pdo->prepare(
            'UPDATE acessos SET quiz_pontuacao = ?, quiz_concluido_em = ? WHERE id = ?'
        );
        $stmt->execute([$pontuacao, $agora, $acessoId]);

        echo json_encode(['ok' => true]);
        exit;
    }

    if ($acao === 'salvar_feedback') {
        $acessoId = !empty($dados['acesso_id']) ? (int)$dados['acesso_id'] : null;
        $nome = trim((string)($dados['nome'] ?? ''));
        $nota = (int)($dados['nota'] ?? 0);
        $comentario = trim((string)($dados['comentario'] ?? ''));

        if (mb_strlen($nome) < 2 || $nota < 1 || $nota > 5) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'erro' => 'Selecione uma nota de 1 a 5 estrelas.']);
            exit;
        }

        $nome = mb_substr($nome, 0, 120);
        $comentario = mb_substr($comentario, 0, 1000);

        $stmt = $pdo->prepare(
            'INSERT INTO feedbacks (acesso_id, nome_usuario, nota, comentario, data_hora) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$acessoId, $nome, $nota, $comentario, $agora]);

        echo json_encode(['ok' => true]);
        exit;
    }

    http_response_code(400);
    echo json_encode(['ok' => false, 'erro' => 'Ação desconhecida.']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'erro' => 'Erro ao gravar dados no servidor.']);
}