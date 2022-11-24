<?php

use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Str;

if (Str::is( '*mfwpharmacy.com*', url('/')) ) 
{
    Route::redirect('/', 'en');
}
else if (Str::is( '*medicineforworld.cn*', url('/')) )
{
    Route::redirect('/', 'cn');
}
else if (Str::is( '*medicinefor.world*', url('/')) )
{
    Route::redirect('/', 'ru');
}
else if (Str::is( '*medicineforworld.org*', url('/')) )
{
    Route::redirect('/', 'en');
}
else 
{
    Route::redirect('/', 'en');
}

// ===============sessions============
// session(['lang' => 'en']);
// if ( app()->getLocale() ) 
// {
//     session([app()->getLocale()]);
// }
// else if ( app()->getLocale() )
// {
//     session([app()->getLocale()]);
// } 
// else
// {
//     session(['lang' => 'en']);
// }

// App::setlocale( getLocaleFromUrl(URL::current()) );

session(['currency' => 'USD']);
// session(['categoryId' => 0]);
// session(['diseaseCategoryId' => 0]);
// ===============sessions============

// mail=======
Route::get('/squirrelmail', function () {  
	ob_start();
    require(path("public")."squirrelmail/index.php");
    return ob_get_clean();
});


Route::get('/bismillah-mfwadmin', function () {  
	// if (Auth::check())
	// 	return redirect()->Route('dashboard'); 
	// else
		return view('auth.login'); 
	
})->name('admin');
Route::post('/adminLoginPost',  'HomeController@adminLoginPost')->name('adminLoginPost');




/////////////////////////////////////////////////////////////////////
// user=========================================================== //
/////////////////////////////////////////////////////////////////////
Route::group([ 'middleware' => ['auth', 'AdminMiddleware']], function ()
{
	Route::get('/home', 'HomeController@index')->name('home');
	// Route::get('/dashboard', function () {  return view('dashboard'); })->name('dashboard');
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	
	Route::group(['prefix' => 'dashboard'], function() {
		Route::get('/dashboardData', 'HomeController@dashboardData')->name('dashboardData');
		Route::get('/getSalesByDiseaseCategory', 'HomeController@getSalesByDiseaseCategory')->name('getSalesByDiseaseCategory');
		Route::get('/getSalesByCategory', 'HomeController@getSalesByCategory')->name('getSalesByCategory');
	});

});



Route::group([ 'prefix' =>'notifications', 'middleware' => 'SuperAdminMiddleware'], function ()
{
	Route::get('/adminNotifications',  'NotificationController@adminNotifications')->name('adminNotifications');
});





// frontend==========================================================================================================================
// frontend==========================================================================================================================
// frontend==========================================================================================================================
// frontend==========================================================================================================================

// set language===========
Route::get('/frontendSetLanguage/{lang}',  'HomeController_F@frontendSetLanguage')->name('frontendSetLanguage');

Route::group(['prefix' => '{language}'], function() {
	Route::get('/frontendSetCurrency/{currency}',  'HomeController_F@frontendSetCurrency')->name('frontendSetCurrency');
});
// set language===========


// guest login===================
Route::group(['prefix' => '{language}'], function() {
	Route::get('/register-customer',  'UserController_F@customerregistration')->name('customerregistration');
	Route::get('/customerLogin',  'UserController_F@customerLogin')->name('customerLogin');
	Route::post('/customerLoginPost',  'UserController_F@customerLoginPost')->name('customerLoginPost');
	Route::post('/customerLoginPost2/{genericBrandId}',  'UserController_F@customerLoginPost2')->name('customerLoginPost2');
	Route::post('/customerRegistrationInsert',  'UserController_F@customerRegistrationInsert')->name('customerregistration.insert');
	Route::get('/dynamicUserEmailVerificationFromEncryption/{email}', 'UserController_F@dynamicUserEmailVerificationFromEncryption')->name('dynamicUserEmailVerificationFromEncryption');
});
// guest login===================


// ==============Some pages===============

Route::group(['prefix' => '{language}'], function() {
	Route::get('/dynamicPageFront/{pageId}', 'PageController@dynamicPageFront')->name('dynamicPageFront');
	Route::get('/{pageURL}/dpf/{pageId}', 'PageController@dpf')->name('dpf');
});

// ==============Some pages===============






/////////////////////////////////////////////////////////////////////
// Notifications=========================================================== //
/////////////////////////////////////////////////////////////////////
Route::group([ 'prefix' =>'notifications', 'middleware' => 'Customer_F_Middleware'], function ()
{
	Route::get('notificationsProductDetailsPage/{genericBrandId}', 'NotificationController_F@productDetailsPage')->name('notifications.productDetailsPage');
});
	Route::get('productPricesForUsersAssignNotifications/{inquirerId}', 'NotificationController_F@productPricesForUsersAssign')->name('notifications.productPricesForUsers.assign');
	Route::get('CartCreatedByCustomerNotifications/{cartId}', 'NotificationController_F@CartCreatedByCustomerNotifications')->name('notifications.CartCreatedByCustomer');
	
	
	Route::get('adminproductPricesForUsersAssignNotifications/{userId}', 'NotificationController@productPricesForUsersAssign')->name('admin.notifications.productPricesForUsers.assign');

	
	Route::get('profileUpdateNotificationsForCustomer/{notificationId}', 'NotificationController@profileUpdateNotificationsForCustomer')->name('profileUpdateNotificationsForCustomer');
	Route::get('profileUpdateNotificationsForAdmin/{userId}', 'NotificationController@profileUpdateNotificationsForAdmin')->name('profileUpdateNotificationsForAdmin');

	Route::get('documentAddedNotificationsForAdmin/{userId}', 'NotificationController@documentAddedNotificationsForAdmin')->name('documentAddedNotificationsForAdmin');





// search===============
Route::group(['prefix' => '{language}'], function() {
	Route::get('search/autocompleteajax','SearchController_F@autoCompleteAjax');
	Route::get('search/autocompleteajax2','SearchController_F@autocompleteajax2');
});
// search===============


// Route::get('/', function () {  return view('frontend.home_f'); })->name('home_f');

// home-------------------


Route::group(['prefix' => '{language}'], function() {
	Route::get('/', 'HomeController_F@home_f')->name('home_f');

	Route::get('/contact', 'HomeController_F@contact_f')->name('contact_f');
	Route::get('/compare', 'HomeController_F@compare_f')->name('compare_f');
	Route::get('/sitemap_f', 'HomeController_F@sitemap_f')->name('sitemap_f');
	Route::get('/blog', 'BlogController@blog_f')->name('blog_f');
});

Route::get('/{language}/sitemap', function () {  
	$url = url('/');
	SitemapGenerator::create($url)->writeToFile('sitemap.xml');
	return redirect(route('sitemap_f', request('language')));
});


Route::group(['prefix' => '{language}'], function() {

	Route::get('home/homecategorysection/getHomeCategoryProducts/{categoryId}', 'HomeController_F@getHomeCategoryProducts')->name('home_f.getHomeCategoryProducts.get');
	Route::get('home/homecategorysection/getHomeCategoryProductsWithPaginate/{categoryId}', 'HomeController_F@getHomeCategoryProductsWithPaginate')->name('home_f.getHomeCategoryProductsWithPaginate.get');
	Route::get('home/homecategorysection/getHomeDiseaseCategoryProducts/{diseaseCategoryId}', 'HomeController_F@getHomeDiseaseCategoryProducts')->name('home_f.getHomeDiseaseCategoryProducts.get');
	Route::get('home/homecategorysection/getHomeDiseaseCategoryProductsWithPaginate/{diseaseCategoryId}', 'HomeController_F@getHomeDiseaseCategoryProductsWithPaginate')->name('home_f.getHomeDiseaseCategoryProductsWithPaginate.get');
	Route::get('home/homecategorysection/productlistPageTopBrandsProductsWithPaginate/{genericCompanyId}', 'HomeController_F@productlistPageTopBrandsProductsWithPaginate')->name('home_f.productlistPageTopBrandsProductsWithPaginate.get');
	
	Route::get('home/homecategorysection/getHomeProductsWithPaginateWithSort/{sortId}', 'HomeController_F@getHomeProductsWithPaginateWithSort')->name('home_f.getHomeProductsWithPaginateWithSort.get');
});

	// Route::get('/{genericBrandURL}/productDetailsPage/{genericBrandId}', function () {
	// 	return redirect('/{genericBrandURL}/productDetailsPage/{genericBrandId}');
	// 	// return redirect()->route('contact_f');
	// });

	// Route::redirect('/{genericBrandURL}/productDetailsPage/{genericBrandId}', '/en/{genericBrandURL}/productDetailsPage/{genericBrandId}', 301);

	// product details page=======
	
	// Route::get('/{genericBrandURL}/productDetailsPage/{genericBrandId}', function () {
	// 	return redirect()->route('productDetailsPage');
	// });

	Route::group(['prefix' => '{language}'], function() {
		Route::get('/productDetailsPageCaller/{genericBrandId}', 'ProductController_F@productDetailsPageCaller')->name('productDetailsPageCaller');
		Route::get('/{genericBrandURL}/productDetailsPage/{genericBrandId}', 'ProductController_F@productDetailsPage')->name('productDetailsPage');

	});

		// wishlist dynamic======
		Route::get('productDetailsPageAddtoWishlist/{userId}/{genericBrandId}', 'ProductController_F@productDetailsPageAddtoWishlist')->name('productDetailsPageAddtoWishlist');
		Route::get('productDetailsPageRemoveFromWishlist/{userId}/{genericBrandId}', 'ProductController_F@productDetailsPageRemoveFromWishlist')->name('productDetailsPageRemoveFromWishlist');
		// wishlist dynamic======

		// compare dynamic======
		Route::get('productDetailsPageAddtoCompare/{userId}/{genericBrandId}', 'ProductController_F@productDetailsPageAddtoCompare')->name('productDetailsPageAddtoCompare');
		Route::get('productDetailsPageRemoveFromCompare/{userId}/{genericBrandId}', 'ProductController_F@productDetailsPageRemoveFromCompare')->name('productDetailsPageRemoveFromCompare');
		Route::get('productDetailsPageRemoveFromCompareCompare/{userId}/{genericBrandId}', 'ProductController_F@productDetailsPageRemoveFromCompareCompare')->name('productDetailsPageRemoveFromCompareCompare');
		// compare dynamic======


		// priceEnquiryRequest dynamic======
		Route::post('customerPriceInquireRequestMailSend', 'MailController@customerPriceInquireRequestMailSend')->name('customerPriceInquireRequestMailSend');
		// priceEnquiryRequest dynamic======

		// write a review dynamic======
		Route::post('customerWriteAReview', 'ReviewController@customerWriteAReview')->name('customerWriteAReview');
		// write a review dynamic======


		// add to product functionality dynamic======
		Route::post('/productDetails/productDetailsAddtoCart/{genericBrandId}/{genericPackSizeId}', 'ProductController_F@productDetailsAddtoCart')->name('productDetailsAddtoCart');
		// add to product functionality dynamic======



	// product details page============================
	// product details page============================


	Route::group(['prefix' => '{language}'], function() {
	// product list page=======
	// product list page=======
	Route::get('productlistPageTopBrands/{genericCompanyId}', 'ProductController_F@productlistPageTopBrands')->name('productlistPageTopBrands');


		Route::get('productlistPage/{diseaseCategoryId?}/{categoryId?}', 'ProductController_F@productlistPage')->name('productlistPage');
		Route::get('productlistPage_new_slider/', 'ProductController_F@productlistPage_new_slider')->name('productlistPage.new_slider');
		Route::get('productlistPage_new_sliderwithpaginate', 'ProductController_F@productlistPage_new_sliderwithpaginate')->name('productlistPage_new_sliderwithpaginate');
		Route::get('productlistPage_best_slider/', 'ProductController_F@productlistPage_best_slider')->name('productlistPage.best_slider');
		Route::get('productlistPage_best_sliderwithpaginate/', 'ProductController_F@productlistPage_best_sliderwithpaginate')->name('productlistPage_best_sliderwithpaginate');
	// product list page=======
	
	// wishlist page===========
		Route::get('wishlistPage/', 'ProductController_F@wishlistPage')->name('wishlistPage');
	// wishlist page===========

	});

	

// admin frontend==========management============
// admin frontend==========management============
Route::group(['prefix' => 'customers'], function ()
{

	Route::group([ 'middleware' => 'FrontendMiddleware'], function() {
		// new selling products slider for home page==========
			Route::get('/new_products_slider_index', 'FrontendController_F@new_products_slider_index')->name('new_products_slider_index');
			Route::post('/new_products_slider_insert', 'FrontendController_F@new_products_slider_insert')->name('new_products_slider_insert');
			Route::delete('/new_products_slider_delete/{slider_new_selling_product_id}', 'FrontendController_F@new_products_slider_delete')->name('new_products_slider_delete');
		// new selling products slider for home page==========


		// best selling products slider for home page==========
			Route::get('/best_selling_products_slider_index', 'FrontendController_F@best_selling_products_slider_index')->name('best_selling_products_slider_index');
			Route::post('/best_selling_products_slider_insert', 'FrontendController_F@best_selling_products_slider_insert')->name('best_selling_products_slider_insert');
			Route::delete('/best_selling_products_slider_delete/{slider_best_selling_product_id}', 'FrontendController_F@best_selling_products_slider_delete')->name('best_selling_products_slider_delete');
		// best selling products slider for home page==========


		// main slider for home page==========
			Route::get('/main_slider_Index', 'FrontendController_F@main_slider_Index')->name('main_slider_Index');
			Route::post('/main_sliderInsert', 'FrontendController_F@main_sliderInsert')->name('main_sliderInsert');
			Route::put('/main_sliderUpdate', 'FrontendController_F@main_sliderUpdate')->name('main_sliderUpdate');
			Route::delete('/main_sliderDelete/{mainsliderId}', 'FrontendController_F@main_sliderDelete')->name('main_sliderDelete');
		// main slider for home page==========


		// main navbar category selection for frontend==========
			Route::get('/frontend_main_navbar_index', 'FrontendController_F@frontend_main_navbar_index')->name('frontend_main_navbar_index');
			Route::post('/frontend_main_navbar_insert', 'FrontendController_F@frontend_main_navbar_insert')->name('frontend_main_navbar_insert');
			Route::delete('/frontend_main_navbar_delete/{menuCategoriesFId}', 'FrontendController_F@frontend_main_navbar_delete')->name('frontend_main_navbar_delete');
		// main navbar category selection for frontend==========

		// testimonial setting page==========
			Route::get('/testimonial_Index', 'FrontendController_F@testimonial_Index')->name('testimonial_Index');
			Route::post('/testimonialInsert', 'FrontendController_F@testimonialInsert')->name('testimonialInsert');
			Route::put('/testimonialUpdate', 'FrontendController_F@testimonialUpdate')->name('testimonialUpdate');
			Route::delete('/testimonialDelete/{testimonialId}', 'FrontendController_F@testimonialDelete')->name('testimonialDelete');
		// testimonial setting page==========

		// currency setting page==========
			Route::get('/currency_Index', 'FrontendController_F@currency_Index')->name('currency_Index');
			Route::put('/currencyUpdate', 'FrontendController_F@currencyUpdate')->name('currencyUpdate');
			Route::delete('/currencyDelete/{countryId}', 'FrontendController_F@currencyDelete')->name('currencyDelete');

		// currency setting page==========


		// top brands for home page==========
			Route::get('/top_brands_index', 'FrontendController_F@top_brands_index')->name('top_brands_index');
			Route::post('/top_brands_insert', 'FrontendController_F@top_brands_insert')->name('top_brands_insert');
			Route::delete('/top_brands_delete/{topBrandId}', 'FrontendController_F@top_brands_delete')->name('top_brands_delete');
		// top brands for home page==========

		// banner for home page==========
			Route::get('/banner_index', 'FrontendController_F@banner_index')->name('banner_index');
			Route::post('/banner_insert', 'FrontendController_F@banner_insert')->name('banner_insert');
			Route::put('/bannerupdate', 'FrontendController_F@bannerupdate')->name('bannerupdate');
			Route::delete('/banner_delete/{topBrandId}', 'FrontendController_F@banner_delete')->name('banner_delete');
		// banner for home page==========

		// seo default for home page==========
			Route::get('/seodefault', 'FrontendController_F@seodefault')->name('seodefault');
			Route::put('/seodefaultUpdate', 'FrontendController_F@seodefaultUpdate')->name('seodefaultUpdate');
		// seo default for home page==========

		// Social Media  portion==========================================
		Route::get('socialmedias', 'SupplierController@socialmedias')->name('socialmedias');
		Route::post('supplierSettingIndex/socialMedia/socialMediaInsert', 'SupplierController@socialMediaInsert')->name('supplier.settings.socialMedia.insert');
		Route::put('supplierSettingIndex/socialMedia/socialMediaUpdate', 'SupplierController@socialMediaUpdate')->name('supplier.settings.socialMedia.update');
		Route::delete('supplierSettingIndex/socialMedia/socialMediaDelete/{socialMediaId}', 'SupplierController@socialMediaDelete')->name('supplier.settings.socialMedia.delete');
		// Social Media  portion==========================================
		

		// approve reviews================================================
		Route::get('customerReviews/', 'FrontendController_F@customerReviews')->name('customerReviews');
		Route::put('customerReviewApprove/{reviewId}', 'FrontendController_F@customerReviewApprove')->name('customerReviewApprove');
		Route::put('customerReviewDisapprove/{reviewId}', 'FrontendController_F@customerReviewDisapprove')->name('customerReviewDisapprove');
		Route::delete('customerReviewDelete/{reviewId}', 'FrontendController_F@customerReviewDelete')->name('customerReviewDelete');
		Route::post('customercommenteditfromadmin', 'FrontendController_F@customercommenteditfromadmin')->name('customercommenteditfromadmin');
		// approve reviews================================================
		
		
		// testimonial_client_contact_request================================================
		Route::get('/testimonial_client_contact_request', 'FrontendController_F@testimonial_client_contact_request')->name('testimonial_client_contact_request');
		Route::post('/testimonial_send_mail_to_requester', 'FrontendController_F@testimonial_send_mail_to_requester')->name('testimonial_send_mail_to_requester');
		Route::delete('/testimonial_client_contact_request_delete/{testimonial_contact_request_id}', 'FrontendController_F@testimonial_client_contact_request_delete')->name('testimonial_client_contact_request_delete');
		// testimonial_client_contact_request================================================


		// contact_with_product_reviewer_requests================================================
		Route::get('/contact_with_product_reviewer_requests', 'FrontendController_F@contact_with_product_reviewer_requests')->name('contact_with_product_reviewer_requests');
		Route::post('/contact_with_product_reviewer_requests_data', 'FrontendController_F@contact_with_product_reviewer_requests_data')->name('contact_with_product_reviewer_requests_data');
		Route::post('/contact_with_product_reviewer_requests_mail_send', 'FrontendController_F@contact_with_product_reviewer_requests_mail_send')->name('contact_with_product_reviewer_requests_mail_send');
		Route::post('/contact_with_product_reviewer_request_delete', 'FrontendController_F@contact_with_product_reviewer_request_delete')->name('contact_with_product_reviewer_request_delete');

		// contact_with_product_reviewer_requests================================================


		// customer_to_admin_contacts================================================
		Route::get('/customer_to_admin_contacts', 'FrontendController_F@customer_to_admin_contacts')->name('customer_to_admin_contacts');
		Route::post('/customer_to_admin_contacts_data', 'FrontendController_F@customer_to_admin_contacts_data')->name('customer_to_admin_contacts_data');
		Route::post('/customer_to_admin_contacts_delete', 'FrontendController_F@customer_to_admin_contacts_delete')->name('customer_to_admin_contacts_delete');
		Route::post('/customer_to_admin_contacts_mail_send', 'FrontendController_F@customer_to_admin_contacts_mail_send')->name('customer_to_admin_contacts_mail_send');
		// customer_to_admin_contacts================================================


	});
	


});


Route::post('/customers/block_a_person_by_mail', 'FrontendController_F@block_a_person_by_mail')->name('block_a_person_by_mail');
Route::post('/customers/block_a_person_by_mail_W_redirect', 'FrontendController_F@block_a_person_by_mail_W_redirect')->name('block_a_person_by_mail_W_redirect');



Route::post('/testimonial_contact_request', 'FrontendController_F@testimonial_contact_request')->name('testimonial_contact_request');
Route::post('/customerToAdminContact', 'FrontendController_F@customerToAdminContact')->name('customerToAdminContact');

Route::post('/contact_with_product_reviewer_request', 'FrontendController_F@contact_with_product_reviewer_request')->name('contact_with_product_reviewer_request');

// frontend====================================================================================================================
// frontend====================================================================================================================
// frontend====================================================================================================================
// frontend====================================================================================================================




Route::group(['prefix' => '{language}'], function() {
	Route::get('/change_passsword_f', 'HomeController@change_passsword_f')->name('change_passsword_f');
	Route::get('/dynamicChangepasswordFromEncryption/{email}/{password}', 'HomeController@dynamicChangepasswordFromEncryption')->name('dynamicChangepasswordFromEncryption');
	Route::post('/change_passsword_f_from_mail', 'HomeController@change_passsword_f_from_mail')->name('change_passsword_f_from_mail');
});





Auth::routes();


	



////////////////////////////////////////////////////////////////////
// super admin panel============================================= //
////////////////////////////////////////////////////////////////////
Route::group([ 'middleware' => 'SuperAdminMiddleware', 'prefix' =>'superadmin'], function ()
{
		// User management 
		Route::Resource('/user', 'UserController');
		Route::get('/users/user/userEdit/{userId}', 'UserController@userEdit')->name('users.user.edit');
		Route::put('/users/user/update/{userId}', 'UserController@userUpdate')->name('users.user.update');

		// roles==================
		Route::Resource('/role', 'RoleController');
		Route::get('roles/role/addrollandmodule', 'RoleController@addRollandModule')->name('roles.role.addrollandmodule');
		Route::post('/role/{roleId}', 'RoleController@update')->name('role.updating');
		Route::get('users/userRoles', 'UserController@userRoles')->name('user.userRoles');

		// dashboard
		Route::get('/superadminconfig', 'HomeController@superadminconfig')->name('superadminconfig');
		// backups
		Route::get('storageBackup', 'HomeController@storageBackup')->name('storageBackup');
		Route::get('storageBackupDelete', 'HomeController@storageBackupDelete')->name('storageBackupDelete');
		Route::get('serverDBBackup', 'HomeController@serverDBBackup')->name('serverDBBackup');
		Route::get('serverDBBackupDelete', 'HomeController@serverDBBackupDelete')->name('serverDBBackupDelete');

		// System Environment variable
		Route::post('/getMostProtectedPassword', 'HomeController@getMostProtectedPassword')->name('getMostProtectedPassword');
		Route::post('/md5MatchForMostProtectedPassword', 'HomeController@md5MatchForMostProtectedPassword')->name('md5MatchForMostProtectedPassword');
		Route::get('/systemEnvironment', 'HomeController@systemEnvironment')->name('systemEnvironment');

		// DB Automated Backups Management
		Route::get('/db_automated_backup_management', 'HomeController@dbAutomatedBackupManagement')->name('dbAutomatedBackupManagement');
		Route::post('/getDBAutomatedBackups', 'HomeController@getDBAutomatedBackups')->name('getDBAutomatedBackups');
		Route::post('/deleteDBBackupFile', 'HomeController@deleteDBBackupFile')->name('deleteDBBackupFile');
		
		// Block List Management
		Route::get('/blockList', 'HomeController@blockList')->name('blockList');
		Route::post('/block_list_data', 'HomeController@block_list_data')->name('block_list_data');
		Route::post('/unblockAPerson', 'HomeController@unblockAPerson')->name('unblockAPerson');
		Route::post('/unblockAPersonWBlockTypeId', 'HomeController@unblockAPersonWBlockTypeId')->name('unblockAPersonWBlockTypeId');


		// cache remove
		Route::get('cacheRemove', 'HomeController@cacheRemove')->name('cacheRemove');


		Route::get('/languageOnOffSettings/{languageId}/{onOffId}', 'HomeController@languageOnOffSettings')->name('languageOnOffSettings');

		
		Route::put('/readatadminallnotifications', 'HomeController@readatadminallnotifications')->name('readatadminallnotifications');
		Route::put('/readatallcustomersallnotifications', 'HomeController@readatallcustomersallnotifications')->name('readatallcustomersallnotifications');
		

		// log
		Route::get('/log_management', 'HomeController@logManagement')->name('logManagement');
		Route::post('/getLogData/{logName}', 'HomeController@getLogData')->name('getLogData');

	});
	
	
	Route::group(['prefix' => '{language}'], function() {
		Route::put('/readatspecificcustomersallnotifications/{customerId}', 'HomeController@readatspecificcustomersallnotifications')->name('readatspecificcustomersallnotifications');
	});
	




////////////////////////////////////////////////////////////////////
// customer panel============================================= //
////////////////////////////////////////////////////////////////////
Route::group([ 'middleware' => 'CustomerMiddleware', 'prefix' => 'customers'], function ()
{
		// customer management 
		Route::get('/customers', 'UserController@customers')->name('customers.customers');
		Route::get('/customersEnable/{userId}', 'UserController@customersEnable')->name('customersEnable');
		Route::post('/admin_to_customer_send_mail', 'UserController@admin_to_customer_send_mail')->name('admin_to_customer_send_mail');

		// customer profile update
		Route::get('/customerProfileUpdate/{userId}',  'UserController@customerProfileUpdate')->name('customerProfileUpdate');
		Route::post('/customerProfileUpdateSave',  'UserController@customerProfileUpdateSave')->name('customerProfileUpdateSave');



		// offer management=============================
			Route::get('offerManagement', 'OfferController@offerManagement')->name('offerManagement');
			Route::put('/offerUpdate', 'OfferController@offerUpdate')->name('offerUpdate');
		// offer management=============================


		// product price for users page=======
			Route::get('productPricesForUsers', 'FrontendController_F@productPricesForUsers')->name('productPricesForUsers');
			Route::get('productPricesForUsersAssign/{userId}', 'FrontendController_F@productPricesForUsersAssign')->name('productPricesForUsers.assign');
			Route::get('getGenericPackSizes/{genericBrandId}', 'FrontendController_F@getGenericPackSizes')->name('getGenericPackSizes');
			Route::put('customerPriceSetup/{userId}', 'FrontendController_F@customerPriceSetup')->name('customerPriceSetup');
			Route::post('customerPriceSetupAdd/{userId}', 'FrontendController_F@customerPriceSetupAdd')->name('customerPriceSetupAdd');
			Route::get('customerPriceSetupUpdate/{userId}/{genericPackSizeId}/{price}/{moq}/{discount}', 'FrontendController_F@customerPriceSetupUpdate')->name('customerPriceSetupUpdate');
			Route::get('customerPriceSetupDelete/{userId}/{genericPackSizeId}', 'FrontendController_F@customerPriceSetupDelete')->name('customerPriceSetupDelete');
		// product price for users page=======
	
});





////////////////////////////////////////////////////////////////////
// Generics Module ============================================= //
////////////////////////////////////////////////////////////////////
Route::group([ 'prefix' =>'generics','middleware' => 'GenericsMiddleware'], function ()
{
	// generic settings page======================================================================================
	Route::get('genericSettingIndex', 'GenericsController@genericSettingIndex')->name('generics.settings.index');

	// generic settings => generic company  portion==========================================
	Route::post('settings/genericCompany/genericCompanyInsert', 'GenericsController@genericCompanyInsert')->name('generics.settings.genericCompany.insert');
	Route::put('settings/genericCompany/genericCompanyUpdate', 'GenericsController@genericCompanyUpdate')->name('generics.settings.genericCompany.update');
	Route::delete('settings/genericCompany/genericCompanyDelete/{genericCompanyId}', 'GenericsController@genericCompanyDelete')->name('generics.settings.genericCompany.delete');


	// generic settings => disease category portion==========================================
	Route::post('settings/category/categoryInsert', 'GenericsController@categoryInsert')->name('generics.settings.category.insert');
	Route::put('settings/category/categoryUpdate', 'GenericsController@categoryUpdate')->name('generics.settings.category.update');
	Route::delete('settings/category/categoryDelete/{categoryId}', 'GenericsController@categoryDelete')->name('generics.settings.category.delete');



	// generic settings => disease category portion==========================================
	Route::post('settings/diseaseCategory/diseaseCategoryInsert', 'GenericsController@diseaseCategoryInsert')->name('generics.settings.diseaseCategory.insert');
	Route::put('settings/diseaseCategory/diseaseCategoryUpdate', 'GenericsController@diseaseCategoryUpdate')->name('generics.settings.diseaseCategory.update');
	Route::delete('settings/diseaseCategory/diseaseCategoryDelete/{diseaseCategoryId}', 'GenericsController@diseaseCategoryDelete')->name('generics.settings.diseaseCategory.delete');







	// generic settings => disease category portion==========================================
	Route::post('settings/dosageForm/dosageFormInsert', 'GenericsController@dosageFormInsert')->name('generics.settings.dosageForm.insert');
	Route::put('settings/dosageForm/dosageFormUpdate', 'GenericsController@dosageFormUpdate')->name('generics.settings.dosageForm.update');
	Route::delete('settings/dosageForm/dosageFormDelete/{genericId}', 'GenericsController@dosageFormDelete')->name('generics.settings.dosageForm.delete');



	// generic settings => generic strength  portion==========================================
	Route::post('settings/genericStrength/genericStrengthInsert', 'GenericsController@genericStrengthInsert')->name('generics.settings.genericStrength.insert');
	Route::put('settings/genericStrength/genericStrengthUpdate', 'GenericsController@genericStrengthUpdate')->name('generics.settings.genericStrength.update');
	Route::delete('settings/genericStrength/genericStrengthDelete/{genericStrengthId}', 'GenericsController@genericStrengthDelete')->name('generics.settings.genericStrength.delete');



	// generic settings => generic strength  portion==========================================

	Route::post('settings/packType/packTypeInsert', 'GenericsController@packTypeInsert')->name('generics.settings.packType.insert');
	Route::put('settings/packType/packTypeUpdate', 'GenericsController@packTypeUpdate')->name('generics.settings.packType.update');
	Route::delete('settings/packType/packTypeDelete/{packTypeId}', 'GenericsController@packTypeDelete')->name('generics.settings.packType.delete');



	// generic settings => generic portion==========================================
	Route::get('/genericIndex', 'GenericsController@genericIndex')->name('generics.generics.index');
	Route::post('settings/generic/genericInsert', 'GenericsController@genericInsert')->name('generics.settings.generic.insert');
	Route::put('settings/generic/genericUpdate', 'GenericsController@genericUpdate')->name('generics.settings.generic.update');
	Route::delete('settings/generic/genericDelete/{genericId}', 'GenericsController@genericDelete')->name('generics.settings.generic.delete');


	// generic settings => Generic brand   portion==========================================
	Route::get('/genericBrandListIndex', 'GenericsController@genericBrandListIndex')->name('generics.genericBrandListIndex.index');
	Route::get('settings/genericBrand/genericBrandCreate', 'GenericsController@genericBrandCreate')->name('generic.settings.brand.create');
	Route::post('settings/genericBrand/genericBrandInsert', 'GenericsController@genericBrandInsert')->name('generic.settings.brand.insert');
	Route::get('settings/generic/genericBrandEdit/{genericBrandId}', 'GenericsController@genericBrandEdit')->name('generic.settings.brand.edit');
	Route::get('settings/generic/genericBrandVideoDelete/{genericBrandId}', 'GenericsController@genericBrandVideoDelete')->name('generic.brand.video.delete');

	Route::get('/genericbrandvideothumbnaildeletenew/{genericbrandVideoId}', 'GenericsController@genericbrandvideothumbnaildeletenew')->name('genericbrandvideothumbnaildeletenew');
	// Route::get('/genericbrandvideothumbnailupdate/{genericbrandVideoId}', 'GenericsController@genericbrandvideothumbnailupdate')->name('genericbrandvideothumbnailupdate');

	Route::get('settings/generic/genericBrandVideoThumbnailDelete/{genericBrandId}', 'GenericsController@genericBrandVideoThumbnailDelete')->name('genericBrandVideoThumbnailDelete');
	Route::get('settings/generic/genericBrandyoutubevideothumbDelete/{genericBrandId}', 'GenericsController@genericBrandyoutubevideothumbDelete')->name('genericBrandyoutubevideothumbDelete');
	Route::get('settings/generic/genericBranddailymotionvideothumbDelete/{genericBrandId}', 'GenericsController@genericBranddailymotionvideothumbDelete')->name('genericBranddailymotionvideothumbDelete');
	Route::get('settings/generic/genericBrandvimeovideothumbDelete/{genericBrandId}', 'GenericsController@genericBrandvimeovideothumbDelete')->name('genericBrandvimeovideothumbDelete');
	
	
	Route::put('settings/generic/genericBrandUpdate/{genericBrandId}', 'GenericsController@genericBrandUpdate')->name('generic.settings.brand.update');
	Route::put('settings/generic/genericBrandUpdate2/{genericBrandId}', 'GenericsController@genericBrandUpdate2')->name('generic.settings.brand.update2');
	Route::delete('settings/generic/genericBrandDelete/{genericBrandId}', 'GenericsController@genericBrandDelete')->name('generics.settings.brand.delete');

	//Meta updates
	Route::get('settings/generic/genericBrandMetaUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaUpdate')->name('generic.settings.meta.update');
	Route::get('settings/generic/genericBrandMetaUpdateall/{genericBrandId}', 'GenericsController@genericBrandMetaUpdateAll')->name('generic.settings.meta.updateall');

	Route::get('settings/generic/genericBrandMetaTitleUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaTitleUpdate')->name('generic.settings.meta_title.update');
	Route::get('settings/generic/genericBrandMetaTitleCNUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaTitleCNUpdate')->name('generic.settings.meta_title.cn.update');
	Route::get('settings/generic/genericBrandMetaTitleRUUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaTitleRUUpdate')->name('generic.settings.meta_title.ru.update');

	Route::get('settings/generic/genericBrandMetaKeywordUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaKeywordUpdate')->name('generic.settings.meta_keywords.update');
	Route::get('settings/generic/genericBrandMetaKeywordCNUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaKeywordCNUpdate')->name('generic.settings.meta_keywords.cn.update');
	Route::get('settings/generic/genericBrandMetaKeywordRUUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaKeywordRUUpdate')->name('generic.settings.meta_keywords.ru.update');
	
	Route::get('settings/generic/genericBrandMetaDescUpdate/{genericBrandId}', 'GenericsController@genericBrandMetaDescUpdate')->name('generic.settings.meta_description.update');
	Route::get('settings/generic/genericBrandMetaDescUpdateCN/{genericBrandId}', 'GenericsController@genericBrandMetaDescUpdateCN')->name('generic.settings.meta_description.cn.update');
	Route::get('settings/generic/genericBrandMetaDescUpdateRU/{genericBrandId}', 'GenericsController@genericBrandMetaDescUpdateRU')->name('generic.settings.meta_description.ru.update');

	Route::get('settings/generic/genericBrandAltTagUpdate/{genericBrandId}', 'GenericsController@genericBrandAltTagUpdate')->name('generic.settings.alt_tag.update');
	Route::get('settings/generic/genericBrandAltTagUpdateCN/{genericBrandId}', 'GenericsController@genericBrandAltTagUpdateCN')->name('generic.settings.alt_tag_CN.update');
	Route::get('settings/generic/genericBrandAltTagUpdateRU/{genericBrandId}', 'GenericsController@genericBrandAltTagUpdateRU')->name('generic.settings.alt_tag_RU.update');

	




	// generic settings => Generic Pack Sizes   portion==========================================
	Route::get('/genericBrandPriceListIndex', 'GenericsController@genericBrandPriceListIndex')->name('genericBrandPriceListIndex');
	Route::get('/genericPackSizes/genericPackSizesCreate', 'GenericsController@genericPackSizesCreate')->name('generic.pack.sizes.create');
	Route::post('/genericPackSizes/genericPackSizesInsert', 'GenericsController@genericPackSizesInsert')->name('generic.pack.sizes.insert');
	Route::get('/generic/genericPackSizesEdit/{genericPackSizeId}', 'GenericsController@genericPackSizesEdit')->name('generic.pack.sizes.edit');
	Route::put('/generic/genericPackSizesUpdate/{genericPackSizeId}', 'GenericsController@genericPackSizesUpdate')->name('generic.pack.sizes.update');
	Route::delete('/generic/packSizesDelete/{genericPackSizeId}', 'GenericsController@genericPackSizesDelete')->name('generics.settings.packSizes.delete');
	// dynamic dependent drop downs
		Route::get('/genericPackSizes/genericPackSizesCreate/getGenericBrands/{genericId}', 'GenericsController@getGenericBrands');



	

	// files========================================================
	Route::get('/filesListIndex', 'GenericsController@filesListIndex')->name('filesListIndex');
	Route::post('/filesInsert', 'GenericsController@filesInsert')->name('filesInsert');
	Route::put('/fileUpdate', 'GenericsController@fileUpdate')->name('fileUpdate');
	Route::delete('/filesDelete/{fileId}', 'GenericsController@filesDelete')->name('filesDelete');
	// files========================================================


	// generic for all product========================================================	
	// Route::domain('{username}.'. env('APP_DOMAIN'))->group(function(){
	// 	Route::get('/genericforallproduct', 'GenericsController@genericforallproduct')->name('genericforallproduct');
	// });

	Route::get('/genericforallproduct', 'GenericsController@genericforallproduct')->name('genericforallproduct');

	Route::post('/addupdateGenericforallproduct', 'GenericsController@addupdateGenericforallproduct')->name('addupdateGenericforallproduct');
	Route::post('/deleteGenericforallproduct/{genericforallproductId}', 'GenericsController@deleteGenericforallproduct')->name('deleteGenericforallproduct');
	Route::post('/updateGenericforallproductvisibility/{genericforallproductId}/{isViewable}', 'GenericsController@updateGenericforallproductvisibility');

	// generic for all product========================================================

});


// generic for all product========================================================
Route::get('/generics/getAllGenerics', 'GenericsController@getAllGenerics')->name('getAllGenerics');
Route::get('/generics/getGenericforallproducts', 'GenericsController@getGenericforallproducts')->name('getGenericforallproducts');
Route::get('/generics/getGenericforallproduct/{genericforallproductId}', 'GenericsController@getGenericforallproduct')->name('getGenericforallproduct');
Route::get('/generics/getGenericforallproductwithgenericid/{genericforallproductId}', 'GenericsController@getGenericforallproductwithgenericid')->name('getGenericforallproductwithgenericid');
Route::get('/generics/getGenericBrandswithgenericid/{genericId}', 'GenericsController@getGenericBrandswithgenericid')->name('getGenericBrandswithgenericid');

// Route::domain('generic.'. 'medicineforworld.com.bd')->group(function(){
// 	Route::get('/{language}/{metaTitle}/generic_medicine/{genericId}', 'GenericsController@generic_medicine')->name('generic_medicine');
// });
Route::get('/{language}/{metaTitle}/generic_medicine/{genericId}', 'GenericsController@generic_medicine')->name('generic_medicine');


// generic for all product========================================================


// for ajax operation
Route::delete('/generics/settings/generic/genericBrandPicDelete/{genericBrandPicId}', 'GenericsController@genericBrandPicDelete')->name('generics.settings.brand.pic.delete');




////////////////////////////////////////////////////////////////////
// Supplier Module ============================================= //
////////////////////////////////////////////////////////////////////
Route::group([ 'prefix' =>'generics','middleware' => 'SupplierMiddleware'], function ()
{
	// supplier settings =>  position  portion==========================================
	Route::get('postions', 'SupplierController@postions')->name('postions');
	Route::post('supplierSettingIndex/position/positionInsert', 'SupplierController@positionInsert')->name('supplier.settings.position.insert');
	Route::put('supplierSettingIndex/position/positionUpdate', 'SupplierController@positionUpdate')->name('supplier.settings.position.update');
	Route::delete('supplierSettingIndex/position/positionDelete/{positionId}', 'SupplierController@positionDelete')->name('supplier.settings.position.delete');

	// supplier index
	Route::get('supplierIndex', 'SupplierController@supplierIndex')->name('supplier.index');
	// supplier settings => supplier create   portion==========================================
	Route::get('supplierSettingIndex/supplier/supplierCreate', 'SupplierController@supplierCreate')->name('supplier.settings.supplier.create');
	Route::post('supplierSettingIndex/supplier/supplierInsert', 'SupplierController@supplierInsert')->name('supplier.settings.supplier.insert');
	Route::get('supplierSettingIndex/supplier/supplierEdit/{supplierId}', 'SupplierController@supplierEdit')->name('supplier.settings.supplier.edit');
	Route::put('supplierSettingIndex/supplier/supplierUpdate/{supplierId}', 'SupplierController@supplierUpdate')->name('supplier.settings.supplier.update');
	Route::delete('supplierSettingIndex/supplier/supplierDelete/{supplierId}', 'SupplierController@supplierDelete')->name('supplier.settings.supplier.delete');

		// dynamic dependent drop downs
		Route::get('/supplierSettingIndex/supplier/supplierCreate/getGenericBrands/{genericId}', 'SupplierController@getGenericBrands');
		Route::get('/supplierSettingIndex/supplier/supplierCreate/getGenericPackSizes/{genericBrandId}', 'SupplierController@getGenericPackSizes');
});
////////////////////////////////////////////////////////////////////
// Supplier Module ============================================= //
////////////////////////////////////////////////////////////////////


// ============ footer =======================
// ============ footer =======================
Route::group([ 'middleware' => 'FooterMiddleware'], function ()
{
	Route::get('/footer/thirdFourthPortion', 'FooterController@thirdFourthPortion')->name('footer.thirdFourthPortion');
	Route::put('/footer/thirdFourthPortionUpdate', 'FooterController@thirdFourthPortionUpdate')->name('footer.thirdFourthPortionUpdate');

	Route::get('/footer/portion1', 'FooterController@portion1')->name('footer.portion1');
	Route::put('/footer/portion1Update', 'FooterController@portion1Update')->name('footer.portion1Update');

	Route::get('/footer/portion1socials', 'FooterController@portion1socials')->name('footer.portion1socials');
	Route::put('/footer/portion1SocialsUpdate', 'FooterController@portion1SocialsUpdate')->name('footer.portion1SocialsUpdate');


	Route::get('/footer/portion2pages', 'FooterController@portion2pages')->name('footer.portion2pages');
	Route::put('/footer/portion2pagesUpdate', 'FooterController@portion2pagesUpdate')->name('footer.portion2pagesUpdate');

	Route::get('/footer/portion3categories', 'FooterController@portion3categories')->name('footer.portion3categories');
	Route::put('/footer/portion3categoriesUpdate', 'FooterController@portion3categoriesUpdate')->name('footer.portion3categoriesUpdate');

	Route::get('/footer/portion4', 'FooterController@portion4')->name('footer.portion4');
	Route::put('/footer/portion4Update', 'FooterController@portion4Update')->name('footer.portion4Update');

	Route::get('/footer/portion4socials', 'FooterController@portion4socials')->name('footer.portion4socials');
	Route::put('/footer/portion4SocialsUpdate', 'FooterController@portion4SocialsUpdate')->name('footer.portion4SocialsUpdate');


	Route::get('/footer/bottomFooter', 'FooterController@bottomFooter')->name('footer.bottomFooter');
	Route::put('/footer/bottomFooterUpdate', 'FooterController@bottomFooterUpdate')->name('footer.bottomFooterUpdate');
});
// ============ footer =======================
// ============ footer =======================





// ============ pages =======================
// ============ pages =======================

Route::group([ 'middleware' => 'PageMiddleware'], function ()
{
	Route::get('/pages/pages', 'PageController@pages')->name('pages');
	Route::post('/pages/pageInsert', 'PageController@pageInsert')->name('pageInsert');

	Route::get('/pages/pageEdit/{pageId}', 'PageController@pageEdit')->name('pageEdit');
	Route::put('/pages/pageUpdate/{pageId}', 'PageController@pageUpdate')->name('pageUpdate');

	Route::delete('/pages/pageDelete/{pageId}', 'PageController@pageDelete')->name('pageDelete');
});

// ============ pages =======================
// ============ pages =======================






////////////////////////////////////////////////////////////////////
// Cart Module ============================================= //
////////////////////////////////////////////////////////////////////
Route::group([ 'prefix' =>'cart','middleware' => 'CartMiddleware'], function ()
{


	// cart approval and other stuff management=============================
		Route::get('cartListAdmin', 'CartController@cartListAdmin')->name('cartListAdmin');
		// approval status update
		Route::post('/cartListAdminApprovalStatusUpdate/{cartId}', 'CartController@cartListAdminApprovalStatusUpdate')->name('cartListAdminApprovalStatusUpdate');
	// cart approval and other stuff management=============================

	// duplicate invoice 
	Route::get('generateDuplicateInvoice/{cartId}', 'CartController@generateDuplicateInvoice')->name('generateDuplicateInvoice');
	Route::post('generateDuplicateInvoiceUpdate/{cartId}', 'CartController@generateDuplicateInvoiceUpdate')->name('generateDuplicateInvoiceUpdate');

	Route::get('/duplicateInvoiceShowing/{cartId}', 'CartController@duplicateInvoiceShowing')->name('duplicateInvoiceShowing');
	Route::get('/duplicateInvoiceHiding/{cartId}', 'CartController@duplicateInvoiceHiding')->name('duplicateInvoiceHiding');

	// prescription/document of cart by admin 
	Route::get('documentUpdateForCartProducts/{cartId}', 'CartController@documentUpdateForCartProducts')->name('documentUpdateForCartProducts');
	Route::post('documentUpdateForCartProductsUpdate/{cartId}', 'CartController@documentUpdateForCartProductsUpdate')->name('documentUpdateForCartProductsUpdate');
	Route::get('documentUpdateForCartProductsDelete/{cartPrescriptionId}', 'CartController@documentUpdateForCartProductsDelete')->name('documentUpdateForCartProductsDelete');


	// batch of products 
	Route::get('batchupdateforcartproducts/{cartId}', 'CartController@batchupdateforcartproducts')->name('batchupdateforcartproducts');
	Route::post('batchupdateforcartproductsUpdate/{cartId}', 'CartController@batchupdateforcartproductsUpdate')->name('batchupdateforcartproductsUpdate');

	// cart approvals
	Route::get('/cartApprovalApprove/{cartId}', 'CartController@cartApprovalApprove')->name('cartApprovalApprove');


	Route::get('/invoiceShowing/{cartId}', 'CartController@invoiceShowing')->name('invoiceShowing');
	Route::get('/invoiceHiding/{cartId}', 'CartController@invoiceHiding')->name('invoiceHiding');


	Route::get('/proformaInvoiceShowing/{cartId}', 'CartController@proformaInvoiceShowing')->name('proformaInvoiceShowing');
	Route::get('/proformaInvoiceHiding/{cartId}', 'CartController@proformaInvoiceHiding')->name('proformaInvoiceHiding');
	
	Route::post('/cartApprovalApproveUpdate/{cartId}', 'CartController@cartApprovalApproveUpdate')->name('cartApprovalApproveUpdate');
	Route::get('/cartApprovalReject/{cartId}', 'CartController@cartApprovalReject')->name('cartApprovalReject');
	Route::put('/cartApprovalRejectUpdate/{cartId}', 'CartController@cartApprovalRejectUpdate')->name('cartApprovalRejectUpdate');
	Route::get('/cartApprovalDelete/{cartId}', 'CartController@cartApprovalDelete')->name('cartApprovalDelete');
	Route::put('/cartApprovalDeleteUpdate/{cartId}', 'CartController@cartApprovalDeleteUpdate')->name('cartApprovalDeleteUpdate');

	// payment confirm and unconfirm
	Route::get('/cartPaymentUnconfirm/{cartId}', 'CartController@cartPaymentUnconfirm')->name('cartPaymentUnconfirm');
	Route::post('/cartPaymentUnconfirmUpdate/{cartId}', 'CartController@cartPaymentUnconfirmUpdate')->name('cartPaymentUnconfirmUpdate');
	Route::get('/cartPaymentConfirm/{cartId}', 'CartController@cartPaymentConfirm')->name('cartPaymentConfirm');
	Route::post('/cartPaymentConfirmUpdate/{cartId}', 'CartController@cartPaymentConfirmUpdate')->name('cartPaymentConfirmUpdate');
	
	// cart add tracking number
	Route::get('/cartAddTrackingNumber/{cartId}', 'CartController@cartAddTrackingNumber')->name('cartAddTrackingNumber');
	Route::post('/cartAddTrackingNumberUpdate/{cartId}', 'CartController@cartAddTrackingNumberUpdate')->name('cartAddTrackingNumberUpdate');
	
	// cart delivery confirm
	Route::get('/cartDeliveryInfo/{cartId}', 'CartController@cartDeliveryInfo')->name('cartDeliveryInfo');
	Route::post('/cartDeliveryInfoUpdate/{cartId}', 'CartController@cartDeliveryInfoUpdate')->name('cartDeliveryInfoUpdate');
	Route::post('/cartDeliveryConfirm', 'CartController@cartDeliveryConfirm')->name('cartDeliveryConfirm');


	

	// proforma invoice company==========
	Route::get('/proformaInvoiceCompany', 'CartController@proformaInvoiceCompany')->name('proformaInvoiceCompany');

	Route::get('/proformacompanylogoDelete/{proformaCompanyId}', 'CartController@proformacompanylogoDelete')->name('proformacompanylogoDelete');
	Route::get('/proformacompanysignatureDelete/{proformaCompanyId}', 'CartController@proformacompanysignatureDelete')->name('proformacompanysignatureDelete');
	Route::get('/proformacompanysealDelete/{proformaCompanyId}', 'CartController@proformacompanysealDelete')->name('proformacompanysealDelete');
	Route::get('/proformacompanywatermarkLogoDelete/{proformaCompanyId}', 'CartController@proformacompanywatermarkLogoDelete')->name('proformacompanywatermarkLogoDelete');
	Route::get('/proformacompanyfooterBackgroundDelete/{proformaCompanyId}', 'CartController@proformacompanyfooterBackgroundDelete')->name('proformacompanyfooterBackgroundDelete');

	Route::post('/proformaInvoiceCompanyInsert', 'CartController@proformaInvoiceCompanyInsert')->name('proformaInvoiceCompanyInsert');
	Route::put('/proformaInvoiceCompanyUpdate', 'CartController@proformaInvoiceCompanyUpdate')->name('proformaInvoiceCompanyUpdate');
	Route::delete('/proformaInvoiceCompanyDelete/{proformaCompanyId}', 'CartController@proformaInvoiceCompanyDelete')->name('proformaInvoiceCompanyDelete');
	// proforma invoice company==========

	// proforma invoice common settings==========
	Route::post('/proformaInvoiceCommonSettingsSave', 'CartController@proformaInvoiceCommonSettingsSave')->name('proformaInvoiceCommonSettingsSave');
	// proforma invoice common settings==========

	//  invoice common settings==========
	Route::get('/invoiceCommonSettings', 'CartController@invoiceCommonSettings')->name('invoiceCommonSettings');
	Route::post('/invoiceCommonSettingsSave', 'CartController@invoiceCommonSettingsSave')->name('invoiceCommonSettingsSave');
	//  invoice common settings==========



	// manual cart create===================
	Route::post('/createmanualcartcustomerRegistrationSave',  'CartController@createmanualcartcustomerRegistrationSave')->name('createmanualcartcustomerRegistration.save');
	Route::get('/createmanualcart', 'CartController@createmanualcart')->name('createmanualcart');
	Route::post('/createmanualcartsave', 'CartController@createmanualcartsave')->name('createmanualcart.save');
	// manual cart create===================


	

	// default reasons and solutions==================
	// default reasons and solutions==================
	Route::get('defaultreasons', 'CartController@defaultReasons')->name('cart.default.reasons');

	// cart default reasons settings =>  reasons   portion==========================================
	Route::post('defaultReasons/defaultReasonInsert', 'CartController@defaultReasonInsert')->name('cart.default.reason.insert');
	Route::put('defaultReasons/defaultReasonUpdate', 'CartController@defaultReasonUpdate')->name('cart.default.reason.update');
	Route::delete('defaultReasons/defaultReasonDelete/{defaultReasonsId}', 'CartController@defaultReasonDelete')->name('cart.default.reason.delete');


	// cart default solutions settings =>  solutions   portion==========================================
	Route::post('defaultSolutions/defaultSolutionInsert', 'CartController@defaultSolutionInsert')->name('cart.default.solution.insert');
	Route::put('defaultSolutions/defaultSolutionUpdate', 'CartController@defaultSolutionUpdate')->name('cart.default.solution.update');
	Route::delete('defaultSolutions/defaultSolutionDelete/{defaultSolutionsId}', 'CartController@defaultSolutionDelete')->name('cart.default.solution.delete');

	// cart default payment receipt default messages settings =>  payment receipt default messages   portion==========================================
	Route::post('paymentreceiptdefaultmessagesInsert', 'CartController@paymentreceiptdefaultmessagesInsert')->name('paymentreceiptdefaultmessagesInsert');
	Route::put('paymentreceiptdefaultmessagesUpdate', 'CartController@paymentreceiptdefaultmessagesUpdate')->name('paymentreceiptdefaultmessagesUpdate');
	Route::delete('paymentreceiptdefaultmessagesDelete/{defaultReasonsId}', 'CartController@paymentreceiptdefaultmessagesDelete')->name('paymentreceiptdefaultmessagesDelete');
	// default reasons and solutions==================
	// default reasons and solutions==================






	

	

	// mail settings
	Route::get('/mailsettings', 'CartController@mailsettings')->name('mail.settings');
	Route::get('/mailsettingslogodelete', 'CartController@mailsettingslogodelete')->name('mailsettingslogodelete');
	Route::put('/mailsettingsupdate', 'CartController@mailsettingsupdate')->name('mail.settings.update');

	Route::post('mailsettings/emailbody/emailbodyInsert', 'CartController@emailbodyInsert')->name('emailbodyInsert');
	Route::put('mailsettings/emailbody/emailbodyUpdate', 'CartController@emailbodyUpdate')->name('emailbodyUpdate');
	Route::delete('mailsettings/emailbody/emailbodyDelete/{emailBodyId}', 'CartController@emailbodyDelete')->name('emailbodyDelete');


	// review
	Route::get('reviews', 'ReviewController@reviews')->name('reviews');





	// payment settings=============================
		Route::get('paymentsettings', 'PaymentController@paymentsettings')->name('paymentsettings');
			


		// ==============payment methods==================
			Route::post('paymentMethodInsert', 'PaymentController@paymentMethodInsert')->name('paymentMethodInsert');
			Route::get('/paymentMethodEdit/{paymentMethodId}', 'PaymentController@paymentMethodEdit')->name('paymentMethodEdit');
			Route::put('/paymentMethodUpdate/{paymentMethodId}', 'PaymentController@paymentMethodUpdate')->name('paymentMethodUpdate');
			
			Route::get('/paymentaccountdetailpicDelete/{paymentAccountDetailsId}', 'PaymentController@paymentaccountdetailpicDelete')->name('paymentaccountdetailpicDelete');

			Route::delete('/paymentMethodDelete/{paymentMethodId}', 'PaymentController@paymentMethodDelete')->name('paymentMethodDelete');
		// ==============payment methods==================


		// ==============payment prices for countries==================
			Route::post('paymentPriceInsert', 'PaymentController@paymentPriceInsert')->name('paymentPriceInsert');
			Route::get('/paymentPriceEdit/{countryId}', 'PaymentController@paymentPriceEdit')->name('paymentPriceEdit');
			Route::put('/paymentPriceUpdate/{countryId}', 'PaymentController@paymentPriceUpdate')->name('paymentPriceUpdate');
			Route::delete('/paymentPriceDelete/{countryId}', 'PaymentController@paymentPriceDelete')->name('paymentPriceDelete');
		// ==============payment prices for countries==================

	// payment settings=============================




	// delivery settings=============================
		Route::get('deliverysettings', 'DeliveryController@deliverysettings')->name('deliverysettings');

		// ==============weights==================
			Route::post('weightInsert', 'DeliveryController@weightInsert')->name('weightInsert');
			Route::put('/weightUpdate', 'DeliveryController@weightUpdate')->name('weightUpdate');
			Route::delete('/weightDelete/{weightId}', 'DeliveryController@weightDelete')->name('weightDelete');
		// ==============weights==================


		// ==============delivery methods==================
			Route::post('deliveryMethodInsert', 'DeliveryController@deliveryMethodInsert')->name('deliveryMethodInsert');
			Route::get('/deliveryMethodEdit/{deliveryMethodId}', 'DeliveryController@deliveryMethodEdit')->name('deliveryMethodEdit');
			Route::put('/deliveryMethodUpdate/{deliveryMethodId}', 'DeliveryController@deliveryMethodUpdate')->name('deliveryMethodUpdate');
			Route::delete('/deliveryMethodDelete/{deliveryMethodId}', 'DeliveryController@deliveryMethodDelete')->name('deliveryMethodDelete');
		// ==============delivery methods==================


		// ==============delivery prices for countries==================
			Route::post('deliveryPriceInsert', 'DeliveryController@deliveryPriceInsert')->name('deliveryPriceInsert');
			Route::get('/deliveryPriceEdit/{countryId}', 'DeliveryController@deliveryPriceEdit')->name('deliveryPriceEdit');
			Route::put('/deliveryPriceUpdate/{countryId}', 'DeliveryController@deliveryPriceUpdate')->name('deliveryPriceUpdate');
			Route::delete('/deliveryPriceDelete/{countryId}', 'DeliveryController@deliveryPriceDelete')->name('deliveryPriceDelete');
		// ==============delivery prices for countries==================

		
		// Route::put('settings/diseaseCategory/diseaseCategoryUpdate', 'GenericsController@diseaseCategoryUpdate')->name('generics.settings.diseaseCategory.update');
		// Route::delete('settings/diseaseCategory/diseaseCategoryDelete/{diseaseCategoryId}', 'GenericsController@diseaseCategoryDelete')->name('generics.settings.diseaseCategory.delete');
	// delivery settings=============================



	
});

Route::get('getGenericPackSizesUsingCustomerId/{customerId}', 'CartController@getGenericPackSizesUsingCustomerId')->name('getGenericPackSizesUsingCustomerId');

Route::get('/getpaymentaccountdetailstitlesagainstpaymentmethod/{paymentMethodId}', 'PaymentController@getpaymentaccountdetailstitlesagainstpaymentmethod');




// ============reports==================
// ============reports==================
Route::group([ 'prefix' =>'report','middleware' => 'ReportMiddleware'], function ()
{
	Route::get('/casehistoryreport', 'ReportController@casehistoryreport')->name('report.casehistory');
	Route::post('/casehistoryremindingalarmedit', 'CartController@casehistoryremindingalarmedit')->name('casehistoryremindingalarmedit');
	
	Route::get('/priceinquiryreport', 'ReportController@priceinquiryreport')->name('report.priceinquiryreport');
	Route::get('/paymentconfirmationreport', 'ReportController@paymentconfirmationreport')->name('report.paymentconfirmationreport');
	Route::get('/allcustomersdata', 'ReportController@allcustomersdata')->name('report.allcustomersdata');
	Route::get('/productsreport', 'ReportController@productsreport')->name('report.productsreport');

	Route::get('/uploadingthirdpartdataindex', 'ReportController@uploadingthirdpartdataindex')->name('uploadingthirdpartdataindex');
	Route::get('/uploadingthirdpartydata_c', 'ReportController@uploadingthirdpartydata_c')->name('uploadingthirdpartydata_c');
	Route::get('/uploadingthirdpartydata_e/{thirdpartydataId}', 'ReportController@uploadingthirdpartydata_e')->name('uploadingthirdpartydata_e');
	Route::delete('/uploadingthirdpartydata_delete/{thirdpartydataId}', 'ReportController@uploadingthirdpartydata_delete')->name('uploadingthirdpartydata_delete');
	Route::put('/uploadingthirdpartydata_e_update/{thirdpartydataId}', 'ReportController@uploadingthirdpartydata_e_update')->name('uploadingthirdpartydata_e_update');
	Route::get('/uploadingthirdpartydata_delete_file/{thirdpartdata_filesId}', 'ReportController@uploadingthirdpartydata_delete_file')->name('uploadingthirdpartydata_delete_file');
});
Route::post('/casehistoryreportmailsend', 'ReportController@casehistoryreportmailsend')->name('report.casehistory.mailsend');
Route::post('/allcustomersdatareportpriceinquireremidermailsend', 'ReportController@allcustomersdatareportpriceinquireremidermailsend')->name('allcustomersdatareportpriceinquireremidermailsend');
// ============reports==================
// ============reports==================




// ============blog section==================
// ============blog section==================
Route::group([ 'prefix' =>'blog','middleware' => 'BlogMiddleware'], function ()
{
	Route::get('/blogManagement', 'BlogController@blogManagement')->name('blogManagement');
	
});
// ============blog section==================
// ============blog section==================



// test
Route::get('/getTime', 'HomeController@getTime')->name('getTime');

Route::get('/test', 'TestController@test')->name('test');



Route::group(['prefix' => 'image'], function() {
	Route::get('getImage', 'CacheController@getImage')->name('getImage');
	Route::get('imageResize', 'CacheController@imageResize')->name('imageResize');
});


Route::group(['prefix' => 'files', 'middleware' => ['auth', 'AdminMiddleware', 'SuperAdminMiddleware'] ], function() {
	Route::post('batchFilesDelete', 'FileController@batchFilesDelete')->name('batchFilesDelete');
});


Route::group([ 'middleware' => 'Customer_F_Middleware', 'prefix'=>'{language}'], function ()
{
		// header section======================
		Route::post('/customerLogout',  'UserController_F@customerLogout')->name('customerLogout');

		// profile update
		Route::get('/profileUpdate',  'UserController_F@profileUpdate')->name('profileUpdate');
		Route::get('/useprofilepicDelete/{userId}',  'UserController_F@useprofilepicDelete')->name('useprofilepicDelete');
		Route::post('/customerRegistrationUpdate',  'UserController_F@customerRegistrationUpdate')->name('customerregistration.update');

		Route::post('/customerAccountDelete',  'UserController_F@customerAccountDelete')->name('customerAccountDelete');

		// order history
		Route::get('/customerOrderHistory',  'UserController_F@customerOrderHistory')->name('customerOrderHistory');
		Route::get('/customerOrderHistoryAndCart/{cartId}/{notificationId}',  'NotificationController_F@customerOrderHistoryAndCart')->name('customerOrderHistoryAndCart');
		Route::get('/customerOrderEdit/{cartId}',  'CartController@customerOrderEdit')->name('customerOrderEdit');

		Route::get('/cartQtyUpdate/{cartId}', 'CartController@cartQtyUpdate')->name('cartQtyUpdate');
		Route::post('/cartUpdateAddQty/{cartDetailId}/{cartId}/{usdToCurrencyRate}/{deliveryPriceInitial}/{deliveryPriceIncrement}/{transactionFee}', 'CartController@cartUpdateAddQty')->name('cartUpdateAddQty');
		Route::post('/cartUpdateSubQty/{cartDetailId}/{cartId}/{usdToCurrencyRate}/{deliveryPriceInitial}/{deliveryPriceIncrement}/{transactionFee}', 'CartController@cartUpdateSubQty')->name('cartUpdateSubQty');


		Route::post('/customerOrderUpdate/{cartId}',  'ProductController_F@customerOrderUpdate')->name('customerOrderUpdate');
		Route::post('/customerPaymentReceiptUpload/{cartId}',  'ProductController_F@customerPaymentReceiptUpload')->name('customerPaymentReceiptUpload');
		Route::post('/customerAddDeliveryInfo/{cartId}',  'ProductController_F@customerAddDeliveryInfo')->name('customerAddDeliveryInfo');
		Route::get('/customerOrderCancel/{cartId}',  'CartController@customerOrderCancel')->name('customerOrderCancel');
		

		Route::get('/customerOrderProformaInvociePrint/{cartId}',  'CartController@customerOrderProformaInvociePrint')->name('customerOrderProformaInvociePrint');
		Route::get('/dynamicproformainvoice/{cartId}',  'CartController@dynamicproformainvoice')->name('dynamicproformainvoice');

		Route::get('/customerOrderInvociePrint/{cartId}',  'CartController@customerOrderInvociePrint')->name('customerOrderInvociePrint');
		Route::get('/dynamicinvoice/{cartId}',  'CartController@dynamicinvoice')->name('dynamicinvoice');

		Route::get('/fakeInvociePrint/{cartId}',  'CartController@fakeInvociePrint')->name('fakeInvociePrint');
		Route::get('/dynamicfakeInvociePrint/{cartId}',  'CartController@dynamicfakeInvociePrint')->name('dynamicfakeInvociePrint');

		
		// prescriptions
		Route::get('/customerPrescriptions',  'UserController_F@customerPrescriptions')->name('customerPrescriptions');
		Route::post('/customerPrescriptionInsert', 'UserController_F@customerPrescriptionInsert')->name('customerPrescriptionInsert');

		// Notifications
		Route::get('/customerNotifications',  'NotificationController_F@customerNotifications')->name('customerNotifications');

		// header section======================


		// go to cart page===============================================
		// go to cart page===============================================
		Route::get('goToCartPage', 'ProductController_F@goToCartPage')->name('goToCartPage');
		Route::post('/productDetailsAddtoCartAddQty/{cartDetailId}', 'ProductController_F@productDetailsAddtoCartAddQty')->name('productDetailsAddtoCartAddQty');
		Route::post('/productDetailsAddtoCartSubQty/{cartDetailId}', 'ProductController_F@productDetailsAddtoCartSubQty')->name('productDetailsAddtoCartSubQty');
		Route::post('/removefromcart_1/{cartDetailId}', 'ProductController_F@removefromcart_1')->name('removefromcart_1');
		// go to cart page================================================
		// go to cart page================================================

		// go to checkout page===============================================
		// go to checkout page===============================================
		Route::get('/checkout', 'ProductController_F@checkout')->name('checkout');
		Route::get('/getDeliveryMethods/{countryId}', 'ProductController_F@getDeliveryMethods')->name('getDeliveryMethods');

		Route::get('/getPaymentMethods/{countryId}', 'ProductController_F@getPaymentMethods')->name('getPaymentMethods');

		Route::get('/getDeliverySummary/{deliveryMethodId}/{countryId}', 'ProductController_F@getDeliverySummary')->name('getDeliverySummary');
		Route::get('/getDeliverySummary2/{deliveryMethodId}/{countryId}/{cartId}/{currency}', 'ProductController_F@getDeliverySummary2')->name('getDeliverySummary2');

		Route::get('/getPaymentSummary/{paymentMethodId}/{countryId}', 'ProductController_F@getPaymentSummary')->name('getPaymentSummary');



		Route::get('/getCheckoutCalculation/{deliveryMethodId}/{countryId}/{paymentMethodId}/{paymentCountryId}', 'ProductController_F@getCheckoutCalculation')->name('getCheckoutCalculation');
		Route::get('/getCheckoutCalculation2/{deliveryMethodId}/{countryId}/{paymentMethodId}/{paymentCountryId}/{cartId}/{currency}', 'ProductController_F@getCheckoutCalculation2')->name('getCheckoutCalculation2');




		Route::post('/checkoutConfirm',  'ProductController_F@checkoutConfirm')->name('checkoutConfirm');


		// go to checkout page================================================
		// go to checkout page================================================
	
});



Route::get('/testData', 'TestController@testData');

