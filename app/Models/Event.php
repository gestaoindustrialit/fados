<?php

namespace App\Models;

class Event extends BaseModel
{
    public function openEvents(): array
    {
        return $this->db->query("SELECT e.*, r.name restaurant_name FROM events e JOIN restaurants r ON r.id=e.restaurant_id WHERE status='open' ORDER BY event_date,start_time")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT e.*, r.name restaurant_name, r.address restaurant_address FROM events e JOIN restaurants r ON r.id=e.restaurant_id WHERE e.id=:id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
