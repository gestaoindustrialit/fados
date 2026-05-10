# Gestão de Reservas para Eventos (PHP MVC)

Aplicação web em PHP puro (sem framework), MVC, PDO e Bootstrap 5.

## Requisitos
- PHP 7.3+ com extensão `pdo_sqlite`
- Apache/Nginx apontando para `public/`

## Instalação (sem MySQL)
1. Copiar projeto para servidor.
2. Garantir permissão de escrita em `storage/`.
3. Executar:
   ```bash
   php install.php
   ```
4. Iniciar servidor local para teste:
   ```bash
   php -S localhost:8000 -t public
   ```

A base SQLite é criada automaticamente em `storage/database.sqlite`.

## Login inicial
- Email: `admin@admin.com`
- Password: `admin123`

## SMTP
Editar `config/config.php` na secção `smtp`.

## Cron lembretes
Executar diariamente (exemplo 09:00):
```bash
0 9 * * * /usr/bin/php /caminho/projeto/public/cron/send_event_reminders.php
```

Log: `storage/logs/email_reminders.log`


## Erro 403 (Forbidden) após instalar
Se acederes ao projeto e aparecer 403, normalmente o Apache está a apontar para a pasta errada.

Este projeto já inclui:
- `.htaccess` na raiz para redirecionar para `public/`
- `public/.htaccess` para enviar rotas para `public/index.php`

Checklist:
1. Confirma que `mod_rewrite` está ativo no Apache.
2. Confirma `AllowOverride All` na vhost/pasta do projeto.
3. Garante permissões de leitura nos ficheiros e execução nas pastas.
4. Se possível, define DocumentRoot diretamente para `.../public`.
