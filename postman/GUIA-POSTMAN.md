# Como executar a coleção Postman do TrabalhoPW1

A coleção usa exemplos JSON válidos e variáveis de e-mail/senha já preenchidas, evitando o HTTP 400 por campos vazios.

## Ordem recomendada

1. Cadastro de empresa.
2. Buscar empresa (salva automaticamente o ID em `empresaId`).
3. Cadastro de candidato.
4. Autenticar candidato (guarda a sessão PHP pelo cookie `PHPSESSID` no Postman).
5. Buscar candidato (salva `candidatoId`).
6. Salvar avaliação e consultar avaliações (salva `avaliacaoId`, caso a avaliação pertença ao candidato logado).
7. Testar as edições. As exclusões devem ser feitas **somente no final**, em um banco de testes.

## Configuração

- `baseUrl` é `http://localhost/TrabalhoPW1-main/controladores/rota.php`; troque somente se a pasta local tiver outro nome.
- `empresaEmail`, `empresaSenha`, `candidatoEmail` e `candidatoSenha` estão preenchidos com dados fictícios; ao repetir o cadastro, escolha um e-mail novo para evitar duplicidade.
- Os IDs não podem ser inventados: `empresaId`, `candidatoId` e `avaliacaoId` são preenchidos pelos scripts nas requisições de busca. Se não houver correspondente, verifique o banco e a resposta.
- Para editar ou excluir avaliações, é necessário estar logado como o autor. Depois de executar 'Sair do candidato', faça login novamente.
- O teste negativo 'Criar avaliação sem login' só deve ser executado sem sessão autenticada; caso contrário, o esperado HTTP 401 não ocorrerá.
- As requisições de exclusão **apagam dados reais**. Não execute a coleção inteira automaticamente em produção.

## Verificação

As requisições usam `POST` com `Content-Type: application/json` e os nomes dos campos esperados pelo `rota.php`. Os exemplos foram revisados, mas não executados no XAMPP local.
