<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(): void { $this->view('auth/login'); }
    public function registerForm(): void { $this->view('auth/register'); }
    public function login(): void { verify_csrf(); if (Auth::attempt($_POST['email'], $_POST['password'])) redirect('/client/dashboard'); flash('error','Credenciais inválidas'); redirect('/login'); }
    public function logout(): void { Auth::logout(); redirect('/'); }
    public function register(): void { verify_csrf(); (new User())->createClient($_POST); flash('success','Conta criada.'); redirect('/login'); }
}
