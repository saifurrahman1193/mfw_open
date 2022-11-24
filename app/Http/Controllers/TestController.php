<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Input;
use DB;
use Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;


class TestController extends Controller
{
    
    public function test()
    {
        return strip_except_english('English= hello world 1234 .0-+$ ,  '.'Russian = Привет мир , chinese = 你好，世界');
    }

    public function testData()
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        // prerequisite data
          
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get(); 
        });
         

        return view('test.test', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData',     'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData' , 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }


}
