# Todo App

## Como rodar a aplicação

- Se já não estiver, entre na pasta do projeto

```sh
cd todo-app
```

## Variáveis de ambiente

- Primeiro, certifique-se de que na raiz do projeto tem um arquivo .env com as variáveis assim como está no .env.example.

- Vamos criar as imagens docker com o servidor e o banco de dados

```sh
docker-compose up -d --build
```

- Em seguida, vamos instalar as dependências, criar a nossa database e a migration. Já tem um script pronto pra isso, então é só dar permissão e rodar ele.

```sh
chmod +x setup.sh
```

```sh
./setup.sh
```

- Pronto. Agora a aplicação está rodando e pronta para ser acessada. No navegador, acesse http://localhost:8080

## Utilizando

- No botão superior direito da tela de login você pode cadastrar o seu usuário e assim que concluir será logado automaticamente. Aí é só aproveitar! :D

## Tecnologias utilizadas

- PHP, Symfony, MariaDB, Bootstrap.
