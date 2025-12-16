# Deploy via Git no cPanel - OLIALI Backend

✅ **Código já está no GitHub:** https://github.com/marcuslimadev/ifood

## Passo 1: Acessar cPanel Git Version Control

1. **Login no cPanel**
   - URL: https://oliali.com.br:2083
   - Usuário: `user@oliali.com.br`
   - Senha: `MundoMelhor@10`

2. **Navegar para Git Version Control**
   - Files → Git Version Control

## Passo 2: Clonar Repositório

1. **Create** → Clone um Repositório

   **Repository URL:**
   ```
   https://github.com/marcuslimadev/ifood.git
   ```

   **Repository Path:**
   ```
   /home/olialicombr/stackfood
   ```

   **Repository Name:**
   ```
   stackfood
   ```

2. Clique em **Create**

## Passo 3: Configurar via Terminal SSH

Após clonar, abra o Terminal no cPanel ou conecte via SSH:

```bash
# Conectar via SSH
ssh user@oliali.com.br

# Navegar para o diretório
cd ~/stackfood

# Verificar arquivos
ls -la

# Instalar dependências do Composer
composer install --no-dev --optimize-autoloader

# Copiar arquivo de ambiente
cp .env.example .env

# Editar variáveis de ambiente
nano .env
```

## Passo 4: Configurar .env

Edite as seguintes variáveis no arquivo `.env`:

```env
APP_NAME=OLIALI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://oliali.com.br

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=olialicombr_data
DB_USERNAME=olialicombr_user
DB_PASSWORD=MundoMelhor@10
```

Salvar: `Ctrl+O`, Enter, `Ctrl+X`

## Passo 5: Comandos Laravel

```bash
# Gerar chave de aplicação
php artisan key:generate

# Criar link simbólico de storage
php artisan storage:link

# Ajustar permissões
chmod -R 755 storage bootstrap/cache
chown -R $USER:$USER storage bootstrap/cache

# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Passo 6: Importar Banco de Dados

### Via phpMyAdmin (Mais Fácil):

1. Acesse cPanel → phpMyAdmin
2. Selecione o banco `olialicombr_data`
3. Clique em "Import"
4. Faça upload do arquivo: `~/stackfood/installation/backup/database.sql`
5. Clique em "Go"

### Via Terminal SSH:

```bash
cd ~/stackfood
mysql -u olialicombr_user -p olialicombr_data < installation/backup/database.sql
# Senha quando solicitado: MundoMelhor@10
```

## Passo 7: Configurar Estrutura para cPanel

O Laravel precisa que o conteúdo da pasta `public/` esteja acessível via web.

### Opção A: Symlink (Recomendado)

```bash
cd ~/public_html
ln -s ~/stackfood/public admin
```

Acesso: `https://oliali.com.br/admin`

### Opção B: Mover Arquivos

```bash
# Fazer backup do public_html atual
cd ~
mv public_html public_html_backup

# Criar symlink
ln -s ~/stackfood/public public_html

# Editar index.php para ajustar caminhos
nano ~/public_html/index.php
```

No `index.php`, alterar:
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

Para:
```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

## Passo 8: Configurar Cron Jobs

No cPanel → Cron Jobs, adicione:

```cron
* * * * * cd /home/olialicombr/stackfood && php artisan schedule:run >> /dev/null 2>&1
```

## Passo 9: Configurar SSL (Importante!)

1. cPanel → SSL/TLS Status
2. Selecione domínio `oliali.com.br`
3. Clique em "Run AutoSSL"

Aguarde instalação do certificado Let's Encrypt.

## Passo 10: Testar Acesso

### Admin Panel:
```
https://oliali.com.br/admin
```

Credenciais padrão (verifique no README ou documentação):
- Email: `admin@admin.com`
- Senha: (conforme documentação)

### API Config:
```
https://oliali.com.br/api/v1/config
```

Deve retornar JSON com configurações do sistema.

## Troubleshooting

### Erro 500:

```bash
# Ver logs
tail -f ~/stackfood/storage/logs/laravel.log

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Permissões:

```bash
chmod -R 755 ~/stackfood/storage
chmod -R 755 ~/stackfood/bootstrap/cache
```

### Composer erros:

```bash
# Atualizar Composer
composer self-update

# Reinstalar dependências
rm -rf vendor
composer install --no-dev
```

## Atualizações Futuras

Para atualizar código do GitHub:

```bash
cd ~/stackfood
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Credenciais Resumidas

**GitHub:**
- Repo: https://github.com/marcuslimadev/ifood

**Servidor:**
- SSH/cPanel: `user@oliali.com.br` / `MundoMelhor@10`
- IP: 148.230.72.7

**Banco de Dados:**
- DB: `olialicombr_data`
- User: `olialicombr_user`
- Pass: `MundoMelhor@10`

**URLs:**
- Admin: https://oliali.com.br/admin
- API: https://oliali.com.br/api/v1/config
