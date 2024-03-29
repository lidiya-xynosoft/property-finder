<?php

// FRONT-END ROUTES

use App\Http\Controllers\Admin\AgreementManageController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\ExpenseManageController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontPageController@index')->name('home');
// Route::get('/', function () {
//     return view('auth.login');
// })->name('home');

Route::get('/slider', 'FrontPageController@slider')->name('slider.index');

Route::post('/search', 'FrontPageController@search')->name('search');

Route::get('/property', 'PagesController@properties')->name('property');
Route::get('/property/{id}/{slug}', 'PagesController@propertieshow')->name('property.show');
Route::post('/property/message', 'PagesController@messageAgent')->name('property.message');
Route::post('/property/comment/{id}', 'PagesController@propertyComments')->name('property.comment');
Route::post('/property/rating', 'PagesController@propertyRating')->name('property.rating');
Route::get('/property/city/{cityslug}', 'PagesController@propertyCities')->name('property.city');
Route::get('/property/{cityslug}', 'PagesController@propertyCitieswithslug')->name('property.cityslug');
Route::get('/property/city-lat-long', 'PagesController@getCityLatLong');


Route::get('/agents', 'PagesController@agents')->name('agents');
Route::get('/agents/{id}', 'PagesController@agentshow')->name('agents.show');

Route::get('/gallery', 'PagesController@gallery')->name('gallery');

Route::get('/blog', 'PagesController@blog')->name('blog');
Route::get('/blog/{id}', 'PagesController@blogshow')->name('blog.show');
Route::post('/blog/comment/{id}', 'PagesController@blogComments')->name('blog.comment');

Route::get('/blog/categories/{slug}', 'PagesController@blogCategories')->name('blog.categories');
Route::get('/blog/tags/{slug}', 'PagesController@blogTags')->name('blog.tags');
Route::get('/blog/author/{username}', 'PagesController@blogAuthor')->name('blog.author');

Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@messageContact')->name('contact.message');
Route::get('/tenant/complaint', 'FrontPageController@complaintForm')->name('complaintform');
Route::post('/tenant/complaint', 'FrontPageController@tenantComplaints')->name('tenant.complaint');


Auth::routes();

Route::get('publish-previewed-agreement', [AgreementManageController::class, 'publishPreviewedAgreement']);
Route::get('/agreement/generate-pdf', [AgreementManageController::class, 'generate_pdf']);
Route::get('agreement/sign-agreement', [AgreementManageController::class, 'signAgreement']);
Route::post('expense/save-update-expense', [ExpenseManageController::class, 'saveUpdateExpense']);
Route::post('invoice/save-invoices', [InvoiceController::class, 'saveUpdateInvoice']);
Route::post('landlord-expense/save-update-expense', [ExpenseManageController::class, 'saveUpdatelandlordExpense']);

Route::post('rent/save-update-rent', [ExpenseManageController::class, 'rentPayment']);
// Route::post('document/save-update-document', [DocumentController::class, 'saveUpdateDocument']);
Route::delete('expense/delete/{id}', [ExpenseManageController::class, 'destroy']);
Route::delete('document/delete/{id}', [DocumentController::class, 'destroy']);
Route::get('rent/pay/{id}', [ExpenseManageController::class, 'rentPayment']);
Route::get('contract/withdrow', [AgreementManageController::class, 'withdrowProperty']);
Route::post('landlord-rent/save-update-landlord-rent', [ExpenseManageController::class, 'landlordRentPayment']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagController');
    Route::resource('document-type', 'DocumentTypeController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('amenities', 'AminityController');
    Route::resource('purposes', 'PurposeController');
    Route::resource('types', 'TypeController');
    Route::resource('properties', 'PropertyController');
    Route::post('properties/gallery/delete', 'PropertyController@galleryImageDelete')->name('gallery-delete');
    Route::get('property/manage/', 'PropertyController@propertyManage')->name('property-manage');
    Route::get('agreement/manage/', 'AgreementManageController@agreementManage')->name('agreement-show');
    Route::resource('complaints', 'ComplaintController');
    Route::post('/agreement/save-update-agreement', 'AgreementManageController@saveUpdateagreement')->name('agreement-manage');
    Route::post('/document/save-update-document', 'DocumentController@saveUpdateDocument')->name('document-save');
    Route::get('/change-handyman-status', 'HandymanController@changeHandymanStatus')->name('change-handyman');
    Route::get('complaint-history/', 'DashboardController@complaintHistory')->name('complaint-history');
    // Route::get('properties/index/{type}', 'PropertyController@index');
    Route::get('/expense/update-expense/{id}', 'ExpenseManageController@updateExpense')->name('update-expense');

    Route::get('landlord-property/manage/', 'PropertylandlordController@propertylandlordManage')->name('landlord-manage');
    Route::post('/landlord/save-update-contract', 'AgreementManageController@saveUpdateContract')->name('contract-manage');
    Route::get('reports/', 'ReportController@index')->name('reports');
    Route::get('tenant-service-report', 'ReportController@tenantServiceReport')->name('tenant-service-report');
    Route::post('tenant-service-report', 'ReportController@tenantServiceReport')->name('tenant-service-report');
    Route::get('property-expense-report', 'ReportController@propertyExpenseReport')->name('property-expense-report');
    Route::post('property-expense-report', 'ReportController@propertyExpenseReport')->name('property-expense-report');
    Route::post('property-income-report', 'ReportController@propertyIncomeReport')->name('property-income-report');
    Route::get('property-income-report', 'ReportController@propertyIncomeReport')->name('property-income-report');
    Route::post('/landlord/save-dividend-rule', 'DividendController@store')->name('dividend-save');
    Route::post('landlord/dividend-rule/delete', 'DividendController@dividendRuleDelete')->name('dividend-rule-delete');
    Route::post('share-holder-account-report', 'ReportController@shareHolderAccountsReport')->name('share-holder-report');
    Route::get('share-holder-account-report', 'ReportController@shareHolderAccountsReport')->name('share-holder-report');

    Route::post('agreement-income-report', 'ReportController@agreementIncomeReport')->name('agreement-income-report');
    Route::get('agreement-income-report', 'ReportController@agreementIncomeReport')->name('agreement-income-report');

    Route::resource('sliders', 'SliderController');
    Route::resource('services', 'ServiceController');
    Route::resource('ledger', 'LedgerController');

    Route::resource('cities', 'CityController');
    Route::resource('countries', 'CountryController');
    Route::resource('tenants', 'TenantController');
    Route::resource('landlords', 'LandlordController');
    Route::resource('share-holder', 'ShareHolderController');
    Route::resource('tenant-service', 'TenantServiceController');
    Route::resource('cancellation-reason', 'CancellationReasonController');
    Route::resource('handyman', 'HandymanController');
    Route::resource('testimonials', 'TestimonialController');
    Route::get('daybook', 'DaybookController@index')->name('transactions');
    Route::get('tenancy-list', 'TenantController@list')->name('list');

    Route::get('galleries/album', 'GalleryController@album')->name('album');
    Route::post('galleries/album/store', 'GalleryController@albumStore')->name('album.store');
    Route::get('galleries/{id}/gallery', 'GalleryController@albumGallery')->name('album.gallery');
    Route::post('galleries', 'GalleryController@Gallerystore')->name('galleries.store');

    Route::get('settings', 'DashboardController@settings')->name('settings');
    Route::post('settings', 'DashboardController@settingStore')->name('settings.store');

    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('complaint', 'DashboardController@complaint')->name('complaint');
    Route::get('complaint/read/{id}', 'DashboardController@complaintRead')->name('complaint.read');
    Route::post('complaint/reject/', 'DashboardController@complaintReject')->name('complaint.reject');
    Route::post('complaint/action', 'DashboardController@complaintAction')->name('complaint.action');
    Route::post('complaint/search', 'DashboardController@complaintSearch')->name('complaint.search');
    Route::get('handyman-manage/', 'HandymanController@handymanManage')->name('handyman-manage');
    Route::get('complaint/invoice/{id}', 'HandymanController@complaintInvoice')->name('complaint.invoice');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::get('message/replay/{id}', 'DashboardController@messageReplay')->name('message.replay');
    Route::post('message/replay', 'DashboardController@messageSend')->name('message.send');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
    Route::post('message/mail', 'DashboardController@contactMail')->name('message.mail');

    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');
});

Route::group(['prefix' => 'agent', 'namespace' => 'Agent', 'middleware' => ['auth', 'agent'], 'as' => 'agent.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');
    Route::resource('properties', 'PropertyController');
    Route::post('properties/gallery/delete', 'PropertyController@galleryImageDelete')->name('gallery-delete');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::get('message/replay/{id}', 'DashboardController@messageReplay')->name('message.replay');
    Route::post('message/replay', 'DashboardController@messageSend')->name('message.send');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
    Route::post('message/mail', 'DashboardController@contactMail')->name('message.mail');
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'user'], 'as' => 'user.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::get('message/replay/{id}', 'DashboardController@messageReplay')->name('message.replay');
    Route::post('message/replay', 'DashboardController@messageSend')->name('message.send');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
});