<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IdentityCardTemplatesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\IdentityCardDetailsController;
use App\Http\Controllers\IdentityCardTemplateDetailsController;
use App\Http\Controllers\JobTitleCategoriesController;
use App\Http\Controllers\JobPositionsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\OrganizationUnitsController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\MaritalStatusesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ZonesController;
use App\Http\Controllers\WoredasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('identity_card_templates', IdentityCardTemplatesController::class)->names([
    'index' => 'identity_card_templates.identity_card_template.index',
    'create' => 'identity_card_templates.identity_card_template.create',
    'store' => 'identity_card_templates.identity_card_template.store',
    'show' => 'identity_card_templates.identity_card_template.show',
    'edit' => 'identity_card_templates.identity_card_template.edit',
    'update' => 'identity_card_templates.identity_card_template.update',
    'destroy' => 'identity_card_templates.identity_card_template.destroy',
]);
require __DIR__ .'/auth.php';

Route::group([
    'prefix' => 'employees',
], function () {
    Route::get('/', [EmployeesController::class, 'index'])
         ->name('employees.employee.index');
    Route::get('/create', [EmployeesController::class, 'create'])
         ->name('employees.employee.create');
    Route::get('/show/{employee}',[EmployeesController::class, 'show'])
         ->name('employees.employee.show')->where('id', '[0-9]+');
    Route::get('/{employee}/edit',[EmployeesController::class, 'edit'])
         ->name('employees.employee.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeesController::class, 'store'])
         ->name('employees.employee.store');
    Route::put('employee/{employee}', [EmployeesController::class, 'update'])
         ->name('employees.employee.update')->where('id', '[0-9]+');
    Route::delete('/employee/{employee}',[EmployeesController::class, 'destroy'])
         ->name('employees.employee.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'identity_card_details',
], function () {
    Route::get('/', [IdentityCardDetailsController::class, 'index'])
         ->name('identity_card_details.identity_card_detail.index');
    Route::get('/create', [IdentityCardDetailsController::class, 'create'])
         ->name('identity_card_details.identity_card_detail.create');
    Route::get('/show/{identityCardDetail}',[IdentityCardDetailsController::class, 'show'])
         ->name('identity_card_details.identity_card_detail.show');
    Route::get('/{identityCardDetail}/edit',[IdentityCardDetailsController::class, 'edit'])
         ->name('identity_card_details.identity_card_detail.edit');
    Route::post('/', [IdentityCardDetailsController::class, 'store'])
         ->name('identity_card_details.identity_card_detail.store');
    Route::put('identity_card_detail/{identityCardDetail}', [IdentityCardDetailsController::class, 'update'])
         ->name('identity_card_details.identity_card_detail.update');
    Route::delete('/identity_card_detail/{identityCardDetail}',[IdentityCardDetailsController::class, 'destroy'])
         ->name('identity_card_details.identity_card_detail.destroy');
});

Route::group([
    'prefix' => 'identity_card_template_details',
], function () {
    Route::get('/', [IdentityCardTemplateDetailsController::class, 'index'])
         ->name('identity_card_template_details.identity_card_template_detail.index');
    Route::get('/create', [IdentityCardTemplateDetailsController::class, 'create'])
         ->name('identity_card_template_details.identity_card_template_detail.create');
    Route::get('/show/{identityCardTemplateDetail}',[IdentityCardTemplateDetailsController::class, 'show'])
         ->name('identity_card_template_details.identity_card_template_detail.show');
    Route::get('/{identityCardTemplateDetail}/edit',[IdentityCardTemplateDetailsController::class, 'edit'])
         ->name('identity_card_template_details.identity_card_template_detail.edit');
    Route::post('/', [IdentityCardTemplateDetailsController::class, 'store'])
         ->name('identity_card_template_details.identity_card_template_detail.store');
    Route::put('identity_card_template_detail/{identityCardTemplateDetail}', [IdentityCardTemplateDetailsController::class, 'update'])
         ->name('identity_card_template_details.identity_card_template_detail.update');
    Route::delete('/identity_card_template_detail/{identityCardTemplateDetail}',[IdentityCardTemplateDetailsController::class, 'destroy'])
         ->name('identity_card_template_details.identity_card_template_detail.destroy');
});

Route::group([
    'prefix' => 'job_title_categories',
], function () {
    Route::get('/', [JobTitleCategoriesController::class, 'index'])
         ->name('job_title_categories.job_title_category.index');
    Route::get('/create', [JobTitleCategoriesController::class, 'create'])
         ->name('job_title_categories.job_title_category.create');
    Route::get('/show/{jobTitleCategory}',[JobTitleCategoriesController::class, 'show'])
         ->name('job_title_categories.job_title_category.show');
    Route::get('/{jobTitleCategory}/edit',[JobTitleCategoriesController::class, 'edit'])
         ->name('job_title_categories.job_title_category.edit');
    Route::post('/', [JobTitleCategoriesController::class, 'store'])
         ->name('job_title_categories.job_title_category.store');
    Route::put('job_title_category/{jobTitleCategory}', [JobTitleCategoriesController::class, 'update'])
         ->name('job_title_categories.job_title_category.update');
    Route::delete('/job_title_category/{jobTitleCategory}',[JobTitleCategoriesController::class, 'destroy'])
         ->name('job_title_categories.job_title_category.destroy');
});

Route::group([
    'prefix' => 'job_positions',
], function () {
    Route::get('/', [JobPositionsController::class, 'index'])
         ->name('job_positions.job_position.index');
    Route::get('/create', [JobPositionsController::class, 'create'])
         ->name('job_positions.job_position.create');
    Route::get('/show/{jobPosition}',[JobPositionsController::class, 'show'])
         ->name('job_positions.job_position.show');
    Route::get('/{jobPosition}/edit',[JobPositionsController::class, 'edit'])
         ->name('job_positions.job_position.edit');
    Route::post('/', [JobPositionsController::class, 'store'])
         ->name('job_positions.job_position.store');
    Route::put('job_position/{jobPosition}', [JobPositionsController::class, 'update'])
         ->name('job_positions.job_position.update');
    Route::delete('/job_position/{jobPosition}',[JobPositionsController::class, 'destroy'])
         ->name('job_positions.job_position.destroy');
});

Route::group([
    'prefix' => 'organizations',
], function () {
    Route::get('/', [OrganizationsController::class, 'index'])
         ->name('organizations.organization.index');
    Route::get('/create', [OrganizationsController::class, 'create'])
         ->name('organizations.organization.create');
    Route::get('/show/{organization}',[OrganizationsController::class, 'show'])
         ->name('organizations.organization.show');
    Route::get('/{organization}/edit',[OrganizationsController::class, 'edit'])
         ->name('organizations.organization.edit');
    Route::post('/', [OrganizationsController::class, 'store'])
         ->name('organizations.organization.store');
    Route::put('organization/{organization}', [OrganizationsController::class, 'update'])
         ->name('organizations.organization.update');
    Route::delete('/organization/{organization}',[OrganizationsController::class, 'destroy'])
         ->name('organizations.organization.destroy');
});

Route::group([
    'prefix' => 'organization_units',
], function () {
    Route::get('/', [OrganizationUnitsController::class, 'index'])
         ->name('organization_units.organization_unit.index');
    Route::get('/create', [OrganizationUnitsController::class, 'create'])
         ->name('organization_units.organization_unit.create');
    Route::get('/show/{organizationUnit}',[OrganizationUnitsController::class, 'show'])
         ->name('organization_units.organization_unit.show');
    Route::get('/{organizationUnit}/edit',[OrganizationUnitsController::class, 'edit'])
         ->name('organization_units.organization_unit.edit');
    Route::post('/', [OrganizationUnitsController::class, 'store'])
         ->name('organization_units.organization_unit.store');
    Route::put('organization_unit/{organizationUnit}', [OrganizationUnitsController::class, 'update'])
         ->name('organization_units.organization_unit.update');
    Route::delete('/organization_unit/{organizationUnit}',[OrganizationUnitsController::class, 'destroy'])
         ->name('organization_units.organization_unit.destroy');
});

Route::group([
    'prefix' => 'salaries',
], function () {
    Route::get('/', [SalariesController::class, 'index'])
         ->name('salaries.salary.index');
    Route::get('/create', [SalariesController::class, 'create'])
         ->name('salaries.salary.create');
    Route::get('/show/{salary}',[SalariesController::class, 'show'])
         ->name('salaries.salary.show');
    Route::get('/{salary}/edit',[SalariesController::class, 'edit'])
         ->name('salaries.salary.edit');
    Route::post('/', [SalariesController::class, 'store'])
         ->name('salaries.salary.store');
    Route::put('salary/{salary}', [SalariesController::class, 'update'])
         ->name('salaries.salary.update');
    Route::delete('/salary/{salary}',[SalariesController::class, 'destroy'])
         ->name('salaries.salary.destroy');
});

Route::group([
    'prefix' => 'marital_statuses',
], function () {
    Route::get('/', [MaritalStatusesController::class, 'index'])
         ->name('marital_statuses.marital_status.index');
    Route::get('/create', [MaritalStatusesController::class, 'create'])
         ->name('marital_statuses.marital_status.create');
    Route::get('/show/{maritalStatus}',[MaritalStatusesController::class, 'show'])
         ->name('marital_statuses.marital_status.show');
    Route::get('/{maritalStatus}/edit',[MaritalStatusesController::class, 'edit'])
         ->name('marital_statuses.marital_status.edit');
    Route::post('/', [MaritalStatusesController::class, 'store'])
         ->name('marital_statuses.marital_status.store');
    Route::put('marital_status/{maritalStatus}', [MaritalStatusesController::class, 'update'])
         ->name('marital_statuses.marital_status.update');
    Route::delete('/marital_status/{maritalStatus}',[MaritalStatusesController::class, 'destroy'])
         ->name('marital_statuses.marital_status.destroy');
});

Route::group([
    'prefix' => 'regions',
], function () {
    Route::get('/', [RegionsController::class, 'index'])
         ->name('regions.region.index');
    Route::get('/create', [RegionsController::class, 'create'])
         ->name('regions.region.create');
    Route::get('/show/{region}',[RegionsController::class, 'show'])
         ->name('regions.region.show');
    Route::get('/{region}/edit',[RegionsController::class, 'edit'])
         ->name('regions.region.edit');
    Route::post('/', [RegionsController::class, 'store'])
         ->name('regions.region.store');
    Route::put('region/{region}', [RegionsController::class, 'update'])
         ->name('regions.region.update');
    Route::delete('/region/{region}',[RegionsController::class, 'destroy'])
         ->name('regions.region.destroy');
});

Route::group([
    'prefix' => 'zones',
], function () {
    Route::get('/', [ZonesController::class, 'index'])
         ->name('zones.zone.index');
    Route::get('/create', [ZonesController::class, 'create'])
         ->name('zones.zone.create');
    Route::get('/show/{zone}',[ZonesController::class, 'show'])
         ->name('zones.zone.show');
    Route::get('/{zone}/edit',[ZonesController::class, 'edit'])
         ->name('zones.zone.edit');
    Route::post('/', [ZonesController::class, 'store'])
         ->name('zones.zone.store');
    Route::put('zone/{zone}', [ZonesController::class, 'update'])
         ->name('zones.zone.update');
    Route::delete('/zone/{zone}',[ZonesController::class, 'destroy'])
         ->name('zones.zone.destroy');
});

Route::group([
    'prefix' => 'woredas',
], function () {
    Route::get('/', [WoredasController::class, 'index'])
         ->name('woredas.woreda.index');
    Route::get('/create', [WoredasController::class, 'create'])
         ->name('woredas.woreda.create');
    Route::get('/show/{woreda}',[WoredasController::class, 'show'])
         ->name('woredas.woreda.show');
    Route::get('/{woreda}/edit',[WoredasController::class, 'edit'])
         ->name('woredas.woreda.edit');
    Route::post('/', [WoredasController::class, 'store'])
         ->name('woredas.woreda.store');
    Route::put('woreda/{woreda}', [WoredasController::class, 'update'])
         ->name('woredas.woreda.update');
    Route::delete('/woreda/{woreda}',[WoredasController::class, 'destroy'])
         ->name('woredas.woreda.destroy');
});