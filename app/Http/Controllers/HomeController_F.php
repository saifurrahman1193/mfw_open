<?php
namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController_F extends Controller
{

   


    public function home_f( $language )
    {

        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });

        

        $genericbrandcategoryData = Cache::remember('genericbrandcategoryData', 100, function () {
            return DB::table("genericbrandcategory_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->get(); 
        });

        $genericbranddieseasecateprodData = Cache::remember('home_fgenericbranddiseasecategoryproducts_view', 100, function () {
            return DB::table("genericbranddiseasecategoryproducts_view")->where('isFrontendVisible', 1)->select('categoryId', 'diseaseCategoryId')->get(); 
        });

        $genericstrengthData = Cache::remember('genericstrengthData', 100, function () {
            return DB::table('genericbrandstrength_view')->get();
        });

        $topbrands_data = Cache::remember('topbrands_data', 100, function () {
            return DB::table('topbrands')->get(); 
        });

        $topbrands_data = Cache::remember('topbrands_data', 100, function () {
            return DB::table('topbrands_view')->get();
        });

        $banner_data = Cache::remember('banner_data', 100, function () {
            return DB::table('banner')->get();
        });

        $testimonial_data = Cache::remember('testimonial_data', 100, function () {
            return DB::table('testimonial_view')->get();
        });

        $slider_new_selling_products_data = Cache::remember('slider_new_selling_products_data', 100, function () {
            return DB::table('slider_new_selling_products_view')->where('isFrontendVisible', 1)->get();
        });

        $slider_best_selling_products_data = Cache::remember('slider_best_selling_products_data', 100, function () {
            return DB::table('slider_best_selling_products_view')->where('isFrontendVisible', 1)->get();
        });

        $mainsliders_data = Cache::remember('mainsliders_data', 100, function () {
            return DB::table('mainsliders')->get();
        });

        


        if (Auth::check()) 
        {
            if (request()->has('testimonialClientContactRequest') && request('testimonialClientContactRequest')!= null ) {
                DB::table('notifications')
                ->where('receiverId', Auth::user()->id)
                ->where('testimonialClientContactRequest', request('testimonialClientContactRequest'))
                ->update([
                    'read_at' => now()
                ]);
            }

            if (request()->has('testimonialAdminToClientContactRequest') && request('testimonialAdminToClientContactRequest')!= null ) {
                DB::table('notifications')
                ->where('receiverId', Auth::user()->id)
                ->where('testimonialAdminToClientContactRequest', request('testimonialAdminToClientContactRequest'))
                ->update([
                    'read_at' => now()
                ]);
            }

            $userData =  DB::table('users')->where('id', Auth::user()->id)->first();

            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');

            return view('frontend.home_f', compact('genericbrandData', 'genericbrandpicData', 'categoryData', 'diseasecategoryData', 'genericstrengthData', 'genericbrandcategoryData', 'menu_categories_f_Data', 'wishlistData', 'compareData', 'userData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','topbrands_data', 'banner_data', 'testimonial_data', 'slider_new_selling_products_data', 'slider_best_selling_products_data', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'mainsliders_data', 'genericbranddieseasecateprodData'));
        }
        else{
            return view('frontend.home_f', compact('genericbrandData', 'genericbrandpicData', 'categoryData', 'diseasecategoryData', 'genericstrengthData', 'genericbrandcategoryData', 'menu_categories_f_Data', 'wishlistData', 'compareData', 'genericstrengthCompactData',  'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','topbrands_data', 'banner_data', 'testimonial_data', 'slider_new_selling_products_data', 'slider_best_selling_products_data', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'mainsliders_data', 'genericbranddieseasecateprodData'));
            
        }

    }



    public function getHomeCategoryProducts($language, $categoryId) 
    {

        if ($categoryId>0) {
            if ($language=='en') 
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrand")->get();
            }
            elseif ($language=='ru')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->get();
            }
            elseif ($language=='cn')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->get();
            }
        }elseif ($categoryId==0) {
            if ($language=='en') 
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->groupBy('genericBrandId')->get();
            }
            elseif ($language=='ru')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->groupBy('genericBrandId')->get();
            }
            elseif ($language=='cn')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->groupBy('genericBrandId')->get();
            }
        }


        // return json_encode($genericBrands);
         $response = ["data" => $genericbrandcategoryproductsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        // return json_encode($genericBrands);
    }

    

    public function getHomeCategoryProductsWithPaginate($language='en', $categoryId) 
    {

        if ($categoryId>0) {
            if ($language=='en') 
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrand")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->paginate(20);
            }
            elseif ($language=='cn')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrandcategoryproducts_view")->where("categoryId", $categoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->paginate(20);
            }
        }elseif ($categoryId==0) {
            if ($language=='en') 
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->groupBy('genericBrandId')->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->groupBy('genericBrandId')->paginate(20);
            }
            elseif ($language=='cn')  
            {
                $genericbrandcategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->groupBy('genericBrandId')->paginate(20);
            }
        }


        // return json_encode($genericBrands);
         $response = ["data" => $genericbrandcategoryproductsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        // return json_encode($genericBrands);
    }

    public function getHomeDiseaseCategoryProducts($language, $diseaseCategoryId) 
    {
        if ($language=='en') 
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrand")->get();
        }
        elseif ($language=='ru')  
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->get();
        }
        elseif ($language=='cn')  
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->get();
        }


        // return json_encode($genericBrands);
         $response = ["data" => $genericbranddiseasecategoryproductsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        // return json_encode($genericBrands);
    }

    public function getHomeDiseaseCategoryProductsWithPaginate($language='en', $diseaseCategoryId) 
    {
        if ($language=='en') 
        {
            if ($diseaseCategoryId==0) {
                $genericbranddiseasecategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrand")->paginate(20);
            } else {
                $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrand")->paginate(20);
            }
            
        }
        elseif ($language=='ru')  
        {
            if ($diseaseCategoryId==0) {
                $genericbranddiseasecategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrandRU")->paginate(20);
            } else {
                $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->paginate(20);
            }
        }
        elseif ($language=='cn')  
        {
            if ($diseaseCategoryId==0) {
                $genericbranddiseasecategoryproductsData = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrandCN")->paginate(20);
            } else {
                $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("diseaseCategoryId", $diseaseCategoryId)->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->paginate(20);
            }
        }


        // return json_encode($genericBrands);
         $response = ["data" => $genericbranddiseasecategoryproductsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        // return json_encode($genericBrands);
    }


    public function productlistPageTopBrandsProductsWithPaginate($language='en', $genericCompanyId) 
    {
        if (app()->getLocale()=='en') 
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("genericCompanyId", $genericCompanyId)->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrand")->paginate(20);
        }
        elseif (app()->getLocale()=='ru')  
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("genericCompanyId", $genericCompanyId)->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrandRU")->paginate(20);
        }
        elseif (app()->getLocale()=='cn')  
        {
            $genericbranddiseasecategoryproductsData = DB::table("genericbranddiseasecategoryproducts_view")->where("genericCompanyId", $genericCompanyId)->where('isFrontendVisible', 1)->groupBy('genericBrandId')->orderBy("genericBrandCN")->paginate(20);
        }

        $response = ["data" => $genericbranddiseasecategoryproductsData];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    

    public function getHomeProductsWithPaginateWithSort($language='en', $sortId) 
    {
        // <option value="1">Sort by Generic Name Ascending</option>
        // <option value="2">Sort by Generic Name Descending</option>

        // <option value="3">Sort by Brand Name Ascending</option>
        // <option value="4">Sort by Brand Name Descending</option>
        
        // <option value="5">Sort by Company NameAscending</option>
        // <option value="6">Sort by Company NameDescending</option>

        // <option value="7">Sort by Review Ascending</option>
        // <option value="8">Sort by Review Descending</option>

        // <option value="9">Sort by Rating Ascending</option>
        // <option value="10">Sort by Rating Descending</option>
        
        if ($sortId==1) {
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericName")->paginate(20);
            }
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericNameCN")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericNameRU")->paginate(20);
            }
        } 
        else if($sortId==2){
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericName", "DESC")->paginate(20);
            }            
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericNameCN", "DESC")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericNameRU", "DESC")->paginate(20);
            }
        }
        else if($sortId==3){
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrand")->paginate(20);
            }            
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandCN")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandRU")->paginate(20);
            }
        }
        else if($sortId==4){
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrand", "DESC")->paginate(20);
            }            
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandCN", "DESC")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericBrandRU", "DESC")->paginate(20);
            }
        }
        else if($sortId==5){
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompany")->paginate(20);
            }            
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompanyCN")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompanyRU")->paginate(20);
            }
        }
        else if($sortId==6){
            if ($language=='en') 
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompany", "DESC")->paginate(20);
            }            
            elseif ($language=='cn')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompanyCN", "DESC")->paginate(20);
            }
            elseif ($language=='ru')  
            {
                $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("genericCompanyRU", "DESC")->paginate(20);
            }
        }
        else if($sortId==7){
            $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("rating")->paginate(20);
        }
        else if($sortId==8){
            $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("rating", "DESC")->paginate(20);
        }
        else if($sortId==9){
            $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("totalReview")->paginate(20);
        }
        else if($sortId==10){
            $products = DB::table("genericbrand_view")->where('isFrontendVisible', 1)->orderBy("totalReview", "DESC")->paginate(20);
        }
        

        $response = ["data" => $products];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    



    // set language
    public function frontendSetLanguage($lang) 
    {
        // session(['lang' => $lang]);

        $previousUrl = app('url')->previous();
        $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        return redirect()->to($previousUrl.'?'. http_build_query([app()->getLocale()]));
    }

    // set currency
    public function frontendSetCurrency($language, $currency) 
    {
        session(['currency' => $currency]);

        // $previousUrl = app('url')->previous();
        // $previousUrl = substr($previousUrl, 0, strpos($previousUrl, "?"));
        // return redirect()->to($previousUrl.'?'. http_build_query([app()->getLocale()]));
        return redirect()->route('home_f', $language);
    }


    public function contact_f( $language )
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        
        if (Auth::check()) 
        {
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
           
            return view('pages.contact_f', compact( 'categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'notificationData', 'userData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else{
            return view('pages.contact_f', compact( 'categoryData',  'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
    }

    public function sitemap_f( $language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        
        if (Auth::check()) 
        {
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
           
            return view('pages.sitemap_f', compact( 'categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'notificationData', 'userData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else{
            return view('pages.sitemap_f', compact( 'categoryData',  'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
    }


    public function compare_f($language )
    {
        // setSessionLanguage();
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');

        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get();  
        });

        $genericbrand_packsizes_data = Cache::remember('genericbrand_packsizes_data', 100, function () {
            return DB::table('genericbrand_packsizes_view')->get();
        });

        $availabilitytypeData = Cache::remember('availabilitytypeData', 100, function () {
            return DB::table('availabilitytype')->get();
        });
        
        $genericpacksizes_with_customer_price_view_data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();

        
        
        if (Auth::check()) 
        {
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            return view('pages.compare_f', compact( 'categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'notificationData', 'userData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandData', 'genericbrand_packsizes_data', 'genericpacksizes_with_customer_price_view_data', 'availabilitytypeData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else{
            return view('pages.compare_f', compact( 'categoryData',  'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandData', 'genericbrand_packsizes_data', 'genericpacksizes_with_customer_price_view_data', 'availabilitytypeData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
            
        }

    }


}
