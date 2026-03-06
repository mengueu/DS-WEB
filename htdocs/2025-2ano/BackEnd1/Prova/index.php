<?php
    require_once 'conexao.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página Inicial</title>
</head>
<body>
    
</body>
<body class="bodyinicio">

    <div class="menu">
        <div class="esquerda">
            <a href="" class="botaoE"><div>Início</div></a>

            <a href="" class="botaoE"><div>Sobre</div></a>

            <a href="" class="botaoE"><div>Contato</div></a>

            <a href="" class="botaoE"><div>Ajuda</div></a>
        </div>
        <div class="direita">

            <a href="" class="botaoD"><div>Login</div></a>

            <a href="" class="botaoD"><div>Registrar</div></a>
        </div>
    </div>

    <div class="cadastrar">
        <h2>Cadastrar Novo Filme:</h2>
        <form method="post" action="cadastrar.php">

            <label for="titulo">Título:*</label><br>
            <input type="text" id="titulo" name="titulo"><br><br>

            <label for="sinopse">Sinopse:*</label><br>
            <textarea id="sinopse" name="sinopse" rows="6" cols="60" max-length="300"></textarea><br><br>

            <label for="ano_lancamento">Ano de Lançamento:*</label><br>
            <input type="number" id="ano_lancamento" name="ano_lancamento"><br><br>

            <label for="genero">Gênero:*</label><br>
            <select id="genero" name="genero">
                <optgroup label="Selecione uma:">
                    <option value="Ficção Científica">Ficção Científica</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Romance/Drama">Romance/Drama</option>
                    <option value="Animação">Animação</option>
                    <option value="Não Informado">Não sei</option>
                </optgroup>
            </select>
            <br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <div class="cadastrados">
        <h2>Consultar Filmes Cadastrados:</h2>
        <?php
            $sql = "SELECT * FROM filmes";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo 
                    "<div class='cards'>
                        <div class='id'>".$linha['idFilme']."</div>
            
                        <h3>".$linha['titulo']."</h3>
            
                        <span class='ano-genero'>".$linha['ano_lancamento']." • ".$linha['genero']."</span>
            
                        <p class='sinopse'>".$linha['sinopse']."</p>    
            
                        <span class='data'>".$linha['data_criacao']."</span><br><br>
            
                        <div class='botoes'>
                            <a class='editar' href='editar.php?idFilme=".$linha['idFilme']."'>Editar</a>
                            <a class='deletar' href='deletar.php?idFilme=".$linha['idFilme']."'>Deletar</a>
                        </div>
                    </div>
                ";
            }
        } else {
            echo "Nenhum dado encontrado";
        }
        ?>
        </table>
    </div>
    <br><br>
    
    <div class="lista">
        <h2>Listagem dos Filmes Cadastrados:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Ano de Lançamento</th>
                <th>Sinopse</th>
                <th>Data de Criação</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        <?php
            $sql = "SELECT * FROM filmes";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>" . $linha['idFilme'] . "</td>
                            <td>" . $linha['titulo'] . "</td>
                            <td>" . $linha['ano_lancamento'] . "</td>
                            <td>" . $linha['sinopse'] . "</td>
                            <td>" . $linha['data_criacao'] . "</td>
                            <td><button class='editar'><a href='editar.php?idFilme=" . $linha['idFilme'] . "'>Editar</a></button></td>
                            <td><button class='deletar'><a href='deletar.php?idFilme=" . $linha['idFilme'] . "'>Deletar</a></button></td>
                        </tr>";
                }
            } else {
                echo "<br>Nenhum dado encontrado";
            }
        ?>
        </table>
    </div> 
    <br><br><br> 
</html>
