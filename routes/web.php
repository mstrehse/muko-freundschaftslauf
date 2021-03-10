<?php

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

/*
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/wir', 'HomeController@wir')->name('wir');
Route::get('/wie', 'HomeController@wie')->name('wie');

Route::get('/team/export/{key}', 'TeamController@export')->name('team.export');
Route::get('/team/create', 'TeamController@create')->name('team.create');
Route::post('/team/create', 'TeamController@store')->name('team.store');
Route::get('/team/{team}', 'TeamController@show')->name('team.show');
Route::get('/team/{team}/edit', 'TeamController@edit')->name('team.edit');
Route::post('/team/{team}/edit', 'TeamController@update')->name('team.update');
Route::get('/team/{team}/distance', 'TeamController@distance')->name('team.distance');

Route::get('/member/export/{key}', 'TeamMemberController@export')->name('member.export');
Route::get('/team/{team}/member/create', 'TeamMemberController@create')->name('member.create');
Route::post('/team/{team}/member/create', 'TeamMemberController@store')->name('member.store');
Route::get('/member/{teamMember}/edit', 'TeamMemberController@edit')->name('member.edit');
Route::post('/member/{teamMember}/edit', 'TeamMemberController@update')->name('member.update');
Route::get('/member/{teamMember}/delete', 'TeamMemberController@delete')->name('member.delete');
Route::post('/member/{teamMember}/delete', 'TeamMemberController@destroy')->name('member.destroy');

Route::get('/sponsor/export/{key}', 'SponsorController@export')->name('sponsor.export');
Route::get('/team/{team}/sponsor/create', 'SponsorController@create')->name('sponsor.create');
Route::post('/team/{team}/sponsor/create', 'SponsorController@store')->name('sponsor.store');
Route::get('/sponsor/{sponsor}/edit', 'SponsorController@edit')->name('sponsor.edit');
Route::post('/sponsor/{sponsor}/edit', 'SponsorController@update')->name('sponsor.update');
Route::get('/sponsor/{sponsor}/delete', 'SponsorController@delete')->name('sponsor.delete');
Route::post('/sponsor/{sponsor}/delete', 'SponsorController@destroy')->name('sponsor.destroy');

Route::get('/team/{team}/result/create', 'ResultController@create')->name('result.create');
Route::post('/team/{team}/result/create', 'ResultController@store')->name('result.store');

Route::get('/result/export/{key}', 'ResultController@export')->name('result.export');
Route::get('/result/{result}/edit', 'ResultController@edit')->name('result.edit');
Route::post('/result/{result}/edit', 'ResultController@update')->name('result.update');
Route::get('/result/{result}/delete', 'ResultController@delete')->name('result.delete');
Route::post('/result/{result}/delete', 'ResultController@destroy')->name('result.destroy');

Route::get('/team/{team}/post/create', 'PostController@create')->name('post.create');
Route::post('/team/{team}/post/create', 'PostController@store')->name('post.store');
Route::get('/team/{team}/post/{post}/edit', 'PostController@edit')->name('post.edit');
Route::post('/team/{team}/post/{post}/edit', 'PostController@update')->name('post.update');
Route::get('/team/{team}/post/{post}/delete', 'PostController@delete')->name('post.delete');
Route::post('/team/{team}/post/{post}/delete', 'PostController@destroy')->name('post.destroy');
Route::get('/gallery', 'PostController@gallery')->name('post.gallery');
Route::get('/post/{post}/report', 'PostController@report')->name('post.report');
Route::post('/post/{post}/report', 'PostController@reportSubmit')->name('post.reportPost');
Route::get('/report-success', 'PostController@reportSuccess')->name('post.reportSuccess');

Route::get('/picture/{picture}/{post}/delete', 'PictureController@delete')->name('picture.delete');

Route::get('/make-storage', function () {
    $exitCode = Artisan::call('storage:link');
});
