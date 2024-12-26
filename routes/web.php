<?php

use App\Http\Controllers\AmenitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PermissionCategory;
use App\Http\Controllers\PermissionsubCategory;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Grouping all routes with auth middleware
Route::middleware(['auth', 'checkRole'])->group(function () {
    Route::get('/register',function(){
        redirect(route('login'));
    });
    Route::get('/profile-update',[MemberController::class, 'profile_update'])->name('profile.update')->middleware('auth');
    Route::get('/change-password',[MemberController::class, 'change_password'])->name('change.password')->middleware('auth');
    Route::post('/update-password',[MemberController::class, 'update_password'])->name('update.password')->middleware('auth');
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Role Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/store-roles', [RoleController::class, 'store_roles'])->name('store.roles');
    Route::get('/edit-roles/{id}', [RoleController::class, 'edit_roles'])->name('edit.roles');
    Route::delete('/destroy-roles/{id}', [RoleController::class, 'destroy_roles'])->name('destroy.roles');

    // Permission Category Routes
    Route::get('/permission_category', [PermissionCategory::class, 'index'])->name('permission.category');
    Route::post('/store-permission_category', [PermissionCategory::class, 'store_permission_category'])->name('store.permission_category');
    Route::get('/edit-permission_category/{id}', [PermissionCategory::class, 'edit_permission_category'])->name('edit.permission_category');
    Route::delete('/destroy-permission_category/{id}', [PermissionCategory::class, 'destroy_permission_category'])->name('destroy.permission_category');

    // Permission Category Routes
    Route::get('/bedtype', [BedController::class, 'index'])->name('bedtype');
    Route::post('/store-bedtype', [BedController::class, 'store_bedtype'])->name('store.bedtype');
    Route::get('/edit-bedtype/{id}', [BedController::class, 'edit_bedtype'])->name('edit.bedtype');
    Route::delete('/destroy-bedtype/{id}', [BedController::class, 'destroy_bedtype'])->name('destroy.bedtype');

    // Permission Sub Category Routes
    Route::get('/permission_subcategory', [PermissionsubCategory::class, 'index'])->name('permission.subcategory');
    Route::post('/store-permission_subcategory', [PermissionsubCategory::class, 'store_permission_subcategory'])->name('store.permission_subcategory');
    Route::get('/edit-permission_subcategory/{id}', [PermissionsubCategory::class, 'edit_permission_subcategory'])->name('edit.permission_subcategory');
    Route::delete('/destroy-permission_subcategory/{id}', [PermissionsubCategory::class, 'destroy_permission_subcategory'])->name('destroy.permission_subcategory');

    // Member Routes
    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::get('approved/member', [MemberController::class, 'approved_index'])->name('approved.member');
    Route::get('pending/member', [MemberController::class, 'pending_index'])->name('pending.member');
    Route::get('/borrower', [MemberController::class, 'borrower'])->name('borrower');
    Route::get('/userlocation', [MemberController::class, 'borrower'])->name('userlocation')->middleware('user_location');
    Route::post('/user_location/check-otp', [MemberController::class, 'check_otp'])->name('userlocation.otp.check');

    Route::match(['get', 'post'], '/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
    Route::get('/member/view/{id}', [MemberController::class, 'view'])->name('member.view');
    Route::post('/member/update', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/delete/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/member/kyc', [MemberController::class, 'member_kyc'])->name('member.kyc');
    Route::get('/view/member/kyc/{id}', [MemberController::class, 'view_member_kyc'])->name('view.member.kyc');
    Route::put('/update/kyc/{id}', [MemberController::class, 'update_kyc_status'])->name('update.kyc.status');

    // Permission Route
    Route::get('/permission/{id}', [RoleController::class, 'permission'])->name('permission');
    Route::post('/permission/update', [RoleController::class, 'update_permission'])->name('permission.update');

    // Status Active Inactive Route
    Route::post('/change-status', [RoleController::class, 'change_status'])->name('change.status');
    Route::post('/user-verified', [RoleController::class, 'user_verified'])->name('user.verified');
    Route::post('/change-status-property', [RoleController::class, 'change_status_property'])->name('change.status.property');

    // Lead Routes
    Route::get('/lead', [LeadController::class, 'index'])->name('lead');
    Route::get('/lead-admin', [LeadController::class, 'admin_lead'])->name('lead.admin');
    Route::match(['get', 'post'], '/lead/create', [LeadController::class, 'create'])->name('lead.create');
    Route::get('/lead/edit/{id}', [LeadController::class, 'edit'])->name('lead.edit');

    Route::post('/lead/update', [LeadController::class, 'update'])->name('lead.update');
    Route::delete('/lead/delete/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
    Route::get('/lead-qualified', [LeadController::class, 'qualified_leads'])->name('lead.qualified');
    Route::get('/kyclead/view/{id}', [LeadController::class, 'kyclead_view'])->name('kyclead.view');
    Route::post('/kyc-process', [LeadController::class, 'kyc_process'])->name('kyc.process');

    // Category Route
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::match(['get', 'post'], '/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Testimonals Route
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
    Route::match(['get', 'post'], '/testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::get('/testimonial/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('/testimonial/update', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::delete('/testimonial/delete/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

    // Job Title Route
    Route::get('/job', [JobController::class, 'index'])->name('job');
    Route::match(['get', 'post'], '/job/create', [JobController::class, 'create'])->name('job.create');
    Route::get('/job/{id}', [JobController::class, 'edit'])->name('job.edit');
    Route::post('/job/update', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/delete/{id}', [JobController::class, 'destroy'])->name('job.destroy');

    // Banners Route
    Route::get('/banner', [BannerController::class, 'index'])->name('banner');
    Route::match(['get', 'post'], '/banner/create', [BannerController::class, 'create'])->name('banner.create');
    Route::get('/banner/{id}', [BannerController::class, 'edit'])->name('banner.edit');
    Route::post('/banner/update', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');

    // Blog Route
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::match(['get', 'post'], '/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/blog/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/update', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

    // Gallary Route
    Route::get('/gallary', [GallaryController::class, 'index'])->name('gallary');
    Route::match(['get', 'post'], '/gallary/create', [GallaryController::class, 'create'])->name('gallary.create');
    Route::get('/gallary/{id}', [GallaryController::class, 'edit'])->name('gallary.edit');
    Route::post('/gallary/update', [GallaryController::class, 'update'])->name('gallary.update');
    Route::delete('/gallary/delete/{id}', [GallaryController::class, 'destroy'])->name('gallary.destroy');

    // Seo Route
    Route::get('/seo', [SeoController::class, 'index'])->name('seo');
    Route::match(['get', 'post'], '/seo/create', [SeoController::class, 'create'])->name('seo.create');
    Route::get('/seo/{id}', [SeoController::class, 'edit'])->name('seo.edit');
    Route::post('/seo/update', [SeoController::class, 'update'])->name('seo.update');
    Route::delete('/seo/delete/{id}', [SeoController::class, 'destroy'])->name('seo.destroy');

    // Property Route
    Route::get('/property', [PropertyController::class, 'index'])->name('property');
    Route::get('pending/property', [PropertyController::class, 'pending_index'])->name('pending.property');
    Route::match(['get', 'post'], '/property/create', [PropertyController::class, 'create'])->name('property.create');
    Route::get('/property/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::post('/property/update', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');
    Route::post('/property/delete-sub-image', [PropertyController::class, 'delete_image'])->name('delete.image');
    Route::match(['get', 'post'], '/property/book/create', [PropertyController::class, 'book_create'])->name('book.property.create');
    Route::get('/book/property/{id}', [PropertyController::class, 'book_edit'])->name('book.property.edit');
    Route::post('/book/property/update', [PropertyController::class, 'book_update'])->name('book.property.update');
    Route::match(['get', 'post'],'/book/property/aad/room/{id}', [PropertyController::class, 'add_room'])->name('book.add.room');


    // Notes Route
    Route::post('/note/save-notes', [NotesController::class, 'create'])->name('notes.create');
    Route::post('/note/fetch-notes', [NotesController::class, 'fetch_notes'])->name('notes.fetch');
    Route::post('/note/notes-delete', [NotesController::class, 'delete_notes'])->name('notes.delete');
    Route::post('/note/notes-disscuss', [NotesController::class, 'notes_disscuss'])->name('notes.disscuss');

    // Providers
    Route::get('/facilities', [FacilitiesController::class, 'index'])->name('facilities');
    Route::match(['get', 'post'], '/facilities/create', [FacilitiesController::class, 'create'])->name('facilities.create');
    Route::get('/facilities/{id}', [FacilitiesController::class, 'edit'])->name('facilities.edit');
    Route::post('/facilities/update', [FacilitiesController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/delete/{id}', [FacilitiesController::class, 'destroy'])->name('facilities.destroy');
    Route::put('/addfacilities-package', [FacilitiesController::class, 'addfacilities_package'])->name('addfacilities.package');

    // Amenties
    Route::get('/amenities', [AmenitiesController::class, 'index'])->name('amenities');
    Route::match(['get', 'post'], '/amenities/create', [AmenitiesController::class, 'create'])->name('amenities.create');
    Route::get('/amenities/{id}', [AmenitiesController::class, 'edit'])->name('amenities.edit');
    Route::post('/amenities/update', [AmenitiesController::class, 'update'])->name('amenities.update');
    Route::delete('/amenities/delete/{id}', [AmenitiesController::class, 'destroy'])->name('amenities.destroy');
    Route::put('/addamenities-package', [AmenitiesController::class, 'addamenities_package'])->name('addamenities.package');

    // Providers
    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::match(['get', 'post'], '/package/create', [PackageController::class, 'create'])->name('package.create');
    Route::get('/package/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/update', [PackageController::class, 'update'])->name('package.update');
    Route::delete('/package/delete/{id}', [PackageController::class, 'destroy'])->name('package.destroy');


    // Payment Mode
    Route::get('/payment-mode', [PaymentModeController::class, 'index'])->name('payment_mode');
    Route::match(['get', 'post'], '/payment-mode/create', [PaymentModeController::class, 'create'])->name('payment_mode.create');
    Route::get('/payment-mode/{id}', [PaymentModeController::class, 'edit'])->name('payment_mode.edit');
    Route::post('/payment-mode/update', [PaymentModeController::class, 'update'])->name('payment_mode.update');
    Route::delete('/payment-mode/delete/{id}', [PaymentModeController::class, 'destroy'])->name('payment_mode.destroy');
    // Bank Detail
    Route::get('/bank', [BankController::class, 'index'])->name('bank');
    Route::match(['get', 'post'], '/bank/create', [BankController::class, 'create'])->name('bank.create');
    Route::get('/bank/{id}', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('/bank/update', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/bank/delete/{id}', [BankController::class, 'destroy'])->name('bank.destroy');
    // cms route
    Route::get('company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::get('pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
    Route::post('pages/{id}', [PagesController::class, 'update'])->name('pages.update');
    Route::get('enquiry', [CompanyController::class, 'enquiry'])->name('enquiry');
    Route::get('career-enquiry', [CompanyController::class, 'career_enquiry'])->name('career.enquiry');

    // enquiry assign
    Route::post('/assign-lead', [LeadController::class, 'assign_lead'])->name('assign.lead');

    Route::post('/viewright-modal', [LeadController::class, 'viewright_modal'])->name('viewright.modal');
    Route::get('/lead/view/{id}', [LeadController::class, 'view'])->name('lead.view');
});
