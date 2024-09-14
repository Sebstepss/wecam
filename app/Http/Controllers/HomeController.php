<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth si lo necesitas
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        // Aplicar el middleware de autenticación para asegurar que el usuario está autenticado
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user(); // O puedes usar Auth::user() si prefieres 

        // Verificar que el usuario esté autenticado
        if ($user) {
            // Obtener los roles del usuario si existen
            $roles = $user->roles->pluck('name')->toArray();
            return view('home', compact('user', 'roles'));
        }

        // Si no hay un usuario autenticado, redirigir al login
        return redirect()->route('login');
    }
}
 