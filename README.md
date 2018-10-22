# Stackzz
**Apresentação**

Plataforma de colaboração de conteúdo, tipo fórum, onde o usuário poderá criar publicações do tipo "pergunta" ou "contribuição" (artigo).

Qualquer uma das publicações poderão ter interações com outros usuários da plataforma por meio de comentários.

O login é feito via Google, somente para colaboradores da Eduzz.

**Configuração do ambiente**

 1. Fazer o clone do repositório
 2. Criar um banco de dados sql (MySQL ou Postgres)
 3. Definir as configurações do banco no .env.example, renomeando o arquivo para .env
 4. Executar as migrations: php artisan migrate
 5. Erguer o servidor com artisan: php artisan serve

**Commits**

Não existe (ainda) uma branch de desenvolvimento, então, quando cair na master vai direto para a produção no Heroku https://stackzz.herokuapp.com
