# Sistema de Agendamento Veterinário

Sistema web para gerenciamento de consultas veterinárias desenvolvido em PHP 8 com arquitetura MVC e banco de dados MySQL.

## 🚀 Funcionalidades

- Cadastro e autenticação de usuários
- Gerenciamento de consultas veterinárias
  - Listagem de todas as consultas
  - Criação de novas consultas
  - Edição de consultas existentes
  - Exclusão de consultas
- Sistema de permissões (usuários só podem editar/excluir suas próprias consultas)
- Interface responsiva com Bootstrap 5

## 📋 Pré-requisitos

- PHP >= 8.0
- MySQL >= 5.7
- Composer
- Servidor web (Apache/Nginx)
- mod_rewrite habilitado (Apache)

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/sistema-veterinario.git
cd sistema-veterinario
```

2. Instale as dependências via Composer:
```bash
composer install
```

3. Configure o banco de dados:
   - Crie um banco de dados MySQL
   - Importe o arquivo `agenda.sql`
   - Configure as credenciais do banco em `src/Config/Database.php`

4. Configure o servidor web:
   - Configure o document root para a pasta `public/`
   - Certifique-se que o mod_rewrite está habilitado (Apache)
   - Verifique as permissões das pastas

## ⚙️ Configuração

1. Banco de dados (`src/Config/Database.php`):
```php
private $host = "localhost";
private $db_name = "agenda";
private $username = "seu_usuario";
private $password = "sua_senha";
```

2. Permissões de pasta:
```bash
chmod 755 -R public/
chmod 755 -R src/
```

## 🏃‍♂️ Executando o projeto

1. Acesse o sistema através do navegador:
```
http://localhost/sistema-veterinario/public
```

2. Crie uma nova conta através da página de registro

3. Faça login e comece a usar o sistema

## 📁 Estrutura do Projeto

```
sistema-veterinario/
├── public/           # Arquivos públicos acessíveis via navegador
│   ├── auth/         # Endpoints de autenticação (login, registro)
│   ├── index.php     # Página inicial
│   ├── .htaccess     # Configuração do Apache para rotas
├── src/              # Código fonte principal
│   ├── Config/       # Configurações, como conexão com o banco de dados
│   ├── Controllers/  # Controladores que lidam com a lógica das requisições
│   ├── Models/       # Modelos que interagem diretamente com o banco de dados
│   ├── Utils/        # Funções auxiliares e classes utilitárias
├── vendor/           # Dependências gerenciadas pelo Composer
├── agenda.sql        # Arquivo com a estrutura do banco de dados
├── composer.json     # Configuração do Composer
├── README.md         # Documentação do projeto
```

## 🛠️ Tecnologias Utilizadas

- PHP 8
- MySQL
- Bootstrap 5
- jQuery
- Composer
- PDO
- HTML5
- CSS3
- JavaScript

## ⚡ Boas Práticas Implementadas

- Arquitetura MVC
- Orientação a Objetos
- Singleton para conexão com banco de dados
- Validação de dados
- Gerenciamento de sessão
- Proteção contra SQL Injection
- Criptografia de senha (MD5)
- PSR-4 Autoloading
- Código limpo e organizado

## 🔒 Segurança

- Senhas criptografadas com MD5
- Proteção contra SQL Injection usando PDO
- Validação de sessão
- Validação de permissões
- Sanitização de dados

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## ✒️ Autores

* **Gabriel G. C. Soares** - *Desenvolvimento inicial* - [gabriel-fstk](https://github.com/gabriel-fstk)

## 📄 Notas de Versão

* 1.0.0
    * Primeira versão do sistema
