<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\DefaultReasons;
use App\DefaultSolutions;
use App\CartaRejectReasons;
use App\CartaRejectSolutions;
use App\CartApproves;
use App\MailSettings;
use App\PaymentReceiptDefaultMessages;
use App\ProformaCompany;
use App\InvoiceCommonSettings;
use App\ProformaInvoiceCommonSettings;
use App\Cart;
use App\Cartpaymentreceiptmessages;
use App\Trackingpictures;
use App\Cartdeliveryinfo;


use App\User;
use App\UserRoles;
use App\EmailBody;

use DB;
use Auth;
use Illuminate\Support\Facades\Cache;


use PDF;
use src\NTWIndia;
use Carbon\Carbon;

use \Gumlet\ImageResize;
use Input;
use Redirect;
use Route;

class CartController extends Controller
{

    // ================admin panel=======================
    // ================admin panel=======================
    public function cartListAdmin()
    {
        $cartData = DB::table('cart_view')->get();
        
        
        $cartdetailsData = DB::table('cartdetails_view')->get();
        $countryData = DB::table('country')->get();
        $deliverymethodsData = DB::table("deliverymethod")->get();
        $paymentmethodsData = DB::table("paymentmethod")->get();
        $userData = DB::table('users')->get();
        $genericbrandData = DB::table('genericbrand_view')->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->get();
        
        $trackingData = DB::table('tracking')->get();

        
        if(request()->has('cartId') && request('cartId')!= null){
            $cartData = $cartData->where('cartId', request('cartId'));
        }

        $cartdeliveryinfoData = DB::table('cartdeliveryinfo')->get();

        $trackingpicturesData = DB::table('trackingpictures')->get();
        $cartprescriptionsData = DB::table('cartprescriptions')->get();
        


        $cartpaymentreceiptmessagesData = DB::table('cartpaymentreceiptmessages')->get();
        return view('frontend.cart_admin', compact('cartData','cartdetailsData', 'countryData', 'deliverymethodsData', 'paymentmethodsData', 'userData', 'genericbrandData', 'genericpacksizes_with_customer_price_Data', 'trackingData', 'cartpaymentreceiptmessagesData', 'cartdeliveryinfoData', 'trackingpicturesData', 'cartprescriptionsData'));
        
    }


    
    public function cartListAdminApprovalStatusUpdate( $cartId )
    {
        $cartData =  DB::table('cart')->where('cartId', $cartId)->first();
        $isCartApproved = $cartData->isCartApproved;
        $customerId = $cartData->customerId;

        if ($isCartApproved == 2) // approved to rejected  (2 to 3)
        {
            DB::table('cart')->where('cartId', $cartId)->update(['isCartApproved' => 3, 'cartStatusId'=> 3, 'rejectCount'=> $cartData->rejectCount+1]);

            // ==============Notification for customer===========
                DB::table('notifications')->insert([
                    'receiverId' => $customerId,
                    'message' => 'Your order #'.$cartId.' has been rejected.',
                    'cartId' => $cartId
                ]);
            // ==============Notification for customer============
        }
        else  // pending/rejected to approved  (0 to 1)
        {
            DB::table('cart')->where('cartId', $cartId)->update(['isCartApproved' => 2, 'cartStatusId'=> 2, 'approveCount'=> $cartData->approveCount+1]);

            // ==============Notification for customer===========
                DB::table('notifications')->insert([
                    'receiverId' => $customerId,
                    'message' => 'Your order #'.$cartId.' has been approved to make payment.',
                    'cartId' => $cartId
                ]);
            // ==============Notification for customer============
            
        }


        return 'success';

    }
    // ================admin panel=======================
    // ================admin panel=======================


    public function customerOrderEdit(Request $request, $language, $cartId )
    {
        $cartId = Crypt::decrypt($cartId);
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        // primary data=============================
         
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');

        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get(); 
        });
         
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        

        // secondary data===============
        $deliverypriceData = Cache::remember('deliverypriceData', 100, function () {
            return DB::table('deliveryprice_view')->get();
        });
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        $paymentpriceData = Cache::remember('paymentpriceData', 100, function () {
            return DB::table('paymentprice_view')->get();
        });


        return view('frontend.cartUpdate_f', compact('wishlistData', 'categoryData', 'compareData','notificationData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'userData', 'deliverypriceData','cartData', 'cartdetailsData', 'genericpacksizes_with_customer_price_data',  'countryData', 'paymentpriceData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData' , 'reviewData', 'reviewsData', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
       
    }



    public function customerOrderCancel($language='en',  $cartId )
    {
        // setSessionLanguage();

        //========== send mail========

        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });

        


        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details


        $mailsettingsData = Cache::remember('mailsettingsData', 100, function () {
            return  DB::table('mailsettings')->first();
        });

        $mailReceiverEmail =  Auth::user()->email;
        $mailReceiverName = Auth::user()->name;
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartData->created_at).' has been cancelled!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartData->created_at).' has been cancelled! ';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        DB::table('cartdetails')->where('cartId', $cartId)->delete();
        $cartNumber = process_order_number($cartId, $cartData->created_at);

        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'inquirerId' => $cartData->customerId, 
                'message' => $cartData->email.' has been cancelled a cart '.process_order_number($cartId, $cartData->created_at),
                'message2' => $cartData->email.' has been cancelled a cart '.process_order_number($cartId, $cartData->created_at),
            ],
        ]);
        // notifications_admin=============


        DB::table('cart')->where('cartId', $cartId)->delete();


        



        // $previousUrl = app('url')->previous();
        // $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        return redirect()->to('/'.'?'. http_build_query([app()->getLocale()]))->with('cacelOrder', 1)->with('cartNumber', $cartNumber);
    }





    public function cartQtyUpdate($language='en', $cartId)
    {
        $cartId = Crypt::decrypt($cartId);


        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        // primary data=============================
         
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
         
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return  DB::table('genericbrand_view')->get(); 
        });
        
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        

        
        
        

        // main content data=======================
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        
        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();

        
        
        return view('frontend.cartQtyUpdate', compact('categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'userData', 'cartData', 'cartdetailsData', 'genericbrandpicData', 'genericpacksizes_with_customer_price_data', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData' , 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));

    }




    public function cartUpdateAddQty($language, $cartDetailId, $cartId, $usdToCurrencyRate, $deliveryPriceInitial, $deliveryPriceIncrement, $transactionFee)
    {
        $cartdetailsData = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->first();
        $qty = $cartdetailsData->qty;
        $qty = $qty + 1;

        DB::table('cartdetails')
            ->where('cartDetailId', $cartDetailId)
            ->update(
                [
                    'qty' => $qty

                ]
            );   


        // for specific cart's cartdetails
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $sumQty = $cartdetailsData->sum('qty');
        $discountTotal = $cartdetailsData->sum('discountTotal') * $usdToCurrencyRate  ;
        $cartWeightGM = $cartdetailsData->sum('cartWeightGM');
        $cartsubtotalwithdiscount = $cartdetailsData->sum('cartsubtotalwithdiscount') * $usdToCurrencyRate ;
        $cartsubtotalwithoutdiscount = $cartdetailsData->sum('subtotal') * $usdToCurrencyRate ;


        // for specific cartdetail data
        $cartdetailsData = $cartdetailsData->where('cartDetailId', $cartDetailId)->first();
        $cartdetailsubtotalwithdiscount = $cartdetailsData->cartsubtotalwithdiscount * $usdToCurrencyRate ;


         $shippingCost=0;
                if ($cartWeightGM<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeightGM/1000);
                }

                $shippingCost = $shippingCost * $usdToCurrencyRate;

        // check offer is applicable for customer and remove transaction fee
                $offerData = DB::table('offer')->where('offerId', 1)->first();
                $offerMinAmount = $offerData->minAmount;

                if ( $cartsubtotalwithdiscount  >= $offerMinAmount * $usdToCurrencyRate) 
                {
                    $cartTotal = $cartsubtotalwithdiscount; 
                    $shippingCost =  0;
                    $offer = $offerData->offer;
                }
                else 
                {
                    $cartTotal = $cartsubtotalwithdiscount + $shippingCost; 
                    $offer= '';
                }

        // check offer is applicable for customer and remove transaction fee

                // after payment method==========
                $transactionFeeAmount = ( (($transactionFee )/100) * $cartTotal ) ;
                $cartTotal = $cartTotal + $transactionFeeAmount;




        DB::table('cart')
            ->where('cartId', $cartId)
            ->update(
                [
                    'discount' => $discountTotal, 
                    'subTotalAmount' => $cartsubtotalwithoutdiscount, 
                    'totalQty' => $sumQty, 
                    'cartWeightGM' => $cartWeightGM, 
                    'shippingAmount' => $shippingCost, 
                    'offer' => $offer,
                    'transactionFeeAmount' => $transactionFeeAmount, 
                    'totalAmount' => $cartTotal

                ]
            ); 


        $response = [ "sumQty" => $sumQty, "qty" => $qty , "cartdetailsubtotalwithdiscount" => $cartdetailsubtotalwithdiscount ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }



    public function cartUpdateSubQty($language, $cartDetailId, $cartId, $usdToCurrencyRate, $deliveryPriceInitial, $deliveryPriceIncrement, $transactionFee)
    {
        $cartdetailsData = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->first();
        $qty = $cartdetailsData->qty;
        $qty = $qty - 1;

        DB::table('cartdetails')
            ->where('cartDetailId', $cartDetailId)
            ->update(
                [
                    'qty' => $qty

                ]
            );   


        // for specific cart's cartdetails
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $sumQty = $cartdetailsData->sum('qty');
        $discountTotal = $cartdetailsData->sum('discountTotal') * $usdToCurrencyRate  ;
        $cartWeightGM = $cartdetailsData->sum('cartWeightGM');
        $cartsubtotalwithdiscount = $cartdetailsData->sum('cartsubtotalwithdiscount') * $usdToCurrencyRate ;
        $cartsubtotalwithoutdiscount = $cartdetailsData->sum('subtotal') * $usdToCurrencyRate ;





        // for specific cartdetail data
        $cartdetailsData = $cartdetailsData->where('cartDetailId', $cartDetailId)->first();
        $cartdetailsubtotalwithdiscount = $cartdetailsData->cartsubtotalwithdiscount * $usdToCurrencyRate ;


         $shippingCost=0;
                if ($cartWeightGM<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeightGM/1000);
                }

                $shippingCost = $shippingCost * $usdToCurrencyRate;

        // check offer is applicable for customer and remove transaction fee
                $offerData = DB::table('offer')->where('offerId', 1)->first();
                $offerMinAmount = $offerData->minAmount;

                if ( $cartsubtotalwithdiscount  >= $offerMinAmount * $usdToCurrencyRate) 
                {
                    $cartTotal = $cartsubtotalwithdiscount; 
                    $shippingCost =  0;
                    $offer = $offerData->offer;
                }
                else 
                {
                    $cartTotal = $cartsubtotalwithdiscount + $shippingCost; 
                    $offer= '';
                }

        // check offer is applicable for customer and remove transaction fee

                // after payment method==========
                $transactionFeeAmount = ( (($transactionFee )/100) * $cartTotal ) ;
                $cartTotal = $cartTotal + $transactionFeeAmount;




        DB::table('cart')
            ->where('cartId', $cartId)
            ->update(
                [
                    'discount' => $discountTotal, 
                    'subTotalAmount' => $cartsubtotalwithoutdiscount, 
                    'totalQty' => $sumQty, 
                    'cartWeightGM' => $cartWeightGM, 
                    'shippingAmount' => $shippingCost, 
                    'offer' => $offer,
                    'transactionFeeAmount' => $transactionFeeAmount, 
                    'totalAmount' => $cartTotal

                ]
            ); 



        $response = [ "sumQty" => $sumQty, "qty" => $qty , "cartdetailsubtotalwithdiscount" => $cartdetailsubtotalwithdiscount ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

  



    // ==================cart deafult reason default solution===================
    // ==================cart deafult reason default solution===================
    public function defaultReasons()
    {
        $defaultreasonsData = DB::table('defaultreasons')->get();
        $defaultsolutionsData = DB::table('defaultsolutions')->get();
        $paymentreceiptdefaultmessagesData = DB::table('paymentreceiptdefaultmessages')->get();

        return view('cart.defaultresonssolutions', compact('defaultreasonsData', 'defaultsolutionsData', 'paymentreceiptdefaultmessagesData'));
    }



        // default reason => gdefault  reason  portion  start ====================
        // default reason => gdefault  reason  portion  start ====================

        public function defaultReasonInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultReason' => 'required|unique:defaultreasons'
                ],
                [  
                    'defaultReason.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = DefaultReasons::create($inputs);
            return back()->with('successMsg', 'New Default Reason successfully added!');
        }

        public function defaultReasonUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultReason' => 'required|unique:defaultreasons,defaultReason,'.$request->defaultReasonId.',defaultReasonId'
                ],
                [  
                    'defaultReason.unique' => 'Duplicate record already exist!',
                ]
            );

            DefaultReasons::find($request->defaultReasonId)->update($request->all()); 
            return back()->with('successMsg', 'Default Reason successfully updated!');
        }

        public function defaultReasonDelete($defaultReasonId)
        {
            DefaultReasons::find($defaultReasonId)->delete(); 
            return back()->with('successMsg', 'Default Reason successfully deleted!');
        }

        // default reason => gdefault  reason  portion  end ====================
        // default reason => gdefault  reason  portion  end ====================



        // default reason => cdefault  solution portion  start ====================
        // default reason => cdefault   solution  start ====================

        public function defaultSolutionInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultSolution' => 'required|unique:defaultsolutions'
                ],
                [  
                    'defaultSolution.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = DefaultSolutions::create($inputs);
            return back()->with('successMsg', 'New Default Solution successfully added!');
        }

        public function defaultSolutionUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultSolution' => 'required|unique:defaultsolutions,defaultSolution,'.$request->defaultSolutionId.',defaultSolutionId'
                ],
                [  
                    'defaultSolution.unique' => 'Duplicate record already exist!',
                ]
            );

            DefaultSolutions::find($request->defaultSolutionId)->update($request->all()); 
            return back()->with('successMsg', 'Default Solution successfully updated!');
        }

        public function defaultSolutionDelete($defaultSolutionId)
        {
            DefaultSolutions::find($defaultSolutionId)->delete(); 
            return back()->with('successMsg', 'Default Solution successfully deleted!');
        }

        // default reason =>  default  solution portion  end ====================
        // default reason =>  default solution  portion  end ====================
    // ==================cart deafult reason default solution===================
    // ==================cart deafult reason default solution===================







        // default reason => gdefault  reason  portion  start ====================
        // default reason => gdefault  reason  portion  start ====================

        public function paymentreceiptdefaultmessagesInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultReason' => 'required|unique:defaultreasons'
                ],
                [  
                    'defaultReason.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = PaymentReceiptDefaultMessages::create($inputs);
            return back()->with('successMsg', 'New Default unconfirmed payment message successfully added!');
        }

        public function paymentreceiptdefaultmessagesUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'defaultReason' => 'required|unique:defaultreasons,defaultReason,'.$request->defaultReasonId.',defaultReasonId'
                ],
                [  
                    'defaultReason.unique' => 'Duplicate record already exist!',
                ]
            );

            PaymentReceiptDefaultMessages::find($request->defaultReasonId)->update($request->all()); 
            return back()->with('successMsg', 'Default unconfirmed payment message successfully updated!');
        }

        public function paymentreceiptdefaultmessagesDelete($defaultReasonId)
        {
            PaymentReceiptDefaultMessages::find($defaultReasonId)->delete(); 
            return back()->with('successMsg', 'Default unconfirmed payment message successfully deleted!');
        }

        // default reason => gdefault  reason  portion  end ====================
        // default reason => gdefault  reason  portion  end ====================




    // =============cart approve  or reject============================
    // =============cart approve  or reject============================
    public function cartApprovalApprove($cartId)
    {
        $paymentmethodsData = DB::table('paymentmethod')->get();
        $cartData = DB::table('cart_view')->where('cartId', $cartId)->first();
        $proformacompanyData = DB::table('proformacompany')->get();
        $cartapprovesData = DB::table('cartapproves_view')->where('cartId', $cartId)->first();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();

        return view('cart.cartapprove', compact('paymentmethodsData', 'cartData', 'proformacompanyData', 'cartapprovesData', 'userData'));
    }

    public function cartApprovalApproveUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        DB::table('cart')->where('cartId', $cartId)
                        ->update([
                                    'isCartApproved'=>2,
                                    'approveCount'=> ((int)$cartData->approveCount)+1,
                                ]);

        DB::table('cartapproves')->where('cartId', $cartId)->delete();
        CartApproves::create($request->all());
        $cartapprovesData = DB::table('cartapproves_view')->where('cartId', $cartId)->first();

        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;

        $paymentaccountdetailData = DB::table('paymentaccountdetails_view')->where('paymentMethodId', $request->paymentMethodId)->first();
        // dd($paymentaccountdetailData);
        

        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been approved to make payment.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been approved! ',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details


        $paymentsummaryData = DB::table('paymentsummary')->where('paymentMethodId', $cartapprovesData->paymentMethodId)->get();
        $paymentsummaries = '';
        foreach ($paymentsummaryData as $paymentsummary) 
        {
            $paymentsummaries = $paymentsummaries.'<li>'.$paymentsummary->paymentSummary.'</li>';
        }

        $isProformaInvoiceVisible = $request->isProformaInvoiceVisible;
        if($isProformaInvoiceVisible)
        {
            $isProformaInvoiceVisible = '<tr>
                                            <th>Proforma invoice PDF link :</th>
                                            <td> <a href="'.url('/').'/en/dynamicproformainvoice'.'/'.$cartId.'">Click to see proforma invoice</a></td>
                                        </tr>';
        }
        else
        {
            $isProformaInvoiceVisible = '';
        }

        $cartapprovespictures= '';
        foreach (DB::table('paymentaccountdetails')->where('paymentAccountDetailsId', $cartapprovesData->paymentAccountDetailsId)->get() as $paymentmethod) {
            $cartapprovespictures = $cartapprovespictures.'<li><a href="'.url('/').$paymentmethod->picPath.'" target="_blank">'.url('/').$paymentmethod->picPath.'</a></li>';
        }

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been approved!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been approved. Please check your Order Details in Profile section for further steps. ';
        $bodyMessage = $bodyMessage.'<br><br>'.'
                        <table style="text-align: left;">
                            <tr>
                                <th>Payment Method</th>
                                <td style="padding: 13px;" >'.$paymentaccountdetailData->paymentMethod.'</td>
                            </tr>
                            <tr>
                                <th>Payment Account Details</th>
                                <td style="padding: 13px;" >'. request('paymentAccountDetails') .'</td>
                            </tr>
                            <tr>
                                <th>Payment Instruction</th>
                                <td style="padding: 13px;" >'. '<ul>'.$paymentsummaries .'</ul>'.'</td>
                            </tr>
                            <tr>
                                <th>Additional Payment Instruction</th>
                                <td style="padding: 13px;" >'. request('paymentAccountDetailsAdditional') .'</td>
                            </tr>
                            <tr>
                                <th>Payment Account Information Image Links</th>
                                <td style="padding: 13px;" >'.'<ul'.$cartapprovespictures.'</ul>'.'</td>
                            </tr>
                                
                            '.$isProformaInvoiceVisible.'
                            
                        </table>';
                       
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;


        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========
        
            return back()->with('successMsg', 'Successfully Approved!');
    }


 
    public function cartApprovalReject($cartId)
    {
        $defaultreasonsData = DB::table('defaultreasons')->get();
        $defaultsolutionsData = DB::table('defaultsolutions')->get();

        $cartarejectreasonsData = DB::table('cartarejectreasons')->where('cartId', $cartId)->get();
        $cartarejectsolutionsData = DB::table('cartarejectsolutions')->where('cartId', $cartId)->get();

        $cartData = DB::table('cart')->where('cartId', $cartId)->first();

        $userData = DB::table('users')->where('id', $cartData->customerId)->first();

        return view('cart.cartreject', compact('defaultreasonsData','defaultsolutionsData', 'cartarejectreasonsData', 'cartarejectsolutionsData', 'cartData', 'userData'));
    }


    
    public function cartApprovalRejectUpdate(Request $request, $cartId)
    {
        CartaRejectReasons::where('cartId', $cartId)->delete();
        CartaRejectSolutions::where('cartId', $cartId)->delete();

        $reasonsStr = '';
        if ($request->reason!=null) 
        {
            foreach($request->reason as $reasons=>$v)
            {
                $reasonsData=array
                (
                    'cartId'=>$cartId,
                    'reason'=>$request->reason[$reasons],
                    'reasonCN'=>$request->reasonCN[$reasons],
                    'reasonRU'=>$request->reasonRU[$reasons],
                );
                $reasonsStr = $reasonsStr.'<li>'.$request->reason[$reasons].'</li>';
                CartaRejectReasons::insert($reasonsData);
            }
        }

        $solutionsStr = '';
        if ($request->solution!=null) 
        {
            foreach($request->solution as $solutions=>$v)
            {
                $solutionsData=array
                (
                    'cartId'=>$cartId,
                    'solution'=>$request->solution[$solutions],
                    'solutionCN'=>$request->solutionCN[$solutions],
                    'solutionRU'=>$request->solutionRU[$solutions],
                );
                $solutionsStr = $solutionsStr.'<li>'.$request->solution[$solutions].'</li>';
                CartaRejectSolutions::insert($solutionsData);
            }
        }
        
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        DB::table('cart')->where('cartId', $cartId)->update([
            'isCartApproved' => 3,
            'rejectCount'=> ((int)$cartData->rejectCount)+1,

        ]);


        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;





        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'cartId' => $cartId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been rejected.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been rejected! ',
                
            ]);
        // ==============Notification for customer============


        //========== send mail========

        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId',$cartData->customerId)->get();
        // cart details and delivery details


        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been rejected!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been rejected! '.'<br>'.'Reasons: <br> <ul>'.$reasonsStr.'</ul>'.'<br>'.'Solutions: <br> <ul>'.$solutionsStr.'</ul>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========


        return back()->with('successMsg', 'Successfully rejected!');
    }


    public function cartApprovalDelete($cartId)
    {
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();
        return view('cart.cartdelete', compact( 'cartData', 'userData'));
    }

    public function cartApprovalDeleteUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been deleted.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been deleted! ',
                'isCartDeleted' => 1
            ]);
        // ==============Notification for customer============


        //========== send mail========

        // cart details and delivery details
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $customerId)->get();
        // cart details and delivery details


        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been deleted!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been deleted! ';
        $bodyMessage = $bodyMessage.'<br><br>'.'
                                            <table style="text-align: left;">
                                                <tr>
                                                    <th>Reasons</th>
                                                    <td>'.$request->reason.'</td>
                                                </tr>
                                                
                                            </table>
                                            ';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        DB::table('cart')->where('cartId', $cartId)->delete();


        return redirect(route('cartListAdmin'))->with('successMsg', 'Successfully deleted!');
    }


    public function cartPaymentUnconfirm($cartId)
    {
        $paymentreceiptdefaultmessagesData = DB::table('paymentreceiptdefaultmessages')->get();
        $cartpaymentreceiptmessagesData = DB::table('cartpaymentreceiptmessages')->where('cartId', $cartId)->get();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $usersData = DB::table('users')->get();
        $userData = $usersData->where('id', $cartData->customerId)->first();
        return view('cart.cartpaymentunconfirm', compact('paymentreceiptdefaultmessagesData','cartpaymentreceiptmessagesData' ,'cartData','usersData', 'userData'));
    }

    public function cartPaymentUnconfirmUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        DB::table('cart')->where('cartId', $cartId)
                        ->update([
                                    'isPaymentConfirm'=>2,
                                    'isPaymentReceiptUploaded'=>0,
                                ]);

        $files ='';


        if ($request->picPath!=null) 
        {
            $batchNumber = DB::table('cartpaymentreceiptmessages')->selectRaw('max(ifnull(batch, 0)) as batchNumber')->pluck('batchNumber')->first();
            $batchNumber += 1 ;

            
            foreach($request->picPath as $pic=>$v)
            {
                $picPathData=array
                (
                    'reason' => $request->reason,
                    'reasonCN' => $request->reasonCN,
                    'reasonRU' => $request->reasonRU,
                    'cartId' => $cartId,
                    'userId' => Auth::user()->id,
                    'isCustomer' => 0,
                    'picPath'=>$request->picPath[$pic],
                );

                // dd($picPathData);
                $lastCreatedcartPaymentReceiptMessageId = Cartpaymentreceiptmessages::create($picPathData)->cartPaymentReceiptMessageId;
                $randomNumber = rand(99,99999);
                
                $file = $picPathData['picPath'];
                $file->move('uploads/cart/paymentreceipt/', 'cartPaymentReceiptMessageId_'.$lastCreatedcartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
                $filePath = '/uploads/cart/paymentreceipt/cartPaymentReceiptMessageId_'.$lastCreatedcartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();

                $files = $files.'<li><a href="'.url('/').$filePath.'" target="_blank">'.url('/').$filePath.'</a></li>';

                Cartpaymentreceiptmessages::find($lastCreatedcartPaymentReceiptMessageId)->update(['picPath'=>'/uploads/cart/paymentreceipt/'.'cartPaymentReceiptMessageId_'.$lastCreatedcartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]);
            }

        }
        else{
            $data=array
            (
                'reason' => $request->reason,
                'reasonCN' => $request->reasonCN,
                'reasonRU' => $request->reasonRU,
                'cartId' => $cartId,
                'userId' => Auth::user()->id,
                'isCustomer' => 0,
            );
            Cartpaymentreceiptmessages::create($data)->cartPaymentReceiptMessageId;
        }




        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been unconfirmed.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been unconfirmed.',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been unconfirmed.';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been unconfirmed.';
        $bodyMessage = $bodyMessage.'<br><br> Unconfirm Message : '.$request->reason.'<br><br>'.'Unconfirm Image Links: <br>'.$files;

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        
        
        return redirect(route('cartListAdmin', ['cartId'=> $cartId]))->with('successMsg', 'Successfully Unconfirmed!');
    }


    public function cartPaymentConfirm($cartId)
    {
        $paymentreceiptdefaultmessagesData = DB::table('paymentreceiptdefaultmessages')->get();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();
        $proformacompanyData = DB::table('proformacompany_view')->get();

        return view('cart.cartpaymentconfirm', compact('paymentreceiptdefaultmessagesData','cartData', 'userData', 'proformacompanyData'));
    }


    public function cartPaymentConfirmUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        DB::table('cart')->where('cartId', $cartId)
        ->update([
                    'isPaymentConfirm'=>1,
                    'paymentConfirmCompanyId'=>$request->paymentConfirmCompanyId,
                    'isInvoiceVisible'=>$request->isInvoiceVisible,
                    'paymentConfirmDate'=>now(),
                    'isPaymentReceiptUploaded'=>0,
                    
                ]);
                                
                                
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been confirmed.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been confirmed.',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been confirmed.';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment has been confirmed.';
        $bodyMessage = $bodyMessage;

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        
        return back()->with('successMsg', 'Successfully Confirmed!');
    }



    public function generateDuplicateInvoice($cartId)
    {
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $proformacompanyData = DB::table('proformacompany')->get();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();

        return view('cart.duplicateinvoicesetup', compact('cartData', 'cartdetailsData', 'proformacompanyData', 'userData'));
    }

    public function generateDuplicateInvoiceUpdate(Request $request, $cartId)
    {
        DB::table('cart')->where('cartId', $cartId)->update([
            'duplicateInvoiceDate' => dmyToYmd($request->duplicateInvoiceDate),
            'duplicateInvoiceCompanyId' => $request->duplicateInvoiceCompanyId,
        ]);

        foreach($request->cartDetailId as $cartdetail=>$v)
        {
            $cartId = $cartId;
            $cartDetailId = $request->cartDetailId[$cartdetail];
            $fakeProduct = $request->fakeProduct[$cartdetail];
            $realPrice = $request->realPrice[$cartdetail];
            $fakePrice = $request->fakePrice[$cartdetail];
            $fakeQty = $request->fakeQty[$cartdetail];
            $fakeProductVisible = $request->fakeProductVisible[$cartdetail];

            DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->update([
                'fakeProduct'=>$fakeProduct,
                'fakePrice'=>$fakePrice,
                'fakeQty'=>$fakeQty,
                'fakeSubAmount'=>$fakePrice*$fakeQty,
                'fakeProductVisible'=>$fakeProductVisible,
            ]);
        }
        $fakeTotalPrice = DB::table('cartdetails')->where('cartId', $cartId)->sum('fakeSubAmount');
        DB::table('cart')->where('cartId', $cartId)->update(['fakeTotalPrice'=>$fakeTotalPrice]);

        return back()->with('successMsg', 'Successfully saved!');
        
    }

    

    public function duplicateInvoiceShowing($cartId)
    {
        DB::table('cart')->where('cartId', $cartId)->update(['isDuplicateInvoiceVisible' => 1]);  
        return back()->with('cartId', $cartId);
    }

    public function duplicateInvoiceHiding($cartId)
    {
        DB::table('cart')->where('cartId', $cartId)->update(['isDuplicateInvoiceVisible' => 0]);  
        return back()->with('cartId', $cartId);
    }



    public function documentUpdateForCartProducts($cartId)
    {
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartprescriptionsData = DB::table('cartprescriptions')->where('cartId', $cartId)->get();
        $usergenericinquiryData  = DB::table('usergenericinquiry_view')->where('inquirerId', $cartData->customerId)->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();

        $userData = DB::table('users')->where('id', $cartData->customerId)->first();
       
        return view('cart.documentUpdateForCartProducts', compact('cartData', 'cartprescriptionsData', 'usergenericinquiryData','cartdetailsData', 'userData'));
    }

    public function documentUpdateForCartProductsUpdate(Request $request, $cartId)
    {
        DB::table('cartprescriptions')
                ->insert([
                        'cartId'=>$cartId,
                        'prescriptionPath'=>$request->prescriptionPath,
                    ]);

        return back()->with('successMsg', 'Successfully saved!');
    }
    public function documentUpdateForCartProductsDelete(Request $request, $cartPrescriptionId)
    {
        DB::table('cartprescriptions')->where('cartPrescriptionId', $cartPrescriptionId)->delete();
        return back()->with('successMsg', 'Successfully deleted!');
    }




    public function batchupdateforcartproducts($cartId)
    {
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        $genericbrandData = DB::table('genericbrand_view')->get();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();
        return view('cart.batchupdateforcartproducts', compact('cartData', 'cartdetailsData', 'genericpacksizes_with_customer_price_Data', 'genericbrandData', 'userData'));
    }

    public function batchupdateforcartproductsUpdate(Request $request, $cartId)
    {
        foreach($request->cartDetailId as $cartdetail=>$v)
        {
            $cartId = $cartId;
            $cartDetailId = $request->cartDetailId[$cartdetail];
            $batch = $request->batch[$cartdetail];
            $manufactureDate = $request->manufactureDate[$cartdetail];
            $expireDate = $request->expireDate[$cartdetail];

            if ($manufactureDate) {
                $manufactureDate=substr($manufactureDate, 6,4).'-'.substr($manufactureDate, 3,2).'-'.substr($manufactureDate, 0,2);
            }
            if ($expireDate) {
                $expireDate=substr($expireDate, 6,4).'-'.substr($expireDate, 3,2).'-'.substr($expireDate, 0,2);
            }

            DB::table('cartdetails')->where('cartDetailId', $cartDetailId)
                        ->update([
                            'batch'=>$batch,
                            'manufactureDate'=>$manufactureDate,
                            'expireDate'=>$expireDate,
                            ]);
            // dd($request->all());

            $randomnumber = rand(99,9999);


            if( isset($request->batchPicPath[$cartdetail]) and $request->batchPicPath[$cartdetail]!= null ){
                $file = $request->batchPicPath[$cartdetail];
    
                $file->move('uploads/cart/batch/', $cartDetailId.'_'.$randomnumber.'.'.$file->getClientOriginalExtension());
                DB::table('cartdetails')->where('cartDetailId', $cartDetailId)
                    ->update([
                        'batchPicPath' => '/uploads/cart/batch/'.$cartDetailId.'_'.$randomnumber.'.'.$file->getClientOriginalExtension()
                        ]);
            }


            
        }
        return back()->with('successMsg', 'Successfully saved!');
    }



    public function cartAddTrackingNumber($cartId)
    {
        $trackingData = DB::table('tracking')->where('cartId', $cartId)->first();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $userData = DB::table('users')->where('id', $cartData->customerId)->first();

        if(isset($trackingData ))
        {
            $trackingpicturesData = DB::table('trackingpictures')->where('trackingId', $trackingData->trackingId)->get();
            return view('cart.cartaddtrackingnumber', compact('trackingData' ,'cartData', 'trackingpicturesData', 'userData'));
        }
        return view('cart.cartaddtrackingnumber', compact('trackingData' ,'cartData', 'userData'));
        
    }


    public function cartAddTrackingNumberUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        // dd(substr($request->sendingDate, 6,4).'-'.substr($request->sendingDate, 3,2).'-'.substr($request->sendingDate, 0,2));
        $sendingDate=substr($request->sendingDate, 6,4).'-'.substr($request->sendingDate, 3,2).'-'.substr($request->sendingDate, 0,2);
        DB::table('cart')->where('cartId', $cartId)
        ->update([
            'isTrackingadded'=>1,
            ]);

        $trackingId = '';

        $trackingData = DB::table('tracking')->where('cartId', $cartId)->first();
        
        if (isset($trackingData)) {

            $trackingId = $trackingData->trackingId;
            DB::table('tracking')
            ->where('trackingId', $trackingId)
            ->update([
                    'tracking' => $request->tracking,
                    'trackingCN' => $request->trackingCN,
                    'trackingRU' => $request->trackingRU,
                    'cartId' => $cartId,
                    'sendingDate' => $sendingDate,
            ]);
            
        }
        else{
            DB::table('tracking')->where('cartId', $cartId)->delete();

            DB::table('tracking')->insert([
                    'tracking' => $request->tracking,
                    'trackingCN' => $request->trackingCN,
                    'trackingRU' => $request->trackingRU,
                    'cartId' => $cartId,
                    'sendingDate' => $sendingDate,
            ]);
            $trackingId = DB::getPdo()->lastInsertId();
            
        }
            
        
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();

    
        $files ='';

        if ($request->picPath!=null) 
        {

            DB::table('trackingpictures')->where('trackingId', $trackingId)->delete();

            foreach($request->picPath as $pic=>$v)
            {
                $picPathData=array
                (
                    'trackingId' => $trackingId,
                    // 'picPath'=>$request->picPath[$pic],
                );

                $lastCreatedtrackingPicId = Trackingpictures::create($picPathData)->trackingPicId;
                $randomNumber = rand(99,99999);
                
                $file = $request->picPath[$pic];
                $file->move('uploads/cart/tracking/', 'trackingPicId_'.$lastCreatedtrackingPicId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

                $filePath = '/uploads/cart/tracking/trackingPicId_'.$lastCreatedtrackingPicId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
                $files = $files.'<li><a href="'.url('/').$filePath.'" target="_blank">'.url('/').$filePath.'</a></li>';


                Trackingpictures::find($lastCreatedtrackingPicId)->update(['picPath'=>'/uploads/cart/tracking/'.'trackingPicId_'.$lastCreatedtrackingPicId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]);
            }
        }


        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s tracking information has been added.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s tracking information has been added.',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s tracking information has been added.';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s tracking information has been added.';
        $bodyMessage = $bodyMessage.'<br><br>'.'
                                                <table style="text-align: left;">
                                                    <tr>
                                                        <th>Tracking Message</th>
                                                        <td style="text-align:left;">'.$request->tracking.'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tracking Picture Link</th>
                                                        <td  style="text-align:left;">'. $files .'</td>
                                                    </tr>

                                                    
                                                </table>
                                                ';
                                                

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        // dd($trackingPhoto);

        
        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);

        //========== send mail========

        
        return back()->with('successMsg', 'Successfully Tracking Information Added!');
    }



    public function cartDeliveryInfo($cartId)
    {
        $cartdeliveryinfoData = DB::table('cartdeliveryinfo')->where('cartId', $cartId)->get();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $usersData = DB::table('users')->get();
        $userData = $usersData->where('id', $cartData->customerId)->first();
        return view('cart.cartdeliveryinfo', compact('cartdeliveryinfoData' ,'cartData', 'usersData', 'userData'));
    }


    public function cartDeliveryInfoUpdate(Request $request, $cartId)
    {
        // dd($request->all());
        DB::table('cart')->where('cartId', $cartId)
        ->update([
                'isDeliveryInfoAdded'=>1,
                'isDeliveryConfirmed'=>0,
            ]);

        $files = '';

        if($request->picPath==null)
        {
            $data=array
                (
                    'message' => $request->message,
                    'messageCN' => $request->messageCN,
                    'messageRU' => $request->messageRU,
                    'cartId' => $cartId,
                    'userId' => Auth::user()->id,
                    'isCustomer' => 0,
                );
            Cartdeliveryinfo::create($data);
        }
            
        if ($request->picPath!=null) 
        {
            $batchNumber = DB::table('cartdeliveryinfo')->selectRaw('max(ifnull(batch, 0)) as batchNumber')->pluck('batchNumber')->first();
            $batchNumber += 1 ;
            
            foreach($request->picPath as $pic=>$v)
            {
                $picPathData=array
                (
                    'message' => $request->message,
                    'messageCN' => $request->messageCN,
                    'messageRU' => $request->messageRU,
                    'cartId' => $cartId,
                    'userId' => Auth::user()->id,
                    'isCustomer' => 0,
                    'picPath'=>$request->picPath[$pic],
                );

                // dd($picPathData);
                $lastCreatedcartDeliveryInfoId = Cartdeliveryinfo::create($picPathData)->cartDeliveryInfoId;
                $randomNumber = rand(99,99999);
                
                $file = $picPathData['picPath'];
                $file->move('uploads/cart/cartdeliveryinfo/', 'cartDeliveryInfoId_'.$lastCreatedcartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

                Cartdeliveryinfo::find($lastCreatedcartDeliveryInfoId)->update(['picPath'=>'/uploads/cart/cartdeliveryinfo/'.'cartDeliveryInfoId_'.$lastCreatedcartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]);

                $filePath = '/uploads/cart/cartdeliveryinfo/'.'cartDeliveryInfoId_'.$lastCreatedcartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();

                $files = $files.'<li><a href="'.url('/').$filePath.'" target="_blank">'.url('/').$filePath.'</a></li>';
            }
        }

        $message =  $request->message;


            
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();

        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added.',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added.';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added.';
        $bodyMessage = $bodyMessage.'<br> Delivery Message : '.$message.'<br>'.'Image Links: <br>'.'<ul>'.$files.'</ul>';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        
        return back()->with('successMsg', 'Successfully delivery information has been added!');
    }

    public function casehistoryremindingalarmedit(Request $request)
    {
        $cartId = $request->cartId;
        DB::table('cart')->where('cartId', $cartId)
        ->update([
                'remindingAlarmDate'=>dmyToYmd($request->remindingAlarmDate),
            ]);
        return back()->with('successMsg', 'Successfully reminding alarm updated!');
    }

    public function cartDeliveryConfirm(Request $request)
    {
        // dd($request->all());
        $deliveryCompleteDate=substr($request->deliveryCompleteDate, 6,4).'-'.substr($request->deliveryCompleteDate, 3,2).'-'.substr($request->deliveryCompleteDate, 0,2);
        $remindingAlarmDate=substr($request->remindingAlarmDate, 6,4).'-'.substr($request->remindingAlarmDate, 3,2).'-'.substr($request->remindingAlarmDate, 0,2);

        // dd($deliveryCompleteDate);

        $cartId=$request->cartId;
        DB::table('cart')->where('cartId', $cartId)
        ->update([
                'isDeliveryConfirmed'=>1,
                'isCartComplete'=>1,
                'deliveryCompleteDate'=>$deliveryCompleteDate,
                'specialNote'=>$request->specialNote,
                'remindingAlarmDate'=>$remindingAlarmDate,
            ]);
            
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();

        $customerId = $cartData->customerId;
        $cartCreated_at = $cartData->created_at;


        // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $customerId,
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery complete.',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery complete.',
                'cartId' => $cartId
            ]);
        // ==============Notification for customer============


        //========== send mail========
        // cart details and delivery details
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();
        // cart details and delivery details

        $usersdata = DB::table('users_view')->get();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = $usersdata->where('id', $customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery complete.';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery complete.';
        $bodyMessage = $bodyMessage;

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        
        return redirect(route('cartListAdmin'))->with('successMsg', 'Successfully delivery complete!');
    }
    // =============cart approve  or reject============================
    // =============cart approve  or reject============================



    // =============mail settings======================================
    // =============mail settings======================================
    public function mailsettings()
    {
        $mailData = DB::table('mailsettings')->first();
        $emailbodyData = DB::table('emailbody')->get();

        return view('cart.mailsettings', compact('mailData', 'emailbodyData'));
    }

    public function mailsettingslogodelete()
    {
        DB::table('mailsettings')->where('mailSettingsId', 1)->update([
            'logo' => ''
        ]);

        return back()->with('successMsg', 'Proforma company footer background deleted!');
    }

    public function mailsettingsupdate(Request $request)
    {
        $inputs = $request->all();
        MailSettings::find(1)->update($inputs);

        if(Input::hasFile('logo')){

            // echo 'Uploaded';
            $file = Input::file('logo');
            
            // $imgSize = $file->getSize()/1024;  // byte/1024 = KB

            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/company/', 'companylogoformail-1.'.$file->getClientOriginalExtension());
            MailSettings::find(1)->update(['logo' => '/uploads/company/'.'companylogoformail-1.'.$file->getClientOriginalExtension()]);

            /////////////////////////////////////////
            // compressing image================== //
            /////////////////////////////////////////
            $image = new ImageResize('uploads/company/'.'companylogoformail-1.'.$file->getClientOriginalExtension());

            // include(app_path().'/includes/image_compress_logics.php');
            
            
            // unlink('uploads/company/'.'companylogoformail-1.'.$file->getClientOriginalExtension());
            // $image->save('uploads/company/'.'companylogoformail-1.'.$file->getClientOriginalExtension());

        }

        return back()->with('successMsg', 'Successfully updated!');
    }

    public function emailbodyInsert(Request $request)
    {
        $inputs = $request->all();
        EmailBody::create($inputs);
        return back()->with('successMsg', 'Successfully added!');
    }

    public function emailbodyUpdate(Request $request)
    {
        EmailBody::find($request->emailBodyId)->update($request->all()); 
        return back()->with('successMsg', 'Successfully updated!');
    }

    public function emailbodyDelete($emailBodyId)
    {
        EmailBody::find($emailBodyId)->delete(); 
        return back()->with('successMsg', 'Successfully deleted!');
    }

    

    // =============mail settings======================================
    // =============mail settings======================================



    // proforma invoice settings=============================================================
    // proforma invoice settings=============================================================
    public function proformaInvoiceCompany()
    {
        $proformacompanyData = DB::table('proformacompany_view')->get();
        $proformainvoicecommonsettingsData = DB::table('proformainvoicecommonsettings')->first();
        return view('cart.proformaInvoiceCompany', compact('proformacompanyData', 'proformainvoicecommonsettingsData'));
    }

    public function proformacompanylogoDelete($proformaCompanyId)
    {
        DB::table('proformacompany')->where('proformaCompanyId', $proformaCompanyId)->update([
            'logo' => ''
        ]);

        return back()->with('successMsg', 'Proforma company logo deleted!');
    }

    public function proformacompanysignatureDelete($proformaCompanyId)
    {
        DB::table('proformacompany')->where('proformaCompanyId', $proformaCompanyId)->update([
            'signature' => ''
        ]);

        return back()->with('successMsg', 'Proforma company signature deleted!');
    }

    public function proformacompanysealDelete($proformaCompanyId)
    {
        DB::table('proformacompany')->where('proformaCompanyId', $proformaCompanyId)->update([
            'seal' => ''
        ]);

        return back()->with('successMsg', 'Proforma company seal deleted!');
    }

    public function proformacompanywatermarkLogoDelete($proformaCompanyId)
    {
        DB::table('proformacompany')->where('proformaCompanyId', $proformaCompanyId)->update([
            'watermarkLogo' => ''
        ]);

        return back()->with('successMsg', 'Proforma company watermark Logo deleted!');
    }

    public function proformacompanyfooterBackgroundDelete($proformaCompanyId)
    {
        DB::table('proformacompany')->where('proformaCompanyId', $proformaCompanyId)->update([
            'footerBackground' => ''
        ]);

        return back()->with('successMsg', 'Proforma company footer background deleted!');
    }

    

    public function proformaInvoiceCompanyInsert(Request $request)
    {
        $inputs = $request->all();
        $lastCreatedProformaCompanyId = ProformaCompany::create($inputs)->proformaCompanyId;
        $randomNumber = rand(99,999);

        if(Input::hasFile('logo'))
        {
            $file = Input::file('logo');
            $file->move('uploads/proformainvoice/logo/', 'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($lastCreatedProformaCompanyId)->update(['logo' => '/uploads/proformainvoice/logo/'.'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }
        if(Input::hasFile('signature'))
        {
            $file = Input::file('signature');
            $file->move('uploads/proformainvoice/signature/', 'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($lastCreatedProformaCompanyId)->update(['signature' => '/uploads/proformainvoice/signature/'.'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }
        if(Input::hasFile('seal'))
        {
            $file = Input::file('seal');
            $file->move('uploads/proformainvoice/seal/', 'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($lastCreatedProformaCompanyId)->update(['seal' => '/uploads/proformainvoice/seal/'.'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }

        if(Input::hasFile('watermarkLogo'))
        {
            $file = Input::file('watermarkLogo');
            $file->move('uploads/proformainvoice/watermarkLogo/', 'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($lastCreatedProformaCompanyId)->update(['watermarkLogo' => '/uploads/proformainvoice/watermarkLogo/'.'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }

        if(Input::hasFile('footerBackground'))
        {
            $file = Input::file('footerBackground');
            $file->move('uploads/proformainvoice/footerBackground/', 'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($lastCreatedProformaCompanyId)->update(['footerBackground' => '/uploads/proformainvoice/footerBackground/'.'ProformaCompanyId-'.$lastCreatedProformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }

        return back()->with('successMsg', 'New proforma company successfully added!');
    }

    public function proformaInvoiceCompanyUpdate(Request $request)
    {
        ProformaCompany::find($request->proformaCompanyId)->update($request->all());  
        $proformaCompanyId = $request->proformaCompanyId;
        $randomNumber = rand(99,999);

        if(Input::hasFile('logo'))
        {
            $file = Input::file('logo');
            $file->move('uploads/proformainvoice/logo/', 'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($proformaCompanyId)->update(['logo' => '/uploads/proformainvoice/logo/'.'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }
        if(Input::hasFile('signature'))
        {
            $file = Input::file('signature');
            $file->move('uploads/proformainvoice/signature/', 'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($proformaCompanyId)->update(['signature' => '/uploads/proformainvoice/signature/'.'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }
        if(Input::hasFile('seal'))
        {
            $file = Input::file('seal');
            $file->move('uploads/proformainvoice/seal/', 'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($proformaCompanyId)->update(['seal' => '/uploads/proformainvoice/seal/'.'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }

        if(Input::hasFile('watermarkLogo'))
        {
            $file = Input::file('watermarkLogo');
            $file->move('uploads/proformainvoice/watermarkLogo/', 'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($proformaCompanyId)->update(['watermarkLogo' => '/uploads/proformainvoice/watermarkLogo/'.'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }
        if(Input::hasFile('footerBackground'))
        {
            $file = Input::file('footerBackground');
            $file->move('uploads/proformainvoice/footerBackground/', 'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            ProformaCompany::find($proformaCompanyId)->update(['footerBackground' => '/uploads/proformainvoice/footerBackground/'.'ProformaCompanyId-'.$proformaCompanyId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]); 
        }

        return back()->with('successMsg', 'Proforma company Successfully Updated!');
    }


    public function proformaInvoiceCompanyDelete($proformaCompanyId)
    {
        $proformacompanyData = DB::table('ProformaCompany')->where('proformaCompanyId',$proformaCompanyId)->first();
        $logo =  $proformacompanyData->logo;
        $signature =  $proformacompanyData->signature;
        $seal =  $proformacompanyData->seal;
        $footerBackground =  $proformacompanyData->footerBackground;
        $watermarkLogo =  $proformacompanyData->watermarkLogo;
        try {
            if (!($logo==null)) 
            {
                unlink($logo);  // delete from storage/public
            }
            if (!($signature==null)) 
            {
                unlink($signature);  // delete from storage/public
            }
            if (!($seal==null)) 
            {
                unlink($seal);  // delete from storage/public
            }
            if (!($footerBackground==null)) 
            {
                unlink($footerBackground);  // delete from storage/public
            }
            if (!($watermarkLogo==null)) 
            {
                unlink($watermarkLogo);  // delete from storage/public
            }
        } catch (\Throwable $th) {
        }

        ProformaCompany::where('proformaCompanyId',$proformaCompanyId)->delete();
        return back()->with('successMsg', 'Proforma company successfully deleted!');
    }


    public function proformaInvoiceCommonSettingsSave(Request $request)
    {
        ProformaInvoiceCommonSettings::find(1)->update($request->all());  
        return back()->with('successMsg', 'Proforma invoice common settings Successfully saved!');
    }

    // proforma invoice settings=============================================================
    // proforma invoice settings=============================================================


    public function customerOrderProformaInvociePrint($language='en', $cartId)
    {
        $cartId =  Crypt::decrypt($cartId);

        // dd(Crypt::decrypt($cartId));
        
        $cartapprovesData = DB::table('cartapproves_view')->where('cartId', $cartId)->first();

        // dd($cartapprovesData);
        
        $proformacompanyData = DB::table('proformacompany')->where('proformaCompanyId', $cartapprovesData->proformaCompanyId)->first();
        $proformainvoicecommonsettingsData = DB::table('proformainvoicecommonsettings')->first();
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $countryData = DB::table('country')->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $genericbrandData = DB::table('genericbrand_view')->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();

        
        // number to word
        $ntw = new \NTWIndia\NTWIndia();
        $ntw = ($ntw->numToWord( (int) $cartData->totalAmount )).' Only.';

        $pdf = PDF::loadView('reports.pdf.customerOrderProformaInvociePrint', compact('cartapprovesData', 'proformacompanyData', 'proformainvoicecommonsettingsData', 'cartData', 'countryData', 'cartdetailsData', 'genericbrandData', 'genericpacksizes_with_customer_price_Data', 'ntw') );
        
        // $pdf = PDF::loadView('reports.pdf.customerOrderProformaInvociePrint', compact('cartapprovesData', 'proformacompanyData', 'proformainvoicecommonsettingsData', 'cartData', 'countryData', 'cartdetailsData', 'genericbrandData', 'genericpacksizes_with_customer_price_Data', 'ntw') );
        return $pdf->stream('MFW_Proforma_Invoice_'.process_order_number($cartData->cartId, $cartData->created_at).' ('.now().').pdf');
    }

   
    public function dynamicproformainvoice($language, $cartId)
    {
        return self::customerOrderProformaInvociePrint($language, Crypt::encrypt($cartId));  
    }




    public function customerOrderInvociePrint($language, $cartId)
    {
        $cartId = Crypt::decrypt($cartId);
        
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartapprovesData = DB::table('cartapproves_view')->where('cartId', $cartId)->first();
        $proformacompanyData = DB::table('proformacompany')->where('proformaCompanyId', $cartData->paymentConfirmCompanyId)->first();
        $invoicecommonsettingsData = DB::table('invoicecommonsettings')->first();
        $proformainvoicecommonsettingsData = DB::table('proformainvoicecommonsettings')->first();

        $countryData = DB::table('country')->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $genericbrandData = DB::table('genericbrand_view')->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();

        
        // number to word
        $ntw = new \NTWIndia\NTWIndia();
        $ntw = ($ntw->numToWord( (int) $cartData->totalAmount )).' Only.';
        
        
        $pdf = PDF::loadView('reports.pdf.customerOrderInvociePrint', compact('cartapprovesData', 'proformacompanyData', 'invoicecommonsettingsData', 'cartData', 'countryData', 'cartdetailsData', 'genericbrandData', 'genericpacksizes_with_customer_price_Data', 'ntw', 'proformainvoicecommonsettingsData') );
        return $pdf->stream('MFW_Invoice_'.process_order_number($cartData->cartId, $cartData->created_at).' ('.now().').pdf');
    }

    
    public function dynamicinvoice($language, $cartId)
    {
        return self::customerOrderInvociePrint($language, Crypt::encrypt($cartId));  
    }


    public function fakeInvociePrint($language, $cartId)
    {
        $cartId = Crypt::decrypt($cartId);
        
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartapprovesData = DB::table('cartapproves_view')->where('cartId', $cartId)->first();
        $proformacompanyData = DB::table('proformacompany')->where('proformaCompanyId', $cartData->duplicateInvoiceCompanyId)->first();
        // dd($cartData->duplicateInvoiceCompanyId);
        $invoicecommonsettingsData = DB::table('invoicecommonsettings')->first();
        $proformainvoicecommonsettingsData = DB::table('proformainvoicecommonsettings')->first();

        $countryData = DB::table('country')->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $totalFakeAmount = $cartdetailsData->sum('fakeSubAmount');
        $genericbrandData = DB::table('genericbrand_view')->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $cartData->customerId)->get();

        
        // number to word
        $ntw = new \NTWIndia\NTWIndia();
        $ntw = ($ntw->numToWord( (int) $totalFakeAmount )).' Only.';
        
        
        $pdf = PDF::loadView('reports.pdf.fakeInvociePrint', compact('cartapprovesData', 'proformacompanyData', 'invoicecommonsettingsData', 'cartData', 'countryData', 'cartdetailsData', 'genericbrandData', 'genericpacksizes_with_customer_price_Data', 'ntw', 'proformainvoicecommonsettingsData', 'totalFakeAmount') );
        return $pdf->stream('MFW_Invoice_'.process_order_number($cartData->cartId, $cartData->created_at).' ('.now().').pdf');
    }

    public function dynamicfakeInvociePrint($language, $cartId)
    {
        return self::fakeInvociePrint($language, Crypt::encrypt($cartId));  
    }

    public function invoiceShowing($cartId)
    {
        DB::table('cart')->where('cartId', $cartId)->update(['isInvoiceVisible' => 1]);  
        return back()->with('cartId', $cartId);
    }

    public function invoiceHiding($cartId)
    {
        DB::table('cart')->where('cartId', $cartId)->update(['isInvoiceVisible' => 0]);  
        return back()->with('cartId', $cartId);
    }



    public function proformaInvoiceShowing($cartId)
    {
        DB::table('cartapproves')->where('cartId', $cartId)->update(['isProformaInvoiceVisible' => 1]);  
        return back()->with('cartId', $cartId);
    }

    public function proformaInvoiceHiding($cartId)
    {
        DB::table('cartapproves')->where('cartId', $cartId)->update(['isProformaInvoiceVisible' => 0]);  
        return back()->with('cartId', $cartId);
    }


    



    //  invoice common settings==========
    //  invoice common settings==========
    public function invoiceCommonSettings()
    {
        $invoicecommonsettingsData = DB::table('invoicecommonsettings')->first();
        return view('cart.invoicesettings', compact( 'invoicecommonsettingsData'));
    }

    public function invoiceCommonSettingsSave(Request $request)
    {
        InvoiceCommonSettings::find(1)->update($request->all());    

        return back()->with('successMsg', 'Invoice common settings Successfully saved!');
    }
    //  invoice common settings==========
    //  invoice common settings==========


    //  invoice common settings==========
    //  invoice common settings==========

    public function createmanualcartcustomerRegistrationSave(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|min:4|max:11|unique_with:users,phoneCode',
            ],
            [ 
                'phone.unique_with' => 'Same phone already exist!',
            ]

        );
        // dd($request->all());
        $inputs = $request->except('photoPath');
        // dd($inputs);
        $lastCreatedUserId = User::create($inputs)->id;
        // UserRoles::create([
        //     'userId'=>$lastCreatedUserId,
             // 'roleId'=>3  // 3 = customer role
        // ]);

        User::find($lastCreatedUserId)->update([
            'manualUserPass' => $request->password,
            'isEmailVerified' => 1
        ]);

        return back()->with('successMsg', 'User successfully added!');
    }

    public function createmanualcart()
    {
        $countryData= DB::table('country')->get();
        $usersData= DB::table('users_view')->get();
        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->get();
        $deliverypriceData = DB::table('deliveryprice_view')->get();

        return view('cart.createmanualcart', compact('countryData', 'usersData', 'genericpacksizes_with_customer_price_data', 'deliverypriceData'));
    }


    public function createmanualcartsave(Request $request)
    {
        // dd($request->all());
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliveryMethodId = $request->deliveryMethodId;
        $paymentMethodId = $request->paymentMethodId;

        $countryId=$request->countryId;

        $paymentprice_data = DB::table('paymentprice_view')->where("paymentMethodId", $paymentMethodId)->where("countryId", $countryId)->first();
        $transactionFee =  $paymentprice_data->transactionFee;

        
        $inputs = $request->except(['genericPackSizeId', 'genericBrandId', 'price', 'discount', 'moq', 'qty', 'subTotal', 'subTotalWtihDiscount']);
        $lastCreatedCartId = Cart::create($inputs)->cartId;

        foreach($request->genericPackSizeId as $genericPackSizeIds=>$v)
        {
            $cartId = $lastCreatedCartId;
            $genericPackSizeId = $request->genericPackSizeId[$genericPackSizeIds];
            $qty = $request->qty[$genericPackSizeIds];
            $price = $request->price[$genericPackSizeIds];
            $discount = $request->discount[$genericPackSizeIds];
            $subTotal = $request->subTotal[$genericPackSizeIds];
            $subTotalWtihDiscount = $request->subTotalWtihDiscount[$genericPackSizeIds];
            $genericBrandId = $request->genericBrandId[$genericPackSizeIds];
            DB::table('cartdetails')->insert(
            [
                'customerId'=>$request->customerId,
                'cartId'=>$cartId,
                'genericPackSizeId'=>$genericPackSizeId,
                'qty'=>$qty,
                'price'=>$price,
                'discount'=>$discount,
                'subTotal'=>$subTotal,
                'subTotalWtihDiscount'=>$subTotalWtihDiscount,
                'genericBrandId'=>$genericBrandId,
            ]);
        }



        $cartId = $lastCreatedCartId;
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();

        $usdToCurrencyRate = $countryData->where('currency', $cartData->currency)->pluck('usdToCurrencyRate')->first();

        // for specific cart's cartdetails
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $cartId)->get();
        $sumQty = $cartdetailsData->sum('qty');
        $discountTotal = $cartdetailsData->sum('discountTotal') * $usdToCurrencyRate  ;
        $cartWeightGM = $cartdetailsData->sum('weightGMSubTotal');
        $cartsubtotalwithdiscount = $cartdetailsData->sum('cartsubtotalwithdiscount') * $usdToCurrencyRate ;
        $cartsubtotalwithoutdiscount = $cartdetailsData->sum('subtotal') * $usdToCurrencyRate ;

        $deliveryprice_data = DB::table('deliveryprice_view')->where("deliveryMethodId", $deliveryMethodId)->where("countryId", $countryId)->first();
        $deliveryPriceInitial = $deliveryprice_data->deliveryPriceInitial ;
        $deliveryPriceIncrement = $deliveryprice_data->deliveryPriceIncrement ;


         $shippingCost=0;
                if ($cartWeightGM<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeightGM/1000);
                }

                $shippingCost = $shippingCost * $usdToCurrencyRate;

        // check offer is applicable for customer and remove transaction fee
                $offerData = DB::table('offer')->where('offerId', 1)->first();
                $offerMinAmount = $offerData->minAmount;

                if ( $cartsubtotalwithdiscount  >= $offerMinAmount * $usdToCurrencyRate) 
                {
                    $cartTotal = $cartsubtotalwithdiscount; 
                    $shippingCost =  0;
                    $offer = $offerData->offer;
                }
                else 
                {
                    $cartTotal = $cartsubtotalwithdiscount + $shippingCost; 
                    $offer= '';
                }

        // check offer is applicable for customer and remove transaction fee

                // after payment method==========
                $transactionFeeAmount = ( (($transactionFee )/100) * $cartTotal ) ;
                $cartTotal = $cartTotal + $transactionFeeAmount;


        $totalProducts = $cartdetailsData->count('qty');

        DB::table('cart')
            ->where('cartId', $cartId)
            ->update(
                [
                    'discount' => $discountTotal, 
                    'subTotalAmount' => $cartsubtotalwithoutdiscount, 
                    'totalQty' => $sumQty, 
                    'cartWeightGM' => $cartWeightGM, 
                    'shippingAmount' => $shippingCost, 
                    'offer' => $offer,
                    'transactionFeeAmount' => $transactionFeeAmount, 
                    'totalAmount' => $cartTotal,

                    'usdToCurrencyRate' => $usdToCurrencyRate,
                    'deliveryPriceInitial' => $deliveryPriceInitial,
                    'deliveryPriceIncrement' => $deliveryPriceIncrement,
                    'transactionFee' => $transactionFee,
                    'totalProducts' => $totalProducts,


                ]
            ); 

        // dd($request->all());

        

        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'cartId' => $lastCreatedCartId, 
                'cartCreatedById' => $request->customerId, 
                'isCartUpdated' => 0,
                'message' => 'A order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created!',
                'message2' => 'A order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created! We will update you here soon. You can check your mail also for getting updates.',
            ],
        ]);
        // notifications_admin=============

        // notifications_customer=============
        DB::table('notifications')->insert([
            [
                'cartId' => $lastCreatedCartId, 
                'receiverId' => $request->customerId, 
                'message' => 'Your order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created!',
                'message2' => 'Your order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created! We will update you here soon. You can check your mail also for getting updates.',
            ],
        ]);


        
        // notifications_customer=============
        // =========================notifications=======================

        //========== send mail========

        
        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $lastCreatedCartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('cartId', $lastCreatedCartId)->get();
        
        $deliverymethodsData =  DB::table('deliverymethod')->get();
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $request->customerId)->get();
        // cart details and delivery details
        


        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = Auth::user()->email;
        $mailReceiverName = $request->takingFor;
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created!';
        $bodyMessage = 'Your order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created! We will update you here soon. You can check your profile also for getting updates.';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        return back()->with('message', 'Successfully order placed!')->with('orderId', $lastCreatedCartId);
    }



    // ajax data retrieving==========
    public function getGenericPackSizesUsingCustomerId($customerId)
    {
        $genericpacksizesData = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $customerId)->get();
        $response = ["genericpacksizesData" => $genericpacksizesData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }
    

   
    //  invoice common settings==========
    //  invoice common settings==========


}
