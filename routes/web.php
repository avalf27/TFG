<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObrasArteController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ExposicionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterArtistaController;
use App\Http\Controllers\Auth\LoginArtistasController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoritosController;
// Ruta de bienvenida (opcional)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');


// Ruta para mostrar el formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para manejar la solicitud de login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Ruta para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Ruta para manejar la solicitud de registro
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


Route::get('/register/artista', [RegisterArtistaController::class, 'showRegistrationForm'])->name('artistas.register.form');

Route::post('/register/artista', [RegisterArtistaController::class, 'register'])->name('register.artista');

Route::get('/artista/login', [LoginArtistasController::class, 'showLoginForm'])->name('artista.login');
Route::post('/artista/login', [LoginArtistasController::class, 'login'])->name('artista.login.post');
Route::post('/artista/logout', [LoginArtistasController::class, 'logout'])->name('artista.logout');

// Mostrar la página de perfil del usuario
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Actualizar información del perfil
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');




// --------------------------------------------------
// Rutas para Usuarios
// --------------------------------------------------

// Lista de usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

// Formulario para crear un nuevo usuario
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');

// Guardar un nuevo usuario
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

// Mostrar detalles de un usuario específico
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show');

// Formulario para editar un usuario existente
Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');

// Actualizar un usuario
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

// Eliminar un usuario
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

// --------------------------------------------------
// Rutas para Obras de Arte
// --------------------------------------------------

// Lista de obras de arte
Route::get('/obras', [ObrasArteController::class, 'index'])->name('obras.index');

// Formulario para crear una nueva obra de arte
Route::get('/obras/create', [ObrasArteController::class, 'create'])->name('obras.create');

// Guardar una nueva obra de arte
Route::post('/obras/guardar', [ObrasArteController::class, 'store'])->name('obras.store');

// Mostrar detalles de una obra de arte específica
Route::get('/obras/{id}', [ObrasArteController::class, 'show'])->name('obras.show');

// Formulario para editar una obra de arte
Route::get('/obras-arte/{id}/edit', [ObrasArteController::class, 'edit'])->name('obras.edit');

// Actualizar una obra de arte
Route::put('/obras-arte/{id}', [ObrasArteController::class, 'update'])->name('obras.update');

// Eliminar una obra de arte
Route::delete('/obras-arte/{id}', [ObrasArteController::class, 'destroy'])->name('obras.destroy');

// Rutas para obras favoritas
Route::post('/obras/{id}/favoritos', [FavoritosController::class, 'addObraFavorita'])->name('favoritos.obras.add')->middleware('auth');
Route::delete('/obras/{id}/favoritos', [FavoritosController::class, 'removeObraFavorita'])->name('favoritos.obras.remove')->middleware('auth');

// --------------------------------------------------
// Rutas para Artistas
// --------------------------------------------------

// Lista de artistas
Route::get('/artistas', [ArtistaController::class, 'index'])->name('artistas.index');

// Formulario para crear un nuevo artista
Route::get('/artistas/create', [ArtistaController::class, 'create'])->name('artistas.create');

// Guardar un nuevo artista
Route::post('/artistas', [ArtistaController::class, 'store'])->name('artistas.store');

// Mostrar detalles de un artista específico
Route::get('/artistas/{id}', [ArtistaController::class, 'show'])->name('artistas.show');

// Formulario para editar un artista
Route::get('/artistas/{id}/edit', [ArtistaController::class, 'edit'])->name('artistas.edit');

// Actualizar un artista
Route::put('/artistas/{id}', [ArtistaController::class, 'update'])->name('artistas.update');

// Eliminar un artista
Route::delete('/artistas/{id}', [ArtistaController::class, 'destroy'])->name('artistas.destroy');

// Añadir un artista a favoritos
Route::post('/artistas/{id}/favorito', [ArtistaController::class, 'addFavorito'])->name('artistas.favorito');

// Eliminar un artista de favoritos
Route::delete('/artistas/{id}/favorito', [ArtistaController::class, 'removeFavorito'])->name('artistas.removeFavorito');
// --------------------------------------------------
// Rutas para Exposiciones
// --------------------------------------------------

// Lista de exposiciones


    Route::get('/exposiciones', [ExposicionController::class, 'index'])->name('exposiciones.index');
    Route::get('/exposiciones/create', [ExposicionController::class, 'create'])->name('exposiciones.create');
    Route::post('/exposiciones', [ExposicionController::class, 'store'])->name('exposiciones.store');
    Route::get('/exposiciones/{id}', [ExposicionController::class, 'show'])->name('exposiciones.show');
    Route::get('/exposiciones/{id}/edit', [ExposicionController::class, 'edit'])->name('exposiciones.edit');
    Route::put('/exposiciones/{id}', [ExposicionController::class, 'update'])->name('exposiciones.update');
    Route::delete('/exposiciones/{id}', [ExposicionController::class, 'destroy'])->name('exposiciones.destroy');
    Route::put('/exposiciones/{id}/artistas', [ExposicionController::class, 'updateArtistas'])->name('exposiciones.update.artistas');
    // Rutas para exposiciones favoritas
    Route::post('/exposiciones/{id}/favoritos', [FavoritosController::class, 'addExposicionFavorita'])->name('favoritos.exposiciones.add')->middleware('auth');
    Route::delete('/exposiciones/{id}/favoritos', [FavoritosController::class, 'removeExposicionFavorita'])->name('favoritos.exposiciones.remove')->middleware('auth');

// --------------------------------------------------
// Rutas para Roles
// --------------------------------------------------
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

// Formulario para crear un nuevo rol
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');

// Guardar un nuevo rol
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

// Mostrar detalles de un rol específico
Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');

// Formulario para editar un rol
Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');

// Actualizar un rol
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');

// Eliminar un rol
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//--------------------------------------------------
// Rutas para Usuarios Registrados
// --------------------------------------------------

Route::middleware(['auth'])->group(function () {
    // Lista de usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

    // Formulario para crear un nuevo usuario
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');

    // Guardar un nuevo usuario
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    // Mostrar detalles de un usuario específico
    Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show');

    // Formulario para editar un usuario existente
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');

    // Actualizar un usuario
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

    // Eliminar un usuario
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Rutas de Obras de Arte y Artistas
    Route::resource('obras-arte', ObrasArteController::class);
});

// --------------------------------------------------
// Rutas para Administradoristradores
// --------------------------------------------------

Route::middleware(['auth', 'Administrador'])->group(function () {


    // Rutas de Roles (solo accesibles por Administradoristradores)
    Route::resource('roles', RoleController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
});

// Rutas para Artistas
Route::prefix('artista')->name('artista.')->middleware('auth:artista')->group(function () {
    Route::get('/perfil', [ArtistaController::class, 'showProfile'])->name('profile.show');
    
    // Rutas para mostrar las obras y exposiciones del artista autenticado
    Route::get('/mis-obras', [ArtistaController::class, 'misObras'])->name('mis-obras');
    Route::get('/mis-exposiciones', [ArtistaController::class, 'misExposiciones'])->name('mis-exposiciones');
});
