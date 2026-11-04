
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Candidato</title>
</head>
<body>

    <h1>Login do Candidato</h1>

    <form action="../controladores/rota.php?acao=autenticarCandidato" method="POST">

        Email:
        <input type="email" name="email" required>
        <br><br>

        Senha:
        <input type="password" name="senha" required>
        <br><br>

        <button type="submit">Entrar</button>

    </form>

    <br>
    <a href="cadastrarCandidato.php">Criar uma conta</a><br>
    <a href="../index.html">Sair</a>
</body>
</html>
