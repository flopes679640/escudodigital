<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escudo Digital – Segurança Digital para a Comunidade</title>
  <style>
    :root {
      --bg: #f4f7fb;
      --surface: #ffffff;
      --primary: #0f2942;
      --accent: #0d9488;
      --accent-hover: #0f766e;
      --danger: #dc2626;
      --success: #15803d;
      --text: #1e293b;
      --muted: #475569;
      --border: #cbd5e1;
      --radius: 12px;
    }

    html { font-size: 16px; scroll-behavior: smooth; }
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    /* Modo Alto Contraste (Desenho Universal) */
    body.alto-contraste {
      --bg: #000000;
      --surface: #111111;
      --primary: #000000;
      --accent: #facc15;
      --accent-hover: #eab308;
      --danger: #ff6b6b;
      --success: #4ade80;
      --text: #ffffff;
      --muted: #facc15;
      --border: #facc15;
    }
    body.alto-contraste .btn-primary,
    body.alto-contraste .badge {
      color: #000000 !important;
      font-weight: 700;
    }

    /* Barra de Acessibilidade */
    .a11y-bar {
      position: sticky;
      top: 0;
      z-index: 100;
      background: var(--primary);
      color: #fff;
      padding: 0.55rem 1rem;
      border-bottom: 2px solid var(--accent);
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
    }
    .a11y-bar span { font-size: 0.85rem; opacity: 0.95; }
    .a11y-controls { display: flex; flex-wrap: wrap; gap: 0.4rem; }
    .a11y-btn {
      background: rgba(255,255,255,0.14);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.35);
      border-radius: 6px;
      padding: 0.35rem 0.65rem;
      font-size: 0.85rem;
      cursor: pointer;
      font-weight: 600;
    }
    .a11y-btn:hover, .a11y-btn:focus {
      background: var(--accent);
      border-color: var(--accent);
      outline: 2px solid #fff;
    }

    .container {
      max-width: 880px;
      margin: 0 auto;
      padding: 1.25rem;
    }

    header.hero {
      background: var(--primary);
      color: #fff;
      padding: 2rem 1.25rem;
      text-align: center;
      border-bottom: 4px solid var(--accent);
    }
    header.hero h1 { margin: 0 0 0.5rem; font-size: 1.9rem; }
    header.hero p { margin: 0 auto; max-width: 650px; font-size: 1.05rem; opacity: 0.92; }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 8px rgba(15, 41, 66, 0.06);
    }

    h2 {
      margin-top: 0;
      font-size: 1.4rem;
      border-left: 5px solid var(--accent);
      padding-left: 0.75rem;
    }

    label { display: block; font-weight: 600; margin-bottom: 0.35rem; }
    input[type="text"], select, textarea {
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
      border: 2px solid var(--border);
      border-radius: 8px;
      background: var(--surface);
      color: var(--text);
      margin-bottom: 1rem;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--accent);
    }

    .btn {
      display: inline-block;
      border: none;
      border-radius: 8px;
      padding: 0.85rem 1.4rem;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: transform 0.1s ease, background 0.15s ease;
    }
    .btn:active { transform: scale(0.98); }
    .btn-primary { background: var(--accent); color: #fff; width: 100%; }
    .btn-primary:hover { background: var(--accent-hover); }
    .btn-outline {
      background: transparent;
      color: var(--text);
      border: 2px solid var(--border);
      padding: 0.65rem 1.15rem;
      font-size: 0.92rem;
    }
    .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
    .btn-danger { background: var(--danger); color: #fff; flex: 1; }
    .btn-success { background: var(--success); color: #fff; flex: 1; }

    .hidden { display: none !important; }

    .boas-vindas {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 0.75rem;
      background: var(--surface);
      border: 2px solid var(--accent);
      border-radius: var(--radius);
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
    }
    .boas-vindas-acoes {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-wrap: wrap;
    }
    .badge {
      background: var(--accent);
      color: #fff;
      padding: 0.25rem 0.7rem;
      border-radius: 999px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    .link-discreto {
      font-size: 0.85rem;
      color: var(--muted);
      text-decoration: underline;
    }

    /* Guias de Golpes */
    .golpe-item {
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 1rem 1.15rem;
      margin-bottom: 0.9rem;
    }
    .golpe-item summary {
      font-weight: 700;
      font-size: 1.08rem;
      cursor: pointer;
      list-style: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .golpe-item summary::after { content: "▼"; font-size: 0.8rem; color: var(--accent); }
    .golpe-item[open] summary::after { content: "▲"; }
    .golpe-body { margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px dashed var(--border); }
    .golpe-body p { margin: 0.4rem 0; }

    /* Quiz */
    .quiz-box {
      border: 2px solid var(--border);
      border-radius: 10px;
      padding: 1.25rem;
    }
    .quiz-progresso {
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--muted);
      margin-bottom: 0.5rem;
    }
    .quiz-cenario {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 1.1rem;
      padding: 1rem;
      background: rgba(13, 148, 136, 0.08);
      border-radius: 8px;
    }
    .quiz-acoes { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .quiz-retorno {
      margin-top: 1rem;
      padding: 1rem;
      border-radius: 8px;
      font-weight: 600;
    }
    .retorno-ok { background: rgba(21, 128, 61, 0.14); border: 1px solid var(--success); }
    .retorno-erro { background: rgba(220, 38, 38, 0.14); border: 1px solid var(--danger); }

    /* Estrelas de Avaliação */
    .estrelas {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    .estrela-btn {
      font-size: 2rem;
      background: none;
      border: 2px solid var(--border);
      border-radius: 8px;
      padding: 0.25rem 0.65rem;
      cursor: pointer;
      color: #94a3b8;
    }
    .estrela-btn.ativa {
      color: #eab308;
      border-color: #eab308;
      background: rgba(234, 179, 8, 0.12);
    }

    .aviso-bloqueio {
      padding: 1rem;
      border-radius: 8px;
      border: 1px dashed var(--border);
      background: rgba(15, 41, 66, 0.04);
      color: var(--muted);
      font-weight: 600;
    }

    .aviso-privacidade {
      font-size: 0.85rem;
      color: var(--muted);
      margin-top: 0.75rem;
    }
    .msg-erro { color: var(--danger); font-weight: 700; margin-bottom: 0.75rem; }
    .msg-sucesso {
      padding: 1rem;
      border-radius: 8px;
      border: 2px solid var(--success);
      background: rgba(21, 128, 61, 0.12);
      font-weight: 600;
    }

    /* Tela Final de Agradecimento */
    .tela-obrigado {
      text-align: center;
      padding: 2rem 1.5rem;
      border: 2px solid var(--success);
    }
    .tela-obrigado .icone-ok {
      font-size: 3.2rem;
      margin-bottom: 0.5rem;
    }
    .tela-obrigado h2 {
      border-left: none;
      padding-left: 0;
      font-size: 1.6rem;
      margin-bottom: 0.5rem;
    }
    .resumo-participacao {
      display: inline-block;
      text-align: left;
      margin: 1.25rem auto;
      padding: 1rem 1.25rem;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: rgba(13, 148, 136, 0.06);
      max-width: 100%;
    }
    .resumo-participacao p { margin: 0.35rem 0; }
    .acoes-finais {
      margin-top: 1.5rem;
      padding-top: 1.25rem;
      border-top: 1px dashed var(--border);
    }

    footer {
      text-align: center;
      padding: 1.5rem 1rem 2.5rem;
      font-size: 0.88rem;
      color: var(--muted);
    }
    footer a { color: var(--accent); font-weight: 600; }
  </style>
</head>
<body>

  <!-- Barra de Acessibilidade (Desenho Universal) -->
  <nav class="a11y-bar" aria-label="Barra de acessibilidade">
    <span>Acessibilidade:</span>
    <div class="a11y-controls">
      <button type="button" class="a11y-btn" id="btnFonteMenos" aria-label="Diminuir tamanho da letra">A-</button>
      <button type="button" class="a11y-btn" id="btnFonteMais" aria-label="Aumentar tamanho da letra">A+</button>
      <button type="button" class="a11y-btn" id="btnContraste" aria-pressed="false">Alto Contraste</button>
      <button type="button" class="a11y-btn" id="btnOuvir">🔊 Ouvir Página</button>
    </div>
  </nav>

  <header class="hero">
    <h1>🛡️ Escudo Digital</h1>
    <p>Portal gratuito de orientação e treinamento prático contra golpes digitais na nossa comunidade.</p>
  </header>

  <main class="container" id="conteudoPrincipal">

    <!-- ETAPA 1: Identificação rápida para registro de acesso -->
    <section class="card" id="secaoEntrada">
      <h2>Bem-vindo(a)! Identifique-se para acessar</h2>
      <p>Em menos de 3 minutos você conhece os golpes mais comuns da internet e testa seus reflexos no nosso quiz interativo.</p>

      <div id="erroEntrada" class="msg-erro hidden" role="alert"></div>

      <form id="formEntrada">
        <label for="nomeUsuario">Seu nome completo *</label>
        <input type="text" id="nomeUsuario" name="nome" placeholder="Ex.: Maria Aparecida Silva" required autocomplete="name">

        <label for="faixaEtaria">Faixa etária (opcional)</label>
        <select id="faixaEtaria" name="faixa_etaria">
          <option value="Não informada">Prefiro não informar</option>
          <option value="Até 25 anos">Até 25 anos</option>
          <option value="26 a 40 anos">26 a 40 anos</option>
          <option value="41 a 59 anos">41 a 59 anos</option>
          <option value="60 anos ou mais">60 anos ou mais</option>
        </select>

        <button type="submit" class="btn btn-primary" id="btnEntrar">Acessar o Portal Gratuito</button>
      </form>

      <p class="aviso-privacidade">
        🔒 <strong>Privacidade:</strong> seu nome e horário de acesso são registrados apenas para comprovação acadêmica de impacto comunitário (Atividade Extensionista – UNINTER). Nenhum dado bancário, senha ou telefone é solicitado.
      </p>
    </section>

    <!-- CONTEÚDO DO PORTAL (liberado após identificação) -->
    <div id="areaPortal" class="hidden">

      <div class="boas-vindas">
        <div>
          <strong>Olá, <span id="spanNome"></span>!</strong><br>
          <small>Acesso registrado em <span id="spanDataHora"></span></small>
        </div>
        <div class="boas-vindas-acoes">
          <span class="badge">Portal Ativo</span>
          <a href="index.php?novo=1" class="link-discreto">Trocar usuário</a>
        </div>
      </div>

      <!-- SEÇÃO 2: Guias rápidos dos 5 golpes -->
      <section class="card">
        <h2>1. Os 5 golpes mais comuns (toque para ler)</h2>

        <details class="golpe-item" open>
          <summary>💬 Golpe do Falso Parente no WhatsApp</summary>
          <div class="golpe-body">
            <p><strong>Como funciona:</strong> um golpista usa a foto de um familiar com um número novo dizendo "troquei de celular" e pede um Pix urgente para pagar uma conta.</p>
            <p><strong>Como se proteger:</strong> nunca faça Pix apenas por mensagem. Faça uma <strong>ligação de vídeo ou de voz</strong> para o número antigo da pessoa antes de transferir qualquer valor.</p>
          </div>
        </details>

        <details class="golpe-item">
          <summary>🔗 Links Falsos (Phishing) de Bancos, Correios e Promoções</summary>
          <div class="golpe-body">
            <p><strong>Como funciona:</strong> mensagens por SMS, e-mail ou WhatsApp com urgência ("sua entrega foi taxada", "sua conta será bloqueada hoje") levando a sites falsos que roubam senhas e cartões.</p>
            <p><strong>Como se proteger:</strong> desconfie de urgência. Não clique no link da mensagem — abra você mesmo o aplicativo oficial do banco ou dos Correios.</p>
          </div>
        </details>

        <details class="golpe-item">
          <summary>📞 Falsa Central Telefônica de Banco</summary>
          <div class="golpe-body">
            <p><strong>Como funciona:</strong> alguém liga fingindo ser da segurança do banco dizendo que houve uma compra suspeita e pede para você instalar um aplicativo ou digitar códigos/senhas para "cancelar".</p>
            <p><strong>Como se proteger:</strong> bancos <strong>nunca</strong> pedem senhas, códigos de SMS, transferências de "estorno" nem a entrega do cartão a um motoboy. Desligue e ligue de outro aparelho para o número atrás do seu cartão.</p>
          </div>
        </details>

        <details class="golpe-item">
          <summary>📱 Clonagem / Roubo de Conta do WhatsApp</summary>
          <div class="golpe-body">
            <p><strong>Como funciona:</strong> o golpista finge ser de um anúncio, sorteio ou pesquisa e pede um código de 6 dígitos que acabou de chegar no seu SMS.</p>
            <p><strong>Como se proteger:</strong> nunca informe códigos recebidos por SMS a ninguém e ative a <strong>Confirmação em Duas Etapas</strong> no menu <em>Configurações → Conta</em> do WhatsApp.</p>
          </div>
        </details>

        <details class="golpe-item">
          <summary>💸 Falso Pix Agendado e Boletos Adulterados</summary>
          <div class="golpe-body">
            <p><strong>Como funciona:</strong> comprovantes falsos de Pix (ou Pix agendado e depois cancelado) e boletos alterados que direcionam o dinheiro para a conta de um terceiro.</p>
            <p><strong>Como se proteger:</strong> ao receber Pix, confira sempre se o saldo <strong>realmente entrou no extrato</strong>. Ao pagar boletos, verifique sempre o nome e o CNPJ do beneficiário antes de confirmar.</p>
          </div>
        </details>
      </section>

      <!-- SEÇÃO 3: Quiz Interativo -->
      <section class="card" id="secaoQuiz">
        <h2>2. Quiz Prático: É Golpe ou é Seguro?</h2>
        <p>Leia cada situação do dia a dia e escolha a resposta correta:</p>

        <div class="quiz-box" id="quizContainer">
          <div class="quiz-progresso" id="quizProgresso"></div>
          <div class="quiz-cenario" id="quizCenario"></div>

          <div class="quiz-acoes" id="quizBotoes">
            <button type="button" class="btn btn-danger" onclick="responderQuiz(true)">🚨 É GOLPE</button>
            <button type="button" class="btn btn-success" onclick="responderQuiz(false)">✅ É SEGURO</button>
          </div>

          <div id="quizRetorno" class="quiz-retorno hidden"></div>
          <button type="button" class="btn btn-primary hidden" id="btnProxima" style="margin-top: 1rem;" onclick="proximaPergunta()">Próxima Pergunta →</button>
        </div>

        <div id="quizResultado" class="hidden" style="margin-top: 1rem;"></div>
      </section>

      <!-- SEÇÃO 4: Feedback da Comunidade -->
      <section class="card" id="secaoFeedback">
        <h2>3. Avalie o Portal (Etapa Final)</h2>

        <div id="avisoFeedbackBloqueado" class="aviso-bloqueio">
          🔒 Responda às 5 perguntas do quiz acima para liberar sua avaliação e concluir sua participação.
        </div>

        <div id="blocoFormFeedback" class="hidden">
          <p>Este portal ajudou você a se sentir mais preparado(a) contra golpes digitais?</p>

          <div id="erroFeedback" class="msg-erro hidden" role="alert"></div>

          <form id="formFeedback">
            <label>Sua nota (toque nas estrelas) *</label>
            <div class="estrelas" role="radiogroup" aria-label="Nota de 1 a 5 estrelas">
              <button type="button" class="estrela-btn" data-nota="1" aria-label="1 estrela">★</button>
              <button type="button" class="estrela-btn" data-nota="2" aria-label="2 estrelas">★</button>
              <button type="button" class="estrela-btn" data-nota="3" aria-label="3 estrelas">★</button>
              <button type="button" class="estrela-btn" data-nota="4" aria-label="4 estrelas">★</button>
              <button type="button" class="estrela-btn" data-nota="5" aria-label="5 estrelas">★</button>
            </div>

            <label for="comentarioFeedback">Deixe um comentário ou sugestão (opcional)</label>
            <textarea id="comentarioFeedback" rows="3" placeholder="Ex.: Muito claro e fácil de usar, aprendi sobre a falsa central do banco!"></textarea>

            <button type="submit" class="btn btn-primary" id="btnEnviarFeedback">Concluir e Enviar Avaliação</button>
          </form>
        </div>
      </section>

    </div>

    <!-- ETAPA FINAL: Tela de Agradecimento (sem interação com a sessão concluída) -->
    <section class="card tela-obrigado hidden" id="secaoAgradecimento" aria-live="polite">
      <div class="icone-ok">✅</div>
      <h2>Muito obrigado pela sua participação!</h2>
      <p>Sua contribuição foi registrada com sucesso e ajuda diretamente a fortalecer a segurança digital na nossa comunidade.</p>

      <div class="resumo-participacao">
        <p><strong>Participante:</strong> <span id="obgNome"></span></p>
        <p><strong>Desempenho no Quiz:</strong> <span id="obgQuiz"></span></p>
        <p><strong>Avaliação enviada:</strong> <span id="obgNota"></span></p>
        <p><strong>Registro em:</strong> <span id="obgData"></span></p>
      </div>

      <p>Você já pode fechar esta página. Se quiser, compartilhe o link do <strong>Escudo Digital</strong> com familiares e amigos!</p>

      <div class="acoes-finais">
        <p style="font-size: 0.88rem; color: var(--muted); margin: 0 0 0.75rem;">
          Outra pessoa da família vai participar usando este mesmo aparelho?
        </p>
        <a href="index.php?novo=1" class="btn btn-outline">Registrar outra pessoa neste aparelho</a>
      </div>
    </section>

  </main>

  <footer>
    Projeto comunitário de Inclusão e Segurança Digital – Atividade Extensionista II (UNINTER)<br>
    Alinhado aos ODS 4, 10 e 16 da ONU | <a href="admin.php">Área de Gestão</a>
  </footer>

  <script>
    // Limpa sessão automaticamente quando acessado com ?novo=1 (ex.: vindo do admin.php)
    const params = new URLSearchParams(window.location.search);
    if (params.get('novo') === '1') {
      sessionStorage.removeItem('escudo_usuario');
      window.history.replaceState({}, '', window.location.pathname);
    }

    // Estado do usuário atual
    let usuarioAtual = { acesso_id: null, nome: '', data_hora: '' };
    let quizFinalizado = false;
    let acertos = 0;

    // === ACESSIBILIDADE (Desenho Universal) ===
    let tamanhoFonte = 16;
    document.getElementById('btnFonteMais').addEventListener('click', () => {
      if (tamanhoFonte < 22) {
        tamanhoFonte += 2;
        document.documentElement.style.fontSize = tamanhoFonte + 'px';
      }
    });
    document.getElementById('btnFonteMenos').addEventListener('click', () => {
      if (tamanhoFonte > 14) {
        tamanhoFonte -= 2;
        document.documentElement.style.fontSize = tamanhoFonte + 'px';
      }
    });
    document.getElementById('btnContraste').addEventListener('click', (e) => {
      const ativo = document.body.classList.toggle('alto-contraste');
      e.target.setAttribute('aria-pressed', ativo ? 'true' : 'false');
    });

    let falando = false;
    function pararLeitura() {
      if (falando && 'speechSynthesis' in window) {
        window.speechSynthesis.cancel();
        falando = false;
        document.getElementById('btnOuvir').textContent = '🔊 Ouvir Página';
      }
    }
    document.getElementById('btnOuvir').addEventListener('click', (e) => {
      if (!('speechSynthesis' in window)) {
        alert('Seu navegador não suporta leitura em voz alta.');
        return;
      }
      if (falando) {
        pararLeitura();
        return;
      }
      const texto = document.getElementById('conteudoPrincipal').innerText;
      const fala = new SpeechSynthesisUtterance(texto);
      fala.lang = 'pt-BR';
      fala.onend = () => {
        falando = false;
        e.target.textContent = '🔊 Ouvir Página';
      };
      falando = true;
      e.target.textContent = '⏹️ Parar Leitura';
      window.speechSynthesis.speak(fala);
    });

    // === ENTRADA E REGISTRO DE ACESSO ===
    function abrirPortal(dados) {
      usuarioAtual = dados;
      sessionStorage.setItem('escudo_usuario', JSON.stringify(dados));
      document.getElementById('spanNome').textContent = dados.nome;
      document.getElementById('spanDataHora').textContent = dados.data_hora;
      document.getElementById('secaoEntrada').classList.add('hidden');
      document.getElementById('secaoAgradecimento').classList.add('hidden');
      document.getElementById('areaPortal').classList.remove('hidden');
      iniciarQuiz();
    }

    const salvo = sessionStorage.getItem('escudo_usuario');
    if (salvo) {
      try { abrirPortal(JSON.parse(salvo)); } catch (_) { sessionStorage.removeItem('escudo_usuario'); }
    }

    document.getElementById('formEntrada').addEventListener('submit', async (e) => {
      e.preventDefault();
      const erroEl = document.getElementById('erroEntrada');
      erroEl.classList.add('hidden');

      const nome = document.getElementById('nomeUsuario').value.trim();
      const faixa_etaria = document.getElementById('faixaEtaria').value;
      const btn = document.getElementById('btnEntrar');
      btn.disabled = true;
      btn.textContent = 'Registrando acesso...';

      try {
        const resp = await fetch('api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ acao: 'registrar_acesso', nome, faixa_etaria })
        });
        const json = await resp.json();
        if (!json.ok) throw new Error(json.erro || 'Não foi possível entrar.');
        abrirPortal({ acesso_id: json.acesso_id, nome: json.nome, data_hora: json.data_hora });
      } catch (err) {
        erroEl.textContent = err.message;
        erroEl.classList.remove('hidden');
        btn.disabled = false;
        btn.textContent = 'Acessar o Portal Gratuito';
      }
    });

    // === QUIZ INTERATIVO ===
    const perguntas = [
      {
        cenario: 'Você recebe uma mensagem de um número desconhecido com a foto do seu filho dizendo: "Oi, troquei de número. Pode pagar um boleto de R$ 650 no Pix agora? Depois te devolvo."',
        ehGolpe: true,
        explicacao: 'É GOLPE! Esse é o golpe do falso parente. Sempre ligue por voz ou vídeo para o número antigo da pessoa antes de fazer qualquer transferência.'
      },
      {
        cenario: 'Você acessa diretamente o aplicativo oficial do seu banco (instalado da loja oficial) para consultar seu extrato e pagar uma conta de luz conferindo o nome da concessionária.',
        ehGolpe: false,
        explicacao: 'É SEGURO! Usar o aplicativo oficial diretamente e conferir os dados do recebedor antes de pagar é a prática correta.'
      },
      {
        cenario: 'Um atendente liga dizendo ser da segurança do banco e pede para você instalar um aplicativo de "suporte remoto" no celular para cancelar uma compra suspeita.',
        ehGolpe: true,
        explicacao: 'É GOLPE! Bancos jamais pedem instalação de aplicativos de acesso remoto. Com ele, o golpista controla seu celular e acessa suas contas.'
      },
      {
        cenario: 'Você recebe um SMS dizendo: "Seu pacote foi taxado na alfândega, clique em bit.ly/taxa-hoje e pague R$ 28 em até 2 horas para não perder a encomenda."',
        ehGolpe: true,
        explicacao: 'É GOLPE! Links encurtados e senso de urgência são sinais clássicos de phishing. Consulte encomendas apenas no site ou app oficial dos Correios.'
      },
      {
        cenario: 'Você ativa a Confirmação em Duas Etapas dentro das configurações do seu próprio WhatsApp, criando um PIN de 6 dígitos que apenas você conhece.',
        ehGolpe: false,
        explicacao: 'É SEGURO! A confirmação em duas etapas é uma das melhores barreiras para impedir que clonem sua conta do WhatsApp.'
      }
    ];

    let indiceAtual = 0;
    let respondeu = false;

    function iniciarQuiz() {
      indiceAtual = 0;
      acertos = 0;
      quizFinalizado = false;
      document.getElementById('quizContainer').classList.remove('hidden');
      document.getElementById('quizResultado').classList.add('hidden');
      document.getElementById('avisoFeedbackBloqueado').classList.remove('hidden');
      document.getElementById('blocoFormFeedback').classList.add('hidden');
      mostrarPergunta();
    }

    function mostrarPergunta() {
      respondeu = false;
      const p = perguntas[indiceAtual];
      document.getElementById('quizProgresso').textContent = `Pergunta ${indiceAtual + 1} de ${perguntas.length}`;
      document.getElementById('quizCenario').textContent = p.cenario;
      document.getElementById('quizBotoes').classList.remove('hidden');
      document.getElementById('quizRetorno').classList.add('hidden');
      document.getElementById('btnProxima').classList.add('hidden');
    }

    function responderQuiz(escolheuGolpe) {
      if (respondeu) return;
      respondeu = true;
      const p = perguntas[indiceAtual];
      const acertou = (escolheuGolpe === p.ehGolpe);
      if (acertou) acertos++;

      const retorno = document.getElementById('quizRetorno');
      retorno.className = 'quiz-retorno ' + (acertou ? 'retorno-ok' : 'retorno-erro');
      retorno.textContent = (acertou ? '✅ Acertou! ' : '❌ Atenção! ') + p.explicacao;
      retorno.classList.remove('hidden');

      document.getElementById('quizBotoes').classList.add('hidden');
      const btnProx = document.getElementById('btnProxima');
      btnProx.textContent = (indiceAtual + 1 < perguntas.length) ? 'Próxima Pergunta →' : 'Ver Meu Resultado';
      btnProx.classList.remove('hidden');
    }

    async function proximaPergunta() {
      indiceAtual++;
      if (indiceAtual < perguntas.length) {
        mostrarPergunta();
        return;
      }

      quizFinalizado = true;
      document.getElementById('quizContainer').classList.add('hidden');
      const res = document.getElementById('quizResultado');
      let nivel = 'Atenção redobrada! Vale reler os 5 guias acima.';
      if (acertos === 5) nivel = 'Excelente! Você está muito bem preparado(a) contra golpes.';
      else if (acertos >= 3) nivel = 'Bom desempenho! Continue sempre desconfiando de pedidos urgentes.';

      res.className = 'msg-sucesso';
      res.innerHTML = `<strong>Resultado Final: ${acertos} de ${perguntas.length} acertos!</strong><br>${nivel}`;
      res.classList.remove('hidden');

      // Libera a seção de avaliação
      document.getElementById('avisoFeedbackBloqueado').classList.add('hidden');
      document.getElementById('blocoFormFeedback').classList.remove('hidden');

      if (usuarioAtual.acesso_id) {
        try {
          await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              acao: 'salvar_quiz',
              acesso_id: usuarioAtual.acesso_id,
              pontuacao: acertos
            })
          });
        } catch (_) {}
      }

      document.getElementById('secaoFeedback').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // === AVALIAÇÃO / FEEDBACK ===
    let notaSelecionada = 0;
    const botoesEstrela = document.querySelectorAll('.estrela-btn');
    botoesEstrela.forEach(btn => {
      btn.addEventListener('click', () => {
        notaSelecionada = parseInt(btn.dataset.nota, 10);
        botoesEstrela.forEach(b => {
          b.classList.toggle('ativa', parseInt(b.dataset.nota, 10) <= notaSelecionada);
        });
      });
    });

    document.getElementById('formFeedback').addEventListener('submit', async (e) => {
      e.preventDefault();
      if (!quizFinalizado) return;

      const erroEl = document.getElementById('erroFeedback');
      erroEl.classList.add('hidden');

      if (notaSelecionada < 1) {
        erroEl.textContent = 'Por favor, toque em uma das estrelas (1 a 5) para avaliar.';
        erroEl.classList.remove('hidden');
        return;
      }

      const btn = document.getElementById('btnEnviarFeedback');
      btn.disabled = true;
      btn.textContent = 'Finalizando...';

      try {
        const resp = await fetch('api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            acao: 'salvar_feedback',
            acesso_id: usuarioAtual.acesso_id,
            nome: usuarioAtual.nome,
            nota: notaSelecionada,
            comentario: document.getElementById('comentarioFeedback').value.trim()
          })
        });
        const json = await resp.json();
        if (!json.ok) throw new Error(json.erro || 'Erro ao enviar avaliação.');

        // Preenche a tela final de agradecimento
        document.getElementById('obgNome').textContent = usuarioAtual.nome;
        document.getElementById('obgQuiz').textContent = `${acertos} de ${perguntas.length} acertos`;
        document.getElementById('obgNota').textContent = `${'★'.repeat(notaSelecionada)} (${notaSelecionada}/5)`;
        document.getElementById('obgData').textContent = usuarioAtual.data_hora;

        // Encerra e limpa a sessão para não permitir reenvio nem reabrir a mesma sessão
        pararLeitura();
        sessionStorage.removeItem('escudo_usuario');
        usuarioAtual = { acesso_id: null, nome: '', data_hora: '' };

        document.getElementById('areaPortal').classList.add('hidden');
        document.getElementById('secaoAgradecimento').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } catch (err) {
        erroEl.textContent = err.message;
        erroEl.classList.remove('hidden');
        btn.disabled = false;
        btn.textContent = 'Concluir e Enviar Avaliação';
      }
    });
  </script>
</body>
</html>