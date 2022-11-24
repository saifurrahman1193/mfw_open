<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FooterThirdFourthPortion;
use App\FooterPortion1;
use App\FooterPortion1Socials;
use App\FooterPortion2Pages;
use App\FooterPortion3Categories;
use App\FooterPortion4;
use App\FooterPortion4Socials;
use App\BottomFooter;


use DB;

class FooterController extends Controller
{

    // ============= footer ===================
    // ============= footer ===================
    public function thirdFourthPortion()
    {
        $categoryData = DB::table('category')->get();
        $footerthirdfourthportionData = DB::table('footerthirdfourthportion')->first();
        return view('footer.thirdFourthPortion', compact('categoryData', 'footerthirdfourthportionData'));
    }
    

    public function thirdFourthPortionUpdate(Request $request )
    {
        FooterThirdFourthPortion::find(1)->update($request->all());  
        return back()->with('successMsg', 'Footer third and fourth portion Successfully updated !!');
    }

   
    // ============= footer ===================
    // ============= footer ===================


    // ============= portion 1 ===================
    // ============= portion 1 ===================
    public function portion1()
    {
        $footerportion1Data = DB::table('footerportion1')->first();
        return view('footer.portion1', compact('footerportion1Data'));
    }
    
    public function portion1Update(Request $request )
    {
        FooterPortion1::find(1)->update($request->all());  
        return back()->with('successMsg', 'Footer portion 1 Successfully updated !!');
    }

    // socials
    public function portion1socials()
    {
        $footerportion1socialsData = DB::table('footerportion1socials_view')->get();
        $socialmediaData = DB::table('socialmedia_view')->get();

        return view('footer.portion1socials', compact('footerportion1socialsData', 'socialmediaData'));
    }
    
    public function portion1socialsUpdate(Request $request )
    {
        FooterPortion1Socials::where('socialMediaId', '>', 0)->delete();

        if ($request->socialMediaId != null) {
            foreach($request->socialMediaId as $portion1socialmedias=>$v)
            {
                $portion1socialmediaData=array
                (
                    'socialMediaId'=>$request->socialMediaId[$portion1socialmedias],
                );
                FooterPortion1Socials::insert($portion1socialmediaData);
            }
        }

        return back()->with('successMsg', 'Footer portion 1 Socials Successfully updated !!');
    }

   
    // ============= portion 1 ===================
    // ============= portion 1 ===================


    // ============= portion 2 ===================
    // ============= portion 2 ===================

    // socials
    public function portion2pages()
    {
        $footerportion2pagesData = DB::table('footerportion2pages_view')->get();
        $pagesData = DB::table('pages')->get();

        return view('footer.portion2pages', compact('footerportion2pagesData', 'pagesData'));
    }
    
    public function portion2pagesUpdate(Request $request )
    {
        FooterPortion2Pages::where('pageId', '>', 0)->delete();

        if ($request->pageId != null) {
            foreach($request->pageId as $portion2pages=>$v)
            {
                $portion2pagesData=array
                (
                    'pageId'=>$request->pageId[$portion2pages],
                );
                FooterPortion2Pages::insert($portion2pagesData);
            }
        }

        return back()->with('successMsg', 'Footer portion 2 Successfully updated !!');
    }

   
    // ============= portion 2 ===================
    // ============= portion 2 ===================



    // ============= portion 3 ===================
    // ============= portion 3 ===================

    // socials
    public function portion3categories()
    {
        $footerportion3categoriesData = DB::table('footerportion3categories_view')->get();
        $categoryData = DB::table('category')->get();

        return view('footer.portion3categories', compact('footerportion3categoriesData', 'categoryData'));
    }
    
    public function portion3categoriesUpdate(Request $request )
    {
        FooterPortion3Categories::where('categoryId', '>', 0)->delete();

        if ($request->categoryId != null) {
            foreach($request->categoryId as $portion3categories=>$v)
            {
                $portion3categoriesData=array
                (
                    'categoryId'=>$request->categoryId[$portion3categories],
                );
                FooterPortion3Categories::insert($portion3categoriesData);
            }
        }

        return back()->with('successMsg', 'Footer portion 3 Successfully updated !!');
    }

   
    // ============= portion 3 ===================
    // ============= portion 3 ===================




    // ============= portion 4 ===================
    // ============= portion 4 ===================
    public function portion4()
    {
        $footerportion4Data = DB::table('footerportion4')->first();
        return view('footer.portion4', compact('footerportion4Data'));
    }
    
    public function portion4Update(Request $request )
    {
        FooterPortion4::find(1)->update($request->all());  
        return back()->with('successMsg', 'Footer portion 4 Successfully updated !!');
    }

    // socials
    public function portion4socials()
    {
        $footerportion4socialsData = DB::table('footerportion4socials_view')->get();
        $socialmediaData = DB::table('socialmedia_view')->get();

        return view('footer.portion4socials', compact('footerportion4socialsData', 'socialmediaData'));
    }
    
    public function portion4socialsUpdate(Request $request )
    {
        FooterPortion4Socials::where('socialMediaId', '>', 0)->delete();

        if ($request->socialMediaId != null) {
            foreach($request->socialMediaId as $portion4socialmedias=>$v)
            {
                $portion4socialmediaData=array
                (
                    'socialMediaId'=>$request->socialMediaId[$portion4socialmedias],
                );
                FooterPortion4Socials::insert($portion4socialmediaData);
            }
        }

        return back()->with('successMsg', 'Footer portion 4 Socials Successfully updated !!');
    }

   
    // ============= portion 4 ===================
    // ============= portion 4 ===================




    public function bottomFooter()
    {
        $bottomfooterData = DB::table('bottomfooter')->first();
        return view('footer.bottomfooter', compact('bottomfooterData'));
    }
    
    public function bottomFooterUpdate(Request $request )
    {
        BottomFooter::find(1)->update($request->all());  
        return back()->with('successMsg', 'Bottom Footer  Successfully updated !!');
    }



}
