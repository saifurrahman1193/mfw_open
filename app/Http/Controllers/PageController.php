<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pages;
use DB;
use Auth;

class PageController extends Controller
{


    // ============= pages ===================
    // ============= pages ===================
    public function pages()
    {
        $pagesData =  DB::table('pages')->get();
        return view('pages.pages', compact('pagesData'));
    }

    public function pageInsert(Request $request)
    {
        $inputs = $request->all();
        Pages::create($inputs);

        return back()->with('successMsg', 'Page Successfully Inserted !!');
    }

    public function pageEdit($pageId)
    {
        $pageData =  DB::table('pages')->where('pageid', $pageId)->first();
        return view('pages.pageEdit', compact('pageData'));
    }

    public function pageUpdate(Request $request , $pageId)
    {
        Pages::find($pageId)->update($request->all());  

        if (isset($request->pageDesc) || isset($request->pageDescCN) || isset($request->pageDescRU)) 
        {
            Pages::find($pageId)->update([
                "pageDesc" => trim($request->pageDesc),
                "pageDescCN" => trim($request->pageDescCN),
                "pageDescRU" => trim($request->pageDescRU)
            ]);
        }
        return back()->with('successMsg', 'Page Successfully updated !!');
    }

    public function pageDelete($pageId)
    {
        Pages::find($pageId)->delete();
        return back()->with('successMsg', 'Page successfully deleted !!');
    }

    // ============= pages ===================
    // ============= pages ===================





    // ============= page front ===================
    // ============= page front ===================
    public function dynamicPageFront($language='en', $pageId)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        // primary data
        
        $pageData =  DB::table('pages')->where('pageId', $pageId)->first();
        
        $pageURL = str_replace(' ', '-', $pageData->pageTitle);

        return redirect()->route('dpf', array($language,  'pageURL'=>$pageURL, 'pageId'=>$pageData->pageId));
    }


    public function dpf($language='en', $pageURL, $pageId)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
        // primary data
        
        $pageData =  DB::table('pages')->where('pageId', $pageId)->first();
        
        if (Auth::check()) 
        {
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            return view('pages.dynamicPageFront', compact('pageData', 'categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'notificationData', 'userData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else{
            return view('pages.dynamicPageFront', compact('pageData', 'categoryData',  'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));

        }

    }
    // ============= page front ===================
    // ============= page front ===================
    
    
    
    
    
}
