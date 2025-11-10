<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categ\CategoryController;
use App\Http\Controllers\Prod\ProductController;

// Rotas de usuários - usar resource para garantir todas as rotas RESTful
use App\Http\Controllers\Admin\main\HomeController;
//rota pra produtos
Route::resource('products', ProductController::class);
// Página pública: se o usuário estiver autenticado, redireciona para /home
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return view('welcome');
});

// Rota para a Home do painel (após login)
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);

// Se quiser exibir a view pública welcome, descomente a linha abaixo
// Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
