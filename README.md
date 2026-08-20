# Código com erro 1

### Possui 3 erros de sintaxe sendo eles:

- A falta de ponto e virgula na linha `die ("erro na conexão: ". $conexao->connect_error)`
         
- Novamente falta de ponto e virgula na linha `<a href="index.php?excluir=<?= $usuario ['id'] ?>">`

- E por fim a falta de ponto e virgula também na linha `$resultado = $conexao->query($sql)`

O uso de ponto e virgula `;` é importante para que a maquina consiga ler a proxima linha, caso não tenha o uso dela, o codigo quando é tentado ser executado ele mostra que não consegue ler a linha que esta apos a falta do ponto evirgula anterior
### Erro de segurança sendo:

Na linha ` <?= $usuario['nome'] ?>` que é executada para criar a tabela, está vulneravel a algo chamado XSS na hora de exibir seus dados. Mas o que é esse XSS? Imagina que, no campo "Nome" do formulário, alguém digite isso ao invés de um nome normal: `<script>alert('hackeado')</script>`, e então isso vai ser salvo no banco normalmente, por mais que o prepared statements proteja o banco ele acaba não filtrando o conteúdo, então para corrigir é adicionado `htmlspecialchars()` deixando então da seguinte forma `<?= htmlspecialchars($usuario['nome']) ?>`