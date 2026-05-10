<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        Auth::requireRole('admin');
        $db = Database::connection();
        $stats = [
            'events' => $db->query('SELECT COUNT(*) c FROM events')->fetch()['c'],
            'pending' => $db->query("SELECT COUNT(*) c FROM reservations WHERE status='pending'")->fetch()['c'],
            'confirmed' => $db->query("SELECT COUNT(*) c FROM reservations WHERE status='confirmed'")->fetch()['c'],
        ];
        $this->view('admin/dashboard', ['stats' => $stats]);
    }
}
