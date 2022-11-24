<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('getRoleList', 'ApiController@getRoleList');


Route::group([ 'prefix' =>'report'], function ()
{
	// Route::get('/casehistoryreport', 'ReportController@casehistoryreport')->name('report.casehistory');
	Route::post('/casehistoryreportgenerator', 'ReportController@casehistoryreportgenerator')->name('casehistoryreportgenerator');
	Route::get('/priceinquiryreportgenerator', 'ReportController@priceinquiryreportgenerator')->name('priceinquiryreportgenerator');
	Route::get('/paymentconfirmationreportgenerator', 'ReportController@paymentconfirmationreportgenerator')->name('paymentconfirmationreportgenerator');
	Route::get('/allcustomersdatagenerator', 'ReportController@allcustomersdatagenerator')->name('allcustomersdatagenerator');
	Route::get('/productsreportgenerator', 'ReportController@productsreportgenerator')->name('productsreportgenerator');
	
	
	Route::get('/uploadingthirdpartdataindexgenerator', 'ReportController@uploadingthirdpartdataindexgenerator')->name('uploadingthirdpartdataindexgenerator');
});


Route::get('/getProducts', 'ApiController@getProducts');


Route::get('/mailValidationChecking/{email}', 'ApiController@mailValidationChecking');



// System Environment variable
Route::post('/systemEnvironmentData', 'ApiController@systemEnvironmentData')->name('systemEnvironmentData');
Route::post('/systemEnvironmentDataUpdate', 'ApiController@systemEnvironmentDataUpdate')->name('systemEnvironmentDataUpdate');




// =================Blog===============
// =================Blog===============
Route::get('/getBlogs', 'BlogController@getBlogs')->name('getBlogs');
Route::get('/getBlogsWithPaginate/{language}/{paginateNumber}', 'BlogController@getBlogsWithPaginate')->name('getBlogsWithPaginate');
Route::get('/getBlog/{blogId}', 'BlogController@getBlog')->name('getBlog');
Route::post('/addBlog', 'BlogController@addBlog')->name('addBlog');
Route::post('/editBlog', 'BlogController@editBlog')->name('editBlog');
Route::post('/deleteBlog/{blogId}', 'BlogController@deleteBlog')->name('deleteBlog');
// =================Blog===============
// =================Blog===============
