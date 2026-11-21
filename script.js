const params = new URLSearchParams(window.location.search);
if (params.get('novo') === '1') {
  sessionStorage.removeItem('escudo_usuario');
  window.history.replaceState({}, '', window.location.pathname);
}


let usuarioAtual = { acesso_id: null, nome: '', data_hora: '' };
let quizFinalizado = false;
let acertos = 0;


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

    document.getElementById('obgNome').textContent = usuarioAtual.nome;
    document.getElementById('obgQuiz').textContent = `${acertos} de ${perguntas.length} acertos`;
    document.getElementById('obgNota').textContent = `${'★'.repeat(notaSelecionada)} (${notaSelecionada}/5)`;
    document.getElementById('obgData').textContent = usuarioAtual.data_hora;

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