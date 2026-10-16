# Mini API de Produtos

## Como rodar

1. Abra o terminal **na pasta onde está o `index.php`** e execute:

```
php -S localhost:8000
```

2. Abra no navegador:
   - http://localhost:8000/status
   - http://localhost:8000/produtos

Para parar o servidor, use `Ctrl + C`.

## Endpoints

| Método | Endereço | Resposta |
|---|---|---|
| GET | /status | `{"status":"ok"}` |
| GET | /produtos | Lista com 3 produtos (id, nome, preco) |

Qualquer outro endereço retorna o código **404**.

## Testando com curl

```
curl http://localhost:8000/status
curl http://localhost:8000/produtos
```

## Testes

Os testes ficam na pasta `testes/`. Cada arquivo é um teste: basta executá-lo com o servidor ligado.

**Requisitos:** deixe a API rodando em um terminal (`php -S localhost:8000`) e rode os testes em **outro terminal**, na pasta do `index.php`.

| Técnica | Comando | O que faz |
|---|---|---|
| Funcional | `php testes/funcional.php` | Confere se `/status`, `/produtos` e o erro 404 respondem como deveriam |
| Regressão | `php testes/regressao.php salvar`, depois altere o `index.php` e rode `php testes/regressao.php` | Compara a API com uma "foto" salva antes da mudança |
| Performance | `php testes/performance.php` | Mede o tempo de resposta e compara com um limite |
| Estresse | `php testes/estresse.php` | Envia centenas de requisições ao mesmo tempo (precisa da extensão `curl`) |
| Recuperação | `php testes/recuperacao.php` | Guia você para derrubar e subir o servidor, e confere se a API volta |
| Segurança | `php testes/seguranca.php` | Procura proteções que estão faltando (aqui, "FALHOU" é uma descoberta) |
| Paralelo | `php testes/paralelo.php` | Compara duas versões da API (veja a preparação no começo do arquivo) |

Para testar uma API em outro endereço, passe a URL no final: `php testes/funcional.php http://localhost:8001`