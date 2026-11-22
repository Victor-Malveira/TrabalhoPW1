# Testes do TrabalhoPW1 — Postman e TestCase Studio

## Pré-requisitos
1. Inicie Apache e MySQL no XAMPP, importe o banco `gestao.sql` e confirme a conexão.
2. Abra `http://localhost/TrabalhoPW1-main/` (ajuste o nome da pasta conforme sua instalação).
3. Use apenas **contas e registros criados para testes**; não utilize dados reais.
4. Guarde capturas com data, resultado e identificação do teste. **Ainda não há resultados executados**.

## 1. Postman (API JSON)
1. No Postman, clique em **Import**, selecione `postman/TrabalhoPW1.postman_collection.json`. 
2. Configure as variáveis da coleção: `baseUrl`, `empresaEmail`, `empresaSenha`, `empresaId`, `candidatoEmail`, `candidatoSenha`, `candidatoId` e `avaliacaoId`. Use e-mails exclusivos de teste e não publique senhas reais.
3. Faça **Send** em cada requisição. O corpo usa **Body → raw → JSON**, método **POST**, cabeçalho `Content-Type: application/json`.
4. Execute o cadastro, autenticação e busca; obtenha os IDs pelo retorno da busca e preencha as variáveis antes de editar ou avaliar.
5. Para salvar avaliação, execute antes **Autenticar candidato** e preserve os cookies do Postman. Para o caso **Criar avaliação sem login**, execute **Sair do candidato** antes.
6. Faça as exclusões **por último**, somente no banco de testes.
7. Na aba **Test Results**, verifique os testes automáticos de HTTP, JSON, `sucesso` e listas retornadas. Salve evidências das respostas e resultados.

**Atenção:** os códigos esperados são baseados no `rota.php` atual; as operações dependem de banco, sessão e registros válidos. O cadastro repetido com mesmo e-mail pode retornar erro. A API de edição/exclusão não aplica checagens de autorização específicas; isso deve ser registrado como risco, não considerado teste de segurança aprovado.

## 2. TestCase Studio (interface)
Instale a extensão **TestCase Studio**, abra a página local, inicie a gravação, execute um cenário por vez e exporte/copiei os passos registrados. Use `testes/TestCaseStudio-cenarios.md` como checklist. A extensão registra interações realizadas no navegador — o roteiro não substitui a gravação real.

## 3. Evidências e entrega
Para cada cenário registre: ID, tela/rota, entrada usada, resultado esperado, resultado observado, status (Aprovado/Reprovado/Não executado), captura de tela e data. No Postman, mostre requisição JSON, resposta e status; no TestCase Studio, a lista de ações registrada e a tela final. Não marque um teste como aprovado antes de executá-lo localmente.
