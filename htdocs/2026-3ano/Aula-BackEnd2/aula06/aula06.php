<?php
/*
    O que significa API?
- API significa Application Programming Interface -> Interface de Programação de Aplicações.
- Uma API é um conjunto de regras e padrões que permite que um software converse com outro software.
- Ela define como um sistema pode solicitar informações ou serviços de outro sistema.


    O que uma API faz?
- Ela permite comunicação entre sistemas.

Exemplos simples:
- O aplicativo de clima usa uma API para buscar a temperatura.
- Sites usam APIs de pagamento para cobrar com cartão.
- Apps de mapa usam API para calcular rotas.
- Sites e aplicativos usam API de CEP para obter dados de endereço.
- Seu frontend (HTML + JS) vai usar sua API em PHP para acessar dados.


    1.3 Como uma API funciona?
APIs funcionam com base em: Requisição → Processamento → Resposta

1. O **`cliente`** envia uma requisição (GET, POST, etc.) que pode conter dados no formato JSON ou XML.
2. O **`servidor`** processa.
3. A **`API devolve uma resposta`** (normalmente em JSON ou XML).


    Como funciona o HTTP?
- HTTP significa **HyperText Transfer Protocol**  um protocolo de comunicação usado para troca de dados entre **`cliente`** e **`servidor`** na Web.

CLIENTE → envia requisição
SERVIDOR → devolve resposta

Exemplo simples:

Você digita **google.com**
- Seu navegador envia uma **requisição HTTP GET**
- O servidor devolve uma **resposta HTTP 200 OK** com a página


    O que é uma Requisição HTTP?

- Uma requisição HTTP é uma mensagem estruturada enviada por um cliente (como navegador ou app) a um servidor, solicitando ações ou dados (como páginas HTML, imagens).
- Ela utiliza métodos ( GET, POST…), URL, cabeçalhos e, opcionalmente, um corpo para interagir com servidores web.

    
    Métodos HTTP:

Os principais são:

    GET: Buscar dados (não envia corpo)
    POST: Enviar dados (criar)
    PUT: Atualizar dados 
    DELETE: Apagar dados 
    PATCH: Atualização parcial 
    OPTIONS: Descobrir quais métodos o servidor aceita 


    URL - Endereço (Endpoint):

- É o endereço do recurso que você quer acessar.

Exemplo:

```
https://api.meusite.com/usuarios
```

    Headers (Cabeçalho):

- São “informações extras” da requisição.

Exemplos:

    Content-Type: Tipo do dado enviado (ex: `application/json`) 
    Authorization: Tokens, autenticação 
    User-Agent: Identifica o cliente (navegador, app, outro sistema etc.) 

---

    Corpo (Body):

- Usado em métodos como POST, PUT e PATCH.

Exemplo sem seguir um padrão:

```json
"Bruno Attina do Nascimento"
```

Exemplo em JSON:

```json
{
  "nome":"Bruno",
  "email":"bruno@email.com"
}
```

---

## **2.2 O que é uma Resposta HTTP?**

Quando o servidor recebe a requisição, ele responde com:

## Status Code (muito importante!)

O status indica o **resultado da operação**.

### **Classes de status**

| Código | Significado |
| --- | --- |
| **1xx** | Informativo |
| **2xx** | Sucesso |
| **3xx** | Redirecionamento |
| **4xx** | Erro do cliente |
| **5xx** | Erro no servidor |

### **Os mais usados**

| Código | Significado |
| --- | --- |
| **200 OK** | Requisição bem-sucedida |
| **201 Created** | Algo foi criado com sucesso |
| **400 Bad Request** | Erro nos dados enviados |
| **401 Unauthorized** | Precisa de autenticação |
| **403 Forbidden** | Sem permissão |
| **404 Not Found** | Recurso não encontrado |
| **500 Internal Server Error** | Erro no servidor (bug) |

---

## Headers (Cabeçalhos)

Exemplo sem seguir um padrão:

`Content-Type: application/data`

Exemplo para o uso de json:

`Content-Type: application/json`

---

## Body (corpo da resposta)

A resposta pode ser HTML, JSON, imagem etc.

Exemplo de resposta JSON de uma API:

```
{
  "status":"ok",
  "mensagem":"Usuário encontrado",
  "dados": {
    "id":1,
    "nome":"Bruno"
  }
}
```

## Exemplo real de Requisição HTTP

### Cliente envia:

```
GET /api/usuarios HTTP/1.1
Host: exemplo.com
User-Agent: Chrome
Content-type: application/json
```

### Servidor responde:

```
HTTP/1.1 200 OK
Content-Type: application/json

[
  { "id": 1, "nome": "Bruno" },
  { "id": 2, "nome": "Ana" }
]
```

---

## 2.3 HTTP é Stateless (sem estado)

Isso significa que:

> **O protocolo HTTP não guarda informações entre uma requisição e outra.**
> 

Cada pedido é independente.

Para guardar estado (login, sessão), usamos:

- Cookies
- Sessões
- Tokens (JWT)

---

    O que é HTTPS?

É o HTTP com criptografia (S de Secure).

Ele utiliza o protocolo TLS/SSL para proteção.

Todas as informações trocadas entre cliente e servidor ficam criptografadas.

Navegadores marcam HTTPS com cadeado 🔒.

---

# 3. **O que é uma Rota?**

Uma rota é o endereço dentro de uma aplicação que leva a um recurso específico.

- É o caminho que o cliente acessa para pedir algo ao servidor.
- A rota diz ao servidor qual código deve ser executado.

Por exemplo:

```
/api/usuarios
/api/produtos
/api/login
```

Essas são rotas diferentes, que fazem coisas diferentes.

---

## **3.1 Como uma rota funciona?**

Quando o cliente faz uma requisição, ele usa:

- **URL → /api.usuarios**
- **Método HTTP → GET, POST, PUT, DELETE**

A junção dos dois define qual rota será acionada.

Exemplo:

```
GET /api/usuarios
```

Significa: Quero listar usuários.

Agora:

```
POST /api/usuarios
```

Significa: Quero criar um usuário.

---

## **3.2 Rotas com Parâmetros**

Rotas podem ter variáveis.

Exemplo:

```
api/produtos/10
```

Aqui o **10** é um ID.

Chamamos isso de **rota com parâmetro**.

Na prática:

- `/produtos/1`
- `/produtos/2`
- `/produtos/99`

Todas são a mesma rota, mas com **ID diferente** que resultam em produtos diferentes.

---

## **3.3 Exemplos práticos de rotas**

### Rotas para usuários:

| Método | Rota | Ação |
| --- | --- | --- |
| GET | /usuarios | Lista todos |
| GET | /usuarios/7 | Mostra o usuário 7 |
| POST | /usuarios | Cria um novo usuário |
| PUT | /usuarios/7 | Atualiza o usuário 7 |
| DELETE | /usuarios/7 | Apaga o usuário 7 |

Cada uma dessas combinações é uma **rota diferente**.

---

## **3.4 Como o servidor identifica qual rota executar?**

De forma simplificada:

1. O servidor recebe a requisição.
2. Ele lê:
    - o **método HTTP**
    - a **URL**
3. Ele procura uma rota correspondente.
4. Ele executa a função daquela rota.

Em PHP puro isso é feito com:

- `$_SERVER['REQUEST_URI']`
- `$_SERVER['REQUEST_METHOD']`

Exemplo simples:

```php
$rota = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];

if ($rota == "/api/usuarios" && $metodo == "GET") {
    listarUsuarios();
}
```

---

## **3.5 Organização de rotas**

Projetos geralmente têm:

✔️ Arquivo exclusivo para rotas

✔️ Um controller para cada recurso

✔️ Uma função para cada ação da rota

Exemplo de estrutura:

```
/api
    index.php
    /routes
        usuarios.php
        produtos.php
    /controllers
        UsuariosController.php
        ProdutosController.php
```
*/
?>