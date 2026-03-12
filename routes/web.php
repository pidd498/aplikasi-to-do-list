<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

// Landing Page (bisa diakses semua orang)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Semua route di bawah ini hanya bisa diakses kalau sudah login
Route::middleware(['auth', 'verified'])->group(function () {

    // 🏠 HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // ✅ TASKS (My Task)
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{id}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // ✅ TODOS (My Todo)
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{id}', [TodoController::class, 'show'])->name('todos.show');
    Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

    // 📬 INBOX
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');

    // 🕐 HISTORY
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    // 👤 PROFILE (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect dashboard ke home (setelah login)
Route::get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard')->middleware('auth');


// Include route auth dari Breeze (login, register, forgot password, dll)
require __DIR__ . '/auth.php';