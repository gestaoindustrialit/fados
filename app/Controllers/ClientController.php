<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Event;
use App\Models\Reservation;

class ClientController extends Controller
{
    public function dashboard(): void { Auth::requireRole('client'); $this->view('client/dashboard'); }
    public function reservations(): void { Auth::requireRole('client'); $u=Auth::user(); $this->view('client/reservations',['reservations'=>(new Reservation())->myReservations((int)$u['id'])]); }
    public function create(int $eventId): void { Auth::requireRole('client'); $this->view('client/create_reservation',['event'=>(new Event())->find($eventId)]); }
    public function store(): void { Auth::requireRole('client'); verify_csrf(); $u=Auth::user(); (new Reservation())->create(['event_id'=>(int)$_POST['event_id'],'user_id'=>$u['id'],'customer_name'=>$_POST['customer_name'],'customer_email'=>$_POST['customer_email'],'customer_phone'=>$_POST['customer_phone'],'number_of_people'=>(int)$_POST['number_of_people'],'notes'=>$_POST['notes']??null]); redirect('/client/reservations'); }
}
