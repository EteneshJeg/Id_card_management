<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    SalaryController,
    MaritalStatusController,
    RegionsController,
    ZonesController,
    WoredaController,
    RolePermissionController,
    AdminDashboardController
};

//  Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes for authenticated users
Route::middleware('auth:sanctum')->group(function () {

    //  Authenticated User Actions
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/{user}', [UserController::class, 'update']);

    // 🧑‍💼 Employees
    Route::apiResource('employees', EmployeesController::class);

    // Identity & Organization
    Route::apiResource('identity-card-details', IdentityCardDetailsController::class);
    Route::apiResource('identity-card-templates', IdentityCardTemplateController::class);
    Route::apiResource('identity-card-template-details', IdentityCardTemplateDetailsController::class);
    Route::apiResource('organizations', OrganizationsController::class);
    Route::apiResource('organization-units', OrganizationUnitController::class);
    Route::apiResource('job-position', JobPositionsController::class);
    Route::apiResource('job-title-categories', JobTitleCategoriesController::class);
    Route::apiResource('salary', SalaryController::class);
    Route::apiResource('marital-status', MaritalStatusController::class);
    Route::apiResource('regions', RegionsController::class);
    Route::apiResource('zones', ZonesController::class);
    Route::apiResource('woreda', WoredaController::class);
    Route::apiResource('users', UserController::class);

    //  Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-dashboard', [AdminDashboardController::class, 'index']);

        // Role/Permission Management
        Route::post('/permissions', [RolePermissionController::class, 'createPermission']);
        Route::post('/roles', [RolePermissionController::class, 'createRole']);
        Route::get('roles', [RolePermissionController::class, 'index']);
        Route::post('roles/{role_id}/permissions', [RolePermissionController::class, 'assignPermissions']);
        Route::post('/users/{user_id}/roles', [RolePermissionController::class, 'assignRoleToUser']);
    });

    //  Get current authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
// Route::apiResource('identity-card-templates', IdentityCardTemplatesController::class);
