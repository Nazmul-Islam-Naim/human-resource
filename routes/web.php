<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesignationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [HomeController::class ,'index'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //******** users part *******//
    Route::prefix(config('app.user'))->group(function () {
        Route::resource('designation', DesignationController::class);
        Route::resource('user-list', UserController::class);
        Route::resource('user-role', RoleController::class);
    });
    
    // change password part
    Route::get('settings', 'App\Http\Controllers\SettingController@index');
    Route::put('update-user-password/{id}', 'App\Http\Controllers\SettingController@updateUserPassword')->name('update-user-password');

    //******** catalog *******//
    Route::prefix(config('app.cat'))->group(function () {
        Route::resource('department', 'App\Http\Controllers\DepartmentController');
        Route::resource('workstation', 'App\Http\Controllers\WorkstationController');
        Route::resource('designation', 'App\Http\Controllers\DesignationController');
        Route::resource('workstation-designations', 'App\Http\Controllers\WorkstationDesignationController');
        Route::resource('department-workstations', 'App\Http\Controllers\DepartmentWorkstationController');
        Route::resource('salary-scale', 'App\Http\Controllers\SalaryScaleController');
        Route::resource('district', 'App\Http\Controllers\DistrictController');
        Route::resource('occupation', 'App\Http\Controllers\OccupationController');
    });

    //******** educational information *******//
    Route::prefix(config('app.education'))->group(function () {
        Route::resource('degrees', 'App\Http\Controllers\DegreeController');
        Route::resource('passingYears', 'App\Http\Controllers\PassingYearController');
        Route::resource('readingSubjects', 'App\Http\Controllers\ReadingSubjectController');
        Route::resource('boards', 'App\Http\Controllers\BoardController');
        Route::resource('courses', 'App\Http\Controllers\CourseController');
        Route::resource('institutes', 'App\Http\Controllers\InstituteController');
        Route::resource('publications', 'App\Http\Controllers\PublicationController');
    });

    //******** general information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('generalInformations', 'App\Http\Controllers\GeneralInformationController');
    });

    //******** educational information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('educationalInformations', 'App\Http\Controllers\EducationalInformationController');
        Route::get('educationalInformations-report', 'App\Http\Controllers\EducationalInformationController@report')->name('educationalInformations-report');
    });
        
    //******** training information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('trainingInformations', 'App\Http\Controllers\TrainingInformationController');
        Route::get('trainingInformations-report', 'App\Http\Controllers\TrainingInformationController@report')->name('trainingInformations-report');
    });
        
    //******** publication information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('publicationInformations', 'App\Http\Controllers\PublicationInformationController');
        Route::get('publicationInformations-report', 'App\Http\Controllers\PublicationInformationController@report')->name('publicationInformations-report');
    });
        
    //******** promotion information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('promotionInformations', 'App\Http\Controllers\PromotionInformationController');
        Route::get('promotionInformations-report', 'App\Http\Controllers\PromotionInformationController@report')->name('promotionInformations-report');
        Route::get('promotionInformations-promotion', 'App\Http\Controllers\PromotionInformationController@promotion')->name('promotionInformations-promotion');
    });
        
    //******** case information *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('caseInformations', 'App\Http\Controllers\CaseInformationController');
        Route::get('caseInformations-report', 'App\Http\Controllers\CaseInformationController@report')->name('caseInformations-report');
    });

    //******** Human Resource *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::get('employee-list', 'App\Http\Controllers\EmployeeController@index')->name('employee-list');
        Route::get('employee-list/create', 'App\Http\Controllers\EmployeeController@create')->name('employee-list/create');
        Route::post('store-employee', 'App\Http\Controllers\EmployeeController@store')->name('store-employee');
        Route::get('employee-list/{id}/edit', 'App\Http\Controllers\EmployeeController@edit')->name('edit-employee-list');
        Route::put('update-employee/{id}', 'App\Http\Controllers\EmployeeController@update')->name('update-employee');
        Route::get('employee-pofile/{id}', 'App\Http\Controllers\EmployeeController@show')->name('employee-pofile');
        Route::get('employee-transfer', 'App\Http\Controllers\EmployeeController@employeeListForTransfer')->name('employee-transfer');
        Route::get('transfer-form/{id}', 'App\Http\Controllers\EmployeeController@trnasferForm')->name('transfer-form');
        Route::post('transfer-form/{id}', 'App\Http\Controllers\EmployeeController@trnasferFormStore')->name('transfer-form-store');
        Route::get('employee-transferred-list', 'App\Http\Controllers\EmployeeController@employeeTransferredList')->name('employee-transferred-list');
        Route::get('employee-transferred-list/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferredListUpdate')->name('employee-transferred-list-edit');
        Route::put('employee-transferred-update/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferredRecordUpdate')->name('employee-transferred-record-update');

        Route::get('employee-release/{id}', 'App\Http\Controllers\EmployeeController@employeeRelease')->name('employee-release');
        Route::put('employee-release-update/{id}', 'App\Http\Controllers\EmployeeController@employeeReleaseUpdate')->name('employee-release-update');

        Route::get('employee-transferred-history/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferHistory')->name('employee-transferred-history');
        Route::get('employee-transfer-application/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationForm')->name('employee-transfer-application');
        Route::post('employee-transfer-application', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationFormStore')->name('employee-transfer-application-form-store');
        Route::get('employee-transfer-application-list', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationList')->name('employee-transfer-application-list');
        Route::get('employee-transfer-application-print/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationPrint')->name('employee-transfer-application-print');
        Route::get('employee-transfer-application-edit/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationEdit')->name('employee-transfer-application-edit');
        Route::put('employee-transfer-application-edit/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationUpdate')->name('employee-transfer-application-update');
        Route::get('employee-transfer-application-delete/{id}', 'App\Http\Controllers\EmployeeController@employeeTransferApplicationDelete')->name('employee-transfer-application-delete');
        Route::get('employee-pension-prl/{id}', 'App\Http\Controllers\EmployeeController@employeePensionPrlForm')->name('employee-pension-prl');
        Route::post('employee-pension-prl/{id}', 'App\Http\Controllers\EmployeeController@employeePensionPrlFormStore')->name('employee-pension-prl-store');
        Route::get('employee-pension-prl-list', 'App\Http\Controllers\EmployeeController@employeePensionPrlList')->name('employee-pension-prl-list');
        Route::get('employee-pension-prl-history/{id}', 'App\Http\Controllers\EmployeeController@employeePensionHistory')->name('employee-pension-prl-history');
        Route::get('employee-pension-prl-edit/{id}', 'App\Http\Controllers\EmployeeController@pensionAndPrlFormEdit')->name('employee-pension-prl-edit');
        Route::put('employee-pension-prl-edit/{id}', 'App\Http\Controllers\EmployeeController@pensionAndPrlFormUpdate')->name('employee-pension-prl-update');
        Route::get('employee-pension-prl-delete/{id}', 'App\Http\Controllers\EmployeeController@pensionAndPrlDelete')->name('employee-pension-prl-delete');
        Route::get('up-coming-pensions', 'App\Http\Controllers\EmployeeController@upComingPension')->name('up-coming-pensions');
        Route::get('up-coming-prls', 'App\Http\Controllers\EmployeeController@upComingPrl')->name('up-coming-prls');

    });

    //******** transfer status reports *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::get('transfer-status-index', 'App\Http\Controllers\TransferStatusController@index')->name('transfer-status-index');
        Route::get('transfer-status-edit/{id}', 'App\Http\Controllers\TransferStatusController@edit')->name('transfer-status-edit');
        Route::put('transfer-status-update/{id}', 'App\Http\Controllers\TransferStatusController@update')->name('transfer-status-update');
        Route::get('transfer-status-report', 'App\Http\Controllers\TransferStatusController@report')->name('transfer-status-report');
        Route::get('transfer-status-time', 'App\Http\Controllers\TransferStatusController@time')->name('transfer-status-time');
    });

    //******** workstation wise employee *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::get('workstations', 'App\Http\Controllers\WorkstationDesignationController@workstations')->name('workstations');
        Route::get('workstations-report/{id}', 'App\Http\Controllers\WorkstationDesignationController@report')->name('workstations-report');
    });

    //******** department wise employee *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::get('departments', 'App\Http\Controllers\DepartmentWorkstationController@departments')->name('departments');
        Route::get('departments-report/{id}', 'App\Http\Controllers\DepartmentWorkstationController@report')->name('departments-report');
    });

    //******** empty designations *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::resource('empty-designations', 'App\Http\Controllers\EmptyDesignationController');
        Route::get('empty-designation', 'App\Http\Controllers\EmptyDesignationController@emptyDesignation')->name('empty-designation');
        Route::get('empty-designations-report/{designationId}', 'App\Http\Controllers\EmptyDesignationController@report')->name('empty-designations-report');
    });

    //******** job repotr *******//
    Route::prefix(config('app.hr'))->group(function () {
        Route::get('job-report', 'App\Http\Controllers\GeneralInformationController@report')->name('job-report');
    });

      //******** dashboard reports *******//
      Route::prefix(config('app.hr'))->group(function () {
        Route::get('overall-employee', 'App\Http\Controllers\DashboardController@overallEmployee')->name('overall-employee');
        Route::get('present-employee', 'App\Http\Controllers\DashboardController@presentEmployee')->name('present-employee');
        Route::get('pension-employee', 'App\Http\Controllers\DashboardController@pensionEmployee')->name('pension-employee');
        Route::get('director', 'App\Http\Controllers\DashboardController@director')->name('director');
        Route::get('assistant-director', 'App\Http\Controllers\DashboardController@assistantDirector')->name('assistant-director');
        Route::get('sub-assistant-director', 'App\Http\Controllers\DashboardController@subAssistantDirector')->name('sub-assistant-director');
    });

});

require __DIR__.'/auth.php';
