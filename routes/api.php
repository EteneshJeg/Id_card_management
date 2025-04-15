<?php

use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\IdentityCardTemplateController;
use App\Http\Controllers\Api\MaritalStatusController;
use App\Http\Controllers\Api\OrganizationUnitController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\WoredaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IdentityCardDetailsController;
use App\Http\Controllers\Api\IdentityCardTemplateDetailsController;
use App\Http\Controllers\Api\JobPositionsController;
use App\Http\Controllers\Api\JobTitleCategoriesController;
use App\Http\Controllers\Api\OrganizationsController;
use App\Http\Controllers\Api\RegionsController;
use App\Http\Controllers\Api\ZonesController;

// use App\Http\Controllers\IdentityCardTemplatesController;



Route::apiResource('employees',EmployeesController::class);

Route::apiResource('identity-card-details',IdentityCardDetailsController::class);

Route::apiResource('identity-card-templates',IdentityCardTemplateController::class);
Route::apiResource('identity-card-template-details',IdentityCardTemplateDetailsController::class);
Route::apiResource('organizations',OrganizationsController::class);
Route::apiResource('organization-unit',OrganizationUnitController::class);
Route::apiResource('job-position',JobPositionsController::class);
Route::apiResource('job-title-categories',JobTitleCategoriesController::class);
Route::apiResource('salary',SalaryController::class);
Route::apiResource('marital-status',MaritalStatusController::class);
Route::apiResource('regions',RegionsController::class);
Route::apiResource('zones',ZonesController::class);
Route::apiResource('woreda',WoredaController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('identity-card-templates', IdentityCardTemplatesController::class);
