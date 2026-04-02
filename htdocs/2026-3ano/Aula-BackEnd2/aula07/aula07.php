<?php
echo "Ver código";
/*# Primeira API

Vamos iniciar a construção da nossa primeira API utilizando PHP Puro, também chamado de **PHP Vanilla**.

Antes de escrever qualquer linha de código, é essencial entender como o servidor funciona, pois é ele quem recebe as requisições, interpreta o PHP e entrega as respostas da API.

Por isso, antes de criar nossas rotas e nossos endpoints, vamos estudar um pouco sobre o ambiente onde nossa API será executada.

---

### O Servidor que Vamos Utilizar: XAMPP

Estamos usando o **XAMPP**, que é um pacote que instala três componentes principais:

- **Apache** (servidor HTTP) → responsável por receber as requisições.
- **MySQL/MariaDB** (banco de dados).
- **PHP** (linguagem que vai gerar respostas dinâmicas).

Para construir uma API, o **Apache** será nosso foco inicial.

É nele que configuramos como as requisições chegam e como os arquivos PHP serão executados.

---

## 1. Entendendo as configurações do Servidor (httpd.conf)

O arquivo **httpd.conf** é o arquivo principal de configuração do Apache.

É nele que definimos:

- Porta do servidor
- Diretórios públicos
- Permissões
- Regras de reescrita
- Comportamento geral do servidor

Compreender esse arquivo nos ajuda a entender **`como o** Apache enxerga ****nossos **arquivos PHP**` e `como ele redireciona requisições` para nossa API.

Este arquivo de configuração é valido para todas as pastas e arquivos dentro do servidor (ou seja, htdocs também), portanto, se precisarmos aplicar uma configuração especifica em um projeto especifico, teremos que usar um arquivo chamado de `.htaccess` .

Mas antes de entendermos o `.htaccess`, precisamos verificar se o servidor esta configurado para permitir a reescrita de regras. Para isso precisamos abrir o arquivo httpd.conf e procurar pelo seguinte:

`httpd.conf` :

```
<Directory "C:/xampp/htdocs">
    AllowOverride All
</Directory>
```

---

### Entendendo o .htaccess

O .htaccess é um arquivo especial do Apache que permite configurar regras específicas dentro de uma pasta, sem alterar o httpd.conf.

Ele é muito útil em APIs porque permite:

- Criar rotas amigáveis (URL rewriting)
- Redirecionar todas as requisições para um único arquivo (geralmente o `index.php`)
- Proteger diretórios
- Trabalhar com permissões
- Reescrever URLs dinâmicas para nossa API

Ou seja:

O `.htaccess` será responsável por fazer com que todas as requisições da API passem pelo arquivo principal, permitindo que seja implementado um sistema de rotas em PHP puro.

## 2. Iniciando o Projeto

- Vamos criar uma pasta dentro do htdocs do Xampp, chamada de `primeira-api`
- Na sequência vamos criar um arquivo chamado de `index.php` e copiar o código da API.

```php
<?php

header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON
header('Access-Control-Allow-Origin: *'); // Permite requisições de qualquer origem (CORS)
header('Access-Control-Allow-Methods: GET, POST'); // Define os métodos HTTP permitidos

$method = $_SERVER['REQUEST_METHOD']; // Captura o método HTTP da requisição atual (GET, POST, etc.)
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extrai apenas o caminho da URL, ignorando query string

// Remove barra inicial
$path = trim($path, '/');
// Divide em segmentos
$segments = explode('/',$path);
// Pega o endpoint solicitado
$endpoint = $segments[1] ?? '';

switch ($endpoint) {
    case 'hello':
        echo json_encode([
            'status'  => 'success',
            'message' => 'Ola! A API esta funcionando.'
        ]);
        break;

    case 'echo':
        if ($method === 'POST'){
            // Lê e decodifica o JSON do corpo da requisição para um array PHP
            $input = json_decode(file_get_contents('php://input'), true); 
        }else {
            $input = "Metodo GET";
        }
        echo json_encode([
            'status' => 'success',
            'echo'   => $input
        ]);
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Endpoint não encontrado.'
        ]);
}
```

Ou se prefirir realizar o download do arquivo:

[index.php](attachment:18053a1d-c70c-4c02-815c-79e71322708e:index.php)

<aside>
💡

**O que o header** `header('Access-Control-Allow-Origin: *');`  faz?

O `*` diz ao navegador: **"aceito requisições de qualquer origem"**, liberando o bloqueio.

Você também pode restringir a uma origem específica:

`header('Access-Control-Allow-Origin: https://meusite.com');`

</aside>

## Configuração que usaremos no `.htaccess`

Vamos criar então um arquivo chamado de .htaccess na raiz do projeto e copia as regras para dentro dele:

```php
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

**Explicando linha por linha o nosso arquivo:**

`RewriteEngine On`

Ativa o módulo de reescrita de URLs do Apache (`mod_rewrite`). Sem essa linha, nada abaixo funciona.

`RewriteCond %{REQUEST_FILENAME} !-f`

Condição: só aplica a regra se o que foi requisitado **não for um arquivo existente**. O `!` significa "não". Isso evita que arquivos reais (como imagens, CSS) sejam redirecionados. Ou seja, se você tentar acessar uma imagem pela url dela você conseguirá.

`RewriteCond %{REQUEST_FILENAME} !-d`

Mesma ideia, mas para diretórios. Se a pasta existir de verdade, não redireciona. Ou seja, se você tentar acessar uma pasta pela url dela você conseguirá.

`RewriteRule ^(.*)$ api.php [QSA,L]`

A regra em si. Lendo cada parte:
``^(.*)$`` -> captura qualquer URL (do início `^` ao fim `$`)
``api.php`` -> redireciona tudo para o seu arquivo principal
``[QSA]`` -> [Query String Append], mantém os parâmetros GET na URL (ex: `?nome=Maria&idade=23`)
``[L]`` -> [Last], indica que esta é a última regra a ser processada
*/
?>