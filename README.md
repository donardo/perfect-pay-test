# Sistema de Processamento de Pagamentos - Asaas Integration

Sistema de processamento de pagamentos integrado com a API do Asaas, desenvolvido com Laravel. O sistema permite processar pagamentos via Boleto, Cartão de Crédito e PIX.

## 📋 Pré-requisitos

- PHP 8.2 ou superior
- Composer
- MySQL 5.7 ou superior

## 🚀 Configuração do Ambiente Local

### Instale as Dependências do PHP

```bash
composer install
```

### Configure o Ambiente

```bash
# Copie o arquivo de exemplo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### Configure o Banco de Dados

No arquivo `.env`, configure as credenciais do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### Configure o Asaas

1. Crie uma conta no [Asaas Sandbox](https://sandbox.asaas.com/)
2. Vá até Configuração de Conta -> Integrações
3. Copie sua API Key
4. Adicione no `.env`:

```env
ASAAS_API_KEY=sua_chave_api_sandbox
```

### Execute as Migrations

```bash
php artisan migrate
```

### Configure o Telescope (Opcional para Debug)

```bash
# Publique os assets do Telescope
php artisan telescope:install

# Execute as migrations do Telescope
php artisan migrate
```

### Inicie o Servidor Local

```bash
php artisan serve
```

O sistema estará disponível em `http://localhost:8000`

## 💳 Testando Pagamentos

### Cartões de Teste

```
# Cartão Válido
Número: 4111 1111 1111 1111
Validade: Qualquer mês/ano futuro
CVV: 123
Nome: Qualquer nome

# Cartão que será Recusado
Número: 4111 1111 1111 1111
Validade: Qualquer mês/ano futuro
CVV: 321
Nome: Qualquer nome
```

### Boleto

- Os boletos gerados no ambiente sandbox não são reais
- Use para testar o fluxo de geração e download

### PIX

- Os QR Codes gerados no ambiente sandbox não são reais
- Use para testar o fluxo de geração e exibição

## 🔍 Debug e Logs

### Telescope

Acesse `http://localhost:8000/telescope` para:
- Monitorar requisições
- Ver queries SQL
- Verificar logs
- Acompanhar jobs e eventos
