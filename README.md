# Gestão de Reservas para Eventos (PHP MVC)

Aplicação web em PHP puro (sem framework), MVC, PDO e Bootstrap 5.

## Requisitos
- PHP 8.1+
- MySQL/MariaDB
- Apache com `mod_rewrite` (ou apontar DocumentRoot para `public/`)

## Instalação
1. Copiar projeto para servidor.
2. Criar base de dados (ex: `fados`).
3. Importar:
   - `database/schema.sql`
   - `database/seed.sql`
4. Editar `config/config.php` (DB e SMTP).
5. Apontar web root para `public/`.

## Login inicial
- Email: `admin@admin.com`
- Password: `admin123`

## Cron lembretes
Executar diariamente (exemplo 09:00):
```bash
0 9 * * * /usr/bin/php /caminho/projeto/public/cron/send_event_reminders.php
```

Log: `storage/logs/email_reminders.log`

## Rotas principais já implementadas
- Públicas: `/`, `/events`, `/event/{id}`, `/login`, `/register`
- Cliente: `/client/dashboard`, `/client/reservations`
- Admin: `/admin/dashboard`

## Notas
- Estrutura preparada para expansão das fases (restaurantes, mesas/layout, eventos, pratos, reservas avançadas, emails SMTP com PHPMailer).
- Inclui CSRF, prepared statements, `password_hash`, sessões e escaping de output.
