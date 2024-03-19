<?php

use App\Http\Controllers\health_ministry\AddHealthMinistry;
use App\Http\Controllers\health_ministry\NotifyHealthCenter;
use App\Http\Controllers\health_ministry\OperationsHealthMinistry;
use App\Http\Controllers\pages\AddChildFile;
use App\Http\Controllers\pages\OperationsChild;
use App\Http\Controllers\pages\RespondInquiries;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$controller_path = 'App\Http\Controllers';

Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::post('/login', $controller_path . '\authentications\LoginBasic@login')->name('login');


Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');


// My Middleware To Handle All Application :

Route::middleware(['auth.user'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    // Main Page Route


Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');

// Logout :
Route::post('/logout', $controller_path . '\authentications\LoginBasic@logout')->name('logout');


// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
// Update User Info
Route::post('/pages/account-settings-account', [App\Http\Controllers\pages\AccountSettingsAccount::class, 'update'])->name('ok');

// Add Child Data
Route::get('/child/add', $controller_path . '\pages\AddChildFile@index')->name('add-child-file');
Route::get('/parent/add', $controller_path . '\pages\AddChildFile@indexParent')->name('add-parent-file');

Route::get('/check-ssn', [AddChildFile::class, 'checkSsn']);

Route::post('/child/add/store', [App\Http\Controllers\pages\AddChildFile::class, 'store'])->name('store-child');

// parent operation
Route::post('/parent/add/store', [App\Http\Controllers\pages\AddParentFile::class, 'store'])->name('store-parent');
Route::get('/parent/show/operation', [App\Http\Controllers\pages\AddParentFile::class, 'index'])->name('page-operation-parent');



// routes/web.php

Route::get('/parent/ssn-form', [App\Http\Controllers\pages\AddParentFile::class, 'showSSNForm'])->name('parent.ssn-form');
Route::post('/parent/children', [App\Http\Controllers\pages\AddParentFile::class, 'getChildren'])->name('parent.children');

Route::get('/child/search', [OperationsChild::class, 'search'])->name('child.search');
Route::get('/operations-child/edit/{id}', [AddChildFile::class, 'edit'])->name('operations-child.edit');
Route::POST('/children/{id}', [AddChildFile::class, 'update'])->name('children.update');
Route::delete('/child/{id}', [AddChildFile::class, 'deleteChild'])->name('child.delete');


// Add Vaccination to Child
Route::get('/vaccination/add', $controller_path . '\pages\VaccinationAddChild@index')->name('add-vaccination');
Route::post('/vaccination/add', [App\Http\Controllers\pages\VaccinationAddChild::class, 'store'])->name('vaccination-add-child');

// Show Notification Page
Route::get('/notification/info/vaccination/add', $controller_path . '\notification\NotificationPage@index')->name('show-form-notification');
Route::post('/notification/info/vaccination/submit', $controller_path . '\notification\NotificationPage@sendNotification')->name('submit-form-notification');
// read notification
Route::post('/notifications/{notificationId}/mark-as-read', $controller_path . '\notification\NotificationPage@markAsRead');


// show operations child

Route::get('/operations/child', $controller_path . '\pages\OperationsChild@index')->name('operations-child');
Route::get('/operations-child/print-health-file/{id}', [OperationsChild::class, 'printHealthFile'])->name('child.printHealthFile');

// Get Child Name By National Number
Route::get('/get-child-name/{national_number}', [App\Http\Controllers\pages\VaccinationAddChild::class, 'getChildName']);
Route::get('/get-child-national-nubmer/{national_number}', [App\Http\Controllers\pages\VaccinationAddChild::class, 'getChildNatinonalNumber']);

// Respond Inquiries

Route::get('/respond-inquiris',[RespondInquiries::class,'index'])->name('respond-inquiry.index');
Route::put('/respond-inquiries/{id}', [RespondInquiries::class, 'update'])->name('respond-inquiries.update');


Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication



// -------------------------------- Ministry Side -------------------------------- \\


Route::get('/health-center/add',[AddHealthMinistry::class,'create'])->name('health-center-add');
Route::post('/health-center/store',[AddHealthMinistry::class,'store'])->name('health-center-store');

Route::get('/operations/health-ministry',[OperationsHealthMinistry::class,'index'])->name('health-ministry-operations');
// Edit Health Center Data
Route::get('/operations-health-center/edit/{id}', [OperationsHealthMinistry::class, 'edit'])->name('edit-health-center');
Route::POST('/operations-health-center/update/{id}', [OperationsHealthMinistry::class, 'update'])->name('update-health-center');

Route::put('/users/{user}/activate', [OperationsHealthMinistry::class,'updateActivation'])->name('updateActivation');


Route::get('/add-location-health-center/{id}', [OperationsHealthMinistry::class, 'showMapUser'])->name('add-location-health-center');
Route::post('/submit-location/{id}', [OperationsHealthMinistry::class, 'submitLocation'])->name('submit-location');


Route::get('/notify-health-center',[NotifyHealthCenter::class,'index'])->name('notify-health-center');
Route::post('/send-notify-health-center', [NotifyHealthCenter::class,'sendNotification'])->name('send-notify-health-center');
Route::post('/send-vacc-to-amount', [NotifyHealthCenter::class,'addVac'])->name('send-vacc-to-amount');

Route::get('/notify-info-health-center',[NotifyHealthCenter::class,'indexInfo'])->name('notify-info-health-center');
Route::post('/send-notify-info-health-center',[NotifyHealthCenter::class,'sendInfoVaccinationNotification'])->name('send-notify-info-health-center');



// -------------------------------- End Ministry Side -------------------------------- \\




// cards
Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');


});


