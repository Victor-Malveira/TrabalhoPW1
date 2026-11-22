# Roteiro de execução — TestCase Studio
Todos os casos abaixo estão **Não executados** até serem realizados no XAMPP com a extensão ativa. Use dados fictícios.

| ID | Cenário | Passos a gravar no navegador | Resultado esperado | Status |
| --- | --- | --- | --- | --- |
| TC-01 | Cadastrar empresa | Abrir cadastro de empresa, preencher nome, e-mail único, senha e telefone; clicar Salvar | Alerta de sucesso; empresa disponível na busca | Não executado |
| TC-02 | Login da empresa | Abrir login, digitar e-mail e senha válidos; clicar Autenticar | Mensagem de sucesso e abertura da área da empresa | Não executado |
| TC-03 | Login incorreto de empresa | Digitar e-mail cadastrado e senha inválida; clicar Autenticar | Mensagem de erro e acesso negado | Não executado |
| TC-04 | Cadastrar candidato | Abrir cadastro, preencher nome, e-mail único, senha, telefone e formato do currículo; clicar Cadastrar | Mensagem de sucesso; candidato cadastrado | Não executado |
| TC-05 | Login do candidato | Abrir login do candidato, inserir credenciais corretas e entrar | Área do candidato e nome apresentado | Não executado |
| TC-06 | Buscar empresa | Abrir a busca, digitar parte do nome e clicar Buscar | Empresas correspondentes exibidas no resultado | Não executado |
| TC-07 | Avaliar empresa | Estar logado como candidato; buscar empresa; selecionar nota e acessibilidade, escrever comentário; enviar avaliação | Confirmação do cadastro e avaliação visível na página da empresa | Não executado |
| TC-08 | Consultar avaliações | Abrir Ver avaliações de uma empresa | Nome da empresa e notas/comentários exibidos | Não executado |
| TC-09 | Editar candidato | Na área do candidato, entrar em Editar meu perfil, alterar telefone e formato; salvar | Mensagem de sucesso e alterações persistidas após recarregar | Não executado |
| TC-10 | Sair do candidato | Na área do candidato, clicar Sair | Redirecionamento para autenticação | Não executado |

## Para registrar as evidências
1. Abra TestCase Studio no navegador, comece uma gravação e execute **um cenário por vez**.
2. Exporte ou copie os passos capturados e salve como evidência com o ID do cenário.
3. Anote o resultado observado e substitua **Não executado** por **Aprovado** ou **Reprovado**, conforme os fatos.
4. Faça capturas de tela da interface e, quando aplicável, do resultado no Postman.

## Modelo de execução
- **ID:** TC-__
- **Data e ambiente:** ___ / XAMPP, PHP, MySQL, navegador
- **Dados utilizados:** ___
- **Resultado esperado:** ___
- **Resultado observado:** ___
- **Status:** Não executado / Aprovado / Reprovado
- **Evidências:** imagem/arquivo exportado e descrição do que comprova

**Nota:** o TestCase Studio documenta as interações de navegação; não executamos o navegador local aqui e não foi produzido arquivo de gravação autêntica da extensão.
