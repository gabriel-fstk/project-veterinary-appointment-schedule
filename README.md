# Sistema de Agendamento Veterin�rio

Sistema web para gerenciamento de consultas veterin�rias desenvolvido em PHP 8 com arquitetura MVC e banco de dados MySQL.

## ?? Funcionalidades

- Cadastro e autentica��o de usu�rios
- Gerenciamento de consultas veterin�rias
  - Listagem de todas as consultas
  - Cria��o de novas consultas
  - Edi��o de consultas existentes
  - Exclus�o de consultas
- Sistema de permiss�es (usu�rios s� podem editar/excluir suas pr�prias consultas)
- Interface responsiva com Bootstrap 5

## ?? Pr�-requisitos

- PHP >= 8.0
- MySQL >= 5.7
- Composer
- Servidor web (Apache/Nginx)
- mod_rewrite habilitado (Apache)

## ?? Instala��o

1. Clone o reposit�rio:
```bash
git clone https://github.com/seu-usuario/sistema-veterinario.git
cd sistema-veterinario
```

2. Instale as depend�ncias via Composer:
```bash
composer install
```

3. Configure o banco de dados:
   - Crie um banco de dados MySQL
   - Importe o arquivo `agenda.sql`
   - Configure as credenciais do banco em `src/Config/Database.php`

4. Configure o servidor web:
   - Configure o document root para a pasta `public/`
   - Certifique-se que o mod_rewrite est� habilitado (Apache)
   - Verifique as permiss�es das pastas

## ?? Configura��o

1. Banco de dados (`src/Config/Database.php`):
```php
private $host = "localhost";
private $db_name = "agenda";
private $username = "seu_usuario";
private $password = "sua_senha";
```

2. Permiss�es de pasta:
```bash
chmod 755 -R public/
chmod 755 -R src/
```

## ????? Executando o projeto

1. Acesse o sistema atrav�s do navegador:
```
http://localhost/sistema-veterinario/public
```

2. Crie uma nova conta atrav�s da p�gina de registro

3. Fa�a login e comece a usar o sistema

## ?? Estrutura do Projeto

```
sistema-veterinario/
??? public/           # Arquivos p�blicos
?   ??? auth/        # Endpoints de autentica��o
?   ??? index.php    # P�gina inicial
?   ??? .htaccess    # Configura��o do Apache
??? src/             # C�digo fonte
?   ??? Config/      # Configura��es
?   ??? Controllers/ # Controladores
?   ??? Models/      # Modelos
?   ??? Utils/       # Utilit�rios
??? vendor/          # Depend�ncias (Composer)
??? agenda.sql       # Estrutura do banco de dados
??? composer.json    # Configura��o do Composer
??? README.md        # Este arquivo
```

## ??? Tecnologias Utilizadas

- PHP 8
- MySQL
- Bootstrap 5
- jQuery
- Composer
- PDO
- HTML5
- CSS3
- JavaScript

## ? Boas Pr�ticas Implementadas

- Arquitetura MVC
- Orienta��o a Objetos
- Singleton para conex�o com banco de dados
- Valida��o de dados
- Gerenciamento de sess�o
- Prote��o contra SQL Injection
- Criptografia de senha (MD5)
- PSR-4 Autoloading
- C�digo limpo e organizado

## ?? Seguran�a

- Senhas criptografadas com MD5
- Prote��o contra SQL Injection usando PDO
- Valida��o de sess�o
- Valida��o de permiss�es
- Sanitiza��o de dados

## ?? Contribuindo

1. Fa�a um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudan�as (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## ?? Licen�a

Este projeto est� sob a licen�a MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## ?? Autores

* **Gabriel G. C. Soares** - *Desenvolvimento inicial* - [gabriel-fstk](https://github.com/gabriel-fstk)

## ?? Notas de Vers�o

* 1.0.0
    * Primeira vers�o do sistema