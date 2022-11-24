<?php
namespace App\Http\Controllers;

use DB;
use App\Notifications;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class NotificationController_F extends Controller
{

    public function productDetailsPage($language, $genericBrandId)
    {
        // setSessionLanguage();

        Notifications::where('receiverId', Auth::user()->id)->where('genericBrandId', $genericBrandId)->update(
            [
                'read_at' => \Carbon\Carbon::now()
            ]
        );

        return redirect()->route('productDetailsPageCaller', array($language, $genericBrandId));        
    }

    public function productPricesForUsersAssign($inquirerId)
    {
        DB::table('notifications_admin')->where('inquirerId', $inquirerId)
        ->update(
            [
                'read_at' => \Carbon\Carbon::now()
            ]
        );

        return redirect()->route('productPricesForUsers.assign', $inquirerId);        
    }

    public function CartCreatedByCustomerNotifications($cartId)
    {
        DB::table('notifications_admin')->where('cartId', $cartId)
        ->update(
            [
                'read_at' => \Carbon\Carbon::now()
            ]
        );

        // return back();        
        return redirect()->route('cartListAdmin',['cartId'=>$cartId] );        

    }



    public function customerNotifications(Request $request, $language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
         
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get(); 
        });

        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        $allnotificationData = DB::table('notifications')->where('receiverId', Auth::user()->id)->get();
        $notificationData = DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get();


        return view('frontend.notifications_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData', 'userData',  'allnotificationData','notificationData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }



    public function customerOrderHistoryAndCart($language='en', $cartId=null, $notificationId=null)
    {

        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        // prerequisite data
          
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get(); 
        });
         

        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');


        // main data
        $cartData = DB::table('cart_view')->where('customerId', Auth::user()->id)->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->get();
        $deliverymethodsData = Cache::remember('deliverymethodsData', 100, function () {
            return DB::table("deliverymethod")->get(); 
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();
        
        
        $cartapprovesData = DB::table("cartapproves_view")->get();

        $cartpaymentreceiptmessagesData = DB::table('cartpaymentreceiptmessages')->get();

        DB::table('notifications')->where('cartId', $cartId)->orWhere('notificationId', $notificationId)
        ->update(
            [
                'read_at' => \Carbon\Carbon::now()
            ]
        );

        $trackingpicturesData = DB::table('trackingpictures')->get();
        

        $cartarejectreasonsData = DB::table('cartarejectreasons')->get();
        $cartarejectsolutionsData = DB::table('cartarejectsolutions')->get();
        $trackingData = DB::table('tracking')->get();
        $trackingData = DB::table('tracking')->get();
        $cartdeliveryinfoData = DB::table('cartdeliveryinfo')->get(); 
        $paymentsummaryData = DB::table('paymentsummary')->get(); 
        
        return view('frontend.orderhistory_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData', 'userData',  'notificationData', 'cartData', 'deliverymethodsData', 'cartdetailsData', 'genericpacksizes_with_customer_price_Data', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData' , 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'cartapprovesData', 'cartarejectreasonsData', 'cartarejectsolutionsData', 'cartpaymentreceiptmessagesData', 'trackingData', 'cartdeliveryinfoData', 'paymentsummaryData', 'trackingpicturesData'));
    }


}
