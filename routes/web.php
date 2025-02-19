<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Exports\TasksExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('tasks/pdf', [TaskController::class, 'generatePDF'])->name('tasks.generatePDF');



Route::resource('categories', CategoryController::class)->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');


Route::get('tasks/export', function () {
    return Excel::download(new TasksExport, 'tasks.xlsx');  
})->name('tasks.export');

Route::get('tasks/export/csv', function () {
    return Excel::download(new TasksExport, 'tasks.csv', \Maatwebsite\Excel\Excel::CSV);  
})->name('tasks.export.csv');

Route::post('/tasks/bulk-delete', [TaskController::class, 'bulkDelete'])->name('tasks.bulkDelete');

