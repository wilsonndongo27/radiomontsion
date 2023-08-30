<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\homeController;
use App\Http\Controllers\Frontend\detailController;
use App\Http\Controllers\Frontend\listController;

use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\CountryStateCityController;
use App\Http\Controllers\Backend\companyController;
use App\Http\Controllers\Backend\bannerController;
use App\Http\Controllers\Backend\newsController;
use App\Http\Controllers\Backend\productServiceController;
use App\Http\Controllers\Backend\partnerController;
use App\Http\Controllers\Backend\achievementController;
use App\Http\Controllers\Backend\StaffProfilController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\podcastController;
use App\Http\Controllers\Backend\fluxController;
use App\Http\Controllers\Backend\programController;

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

Route::get('/', [homeController::class, 'index'])->name('home'); 
Route::get('/detail/{id}/news', [detailController::class, 'detailNewsMethod'])->name('detail-news'); 
Route::get('/detail/{id}/product', [detailController::class, 'detailProductMethod'])->name('detail-product'); 
Route::get('/detail/{id}/partner', [detailController::class, 'detailPartnerMethod'])->name('detail-partner'); 
Route::get('/detail/{id}/staff', [detailController::class, 'detailStaffMethod'])->name('detail-staff');
Route::get('/detail/{id}/achievement', [detailController::class, 'detailAchievementMethod'])->name('detail-achievement'); 
Route::get('/detail/{id}/banner', [detailController::class, 'detailBannerMethod'])->name('detail-banner'); 
Route::get('/contact', [detailController::class, 'contactMethod'])->name('contact'); 
Route::get('/about', [detailController::class, 'aboutMethod'])->name('about'); 

 
Route::get('/list-service', [listController::class, 'listServiceMethod'])->name('list-service'); 
Route::get('/list-news', [listController::class, 'listNewsMethod'])->name('list-news'); 
Route::get('/list-program', [listController::class, 'listProgramMethod'])->name('list-program'); 
Route::get('/list-podcast', [listController::class, 'listPodcastMethod'])->name('list-podcast'); 
Route::get('/list-podcast/{id}/program', [listController::class, 'listPodcastProgramMethod'])->name('list-podcast-program'); 



Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard'); 
Route::get('/login', [dashboardController::class, 'login'])->name('login'); 
Route::post('/login-admin', [userController::class, 'authenticate'])->name('login-admin'); 
Route::get('/logout-admin', [userController::class, 'logout'])->name('logout-admin'); 

Route::get('/home-users', [userController::class, 'index'])->name('home-users'); 
Route::post('/create-user', [userController::class, 'createUserMethod'])->name('create-user'); 
Route::post('/update-user', [userController::class, 'updateUserMethod'])->name('update-user'); 
Route::post('/delete-user', [userController::class, 'deleteUserMethod'])->name('delete-user'); 
Route::post('/status-user', [userController::class, 'statusUserMethod'])->name('status-user'); 
Route::post('/password-user', [userController::class, 'passwordUserMethod'])->name('password-user'); 


Route::get('/company', [companyController::class, 'index'])->name('company'); 
Route::post('/create-company', [companyController::class, 'createCompanyMethod'])->name('create-company'); 
Route::post('/update-company', [companyController::class, 'updateCompanyMethod'])->name('update-company'); 


Route::get('/banner', [bannerController::class, 'index'])->name('banner');
Route::post('/create-banner', [bannerController::class, 'createBannerMethod'])->name('create-banner');
Route::post('/update-banner', [bannerController::class, 'updateBannerMethod'])->name('update-banner');
Route::post('/delete-banner', [bannerController::class, 'deleteBannerMethod'])->name('delete-banner');
Route::post('/status-banner', [bannerController::class, 'statusBannerMethod'])->name('status-banner');


Route::get('/news', [newsController::class, 'index'])->name('news');
Route::post('/create-news', [newsController::class, 'createNewsMethod'])->name('create-news');
Route::post('/update-news', [newsController::class, 'updateNewsMethod'])->name('update-news');
Route::post('/delete-news', [newsController::class, 'deleteNewsMethod'])->name('delete-news');
Route::post('/status-news', [newsController::class, 'statusNewsMethod'])->name('status-news');


Route::get('/product', [productServiceController::class, 'index'])->name('product');
Route::post('/create-product', [productServiceController::class, 'createProductMethod'])->name('create-product');
Route::post('/update-product', [productServiceController::class, 'updateProductMethod'])->name('update-product');
Route::post('/delete-product', [productServiceController::class, 'deleteProductMethod'])->name('delete-product');
Route::post('/status-product', [productServiceController::class, 'statusProductMethod'])->name('status-product');


Route::get('/partner', [partnerController::class, 'index'])->name('partner');
Route::post('/create-partner', [partnerController::class, 'createPartnerMethod'])->name('create-partner');
Route::post('/update-partner', [partnerController::class, 'updatePartnerMethod'])->name('update-partner');
Route::post('/delete-partner', [partnerController::class, 'deletePartnerMethod'])->name('delete-partner');
Route::post('/status-partner', [partnerController::class, 'statusPartnerMethod'])->name('status-partner');


Route::get('/achievement', [achievementController::class, 'index'])->name('achievement');
Route::post('/create-achievement', [achievementController::class, 'createAchievementMethod'])->name('create-achievement');
Route::post('/update-achievement', [achievementController::class, 'updateAchievementMethod'])->name('update-achievement');
Route::post('/delete-achievement', [achievementController::class, 'deleteAchievementMethod'])->name('delete-achievement');
Route::post('/status-achievement', [achievementController::class, 'statusAchievementMethod'])->name('status-achievement');

Route::get('/staff-profil', [StaffProfilController::class , 'index'])->name('staff-profil');
Route::post('/create-profil', [StaffProfilController::class, 'createProfilMethod'])->name('create-profil');
Route::post('/update-profil', [StaffProfilController::class, 'updateProfilMethod'])->name('update-profil');
Route::post('/delete-profil', [StaffProfilController::class, 'deleteProfilMethod'])->name('delete-profil');
Route::post('/status-profil', [StaffProfilController::class, 'statusProfilMethod'])->name('status-profil');

Route::get('/staff', [StaffController::class, 'index'])->name('staff');
Route::post('/create-staff', [StaffController::class, 'createStaffMethod'])->name('create-staff');
Route::post('/update-staff', [StaffController::class, 'updateStaffMethod'])->name('update-staff');
Route::post('/delete-staff', [StaffController::class, 'deleteStaffMethod'])->name('delete-staff');
Route::post('/status-staff', [StaffController::class, 'statusStaffMethod'])->name('status-staff');

Route::post('get-states-by-country', [CountryStateCityController::class, 'getState'])->name('get-states-by-country');
Route::post('get-cities-by-state', [CountryStateCityController::class, 'getCity'])->name('get-cities-by-state');

Route::get('/podcast', [podcastController::class, 'index'])->name('podcast');
Route::post('/create-podcast', [podcastController::class, 'createPodcastMethod'])->name('create-podcast');
Route::post('/update-podcast', [podcastController::class, 'updatePodcastMethod'])->name('update-podcast');
Route::post('/delete-podcast', [podcastController::class, 'deletePodcastMethod'])->name('delete-podcast');
Route::post('/status-podcast', [podcastController::class, 'statusPodcastMethod'])->name('status-podcast');

Route::get('/radio', [fluxController::class, 'index'])->name('radio');
Route::post('/create-radio', [fluxController::class, 'createRadioMethod'])->name('create-radio');
Route::post('/update-radio', [fluxController::class, 'updateRadioMethod'])->name('update-radio');
Route::post('/delete-radio', [fluxController::class, 'deleteRadioMethod'])->name('delete-radio');
Route::post('/status-radio', [fluxController::class, 'statusRadioMethod'])->name('status-radio');

Route::get('/program', [programController::class, 'index'])->name('program');
Route::post('/create-program', [programController::class, 'createProgramMethod'])->name('create-program');
Route::post('/update-program', [programController::class, 'updateProgramMethod'])->name('update-program');
Route::post('/delete-program', [programController::class, 'deleteProgramMethod'])->name('delete-program');
Route::post('/status-program', [programController::class, 'statusProgramMethod'])->name('status-program');