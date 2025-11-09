<?php
namespace App\Http\Controllers\Admin\main;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Pode adicionar lógica aqui se quiser

        // Retorna a view do painel administrativo
        return view('admin.Main.home');
    }
}
