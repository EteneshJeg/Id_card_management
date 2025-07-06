<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

// Controllers
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    EmployeesController,
    IdentityCardTemplateController,
    IdentityCardDetailsController,
    IdentityCardTemplateDetailsController,
    OrganizationsController,
    OrganizationUnitController,
    JobPositionsController,
    JobTitleCategoriesController,
    MaritalStatusController,
    RegionsController,
    ZonesController,
    WoredaController,
    AdminDashboardController,
    RoleController
};

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('organization-units', OrganizationUnitController::class);
Route::apiResource('job-title-categories', JobTitleCategoriesController::class);
Route::apiResource('job-position', JobPositionsController::class);
Route::get('/permissions', function () {
        return Permission::all();
    });

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Authenticated user actions
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/{user}', [UserController::class, 'update']);

    // Employees
    Route::apiResource('employees', EmployeesController::class);

    // Identity & Organization
    Route::apiResource('identity-card-details', IdentityCardDetailsController::class);
    Route::apiResource('identity-card-templates', IdentityCardTemplateController::class);
    Route::apiResource('identity-card-template-details', IdentityCardTemplateDetailsController::class);
    Route::apiResource('organizations', OrganizationsController::class);
    Route::apiResource('marital-status', MaritalStatusController::class);
    Route::post('/marital-status/delete-bunch', [MaritalStatusController::class, 'bulkDestroy']);
    Route::apiResource('regions', RegionsController::class);
    Route::apiResource('zones', ZonesController::class);
    Route::apiResource('woreda', WoredaController::class);
    Route::apiResource('users', UserController::class);

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-dashboard', [AdminDashboardController::class, 'index']);

        // Add admin role/permission management here if needed
    });



    // Roles resource routes except 'show'
    Route::apiResource('roles', RoleController::class)->except(['show']);

    // Assign role to user (quick)
    Route::post('/users/{user}/assign-role', function (User $user, Request $request) {
        $request->validate(['role' => 'required|string|exists:roles,name']);
        $user->assignRole($request->role);
        return response()->json($user->load('roles'));
    });

    // Get current authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::apiResource('identity-card-templates', IdentityCardTemplatesController::class);
