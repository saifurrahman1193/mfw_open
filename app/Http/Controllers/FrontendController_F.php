<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\CustomerGenericPrices;
use App\MainSliders;
use App\Slider_New_Selling_Products;
use App\Slider_Best_Selling_Products;
use App\Menu_Categories_F;
use App\Testimonial;
use App\Country;
use App\TopBrands;
use App\Banner;
use App\Review;
use App\SEODefault;
use Auth;




use \Input as Input;




class FrontendController_F extends Controller
{


    // ==============Assign product prices================
    // ==============Assign product prices================

    // loads users only=========
    public function productPricesForUsers()
    {
        $usersData = DB::table('users')->get();
        return view('frontend.productPricesForUsers', compact('usersData'));
    }

    // load price setup page=================
    public function productPricesForUsersAssign($userId)
    {
        $usersData = DB::table('users_view')->where('id', $userId)->first();
        $genericbrandData = DB::table('genericbrand_view')->get();

        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', $userId)->get();
        $sppliergenericprices_data = DB::table('sppliergenericprices_view')->get();

        $usergenericinquiryData = DB::table('usergenericinquiry_view')->where('inquirerId', $userId)->get();

        return view('frontend.productPricesForUsersAssign', compact('usersData', 'genericbrandData', 'genericpacksizes_with_customer_price_data', 'usergenericinquiryData', 'sppliergenericprices_data'));
    }


    // ajax data retrieving==========
    public function getGenericPackSizes($genericBrandId)
    {
        $genericpacksizesData = DB::table('genericpacksizes_view')->where('genericBrandId', $genericBrandId)->get();
        $response = ["genericpacksizesData" => $genericpacksizesData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);

    }




    // price stup function=======*******======
    public function customerPriceSetup(Request $request, $userId)
    {

        $genericpacksizesData = DB::table('genericpacksizes_view')->get();

        // 1. delete the pictures first==============
        CustomerGenericPrices::where('customerId', $userId)->delete();

        // dd($genericpacksizesData);

        // 3. update disease category
        // generic brand disease categories update============
        if ($request->genericPackSizeId!=null) 
        {
            foreach($request->genericPackSizeId as $genericPackSizeIds=>$v)
            {
                $genericPackSizeIdsData=array
                (
                    'customerId'=>$userId,
                    'genericPackSizeId'=>$request->genericPackSizeId[$genericPackSizeIds],
                    'price'=>$request->price[$genericPackSizeIds],
                    'moq'=>$request->moq[$genericPackSizeIds],
                    'discount'=>$request->discount[$genericPackSizeIds],


                    // 'discount'=>$request->discount,


                );

                // dd($genericPackSizeIdsData);
                // dd($genericPackSizeIdsData['price']);
                // dd($genericPackSizeIdsData['discount']);
                CustomerGenericPrices::insert($genericPackSizeIdsData);

                // update cart details for sepecific customer
                    DB::table('cartdetails')
                    ->where('cartId', null)
                    ->where('genericPackSizeId', $genericPackSizeIdsData['genericPackSizeId'] )
                    ->where('customerId', $userId )
                    ->update(
                        [
                            'price' => $genericPackSizeIdsData['price'],
                            'discount' => $genericPackSizeIdsData['discount'],
                        ]
                    ); 
                // update cart details for sepecific customer


                // notify thread========
                // auth()->user()->notify(new PriceInquiryRequestApproval);

                DB::table('notifications')->insert([
                    [
                        'receiverId' => $userId, 
                        'genericBrandId' => $genericpacksizesData->where('genericPackSizeId', $request->genericPackSizeId[$genericPackSizeIds])->pluck('genericBrandId')->first(), 
                        'message' => 'Price has been set for product '.$genericpacksizesData->where('genericPackSizeId', $request->genericPackSizeId[$genericPackSizeIds])->pluck('genericBrand')->first()
                    ],
                ]);
                // notify thread========


            }
        }


        return back()->with('successMsg', 'Generic price successfully assigned to the customer!');
    }


    public function customerPriceSetupAdd(Request $request, $userId)
    {

        CustomerGenericPrices::where('genericPackSizeId', $request->genericPackSizeId)->where('customerId', $userId)->delete();

        CustomerGenericPrices::insert([
            'customerId'=>$userId,
            'genericPackSizeId'=>$request->genericPackSizeId,
            'price'=>$request->price,
            'moq'=>$request->moq,
            'discount'=>$request->discount,
        ]);

        DB::table('cartdetails')
        ->where('customerId', $userId )
        ->whereNull('cartId')
        ->where('genericPackSizeId', $request->genericPackSizeId )
        ->update(
            [
                'price' => $request->price,
                'discount' => $request->discount,
            ]
        ); 

        // cause after assigned product user assigned product pack
        $genericpacksizeData = DB::table('genericpacksizes_with_customer_price_view')->where('genericPackSizeId', $request->genericPackSizeId)->where('customerId', $userId)->first();
        $userData = DB::table('users_view')->where('id', $userId)->first();

        $product = $genericpacksizeData->genericBrand.' ('.$genericpacksizeData->genericName.' '.$genericpacksizeData->genericStrength.'), '.$genericpacksizeData->genericPackSize.'\'s '.$genericpacksizeData->packType.' | '.$genericpacksizeData->dosageForm.' | '.$genericpacksizeData->genericCompany;

        DB::table('notifications')->insert([
            [
                'receiverId' => $userId, 
                'genericBrandId' => $genericpacksizeData->genericBrandId, 
                'message' => 'A '.$product.' price has been added.',
                'message2' => 'A '.$product.' price has been added.'
            ],
        ]);

        DB::table('notifications_admin')->insert([
                'priceAddUpdateDeletedForUserId' => $userId, 
                'message' => $userData->email.' price has been added for '.$product,
                'message2' => $userData->email.' price has been added for '.$product,
        ]);



        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $userId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $userId)->pluck('name')->first();
        
        $subject = $mailReceiverName.'\'s price inquire for '.$product;
		$bodyMessage = 'Your inquired price has been given below:'.'<br><br>'
										.'Generic Brand: '.$genericpacksizeData->genericBrand .'<br>'
										.'Generic Name: '.$genericpacksizeData->genericName .'<br>'
										.'Generic Company: '.$genericpacksizeData->genericCompany .'<br>'
										.'Dosage Form: '.$genericpacksizeData->dosageForm .'<br>'
										.'Generic Strength: '.$genericpacksizeData->genericStrength .'<br>'
										.'Pack Size: '.$genericpacksizeData->genericPackSize .'<br>'
										.'Pack Type: '.$genericpacksizeData->packType .'<br>'
										.'Offer Price: USD '.$genericpacksizeData->customerPrice .'<br>'
										.'Discount: USD '.$genericpacksizeData->discount .'<br>'
										.'Min Quantity: '.$genericpacksizeData->moq .'<br>'
										.'Availability: '.$genericpacksizeData->availabilityType.
                                        '<br><br><p style="text-align: justify;">For order, please go to your profile and add to cart. Or contact us through email/ WhatsApp/ Wechat/ other media to provide order manually.</p>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
		// =================mail sending=============



       
        return back()->with('successMsg', 'Generic price successfully assigned to the customer!');
    }

    public function customerPriceSetupUpdate(Request $request, $userId, $genericPackSizeId, $price, $moq, $discount)
    {

        // CustomerGenericPrices::where('genericPackSizeId', $genericPackSizeId)->where('customerId', $userId)->delete();

        CustomerGenericPrices::where('genericPackSizeId', $genericPackSizeId)->where('customerId', $userId)
        ->update([
            'customerId'=>$userId,
            'genericPackSizeId'=>$genericPackSizeId,
            'price'=>$price,
            'moq'=>$moq,
            'discount'=>$discount,
        ]);

        // get rejected orders
        $rejectedOrders = DB::table('cart')->where('customerId', $userId )->where('isCartApproved', 3)->pluck('cartId')->toArray();
        $rejectedOrders= array_merge($rejectedOrders, [null]);
        // dd($rejectedOrders);


        DB::table('cartdetails')
        ->where('customerId', $userId )
        ->whereIn('cartId', $rejectedOrders)
        ->where('genericPackSizeId', $genericPackSizeId )
        ->update(
            [
                'price' => $price,
                'discount' => $discount,
            ]
        ); 
        

        $genericpacksizeData = DB::table('genericpacksizes_with_customer_price_view')->where('genericPackSizeId', $genericPackSizeId)->where('customerId', $userId)->first();
        $userData = DB::table('users_view')->where('id', $userId)->first();

        $product = $genericpacksizeData->genericBrand.' ('.$genericpacksizeData->genericName.' '.$genericpacksizeData->genericStrength.'), '.$genericpacksizeData->genericPackSize.'\'s '.$genericpacksizeData->packType.' | '.$genericpacksizeData->dosageForm.' | '.$genericpacksizeData->genericCompany;

        DB::table('notifications')->insert([
            [
                'receiverId' => $userId, 
                'genericBrandId' => $genericpacksizeData->genericBrandId, 
                'message' => 'A '.$product.' price has been updated.',
                'message2' => 'A '.$product.' price has been updated.'
            ],
        ]);

        DB::table('notifications_admin')->insert([
                'priceAddUpdateDeletedForUserId' => $userId, 
                'message' => $userData->email.' price has been updated for '.$product,
                'message2' => $userData->email.' price has been updated for '.$product,
        ]);


        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $userId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $userId)->pluck('name')->first();
        
        $subject = $mailReceiverName.'\'s price has been updated for '.$product;
		$bodyMessage = 'Your updated price has been given below:'.'<br><br>'
										.'Generic Brand: '.$genericpacksizeData->genericBrand .'<br>'
										.'Generic Name: '.$genericpacksizeData->genericName .'<br>'
										.'Generic Company: '.$genericpacksizeData->genericCompany .'<br>'
										.'Dosage Form: '.$genericpacksizeData->dosageForm .'<br>'
										.'Generic Strength: '.$genericpacksizeData->genericStrength .'<br>'
										.'Pack Size: '.$genericpacksizeData->genericPackSize .'<br>'
										.'Pack Type: '.$genericpacksizeData->packType .'<br>'
										.'Offer Price: USD '.$genericpacksizeData->customerPrice .'<br>'
										.'Discount: USD '.$genericpacksizeData->discount .'<br>'
										.'Min Quantity: '.$genericpacksizeData->moq .'<br>'
										.'Availability: '.$genericpacksizeData->availabilityType. '<br>'
                                        . '<br>'
                                        . 'For order, please go to your profile and add to cart. Or contact us through email/ WhatsApp/ Wechat/ other media to provide order manually.';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============
        
       
        return back()->with('successMsg', 'Generic price successfully assigned to the customer!');
    }


    public function customerPriceSetupDelete(Request $request, $userId, $genericPackSizeId)
    {
        CustomerGenericPrices::where('genericPackSizeId', $genericPackSizeId)->where('customerId', $userId)->delete();

        DB::table('cartdetails')
        ->where('customerId', $userId )
        ->where('cartId', null)
        ->where('genericPackSizeId', $genericPackSizeId )
        ->delete(); 

        $genericpacksizeData = DB::table('genericpacksizes_view')->where('genericPackSizeId', $genericPackSizeId)->first();
        $userData = DB::table('users_view')->where('id', $userId)->first();

        $product = $genericpacksizeData->genericBrand.' ('.$genericpacksizeData->genericName.' '.$genericpacksizeData->genericStrength.'), '.$genericpacksizeData->genericPackSize.'\'s '.$genericpacksizeData->packType.' | '.$genericpacksizeData->dosageForm.' | '.$genericpacksizeData->genericCompany;

        DB::table('notifications')->insert([
            [
                'receiverId' => $userId, 
                'genericBrandId' => $genericpacksizeData->genericBrandId, 
                'message' => 'A '.$product.' price has been deleted.',
                'message2' => 'A '.$product.' price has been deleted.'
            ],
        ]);

        DB::table('notifications_admin')->insert([
                'priceAddUpdateDeletedForUserId' => $userId, 
                'message' => $userData->email.' price has been deleted for '.$product,
                'message2' => $userData->email.' price has been deleted for '.$product,
        ]);



        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $userId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $userId)->pluck('name')->first();
        
        $subject = $mailReceiverName.'\'s price has been deleted for '.$product;
		$bodyMessage = 'Your price has been deleted for '.$product;
										
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============
        

       
        return back()->with('successMsg', 'Generic price successfully assigned to the customer!');
    }


    // ==============Assign product prices================
    // ==============Assign product prices================


    // =====================customer=====================
    public function customerReviews()
    {
        $reviewData = DB::table('reviews_view')->get();
        $genericbrandpicData = DB::table('genericbrandpic')->select('genericBrandPicId', 'genericBrandId', 'picPath')->get();

        if(request()->has('reviewId') and request('reviewId')!=null)
        {
            DB::table('notifications_admin')->where('reviewId', request('reviewId'))->update(['read_at' => now()] );
            $reviewData = $reviewData->where('reviewId', request('reviewId'));
        }
        return view('customers.reviewapprovals', compact('reviewData', 'genericbrandpicData'));
    }

    public function customerReviewApprove($reviewId)
    {
        Review::where('reviewId', $reviewId)->update(['isApproved' => 1]);

        // ==============Notification for customer===========

            $reviewData = DB::table('reviews_view')->where('reviewId', $reviewId)->first();
            $reviewerId = $reviewData->reviewerId;
            $genericBrandId = $reviewData->genericBrandId;
            $genericBrand = $reviewData->genericBrand;

            DB::table('notifications')->insert([
                'receiverId' => $reviewerId,
                'reviewId' => $reviewId,
                'genericBrandId' => $genericBrandId,
                'message' => 'Your review for '.$genericBrand.' has been approved ',
                'message2' => 'Your review for '.$genericBrand.' has been approved ',
            ]);
        // ==============Notification for customer============

        $genericbrandData = DB::table('genericbrand_view')->where('genericBrandId', $genericBrandId)->first();
        $product = $genericbrandData->genericBrand.' ('.$genericbrandData->genericName.') | '.$genericbrandData->genericCompany;

        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $reviewData->email;
        $mailReceiverName = $reviewData->name;
        
        $subject = $mailReceiverName.'\'s submitted review for '.$product.' has been approved.';
        $bodyMessage = 'You submitted review for '.$product.' has been approved.';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============


        return back()->with('successMsg', 'Customer Review successfully approved!');
    }

    public function customerReviewDisapprove($reviewId)
    {
        Review::where('reviewId', $reviewId)->update(['isApproved' => 0]);

        // ==============Notification for customer===========

            $reviewData = DB::table('reviews_view')->where('reviewId', $reviewId)->first();
            $reviewerId = $reviewData->reviewerId;
            $genericBrandId = $reviewData->genericBrandId;
            $genericBrand = $reviewData->genericBrand;

            DB::table('notifications')->insert([
                'receiverId' => $reviewerId,
                'reviewId' => $reviewId,
                'genericBrandId' => $genericBrandId,
                'message' => 'Your review for '.$genericBrand.' has been disapproved ',
                'message2' => 'Your review for '.$genericBrand.' has been disapproved ',
            ]);
        // ==============Notification for customer============

        $genericbrandData = DB::table('genericbrand_view')->where('genericBrandId', $genericBrandId)->first();
        $product = $genericbrandData->genericBrand.' ('.$genericbrandData->genericName.') | '.$genericbrandData->genericCompany;

        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $reviewData->email;
        $mailReceiverName = $reviewData->name;
        
        $subject = $mailReceiverName.'\'s submitted review for '.$product.' has been disapproved.';
        $bodyMessage = 'You submitted review for '.$product.' has been disapproved.';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2_1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============


        return back()->with('successMsg', 'Customer Review successfully disapprove!');
    }
    public function customerReviewDelete($reviewId)
    {
        Review::find($reviewId)->delete();
        return back()->with('successMsg', 'Customer Review successfully deleted!');
    }

    public function customercommenteditfromadmin(Request $request)
    {
        Review::find($request->reviewId)->update([
            'comment' => $request->comment
        ]);
        return back()->with('successMsg', 'Customer comment successfully updated!');
    }
    // =====================customer=====================







    // main slider=============================================================
    // main slider=============================================================
    // main slider=============================================================
    public function main_slider_Index()
    {
        $mainslidersData = DB::table('mainsliders')->get();
        return view('frontend.main_slider', compact('mainslidersData'));
    }

    public function main_sliderInsert(Request $request)
    {

        $this->validate($request, [
          'photoPath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
         ]);


        $inputs = $request->all();
        $lastCreatedSliderId = MainSliders::create($inputs)->mainsliderId;

        if(Input::hasFile('photoPath'))
        {
            // echo 'Uploaded';
            $file = Input::file('photoPath');
            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/mainsliders/', 'mainsliderId-'.$lastCreatedSliderId.'.'.$file->getClientOriginalExtension());
            MainSliders::find($lastCreatedSliderId)->update(['photoPath' => '/uploads/mainsliders/'.'mainsliderId-'.$lastCreatedSliderId.'.'.$file->getClientOriginalExtension()]); 
        }

        return back()->with('successMsg', 'New slider successfully added!');
    }

    public function main_sliderUpdate(Request $request)
    {
        $this->validate($request, [
          'photoPath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
         ]);

        MainSliders::where('mainsliderId', $request->mainsliderId)->update($request->except(['_token','_method']));  

        if(Input::hasFile('photoPath'))
        {

            $file = Input::file('photoPath');
            $file->move('uploads/mainsliders/', 'mainsliderId-'.$request->mainsliderId.'.'.$file->getClientOriginalExtension());

            MainSliders::where('mainsliderId', $request->mainsliderId)->update(['photoPath'  => '/uploads/mainsliders/'.'mainsliderId-'.$request->mainsliderId.'.'.$file->getClientOriginalExtension()]);
        }

        return back()->with('successMsg', 'Slider Successfully Updated!');
    }


    public function main_sliderDelete($mainsliderId)
    {
        $imageName =  DB::table('mainsliders')->where('mainsliderId',$mainsliderId)->pluck('photoPath')->first();
        if (!($imageName==null)) 
        {
           try {
            unlink($imageName);  // delete from storage/public
           } catch (\Throwable $th) {
               //throw $th;
           }
        }

        MainSliders::where('mainsliderId',$mainsliderId)->delete();
        return back()->with('successMsg', 'Slider successfully deleted!');
    }

    // main slider=============================================================
    // main slider=============================================================
    // main slider=============================================================









    // new selling products slider for home page=============================================================
    // new selling products slider for home page=============================================================
    // new selling products slider for home page=============================================================
    public function new_products_slider_index()
    {
        $slider_new_selling_products_data = DB::table('slider_new_selling_products_view')->get();
        $genericbrand_data = DB::table('genericbrand_view')->get();
        $genericbrandpicData = DB::table('genericbrandpic')->select('genericBrandPicId', 'genericBrandId', 'picPath')->get();
        return view('frontend.new_products_slider', compact('slider_new_selling_products_data', 'genericbrand_data', 'genericbrandpicData'));
    }

    public function new_products_slider_insert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'genericBrandId' => 'required|unique:slider_new_selling_products'
            ],
            [  
                'genericBrandId.unique' => 'Duplicate record already exist!',
            ]
        );


        $inputs = $request->all();
        Slider_New_Selling_Products::create($inputs);

        return back()->with('successMsg', 'New product successfully added!');
    }

    public function new_products_slider_delete($slider_new_selling_product_id)
    {
        Slider_New_Selling_Products::where('slider_new_selling_product_id',$slider_new_selling_product_id)->delete();
        return back()->with('successMsg', 'Slider New Product successfully deleted!');
    }

    

    // new selling products slider for home page=============================================================
    // new selling products slider for home page=============================================================
    // new selling products slider for home page=============================================================



    // best selling products slider for home page=============================================================
    // best selling products slider for home page=============================================================
    // best selling products slider for home page=============================================================
    public function best_selling_products_slider_index()
    {
        $slider_best_selling_products_data = DB::table('slider_best_selling_products_view')->get();
        $genericbrand_data = DB::table('genericbrand_view')->get();
        $genericbrandpicData = DB::table('genericbrandpic')->select('genericBrandPicId', 'genericBrandId', 'picPath')->get();
        return view('frontend.best_products_slider', compact('slider_best_selling_products_data', 'genericbrand_data', 'genericbrandpicData'));
    }

    public function best_selling_products_slider_insert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'genericBrandId' => 'required|unique:slider_best_selling_products'
            ],
            [  
                'genericBrandId.unique' => 'Duplicate record already exist!',
            ]
        );


        $inputs = $request->all();
        Slider_Best_Selling_Products::create($inputs);

        return back()->with('successMsg', 'Slider Best Selling product successfully added!');
    }

    public function best_selling_products_slider_delete($slider_best_selling_product_id)
    {
        Slider_Best_Selling_Products::where('slider_best_selling_product_id',$slider_best_selling_product_id)->delete();
        return back()->with('successMsg', 'Slider Best Selling Product successfully deleted!');
    }

    

    // best selling products slider for home page=============================================================
    // best selling products slider for home page=============================================================
    // best selling products slider for home page=============================================================





    // main navbar category selection for frontend=============================================================
    // main navbar category selection for frontend=============================================================
    // main navbar category selection for frontend=============================================================
    public function frontend_main_navbar_index()
    {
        $category_data = DB::table('category')->get();
        $menu_categories_f_data = DB::table('menu_categories_f')->get();
        return view('frontend.frontend_main_navbar_index', compact('category_data', 'menu_categories_f_data'));
    }

    public function frontend_main_navbar_insert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'categoryId' => 'required|unique:menu_categories_f'
            ],
            [  
                'categoryId.unique' => 'Duplicate record already exist!',
            ]
        );


        $inputs = $request->all();
        Menu_Categories_F::create($inputs);

        return back()->with('successMsg', 'Main navbar category successfully added!');
    }

    public function frontend_main_navbar_delete($categoryId)
    {
        Menu_Categories_F::where('categoryId',$categoryId)->delete();
        return back()->with('successMsg', 'Main navbar category successfully deleted!');
    }

    

    // main navbar category selection for frontend=============================================================
    // main navbar category selection for frontend=============================================================
    // main navbar category selection for frontend=============================================================





    // testimonial settings page=============================================================
    // testimonial settings page=============================================================
    // testimonial settings page=============================================================
    public function testimonial_Index()
    {
        $testimonialData = DB::table('testimonial_view')->get();
        $userData = DB::table('users')->get();
        return view('frontend.testimonial_index', compact('testimonialData', 'userData'));
    }

    public function testimonialInsert(Request $request)
    {
        $this->validate($request, [
            'manual_picpath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
           ]);
           
        // dd($request->all());
        $inputs = $request->except('manual_picpath');
        $testimonialId = Testimonial::create($inputs)->testimonialId;

        if(Input::hasFile('manual_picpath'))
        {
            // echo 'Uploaded';
            $file = Input::file('manual_picpath');
            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/users/', 'testimonialId-'.$testimonialId.'.'.$file->getClientOriginalExtension());
            Testimonial::find($testimonialId)->update(['manual_picpath' => '/uploads/users/'.'testimonialId-'.$testimonialId.'.'.$file->getClientOriginalExtension()]); 
        }

        return back()->with('successMsg', 'New testimonial successfully added!');
    }

    public function testimonialUpdate(Request $request)
    {

        $this->validate($request, [
            'manual_picpath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
           ]);
  
        Testimonial::where('testimonialId', $request->testimonialId)->update($request->except(['_token','_method']));  
  
          if(Input::hasFile('manual_picpath'))
          {
  
              $file = Input::file('manual_picpath');
              $file->move('uploads/users/', 'testimonialId-'.$request->testimonialId.'.'.$file->getClientOriginalExtension());
  
              Testimonial::where('testimonialId', $request->testimonialId)->update(['manual_picpath'  => '/uploads/users/'.'testimonialId-'.$request->testimonialId.'.'.$file->getClientOriginalExtension()]);
          }



        return back()->with('successMsg', 'Testimonial Successfully Updated!');
    }

    public function testimonialDelete($testimonialId)
    {
        Testimonial::where('testimonialId',$testimonialId)->delete();
        return back()->with('successMsg', 'Testimonial successfully deleted!');
    }

    // testimonial settings page=============================================================
    // testimonial settings page=============================================================
    // testimonial settings page=============================================================





    // currency settings page=============================================================
    // currency settings page=============================================================
    // currency settings page=============================================================
    public function currency_Index()
    {
        $currencyData = DB::table('country')->get();
        return view('frontend.currency', compact('currencyData'));
    }

    public function currencyUpdate(Request $request)
    {
        Country::where('countryId', $request->countryId)->update(
            [
                'currency' => strtoupper(trim($request->currency)),
                'usdToCurrencyRate' => $request->usdToCurrencyRate,
                'hexcode' => $request->hexcode,
            ]
        );  
        return back()->with('successMsg', 'Currency Successfully Updated!');
    }

    public function currencyDelete($countryId)
    {
        Country::where('countryId', $countryId)->delete();
        return back()->with('successMsg', 'Currency successfully deleted!');
    }

    // currency settings page=============================================================
    // currency settings page=============================================================
    // currency settings page=============================================================




    // Top brands for home page=============================================================
    // Top brands for home page=============================================================
    // Top brands for home page=============================================================
    public function top_brands_index()
    {
        $topbrands_data = DB::table('topbrands_view')->get();
        $genericcompany_data = DB::table('genericcompany')->get();
        return view('frontend.topbrands', compact('topbrands_data', 'genericcompany_data') );
    }

    public function top_brands_insert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'genericCompanyId' => 'required|unique:topbrands',
                'picPath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
            ],
            [  
                'genericCompanyId.unique' => 'Duplicate record already exist!',
            ]
        );



        $inputs = $request->all();
        $lastCreatedTopBrandId = TopBrands::create($inputs)->topBrandId;

        if(Input::hasFile('picPath'))
        {
            // echo 'Uploaded';
            $file = Input::file('picPath');
            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/topbrands/', 'topBrandId-'.$lastCreatedTopBrandId.'.'.$file->getClientOriginalExtension());
            TopBrands::find($lastCreatedTopBrandId)->update(['picPath' => '/uploads/topbrands/'.'topBrandId-'.$lastCreatedTopBrandId.'.'.$file->getClientOriginalExtension()]); 
        }



        return back()->with('successMsg', 'Top Brand successfully added!');
    }

    public function top_brands_delete($topBrandId)
    {
        TopBrands::where('topBrandId', $topBrandId)->delete();
        return back()->with('successMsg', 'Top brand successfully deleted!');
    }

    

    // Top brands for home page=============================================================
    // Top brands for home page=============================================================
    // Top brands for home page=============================================================






    // banner for home page=============================================================
    // banner for home page=============================================================
    // banner for home page=============================================================
    public function banner_index()
    {
        $bannerData = DB::table('banner')->get();
        return view('frontend.banner', compact('bannerData') );
    }

    public function banner_insert(Request $request)
    {

        $inputs = $request->all();
        $lastCreatedBannerId = Banner::create($inputs)->bannerId;

        if(Input::hasFile('picPath'))
        {
            // echo 'Uploaded';
            $file = Input::file('picPath');
            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/banner/', 'bannerId-'.$lastCreatedBannerId.'.'.$file->getClientOriginalExtension());
            Banner::find($lastCreatedBannerId)->update(['picPath' => '/uploads/banner/'.'bannerId-'.$lastCreatedBannerId.'.'.$file->getClientOriginalExtension()]); 
        }

        return back()->with('successMsg', 'Banner successfully added!');
    }


    public function bannerupdate(Request $request)
    {
        $this->validate($request, [
          'picPath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF'
         ]);

        Banner::where('bannerId', $request->bannerId)->update($request->except(['_token','_method']));  

        if(Input::hasFile('picPath'))
        {

            $file = Input::file('picPath');
            $file->move('uploads/banner/', 'bannerId-'.$request->bannerId.'.'.$file->getClientOriginalExtension());

            Banner::where('bannerId', $request->bannerId)->update(['picPath'  => '/uploads/banner/'.'bannerId-'.$request->bannerId.'.'.$file->getClientOriginalExtension()]);
        }

        return back()->with('successMsg', 'Banner Successfully Updated!');
    }



    public function banner_delete($bannerId)
    {
         try {
            unlink(DB::table('banner')->where('bannerId', $bannerId)->pluck('picPath')->first());
         } catch (\Throwable $th) {
             //throw $th;
         }
        Banner::where('bannerId', $bannerId)->delete();
        return back()->with('successMsg', 'Banner successfully deleted!');
    }

    

    // banner for home page=============================================================
    // banner for home page=============================================================
    // banner for home page=============================================================
    
    
    // seo default=============================================================
    // seo default=============================================================
    public function seodefault()
    {
        $seodefault = DB::table('seodefault')->first();
        return view('seo.seodefault', compact('seodefault') );
    }
    public function seodefaultUpdate(Request $request)
    {
        SEODefault::find(1)->update($request->all());

        return back()->with('successMsg', 'SEO Default successfully updated!');
    }
    // seo default=============================================================
    // seo default=============================================================



    // testimonial=========================
    // testimonial=========================
    public function testimonial_contact_request(Request $request)
    {
        // if(isset($request->testimonialId) && ($request->testimonialId!=NULL)){

        // }

        if (checkIsBlackListed($request->requesterEmail, 3)) 
        {
            return back();
        }

        $this->validate($request, [
            'testimonialId' => 'required',          
        ]       
        );

        // setSessionLanguage();
        $isValidRequest = 1;

        $requestCount =  DB::table('testimonial_contact_request')
                            ->where('testimonialId', $request->testimonialId)
                            ->where('requesterEmail', $request->requesterEmail)
                            ->count();

        if ($requestCount >= 2) {
            $isValidRequest=0;
        }

        if ($isValidRequest==1) {
            DB::table('testimonial_contact_request')->insert([
                'testimonialId' => $request->testimonialId,
                'requesterId' => $request->requesterId,
                'requesterName' => $request->requesterName,
                'requesterEmail' => $request->requesterEmail
            ]);

            $testimonial = DB::table('testimonial_view')->where('testimonialId', $request->testimonialId)->first();
            $testimonialClientName = $testimonial->name ; 

            
            

            if (Auth::check()) {
                // ==============Notification for customer===========
                DB::table('notifications')->insert([
                    'receiverId' => Auth::user()->id,
                    'testimonialClientContactRequest' => 1,
                    'message' => 'Your request for contacting with client '.$testimonialClientName.' from testimonial section has been submitted.',
                    'message2' => 'Your request for contacting with client '.$testimonialClientName.' from testimonial section has been submitted.',
                    
                ]);
                // ==============Notification for customer============

                // notifications_admin=============
                DB::table('notifications_admin')->insert([
                    [
                        'testimonialId' => $request->testimonialId,
                        'testimonialClientContactRequest' => 1,
                        'testimonialClientContactRequesterId' => Auth::user()->id , 
                        'message' => 'A testimonial request from '.$request->requesterName.' has been inquired.',
                        'message2' => 'A testimonial request from '.$request->requesterName.' has been inquired.',
                    ],
                ]);
                // notifications_admin=============
            }



            // =================mail sending=============
            // =================mail sending=============
            $mailsettingsData = DB::table('mailsettings')->first();
            
            $mailSenderEmail = $mailsettingsData->mail;
            $mailSenderName = 'Medicine For World';
            $mailReceiverEmail = $request->requesterEmail;
            $mailReceiverName = $request->requesterName;

            
            
            $subject = 'Dear '.$mailReceiverName.' request for contacting with client '.$testimonialClientName.' from testimonial section has been submitted.';
            $bodyMessage = 'Your request for contacting with client '.$testimonialClientName.' from testimonial section has been taken into consideration. you will be soon notified.';

            $website = $mailsettingsData->website;
            $contactMails = $mailsettingsData->contactMails;
            $numberTitle = $mailsettingsData->numberTitle;
            $number = $mailsettingsData->number;
            $logo = $mailsettingsData->logo;
            
            
            mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
            // =================mail sending=============
            // =================mail sending=============


            return back()->with('testimonial_contact_request_ok', 1);
        }
        return back()->with('testimonial_contact_request_limit_overload', 1);
    }    

    public function testimonial_client_contact_request(){
        $testimonial_contact_request_data = DB::table('testimonial_contact_request_view')->get();

        if (request()->has('testimonialClientContactRequest') && request('testimonialClientContactRequest')!= null 
            && request()->has('testimonialClientContactRequesterId') && request('testimonialClientContactRequesterId')!= null 
            && request()->has('testimonialId') && request('testimonialId')!= null) 
        {
            $testimonial_contact_request_data = $testimonial_contact_request_data
                                                ->where('requesterId', request('testimonialClientContactRequesterId'))
                                                ->where('testimonialId', request('testimonialId'));
            DB::table('notifications_admin')
                ->where('testimonialClientContactRequest', request('testimonialClientContactRequest'))
                ->where('testimonialClientContactRequesterId', request('testimonialClientContactRequesterId'))
                ->where('testimonialId', request('testimonialId'))
                ->update([
                    'read_at' => now()
                ]);
        }

        return view('frontend.testimonial_client_contact_request', compact('testimonial_contact_request_data'));
    }

    public function testimonial_client_contact_request_delete($testimonial_contact_request_id)
    {
        DB::table('testimonial_contact_request')->where('testimonial_contact_request_id', $testimonial_contact_request_id)->delete();
        return back()->with('successMsg', 'Successfuly deleted!');
    }


    public function testimonial_send_mail_to_requester(Request $request)
    {
        $testimonial_contact_request = DB::table('testimonial_contact_request_view')
                                        ->where('testimonial_contact_request_id', $request->testimonial_contact_request_id)
                                        ->first();

        if ($testimonial_contact_request->requesterId != null) 
        {
            // ==============Notification for customer===========
            DB::table('notifications')->insert([
                'receiverId' => $testimonial_contact_request->requesterId,
                'testimonialAdminToClientContactRequest' => 1,
                'message' => 'Updates on you request for '.$request->testimonialClientName.' information from testimonial section',
                'message2' => 'Updates on you request for '.$request->testimonialClientName.' information from testimonial section' 
                
            ]);
            // ==============Notification for customer============

            // notifications_admin=============
            DB::table('notifications_admin')->insert(
                [
                    'testimonialId' => $testimonial_contact_request->testimonialId,
                    'testimonialAdminToClientContactRequest' => 1,
                    'testimonialClientContactRequesterId' => $testimonial_contact_request->requesterId , 
                    'message' => 'Updates on requester '.$request->requesterName.'\'s request for '.$request->testimonialClientName.' information from testimonial section',
                    'message2' => 'Updates on requester '.$request->requesterName.'\'s request for '.$request->testimonialClientName.' information from testimonial section'
                ]
            );
            // notifications_admin=============
        }


        DB::table('testimonial_contact_request')->where('testimonial_contact_request_id', $request->testimonial_contact_request_id)
            ->update([
                'isMailSent' => 1
            ]);
        // dd($request->all());
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $mailReceiverEmail = $request->requesterEmail;
        $mailReceiverName  = $request->requesterName;

        $subject = 'Updates of '.$mailReceiverName.'\'s request for '.$request->testimonialClientName.'\'s information from testimonial section';
        $bodyMessage = $request->emailBody;
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;


        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);

        return back()->with('successMsg', 'Successfully Mail Sent!');
    }
    // testimonial=========================
    // testimonial=========================



    // contact_with_product_reviewer_request
    // contact_with_product_reviewer_request
    public function contact_with_product_reviewer_request(Request $request)
    {
        if (checkIsBlackListed($request->requesterEmail, 2)) 
        {
            return back();
        }

        $isValidRequest=1;

        $this->validate($request, [
                'reviewId' => 'required',          
                'requesterName' => 'required',          
                'requesterEmail' => 'required',  
                // 'reviewerId' => 'required',  
                // 'genericBrandId' => 'required',  
                        
            ]       
        );

        $requestCount =  DB::table('contact_w_reviewer_req')
                            ->where('reviewId', $request->reviewId)
                            ->where('requesterEmail', $request->requesterEmail)
                            ->count();

        if ($requestCount > 2) {
            $isValidRequest=0;
        }

        

        if ($isValidRequest==1) {
            $review = DB::table('reviews_view')->where('reviewId', $request->reviewId)->first();
            $reviewerName = $review->name ; 


            DB::table('contact_w_reviewer_req')->insert([
                'reviewId' => $request->reviewId,
                'genericBrandId' => $review->genericBrandId,
                'requesterId' => $request->requesterId,
                'requesterName' => $request->requesterName,
                'requesterEmail' => $request->requesterEmail
            ]);

            

            if (Auth::check()) {
                // ==============Notification for customer===========
                DB::table('notifications')->insert([
                    'reviewId' => $request->reviewId,
                    'receiverId' => Auth::user()->id,
                    'genericBrandId' => $review->genericBrandId,
                    'contact_with_product_reviewer_request' => 1,
                    'message' => 'Your request for contacting with client '.$reviewerName.' from review section has been submitted.',
                    'message2' => 'Your request for contacting with client '.$reviewerName.' from review section has been submitted.',
                    
                ]);
                // ==============Notification for customer============

                // notifications_admin=============
                DB::table('notifications_admin')->insert([
                    [
                        'reviewId' => $request->reviewId,
                        'reviewerId' => $review->reviewerId,
                        'genericBrandId' => $review->genericBrandId,
                        'contact_with_product_reviewer_request' => 1,
                        'contact_with_product_reviewer_requesterId' => Auth::user()->id , 
                        'message' => 'A contact with product reviewer request from '.$request->requesterName.' has been inquired.',
                        'message2' => 'A contact with product reviewer request from '.$request->requesterName.' has been inquired.',
                    ],
                ]);
                // notifications_admin=============
            }



            // =================mail sending=============
            // =================mail sending=============
            $mailsettingsData = DB::table('mailsettings')->first();
            
            $mailSenderEmail = $mailsettingsData->mail;
            $mailSenderName = 'Medicine For World';
            $mailReceiverEmail = $request->requesterEmail;
            $mailReceiverName = $request->requesterName;

            
            
            $subject = 'Dear '.$mailReceiverName.' request for contacting with client '.$reviewerName.' from review section has been submitted.';
            $bodyMessage = 'Your request for contacting with client '.$reviewerName.' from review section has been taken into consideration. you will be soon notified.';

            $website = $mailsettingsData->website;
            $contactMails = $mailsettingsData->contactMails;
            $numberTitle = $mailsettingsData->numberTitle;
            $number = $mailsettingsData->number;
            $logo = $mailsettingsData->logo;
            
            
            mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
            // =================mail sending=============
            // =================mail sending=============


            return back()->with('contact_with_product_reviewer_request_ok', 1);
        }

        return back()->with('contact_with_product_reviewer_request_limit_overload', 1);
    }  



    public function contact_with_product_reviewer_requests(){
        $contact_with_product_reviewer_request_data = DB::table('contact_w_reviewer_req_view')->get();

        if (request()->has('contact_with_product_reviewer_request') && request('contact_with_product_reviewer_request')!= null 
            && request()->has('contact_with_product_reviewer_requesterId') && request('contact_with_product_reviewer_requesterId')!= null 
            && request()->has('reviewId') && request('reviewId')!= null) 
        {
            DB::table('notifications_admin')
                ->where('contact_with_product_reviewer_request', request('contact_with_product_reviewer_request'))
                ->where('contact_with_product_reviewer_requesterId', request('contact_with_product_reviewer_requesterId'))
                ->where('reviewId', request('reviewId'))
                ->update([
                    'read_at' => now()
                ]);
        }

        return view('frontend.contact_with_product_reviewer_requests');
    }

    public function contact_with_product_reviewer_requests_data(Request $request)
    {
        if (Auth::check()) 
        {
            $contact_w_reviewer_req_data = [];
            $mailData = [];
            $contact_w_reviewer_req_data = DB::table('contact_w_reviewer_req_view')->get();
            $mailData = DB::table('emailbody')->get();
            $response = ["status" => "Success", "data"=> $contact_w_reviewer_req_data, "mailData"=> $mailData];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        return response(400, ["Content-Type" => "application/json"]);

    }

    public function contact_with_product_reviewer_requests_mail_send(Request $request)
    {
        if (Auth::check()) 
        {
            $contact_w_reviewer_req_id = $request->postData['contact_w_reviewer_req_id'];
            $reviewId = $request->postData['reviewId'];
            $requesterName = $request->postData['requesterName'];
            $requesterEmail = $request->postData['requesterEmail'];
            $emailBody = $request->postData['emailBody'];


            if ($contact_w_reviewer_req_id!=null && $reviewId!=null && $requesterName!=null && $requesterEmail!=null && $emailBody!=null) 
            {

                $contact_w_reviewer_req_data = DB::table('contact_w_reviewer_req_view')->where('contact_w_reviewer_req_id', $contact_w_reviewer_req_id)->first();

                if ($contact_w_reviewer_req_data->requesterId != null) 
                {
                    // ==============Notification for customer===========
                    DB::table('notifications')->insert([
                        'reviewId' => $reviewId,
                        'receiverId' => $contact_w_reviewer_req_data->requesterId,
                        'genericBrandId' => $contact_w_reviewer_req_data->genericBrandId,
                        'cont_with_prod_rev_req_s_mail_to_reqester' => 1,
                        'message' => 'Updates on you request for '.$requesterName.' information from review section',
                        'message2' => 'Updates on you request for '.$requesterName.' information review section' 
                        
                    ]);
                    // ==============Notification for customer============

                    // notifications_admin=============
                    DB::table('notifications_admin')->insert(
                        [
                            'reviewId' => $reviewId,
                            'reviewerId' => $contact_w_reviewer_req_data->reviewerId,
                            'genericBrandId' => $contact_w_reviewer_req_data->genericBrandId,
                            
                            'contact_with_product_reviewer_request' => 1,
                            'contact_with_product_reviewer_requesterId' => $contact_w_reviewer_req_data->requesterId ,

                            'message' => 'Updates on requester '.$requesterName.'\'s request for '.$contact_w_reviewer_req_data->reviewerName.' information',
                            'message2' => 'Updates on requester '.$requesterName.'\'s request for '.$contact_w_reviewer_req_data->reviewerName.' information'
                        ]
                    );
                    // notifications_admin=============
                }


                DB::table('contact_w_reviewer_req')->where('contact_w_reviewer_req_id', $contact_w_reviewer_req_id)
                    ->update([
                        'isMailSent' => 1
                    ]);
                $mailsettingsData = DB::table('mailsettings')->first();

                $mailSenderEmail = $mailsettingsData->mail;
                $mailSenderName  = 'Medicine For World';

                $mailReceiverEmail = $requesterEmail;
                $mailReceiverName  = $requesterName;

                $subject = 'Updates of '.$requesterName.'\'s request for '.$contact_w_reviewer_req_data->reviewerName.'\'s information from review section';
                $bodyMessage = $emailBody;
                $website = $mailsettingsData->website;
                $contactMails = $mailsettingsData->contactMails;
                $numberTitle = $mailsettingsData->numberTitle;
                $number = $mailsettingsData->number;
                $logo = $mailsettingsData->logo;


                mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);



                $response = ["status" => "Success"];
                return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
            }
            

            return response(json_encode(["status"=> "Failure!"]),400, ["Content-Type" => "application/json"]);

        }
        return response(json_encode(["status"=> "Failure!"]),400, ["Content-Type" => "application/json"]);

    }


    public function contact_with_product_reviewer_request_delete(Request $request)
    {
        if (Auth::check()) 
        {
            $contact_w_reviewer_req_id = $request->postData['contact_w_reviewer_req_id'];
            DB::table('contact_w_reviewer_req')->where('contact_w_reviewer_req_id', $contact_w_reviewer_req_id)->delete();
            $response = ["status" => "Success"];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        return response(400, ["Content-Type" => "application/json"]);
    }

    public function block_a_person_by_mail(Request $request)
    {
        if (Auth::check()) 
        {
            $name = $request->postData['name'];
            $email = $request->postData['email'];
            $blockTypeId = $request->postData['blockTypeId'];
            
            blocklisting($name, $email, $blockTypeId);

            $response = ["status" => "Success"];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        return response(400, ["Content-Type" => "application/json"]);
    }

    public function block_a_person_by_mail_W_redirect(Request $request)
    {
        if (Auth::check()) 
        {
            $name = $request->name;
            $email = $request->email;
            $blockTypeId = $request->blockTypeId;
            
            blocklisting($name, $email, $blockTypeId);

            return back();
        }
        return back();
    }
    
    // contact_with_product_reviewer_request
    // contact_with_product_reviewer_request
    



    // =========== customer to admin contact =============
    // =========== customer to admin contact =============
    public function customerToAdminContact(Request $request)
    {
        if (checkIsBlackListed($request->manualEmail, 1)) 
        {
            return back();
        }
        $todayNumberOfYear = carbondatetimeToDayNumberOfYear(\Carbon\Carbon::now());

        $this->validate($request, [
                'manualName' => 'required',          
                'manualEmail' => 'required',          
                'message' => 'required|max:2000',   
                'isFormValidToSubmit' => 'required|numeric',
                'td' => 'required|string',
                'tddn_'.$todayNumberOfYear => 'required|numeric',       
            ]       
        );

        $todaydateYmd = carbondatetimeToYmd(\Carbon\Carbon::now());
        if ($todaydateYmd != $request->td) {
            return back();
        }

        if ($todayNumberOfYear != request('tddn_'.$todayNumberOfYear)) {
            return back();
        }


        DB::table('customertoadmincontact')->insert([
            'customerId' => $request->customerId,
            'manualName' => $request->manualName,
            'manualEmail' => $request->manualEmail,
            'message' => $request->message,
        ]);


        if (Auth::check()) {

            // notifications_admin=============
            DB::table('notifications_admin')->insert([
                [
                    'customer_to_admin_contact' => 1,
                    'customer_to_admin_contactRequesterId' => Auth::user()->id , 
                    'message' => 'A customer conatact via email '.$request->requesterName.' has been sent.',
                    'message2' => 'A customer conatact via email '.$request->requesterName.' has been sent.',
                ],
            ]);
            // notifications_admin=============
        }


        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $request->manualEmail;
        $mailReceiverName = $request->manualName;

        
        $subject = 'Dear '.$mailReceiverName.', we received your email. We will contact you soon.';
        $bodyMessage = 'Your message: "'.$request->message.'"'.'<br><br>'.'We received your email. We will contact you soon.';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============

        return back()->with('cutomer_to_admin_contact', 1);
    }   



    public function customer_to_admin_contacts(){

        if (request()->has('customer_to_admin_contactRequesterId') && request('customer_to_admin_contactRequesterId')!= null ) 
        {
            DB::table('notifications_admin')
                ->where('customer_to_admin_contactRequesterId', request('customer_to_admin_contactRequesterId'))
                ->update([
                    'read_at' => now()
                ]);
        }

        return view('frontend.customer_to_admin_contact');
    }


    public function customer_to_admin_contacts_data(Request $request)
    {
        if (Auth::check()) 
        {
            $customer_to_admin_contacts_data = [];
            $mailData = [];
            $mailData = DB::table('emailbody')->get();

            $customertoadmincontact_data = DB::table('customertoadmincontact_view')->get();
            $response = ["status" => "Success", "data"=> $customertoadmincontact_data, 'mailData'=> $mailData];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        return response(400, ["Content-Type" => "application/json"]);

    }


    public function customer_to_admin_contacts_delete(Request $request)    {
        
        if (Auth::check()) 
        {
            $customertoadmincontactId = $request->postData['customertoadmincontactId'];
            DB::table('customertoadmincontact')->where('customertoadmincontactId', $customertoadmincontactId)->delete();
            $response = ["status" => "Success"];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        return response(400, ["Content-Type" => "application/json"]);
    }

   
    public function customer_to_admin_contacts_mail_send(Request $request)
    {
        // dd($request);
        
        if (Auth::check()) 
        {
            $customertoadmincontactId = $request->postData['customertoadmincontactId'];
            $customerId = $request->postData['customerId'];
            $requesterName = $request->postData['manualName'];
            $requesterEmail = $request->postData['manualEmail'];
            $emailBody = $request->postData['emailBody'];


            if ($customertoadmincontactId!=null  && $requesterName!=null && $requesterEmail!=null && $emailBody!=null) 
            {
                DB::table('customertoadmincontact')->where('customertoadmincontactId', $customertoadmincontactId)
                    ->update([
                        'isMailSent' => 1
                    ]);
                $mailsettingsData = DB::table('mailsettings')->first();

                $mailSenderEmail = $mailsettingsData->mail;
                // $mailSenderEmail = 'info@medicineforworld.com.bd';
                $mailSenderName  = 'Medicine For World';

                $mailReceiverEmail = $requesterEmail;
                $mailReceiverName  = $requesterName;

                $subject = 'Dear '.$mailReceiverName.', reply from MFW support TEAM.';
                $bodyMessage = $emailBody;

                // 'Your message: "'.$request->message.'"'.'<br><br>'.'We received your email. We will contact you soon.';
                
                $website = $mailsettingsData->website;
                $contactMails = $mailsettingsData->contactMails;
                $numberTitle = $mailsettingsData->numberTitle;
                $number = $mailsettingsData->number;
                $logo = $mailsettingsData->logo;


                mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);



                $response = ["status" => "Success"];
                return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
            }
            

            return response(json_encode(["status"=> "Failure!"]),400, ["Content-Type" => "application/json"]);

        }
        return response(json_encode(["status"=> "Failure!"]),400, ["Content-Type" => "application/json"]);

    }

    // =========== customer to admin contact =============
    // =========== customer to admin contact =============

}
