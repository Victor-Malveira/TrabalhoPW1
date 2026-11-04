
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Candidato</title>
</head>
<body>

    <h1>Cadastro de Candidato</h1>

    <form action="../controladores/rota.php?acao=salvarCandidato" method="POST">

        Nome:
        <input type="text" name="nome" required>
        <br><br>

        Email:
        <input type="email" name="email" required>
        <br><br>

        Senha:
        <input type="password" name="senha" required>
        <br><br>

        Telefone:
        <input type="text" name="telefone">
        <br><br>

        Formato do currículo:
        <select name="formatoCurriculo">
            <option value="Texto">Texto</option>
            <option value="Libras">Vídeo em Libras</option>
            <option value="Audio">Áudio</option>
        </select>
        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

    <br>
    <a href="autenticarCandidato.php">Já tenho uma conta</a><br>

    <a href="../index.html">Sair</a>

</body>
</html>
