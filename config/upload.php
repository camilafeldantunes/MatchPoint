<?php

/**
 * Processa e valida o upload de uma imagem com segurança.
 *
 * @param  array       $file        Entrada de $_FILES['campo']
 * @param  string      $pasta       Caminho físico da pasta de destino
 * @param  string|null $fotoAntiga  Caminho da foto atual (para manter se não enviar nova)
 * @return array ['sucesso' => bool, 'caminho' => string|null, 'erro' => string|null]
 */
function processarUploadImagem(array $file, string $pasta, ?string $fotoAntiga = null): array
{
    // Nenhum arquivo enviado — mantém a foto antiga
    if (empty($file['name'])) {
        return ['sucesso' => true, 'caminho' => $fotoAntiga, 'erro' => null];
    }

    // ── 1. Erro no upload reportado pelo PHP ──────────────────────────
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['sucesso' => false, 'caminho' => null, 'erro' => 'Falha no envio do arquivo.'];
    }

    // ── 2. Tamanho máximo: 2 MB ───────────────────────────────────────
    $maxBytes = 2 * 1024 * 1024;
    if ($file['size'] > $maxBytes) {
        return ['sucesso' => false, 'caminho' => null, 'erro' => 'A imagem deve ter no máximo 2 MB.'];
    }

    // ── 3. Extensão permitida (não confiar sozinha, mas usada no nome) ─
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
    $info = pathinfo($file['name']);
    $extensao = strtolower($info['extension'] ?? '');

    if (!in_array($extensao, $extensoesPermitidas)) {
        return ['sucesso' => false, 'caminho' => null, 'erro' => 'Formato inválido. Use JPG, PNG ou WEBP.'];
    }

    // ── 4. Tipo MIME real do arquivo (lê os bytes, ignora o que o browser diz) ──
    $mimePermitidos = ['image/jpeg', 'image/png', 'image/webp'];
    $mimeReal = mime_content_type($file['tmp_name']);

    if (!in_array($mimeReal, $mimePermitidos)) {
        return ['sucesso' => false, 'caminho' => null, 'erro' => 'O arquivo enviado não é uma imagem válida.'];
    }

    // ── 5. Nome único — não usa o nome original do usuário ────────────
    $nomeUnico = uniqid('img_', true) . '.' . $extensao;

    // ── 6. Garante que a pasta existe ─────────────────────────────────
    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    // ── 7. Evita sobrescrita mesmo com uniqid (paranoia extra) ────────
    $destino = $pasta . $nomeUnico;
    while (file_exists($destino)) {
        $nomeUnico = uniqid('img_', true) . '.' . $extensao;
        $destino   = $pasta . $nomeUnico;
    }

    // ── 8. Move o arquivo para o destino final ────────────────────────
    if (!move_uploaded_file($file['tmp_name'], $destino)) {
        return ['sucesso' => false, 'caminho' => null, 'erro' => 'Não foi possível salvar a imagem.'];
    }

    return [
        'sucesso' => true,
        'caminho' => '/MATCHPOINT/fotos/' . $nomeUnico,
        'erro'    => null
    ];
}