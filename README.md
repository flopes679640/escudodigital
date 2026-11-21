# 🛡️ Escudo Digital – Portal Comunitário de Segurança Digital

Projeto desenvolvido para a disciplina **Atividade Extensionista II** (Escola Superior Politécnica – UNINTER), com o objetivo de promover inclusão digital e capacitar moradores da comunidade local na prevenção contra golpes virtuais.

## 🎯 Alinhamento aos ODS (ONU)
- **ODS 4 – Educação de Qualidade:** conteúdo educativo gratuito e interativo sobre segurança digital.
- **ODS 10 – Redução das Desigualdades:** inclusão digital voltada a diferentes faixas etárias.
- **ODS 16 – Paz, Justiça e Instituições Eficazes:** conscientização em segurança da informação e prevenção a fraudes.

## ♿ Desenho Universal e Acessibilidade
- Controle de tamanho de fonte (`A+` / `A-`).
- Modo de **Alto Contraste** para baixa visão.
- Leitura em voz alta nativa (*Web Speech API* em português).
- Interface responsiva, intuitiva e com validação tolerante a erros.

## 🧩 Funcionalidades
1. **Identificação e Registro de Fluxo de Acessos:** grava nome, faixa etária, data e horário de cada participante no banco de dados.
2. **Guias Rápidos:** explicação clara dos 5 golpes digitais mais comuns no Brasil.
3. **Quiz Interativo ("É Golpe ou é Seguro?"):** 5 cenários reais com explicação imediata e pontuação final.
4. **Avaliação Integrada:** coleta de notas (1 a 5 estrelas) e comentários da comunidade.
5. **Painel de Evidências (`admin.php`):** consolida acessos, resultados e feedbacks para comprovação do impacto.

## 🛠️ Tecnologias Utilizadas
- PHP 8+ (PDO)
- MariaDB
- HTML5, CSS3 e JavaScript puro

## 🚀 Como executar
1. Importe o arquivo `schema.sql` no MySQL.
2. Copie `config.example.php` para `config.php` e informe as credenciais do banco.
3. Publique a pasta em um servidor web com PHP (Apache/Nginx) e acesse `index.php`.