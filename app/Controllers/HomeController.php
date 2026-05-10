<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Event;

class HomeController extends Controller
{
    public function index(): void { $this->view('public/home'); }
    public function events(): void { $this->view('public/events', ['events' => (new Event())->openEvents()]); }
    public function eventDetail(int $id): void { $this->view('public/event_detail', ['event' => (new Event())->find($id)]); }
}
