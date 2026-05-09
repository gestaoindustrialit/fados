<?php

namespace App\Models;

class Reservation extends BaseModel
{
    public function myReservations(int $userId): array
    {
        $stmt = $this->db->prepare('SELECT r.*, e.title, e.event_date FROM reservations r JOIN events e ON e.id=r.event_id WHERE r.user_id=:uid ORDER BY r.created_at DESC');
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO reservations (event_id,user_id,customer_name,customer_email,customer_phone,number_of_people,status,notes,created_by_admin,created_at,updated_at) VALUES (:event_id,:user_id,:customer_name,:customer_email,:customer_phone,:number_of_people,\'pending\',:notes,0,NOW(),NOW())');
        return $stmt->execute($data);
    }
}
