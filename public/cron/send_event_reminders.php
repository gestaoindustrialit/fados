<?php
require __DIR__ . '/../../app/Core/Helpers.php';
require __DIR__ . '/../../app/Core/Database.php';

use App\Core\Database;

$logFile = __DIR__ . '/../../storage/logs/email_reminders.log';
$db = Database::connection();
$sql = "SELECT r.id reservation_id,r.customer_email,r.customer_name,r.number_of_people,e.id event_id,e.title,e.event_date,e.start_time,rest.name restaurant_name,rest.address
FROM reservations r JOIN events e ON e.id=r.event_id JOIN restaurants rest ON rest.id=e.restaurant_id
WHERE r.status='confirmed' AND e.event_date=date('now','+1 day')
AND NOT EXISTS(SELECT 1 FROM email_logs l WHERE l.reservation_id=r.id AND l.type='reminder_day_before' AND l.status='sent')";
foreach ($db->query($sql)->fetchAll() as $row) {
    $ok = mail($row['customer_email'], 'Lembrete de evento: '.$row['title'], "Olá {$row['customer_name']}, lembrete para {$row['title']} em {$row['event_date']} {$row['start_time']}");
    $stmt = $db->prepare("INSERT INTO email_logs (reservation_id,event_id,email,type,status,error_message,sent_at,created_at) VALUES (:rid,:eid,:email,'reminder_day_before',:status,:error,datetime('now'),datetime('now'))");
    $stmt->execute(['rid'=>$row['reservation_id'],'eid'=>$row['event_id'],'email'=>$row['customer_email'],'status'=>$ok?'sent':'failed','error'=>$ok?null:'mail() falhou']);
    file_put_contents($logFile, date('c')." reservation {$row['reservation_id']} => ".($ok?'sent':'failed').PHP_EOL, FILE_APPEND);
}
