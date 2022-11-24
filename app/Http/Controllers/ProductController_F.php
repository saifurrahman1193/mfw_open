<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Wishlist;
use App\Compare;
use App\UserGenericInquiry;
use App\Cart;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Input;
use Illuminate\Support\Str;
use URL;


class ProductController_F extends Controller
{

    

    public function productDetailsPageCaller($language, $genericBrandId)
    {

        // dd($genericBrandId);
        
        if (  request()->has('reviewId') and request('reviewId')!= null ) 
        {
            DB::table('notifications')->where('reviewId', request('reviewId') )->update([ 'read_at' => \Carbon\Carbon::now() ]);
        } 
        else if (Auth::check())
        {
            DB::table('notifications')->where('genericbrandId', $genericBrandId )->where('receiverId', Auth::user()->id )->update([ 'read_at' => \Carbon\Carbon::now() ]);
        } 
        
        // setSessionLanguage();
        $productdetail_redirecter_f_data =  DB::table('productdetail_redirecter_f_view')->get();

        // dd($productdetail_redirecter_f_data);
        // dd($genericBrandId);

        $genericbrandData = $productdetail_redirecter_f_data->where('genericBrandId', $genericBrandId)->first();

        // dd($genericbrandData);

        // if (!isset($genericbrandData)) {
        //     // setSessionLanguage();
        //     return redirect()->to('/productnotfound'.'?'. http_build_query([app()->getLocale()]));
        // }

        $genericBrand = $genericbrandData->genericBrand;
        $genericCompany = $genericbrandData->genericCompany;
        $genericName = $genericbrandData->genericName;
        $genericStrength = $genericbrandData->genericStrength;
        $category = $genericbrandData->category;
        $usesFor = $genericbrandData->usesFor;


        // $genericBrandURL = str_replace(' ', '-', $genericName).'-'.str_replace(' ', '-', $genericBrand).'-'.str_replace(' ', '-', $genericCompany).'-'.'Generic-'.str_replace(' ', '-', $genericName).'-'.str_replace('/', '-', str_replace(' ', '-', $genericStrength)).'-'.str_replace(' ', '-', $usesFor).'-'.$category;
        // $genericBrandURL = str_replace(' ', '-', $genericName).'-'.str_replace(' ', '-', $genericBrand).'-'.str_replace(' ', '-', $genericCompany).'-'.'Generic-'.str_replace(' ', '-', $genericName).'-'.str_replace('/', '-', str_replace(' ', '-', $genericStrength)).'-'.'-'.str_replace(' ', '-', $category);

        $str = $genericName.' '. $genericBrand.' '. $genericCompany.' Generic '. $genericName.' '. $genericStrength .' '. $category;
        $str = trim($str);

        $str = str_replace("/", ' ', $str);


        $genericBrandURL =  Str::slug($str);


        return redirect()->route('productDetailsPage', array( $language,'genericBrandURL'=>$genericBrandURL, 'genericBrandId'=>$genericBrandId));
    }

    

    public function productDetailsPage($language, $genericBrandURL, $genericBrandId)
    {
        // setSessionLanguage();
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return DB::table('genericbrand_view')->get(); 
        });

        if ( is_numeric($genericBrandId)) 
        {
            $specifiedGenericbrandData = $genericbrandData->where('genericBrandId', $genericBrandId)->first(); 
        }
        else 
        {
           $specifiedGenericbrandData = $genericbrandData->where('genericBrand', trim($genericBrandId))->first();  
           $genericBrandId = ($genericbrandData->where('genericBrand', trim($genericBrandId)))->pluck('genericBrandId')->first();   
        }

        // $genericstrengthData = DB::table('genericbrandstrength_view')->get();
        $allGenericstrengthIndivData = Cache::remember('allGenericstrengthIndivData', 5, function () {
            return DB::table('genericbrandstrengthindv_view')->get(); 
        });

        $genericbrand_packsizes_data = Cache::remember('genericbrand_packsizes_data', 5, function () {
            return DB::table('genericbrand_packsizes_view')->get();
        });

        $genericbrand_packsizes_data = $genericbrand_packsizes_data->where('genericBrandId', $genericBrandId)->first();

        $availabilitytypeData = Cache::remember('availabilitytypeData', 5, function () {
            return DB::table('availabilitytype')->get();
        });

        $genericpacksizesData = DB::table('genericpacksizes_view')->get(); 


        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');

            $genericpacksizes_with_customer_price_view_data = DB::table('genericpacksizes_with_customer_price_view')->where('genericBrandId', $genericBrandId)->where('customerId', Auth::user()->id)->get();
            $usergenericinquiryData = DB::table('usergenericinquiry_view')->where('genericBrandId', $specifiedGenericbrandData->genericBrandId)->where('inquirerId', Auth::user()->id )->get();
           
            return view('frontend.product_details_f', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData',  'specifiedGenericbrandData', 'wishlistData', 'compareData', 'userData', 'allGenericstrengthIndivData', 'genericpacksizes_with_customer_price_view_data', 'genericstrengthCompactData', 'availabilitytypeData', 'notificationData', 'genericbrand_packsizes_data', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericpacksizesData', 'usergenericinquiryData'));
        }
        else{
            return view('frontend.product_details_f', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData',  'specifiedGenericbrandData',  'allGenericstrengthIndivData', 'genericstrengthCompactData', 'availabilitytypeData',  'genericbrand_packsizes_data', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericpacksizesData'));
        }

    }




    // wishlist dynamic======
    public function productDetailsPageAddtoWishlist($userId, $genericBrandId)
    {
        DB::table('wishlist')->insert(
            [
                'wisherId' => $userId, 
                'genericBrandId' => $genericBrandId
            ]
        );

        $wisher_add_to_wishlist_count = DB::table('wishlist')->where('wisherId', $userId)->count('wisherId');

        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function productDetailsPageRemoveFromWishlist($userId, $genericBrandId)
    {
        Wishlist::where('wisherId', $userId)->where('genericBrandId', $genericBrandId)->delete();

        $wisher_add_to_wishlist_count = DB::table('wishlist')->where('wisherId', $userId)->count('wisherId');
        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }
    // wishlist dynamic======

    // compare dynamic======
    public function productDetailsPageAddtoCompare($userId, $genericBrandId)
    {
        DB::table('compare')->insert(
            [
                'comparerId' => $userId, 
                'genericBrandId' => $genericBrandId
            ]
        );

        $wisher_add_to_wishlist_count = DB::table('compare')->where('comparerId', $userId)->count('comparerId');
        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];

        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function productDetailsPageRemoveFromCompare($userId, $genericBrandId)
    {
        Compare::where('comparerId', $userId)->where('genericBrandId', $genericBrandId)->delete();

        $wisher_add_to_wishlist_count = DB::table('compare')->where('comparerId', $userId)->count('comparerId');
        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];

        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function productDetailsPageRemoveFromCompareCompare($userId, $genericBrandId)
    {
        Compare::where('comparerId', $userId)->where('genericBrandId', $genericBrandId)->delete();

        $wisher_add_to_wishlist_count = DB::table('compare')->where('comparerId', $userId)->count('comparerId');
        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];

        return back();
    }

    // compare dynamic======


    // priceEnquiryRequest dynamic======
    public function priceEnquiryRequest($userId, $genericBrandId)
    {
        // setSessionLanguage();

        UserGenericInquiry::where('inquirerId', $userId)->where('genericBrandId', $genericBrandId)->delete();

        $response = ["data" => $wisher_add_to_wishlist_count, "message" => 'success' ];

        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }
    // priceEnquiryRequest dynamic======




    // add to cart function=========================
    public function productDetailsAddtoCart($genericBrandId, $genericPackSizeId)
    {
        $customerId = Auth::user()->id;
        
        $cartdetailsData = DB::table('cartdetails')
                              ->where('customerId', $customerId)
                              ->where('cartId', null)
                              ->where('genericBrandId', $genericBrandId)
                              ->where('genericPackSizeId', $genericPackSizeId)
                              ->first();
        $customergenericprices = DB::table('customergenericprices')->where('genericPackSizeId', $genericPackSizeId)->where('customerId', $customerId)->first();



        if (!(isset($cartdetailsData)) ) 
        {
            
            DB::table('cartdetails')->insert(
                [
                    'genericBrandId' => $genericBrandId, 
                    'genericPackSizeId' => $genericPackSizeId,
                    'price' => $customergenericprices->price,
                    'discount' => $customergenericprices->discount,
                    'qty' => 1,
                    'customerId' => $customerId
                ]
            );
            
        }
        else 
        {
            $qty = $cartdetailsData->qty;
            $qty = $qty +1;

            
             DB::table('cartdetails')
                ->where('customerId', $customerId)
                ->where('genericBrandId', $genericBrandId)->where('genericPackSizeId', $genericPackSizeId)
                ->update(
                [
                    'qty' => $qty,
                    'price' => $customergenericprices->price,
                    'discount' => $customergenericprices->discount,
                ]
            );   
        }

        $sumQty = DB::table('cartdetails')->where('customerId', $customerId)->where('cartId', null)->sum('qty');

        $response = [ "qty" => $sumQty ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }
    // add to cart function=========================





    public function productlistPage($language, $diseaseCategoryId=null, $categoryId=null)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');

        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });

        $specific_category='';
        

        if ($diseaseCategoryId==-1 && $categoryId>0 )  // specific category
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where('categoryId', $categoryId)->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrand")->paginate(20);
            $specific_category=DB::table("genericbrandcategoryproducts_view")->where('categoryId', $categoryId)->where('isFrontendVisible', 1)->first();
        }
        else if ($diseaseCategoryId==0)  // all category
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrand")->paginate(20);
        }
        else if ($diseaseCategoryId>0 ) 
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrand")->paginate(20);
            $specific_category=DB::table("genericbranddiseasecategoryproducts_view")->where('diseaseCategoryId', $diseaseCategoryId)->where('isFrontendVisible', 1)->first();
        }
        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('productlistPage_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });


        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'reviewData', 'reviewsData', 'genericbrandcategoryData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbranddieseasecateprodData', 'specific_category'));
        }
        else
        {
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericstrengthCompactData', 'reviewData', 'reviewsData', 'genericbrandcategoryData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbranddieseasecateprodData', 'specific_category'));
        }

    }


    public function productlistPageTopBrands($language, $genericCompanyId)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });
        $genericbranddiseasecategoryproductsData =   DB::table("genericbranddiseasecategoryproducts_view")->where("genericCompanyId", $genericCompanyId)->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrand")->paginate(20);
       
        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('productlistPageTopBrands_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });


        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }
        else
        {
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData',  'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }

    }


    
    public function productlistPage_new_slider()
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get();
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });
        $genericbranddiseasecategoryproductsData = Cache::remember('productlistPage_new_slidergenericbranddiseasecategoryproductsData', 5, function () {
            return  DB::table('slider_new_selling_products_view')->where('isFrontendVisible', 1)->get();
        });
       
        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('productlistPage_new_slider_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });

        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }
        else{
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }

    }

    public function productlistPage_new_sliderwithpaginate()
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get();
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });
        $genericbranddiseasecategoryproductsData = Cache::remember('productlistPage_new_sliderwithpaginategenericbranddiseasecategoryproductsData', 5, function () {
            return  DB::table('slider_new_selling_products_view')->where('isFrontendVisible', 1)->paginate(20);
        });
       
        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('productlistPage_new_sliderwithpaginate_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });

        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }
        else{
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }

        

    }



    public function productlistPage_best_slider()
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });
        $genericbranddiseasecategoryproductsData = Cache::remember('productlistPage_best_slidergenericbranddiseasecategoryproductsData', 5, function () {
            return  DB::table('slider_best_selling_products_view')->paginate(20);
        });

        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });


        $genericbranddieseasecateprodData = Cache::remember('productlistPage_best_slider_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->select('categoryId', 'diseaseCategoryId')->get(); 
        });

        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data','genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }
        else
        {
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData',  'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data','genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }


    }


    public function productlistPage_best_sliderwithpaginate()
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });
        $genericbranddiseasecategoryproductsData = Cache::remember('genericbranddiseasecategoryproductsData', 5, function () {
            return  DB::table('slider_best_selling_products_view')->where('isFrontendVisible', 1)->paginate(20);
        });

        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('productlistPage_best_sliderwithpaginate_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });

        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',  'wishlistData', 'compareData', 'userData', 'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data','genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }
        else
        {
            return view('frontend.productlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData',   'genericbranddiseasecategoryproductsData', 'genericstrengthCompactData',  'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data','genericbrandcategoryData', 'genericbranddieseasecateprodData'));
        }


    }


    // wishlist=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // wishlist=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    public function wishlistPage($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->get(); 
        });
        $genericstrengthData = Cache::remember('genericstrengthData', 5, function () {
            return  DB::table('genericbrandstrength_view')->get();
        });

        
        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.wishlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData', 'wishlistData', 'compareData', 'userData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else
        {
            return view('frontend.wishlist', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'genericbrandpicData', 'genericstrengthData','genericstrengthCompactData',  'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        

    }
    // wishlist=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // wishlist=-=-=-=-=-=-=-=-=-=-=-=-=-=-




    // go to cart page======================================================
     public function goToCartPage($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        // primary data=============================
          
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
         
         
        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->get();
        });
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();

        // main content data=======================
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', null)->get();
        
        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();

        
        $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();
       

        
       



        // $genericpacksizes_with_customer_price_view_data = DB::table('genericpacksizes_with_customer_price_view')->where('genericBrandId', $genericBrandId)->where('customerId', Auth::user()->id)->get();

        // dd($cartdetailsData);

        // $cartSubTotal = 0;
        // $cartSumDiscount = 0;
        // $cartSumTax = 0;
        // $cartSumShippingCost = 0;

        // foreach ($cartdetailsData as $cartdetail) {
        //        $cartSubTotal += $cartdetail->qty*$cartdetail->price;
        //        $cartSumDiscount += $cartdetail->qty*$cartdetail->discount;
        //        $cartSumTax += $cartdetail->tax;
        //        $cartSumShippingCost += $cartdetail->shippingCost;
        // }

        // $cartSubTotal -=$cartSumDiscount;

        // $cartTotal = 0;

        // $cartTotal = $cartSubTotal+$cartSumTax+$cartSumShippingCost;
        
        return view('frontend.cart', compact('categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'userData', 'cartdetailsData', 'genericbrandpicData', 'genericpacksizes_with_customer_price_data', 'notificationData', 'countryData', 'usdToCurrencyRate', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData' , 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));

    }


    public function productDetailsAddtoCartAddQty($language, $cartDetailId)
    {
        $customerId = Auth::user()->id;
        
        $qty = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->pluck('qty')->first();
        $qty = $qty +1;
        
        DB::table('cartdetails')
            ->where('cartDetailId', $cartDetailId)
            ->update(
                [
                    'qty' => $qty
                ]
            );   

        $sumQty = DB::table('cartdetails')->where('customerId', $customerId)->where('cartId', null)->sum('qty');


        $discount = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->pluck('discount')->first();

        $response = [ "sumQty" => $sumQty, "qty" => $qty , "discount" => $discount ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function productDetailsAddtoCartSubQty($language, $cartDetailId)
    {
        $customerId = Auth::user()->id;
        
        $qty = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->pluck('qty')->first();
        $qty = $qty -1;
        
        DB::table('cartdetails')
            ->where('cartDetailId', $cartDetailId)
            ->update(
                [
                    'qty' => $qty
                ]
            );   

        $sumQty = DB::table('cartdetails')->where('customerId', $customerId)->where('cartId', null)->sum('qty');


        $discount = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->pluck('discount')->first();

        $response = [ "sumQty" => $sumQty, "qty" => $qty  ,"discount" => $discount  ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }



    public function removefromcart_1($language, $cartDetailId)
    {
        $customerId = Auth::user()->id;
        
        $qty = DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->pluck('qty')->first();
        $qty = $qty -1;
        
        DB::table('cartdetails')->where('cartDetailId', $cartDetailId)->delete();   

        $sumQty = DB::table('cartdetails')->where('customerId', $customerId)->where('cartId', null)->sum('qty');



        // $cartdetailsData = DB::table('cartdetails')->where('customerId', Auth::user()->id)->where('cartId', null)->get();
        // $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        // $cartSubTotal = 0;
        // foreach ($cartdetailsData as $cartdetail) {
        //        $cartSubTotal += $cartdetail->qty*$cartdetail->price;
        // }

        // $cartTotal = 0;

        // $cartTotal = $cartSubTotal-$genericpacksizes_with_customer_price_data->min('discount')+$genericpacksizes_with_customer_price_data->min('tax')+$genericpacksizes_with_customer_price_data->min('shippingCost');

        $response = [ "sumQty" => $sumQty  ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    

    
    // go to cart page======================================================




    // checkout page============================================
    // checkout page============================================
    public function checkout($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();


        // primary data=============================
          
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
         
         
        $genericbrandData = Cache::remember('genericbrandData', 5, function () {
            return  DB::table('genericbrand_view')->get(); 
        });
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();

        // secondary data===============
        $deliverypriceData = Cache::remember('deliverypriceData', 5, function () {
            return  DB::table('deliveryprice_view')->get();
        });
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', null)->get();
        $genericpacksizes_with_customer_price_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
       
        $paymentpriceData = Cache::remember('paymentpriceData', 5, function () {
            return  DB::table('paymentprice_view')->get();
        });
        


        // dd($userData);

        // dd($cartdetailsData);

        // checkout restriction--------------
            $reject = 0;
            foreach ($cartdetailsData as $cartdetail_data) 
            {
                $moq = $cartdetail_data->moq;
                $qty = $cartdetail_data->qty;

                if ($moq > $qty) 
                {
                    $reject = 1;
                }
            }

            if ($cartdetailsData->count('customerId')<1 ) {
                $reject = 1;
            }
            
            if ($reject == 1) 
            {
                session()->flash('checkOutRejected', 1);
                return redirect(Route('goToCartPage', array( app()->getLocale())));
            }
        // checkout restriction--------------

        $cartDiscount = $cartdetailsData->sum('discountTotal') ;
        $cartSubTotal = $cartdetailsData->sum('subtotal') ;


        $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();


        $cartTax = 0;
        $cartShippingCost = 0;

        $cartTotal = 0;

        $cartTotal = $cartSubTotal-$cartDiscount+$cartTax+$cartShippingCost;


        return view('frontend.checkout', compact('categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'userData', 'deliverypriceData', 'cartdetailsData', 'genericpacksizes_with_customer_price_data', 'cartTotal', 'cartSubTotal', 'notificationData', 'countryData', 'countryData', 'cartDiscount', 'cartTax', 'cartShippingCost',  'usdToCurrencyRate', 'paymentpriceData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData' , 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }


    public function getDeliveryMethods($language, $countryId) 
    {
        $deliverymethodsData = DB::table("deliveryprice_view")->where("countryId",$countryId)->where('deliveryMethodId', '!=', null)->get();
        $response = ["deliverymethodsData" => $deliverymethodsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function getPaymentMethods($language, $countryId) 
    {
        $paymentmethodsData = DB::table("paymentprice_view")->where("countryId",$countryId)->where('paymentMethodId', '!=', null)->get();
        $response = ["paymentmethodsData" => $paymentmethodsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }



    public function getDeliverySummary($language, $deliveryMethodId, $countryId) 
    {
        $getDeliverySummaryData = DB::table("deliverysummary")->where("deliveryMethodId", $deliveryMethodId)->select("deliverySummaryId","deliverySummary", "deliverySummaryCN", "deliverySummaryRU")->get();


        $deliveryprice_data = DB::table('deliveryprice_view')->where("deliveryMethodId", $deliveryMethodId)->where("countryId", $countryId)->first();
        
        $countryData = DB::table('country')->get(); 
        $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();
        // $cartShippingCost = ?       ============
        $deliveryPriceInitial = $deliveryprice_data->deliveryPriceInitial ;
        $deliveryPriceIncrement = $deliveryprice_data->deliveryPriceIncrement ;
        
        // delivery fee calculation============
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', null)->get();

        $cartWeight = $cartdetailsData->sum('weightGMSubTotal');
        $shippingCost=0;
        if ($cartWeight<=1000) 
        {
            $shippingCost = $deliveryPriceInitial;
        }
        else 
        {
            $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeight/1000);
        }

        if (app()->getLocale()=='en') 
        {
            $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( For '. floor( ($cartWeight-1)/1000).' kg - '. ceil($cartWeight/1000). ' kg )';
        }
        else if (app()->getLocale()=='cn') 
        {
            $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( 对于 '. floor( ($cartWeight-1)/1000).' 公斤 - '. ceil($cartWeight/1000). ' 公斤 )';
        }
        else if (app()->getLocale()=='ru') 
        {
            $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( За '. floor( ($cartWeight-1)/1000).' кг - '. ceil($cartWeight/1000). ' кг )';
        }
        // delivery fee calculation============


        $response = ["deliverySummaryData" => $getDeliverySummaryData, 'cartshippingCostWeightForDeliverySummary'=> $cartshippingCostWeightForDeliverySummary];

        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function getDeliverySummary2($language, $deliveryMethodId, $countryId, $cartId, $currency) 
    {
        $getDeliverySummaryData =   DB::table("deliverysummary")->get();
        $deliveryprice_data = DB::table('deliveryprice_view')->get();

        $getDeliverySummaryData = $getDeliverySummaryData->where("deliveryMethodId", $deliveryMethodId);


            $deliveryprice_data = $deliveryprice_data->where("deliveryMethodId", $deliveryMethodId)->where("countryId", $countryId)->first();
            
            $countryData = Cache::remember('countryData', 5, function () {
                return  DB::table('country')->get();
            });
            $usdToCurrencyRate = $countryData->where('currency', $currency)->pluck('usdToCurrencyRate')->first();
            // $cartShippingCost = ?       ============
            $deliveryPriceInitial = $deliveryprice_data->deliveryPriceInitial ;
            $deliveryPriceIncrement = $deliveryprice_data->deliveryPriceIncrement ;
                // delivery fee calculation============
                $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->get();

                $cartWeight = $cartdetailsData->sum('weightGMSubTotal');
                $shippingCost=0;
                if ($cartWeight<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeight/1000);
                }

                if (app()->getLocale()=='en') 
                {
                    $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( For '. floor( ($cartWeight-1)/1000).' kg - '. ceil($cartWeight/1000). ' kg )';
                }
                else if (app()->getLocale()=='cn') 
                {
                    $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( 对于 '. floor( ($cartWeight-1)/1000).' 公斤 - '. ceil($cartWeight/1000). ' 公斤 )';
                }
                else if (app()->getLocale()=='ru') 
                {
                    $cartshippingCostWeightForDeliverySummary =  ($shippingCost*$usdToCurrencyRate).' ( За '. floor( ($cartWeight-1)/1000).' кг - '. ceil($cartWeight/1000). ' кг )';
                }
                // delivery fee calculation============


        $response = ["deliverySummaryData" => $getDeliverySummaryData, 'cartshippingCostWeightForDeliverySummary'=> $cartshippingCostWeightForDeliverySummary];

        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);

    }


    public function getPaymentSummary($language, $paymentMethodId, $countryId) 
    {
        if ($paymentMethodId!= null) 
        {
            $getPaymentSummaryData = DB::table("paymentsummary")->where("paymentMethodId", $paymentMethodId)->get();
            $paymentprice_data = DB::table("paymentprice_view")->where("paymentMethodId", $paymentMethodId)->where("countryId", $countryId)->first();
            $response = ["paymentSummaryData" => $getPaymentSummaryData, 'transactionFee'=>(double) $paymentprice_data->transactionFee ];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }

    }



    public function getCheckoutCalculation($language, $deliveryMethodId, $countryId, $paymentMethodId, $paymentCountryId) 
    {
        $deliveryprice_data = DB::table('deliveryprice_view')->where("deliveryMethodId", $deliveryMethodId)->where("countryId", $countryId)->first();
        $countryData = DB::table('country')->get(); 
        
        // $cartShippingCost = ?       ============
            $deliveryPriceInitial = $deliveryprice_data->deliveryPriceInitial ;
            $deliveryPriceIncrement = $deliveryprice_data->deliveryPriceIncrement ;
            // get total weight
                $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', null)->get();
                $cartWeight = $cartdetailsData->sum('weightGMSubTotal');
                $cartdiscount = $cartdetailsData->sum('discountTotal') ;
                $cartsubtotal = $cartdetailsData->sum('subtotal') ;
                $cartsubtotalwithdiscount = $cartdetailsData->sum('cartsubtotalwithdiscount') ;
                $shippingCost=0;
                if ($cartWeight<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeight/1000);
                }
                 
                // check offer is applicable for customer and remove transaction fee
                $offerData =  DB::table('offer')->where('offerId', 1)->get();
                $offer =  $offerData->pluck('offer')->first();
                $offerMinAmount = $offerData->pluck('minAmount')->first();
                if ( $cartsubtotalwithdiscount >= $offerMinAmount) 
                {
                    $cartTotal = $cartsubtotalwithdiscount; 
                    $shippingCost =  0;
                }
                else 
                {
                    $cartTotal = $cartsubtotalwithdiscount + $shippingCost; 
                }
                // check offer is applicable for customer and remove transaction fee
                // after payment method==========
                $paymentprice_data = DB::table('paymentprice_view')->where("paymentMethodId", $paymentMethodId)->where("countryId", $countryId)->first();
                $transactionFee =  $paymentprice_data->transactionFee;
                $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();
                $cartTotal = $cartTotal * $usdToCurrencyRate;
                $transactionFee = ( ($transactionFee/100) * $cartTotal ) ;
                $cartTotal = $cartTotal + $transactionFee;  
        $response = [ "deliveryPriceInitial" => (double) $deliveryPriceInitial, "deliveryPriceIncrement" => (double) $deliveryPriceIncrement,  'shippingCost' => (double) $shippingCost , 'cartTotal' =>(double)  $cartTotal, 'cartdiscount'=>(double) $cartdiscount, 'usdToCurrencyRate'=>(double) $usdToCurrencyRate, 'cartsubtotal'=>(double) $cartsubtotal, 'cartWeight'=>(double) $cartWeight, 'transactionAmount'=>(double) $transactionFee, 'offer'=>$offer ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }
    public function getCheckoutCalculation2($language, $deliveryMethodId, $countryId, $paymentMethodId, $paymentCountryId, $cartId, $currency) 
    {
        $deliveryprice_data = DB::table('deliveryprice_view')->where("deliveryMethodId", $deliveryMethodId)->where("countryId", $countryId)->first();
        $countryData = DB::table('country')->get(); 
        // $cartShippingCost = ?       ============
            $deliveryPriceInitial = $deliveryprice_data->deliveryPriceInitial ;
            $deliveryPriceIncrement = $deliveryprice_data->deliveryPriceIncrement ;
            // get total weight
                $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->get();
                $cartWeight = $cartdetailsData->sum('weightGMSubTotal');
                $cartdiscount = $cartdetailsData->sum('discountTotal') ;
                $cartsubtotal = $cartdetailsData->sum('subtotal') ;
                $cartsubtotalwithdiscount = $cartdetailsData->sum('cartsubtotalwithdiscount') ;
                $shippingCost=0;
                if ($cartWeight<=1000) 
                {
                    $shippingCost = $deliveryPriceInitial;
                }
                else 
                {
                    $shippingCost =  $deliveryPriceInitial+ $deliveryPriceIncrement * ceil($cartWeight/1000);
                }
                 
                // check offer is applicable for customer and remove transaction fee
                $offerData =  DB::table('offer')->where('offerId', 1)->get();
                $offer =  $offerData->pluck('offer')->first();
                $offerMinAmount = $offerData->pluck('minAmount')->first();
                if ( $cartsubtotalwithdiscount >= $offerMinAmount) 
                {
                    $cartTotal = $cartsubtotalwithdiscount; 
                    $shippingCost =  0;
                }
                else 
                {
                    $cartTotal = $cartsubtotalwithdiscount + $shippingCost; 
                }
                // check offer is applicable for customer and remove transaction fee
                // after payment method==========
                $paymentprice_data = DB::table('paymentprice_view')->where("paymentMethodId", $paymentMethodId)->where("countryId", $countryId)->first();
                $transactionFee =  $paymentprice_data->transactionFee;
                $usdToCurrencyRate = $countryData->where('currency', $currency)->pluck('usdToCurrencyRate')->first();
                $cartTotal = $cartTotal * $usdToCurrencyRate;
                $transactionFee = ( ($transactionFee/100) * $cartTotal ) ;
                $cartTotal = $cartTotal + $transactionFee;  
        $response = [ "deliveryPriceInitial" => (double) $deliveryPriceInitial, "deliveryPriceIncrement" => (double) $deliveryPriceIncrement,  'shippingCost' => (double) $shippingCost , 'cartTotal' =>(double)  $cartTotal, 'cartdiscount'=>(double) $cartdiscount, 'usdToCurrencyRate'=>(double) $usdToCurrencyRate, 'cartsubtotal'=>(double) $cartsubtotal, 'cartWeight'=>(double) $cartWeight, 'transactionAmount'=>(double) $transactionFee, 'offer'=>$offer ];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function checkoutConfirm(Request $request, $language)
    {
        // setSessionLanguage();

        // dd($request);
        $inputs = $request->all();
        $lastCreatedCartId = Cart::create($inputs)->cartId;

        DB::table('cart')->where('cartId', $lastCreatedCartId)
                         ->update(
                            [
                                'cartStatusId' => 1, //pending
                                'isCartApproved' => 1, //pending
                            ]
                         );

        DB::table('cartdetails')->where('customerId', Auth::user()->id)->where('cartId', null)
                                ->update(
                                    [
                                        'cartId' => $lastCreatedCartId,
                                    ]
                                );

        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'cartId' => $lastCreatedCartId, 
                'cartCreatedById' => Auth::user()->id, 
                'isCartUpdated' => 0,
                'message' => Auth::user()->email.' order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created!',
                'message2' => Auth::user()->email.' order '.process_order_number($lastCreatedCartId, \Carbon\Carbon::now()).' has been created! We will update you here soon. You can check your mail also for getting updates.',
            ],
        ]);
        // notifications_admin=============

        // notifications_customer=============
        DB::table('notifications')->insert([
            [
                'cartId' => $lastCreatedCartId, 
                'receiverId' => Auth::user()->id, 
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
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        // cart details and delivery details
        


        $mailsettingsData = DB::table('mailsettings')->first();

        $mailReceiverEmail = Auth::user()->email;
        $mailReceiverName = Auth::user()->name;
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

        return redirect(Route('home_f', $language))->with('message', 'Successfully order placed!')->with('orderId', $lastCreatedCartId);
    }



    public function customerOrderUpdate(Request $request, $language, $cartId)
    {
        // setSessionLanguage();

        $cartId = Crypt::decrypt($cartId);

        $inputs = $request->all();

        Cart::find($cartId)->update($inputs);
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        
        DB::table('cart')->where('cartId', $cartId)
                         ->update(
                            [
                                'cartStatusId' => 1, //pending
                                'isCartApproved' => 1, //pending
                                'updateCount' => $cartData->updateCount+1, //pending
                            ]
                         );


        $cartCreated_at = $cartData->created_at;


        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'cartId' => $cartId, 
                'cartCreatedById' => Auth::user()->id, 
                'isCartUpdated' => 1,
                'message' => Auth::user()->email.' Order '.process_order_number($cartId, $cartCreated_at).' has been updated!',
                
            ],
        ]);
        // notifications_admin=============

         // notifications to customer=============
         DB::table('notifications')->insert([
            [
                'cartId' => $cartId, 
                'receiverId' => Auth::user()->id, 
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been updated!',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).' has been updated! We will update you here soon. You can check your mail also for getting updates.',
            ],
        ]);
        // notifications=============

        // =========================notifications=======================


        //========== send mail========

        // cart details and delivery details
        $cartData = DB::table('cart')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        // cart details and delivery details


        $mailsettingsData = Cache::remember('mailsettingsData', 5, function () {
            return  DB::table('mailsettings')->first();
        });

        $mailReceiverEmail = Auth::user()->email;
        $mailReceiverName = Auth::user()->name;
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been updated!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).' has been updated! We will update you here soon. You can check your profile also for getting updates.';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========


        $previousUrl = app('url')->previous();
        $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        return redirect()->to($previousUrl.'?'. http_build_query([app()->getLocale()]))->with('orderId', $cartId);
    }


    public function customerPaymentReceiptUpload(Request $request, $language, $cartId)
    {
        // setSessionLanguage();
            
        $prescriptionLinks = '';

        $documentLinks ='';

        if ($request->paymentReceiptImagePath!=null) 
        {
            $batchNumber = DB::table('cartpaymentreceiptmessages')->selectRaw('max(ifnull(batch, 0)) as batchNumber')->pluck('batchNumber')->first();
            $batchNumber += 1 ;
            
            $index = 0;
            foreach($request->paymentReceiptImagePath as $paymentreceipt=>$v)
            {
                $index++;
                DB::table('cartpaymentreceiptmessages')->insert([
                    'batch'=>$batchNumber,
                    'reason' => $request->paymentReceiptMessage,
                    'cartId' => $cartId,
                    'userId' => Auth::user()->id,
                    'isCustomer' => 1,
                ]);
                $cartPaymentReceiptMessageId = DB::getPdo()->lastInsertId();
                

                $randomNumber = rand(99,99999);
                
                $file = $request->paymentReceiptImagePath[$paymentreceipt];
                $file->move('uploads/cart/paymentreceipt/', 'paymentreceipt_'.$cartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

                DB::table('cartpaymentreceiptmessages')->where('cartPaymentReceiptMessageId', $cartPaymentReceiptMessageId)
                ->update([
                    'picPath'=>'/uploads/cart/paymentreceipt/'.'paymentreceipt_'.$cartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()
                    ]);

                $documentLink = '/uploads/cart/paymentreceipt/'.'paymentreceipt_'.$cartPaymentReceiptMessageId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
                $documentLinks = $documentLinks.'<li>'.'<a href="'.url('/').$documentLink.'" target="_blank">'.'Click link file_'.$index.'</a></li>';
            }
        }

        DB::table('cart')->where('cartId', $cartId)->update([
            'isPaymentReceiptUploaded' => 1,
        ]);


        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartCreated_at = $cartData->created_at;
        // dd($cartData);

        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'cartId' => $cartId, 
                'cartCreatedById' => Auth::user()->id, 
                'isCartUpdated' => 1,
                'message' => Auth::user()->email.' Order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded!',
                'message2' => Auth::user()->email.' Order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded!',
                
            ],
        ]);
        // notifications_admin=============

         // notifications to customer=============
         DB::table('notifications')->insert([
            [
                'cartId' => $cartId, 
                'receiverId' => Auth::user()->id, 
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded!',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded! We will update you here soon. You can check your mail also for getting updates.',
            ],
        ]);
        // notifications=============

        // =========================notifications=======================


        //========== send mail========

        // cart details and delivery details
        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        // cart details and delivery details


        $mailsettingsData = Cache::remember('mailsettingsData', 5, function () {
            return  DB::table('mailsettings')->first();
        });


        $mailReceiverEmail = Auth::user()->email;
        $mailReceiverName = Auth::user()->name;
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s payment receipt information has been uploaded! We will update you here soon. You can check your mail also for getting updates.';
        $bodyMessage = $bodyMessage.'<br><br>'.'<table style="text-align: left;">
                                                    <tr>
                                                        <th>Message</th>
                                                        <td>'.$request->paymentReceiptMessage.'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Account Information Image Links</th>
                                                        <td >'.'<ul>'.$documentLinks.'</ul>'.'</td>
                                                    </tr>
                                                </table>';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        // $previousUrl = app('url')->previous();
        // $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        // return redirect()->to($previousUrl.'?'. http_build_query([app()->getLocale()]))->with('paymentReceiptUploaded', 1);

        // return redirect()->to('/'.'?'. http_build_query([app()->getLocale(), 'paymentReceiptUploaded'=> 1]))->with('paymentReceiptUploaded', 1);
        return redirect()->to(route('customerOrderHistory', $language).'?'. http_build_query([ 'paymentReceiptUploaded'=> 1]));

    }



    public function customerAddDeliveryInfo(Request $request, $language, $cartId)
    {
        // setSessionLanguage();

        $files ='';

        if ($request->picPath!=null) 
        {
            $batchNumber = DB::table('cartdeliveryinfo')->selectRaw('max(ifnull(batch, 0)) as batchNumber')->pluck('batchNumber')->first();
            $batchNumber += 1 ;
            
            $index = 0;
            foreach($request->picPath as $picpaths=>$v)
            {
                $index++;
                DB::table('cartdeliveryinfo')->insert([
                    'batch'=>$batchNumber,
                    'message' => $request->message,
                    'cartId' => $cartId,
                    'userId' => Auth::user()->id,
                    'isCustomer' => 1,
                ]);
                $cartDeliveryInfoId = DB::getPdo()->lastInsertId();
                
                $randomNumber = rand(99,99999);
                
                $file = $request->picPath[$picpaths];
                $file->move('uploads/cart/cartdeliveryinfo/', 'cartdeliveryinfo_'.$cartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

                DB::table('cartdeliveryinfo')->where('cartDeliveryInfoId', $cartDeliveryInfoId)
                ->update([
                    'picPath'=>'/uploads/cart/cartdeliveryinfo/'.'cartdeliveryinfo_'.$cartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()
                    ]);

                $filePath = '/uploads/cart/cartdeliveryinfo/'.'cartdeliveryinfo_'.$cartDeliveryInfoId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
                $files = $files.'<li><a href="'.url('/').$filePath.'" target="_blank">'.'Click link file_'.$index.'</a></li>';
            }
        }
        else{
            DB::table('cartdeliveryinfo')->insert([
                'message' => $request->message,
                'cartId' => $cartId,
                'userId' => Auth::user()->id,
                'isCustomer' => 1,
            ]);
        }

        DB::table('cart')->where('cartId', $cartId)->update([
            'isDeliveryInfoAdded' => 1,
        ]);



        $cartData = DB::table('cart')->where('cartId', $cartId)->first();
        $cartCreated_at = $cartData->created_at;
        // dd($cartData);

        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'cartId' => $cartId, 
                'cartCreatedById' => Auth::user()->id, 
                'isCartUpdated' => 1,
                'message' => Auth::user()->email.' Order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added!',
                
            ],
        ]);
        // notifications_admin=============

         // notifications to customer=============
         DB::table('notifications')->insert([
            [
                'cartId' => $cartId, 
                'receiverId' => Auth::user()->id, 
                'message' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added!',
                'message2' => 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery information has been added!',
            ],
        ]);
        // notifications=============

        // =========================notifications=======================


        //========== send mail========

        // cart details and delivery details
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->where('cartId', $cartId)->get();
        $countryData = Cache::remember('countryData', 10, function () {
            return DB::table('country')->get();
        });
        $deliverymethodsData = Cache::remember('deliverymethodsData', 10, function () {
            return DB::table('deliverymethod')->get();
        });
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        // cart details and delivery details


        $mailsettingsData = Cache::remember('mailsettingsData', 5, function () {
            return  DB::table('mailsettings')->first();
        });

        $mailReceiverEmail = Auth::user()->email;
        $mailReceiverName = Auth::user()->name;
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        $subject = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery  information has been added!';
        $bodyMessage = 'Your order '.process_order_number($cartId, $cartCreated_at).'\'s delivery  information has been added!'.'<br> Delivery Message : '.$request->message.'<br>'.'Image Links: <br>'.'<ul>'.$files.'</ul>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;

        mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData,$genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData);
        //========== send mail========

        // $previousUrl = app('url')->previous();
        // $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        // return redirect()->to($previousUrl.'?'. http_build_query([app()->getLocale()]))->with('customerAddDeliveryInfo', 1);
        // $previousUrl = app('url')->previous();
        // $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        return redirect()->to(route('customerOrderHistory', $language).'?'. http_build_query([ 'customerAddDeliveryInfo'=> 1]));
        // return redirect()->to($previousUrl)->with('customerAddDeliveryInfo', 1);
        // return back()->with('customerAddDeliveryInfo', 1);
    }

    // checkout page============================================
    // checkout page============================================


}
