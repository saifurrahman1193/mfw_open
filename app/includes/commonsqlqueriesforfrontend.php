<?php

    $countryData = Cache::rememberForever('countryData',  function () {
        return DB::table('country')->get();
    });

    $footerportion1Data = Cache::rememberForever('footerportion1Data', function () {
        return DB::table('footerportion1')->first();
    });

    $footerportion1socialsData = Cache::rememberForever('footerportion1socialsData',  function () {
        return DB::table('footerportion1socials_view')->get();
    });

    $footerportion2pagesData = Cache::rememberForever('footerportion2pagesData', function () {
        return DB::table('footerportion2pages_view')->get();
    });

    $footerportion3categoriesData = Cache::rememberForever('footerportion3categoriesData', function () {
        return DB::table('footerportion3categories_view')->get();
    });

    $footerportion4Data = Cache::rememberForever('footerportion4Data',  function () {
        return DB::table('footerportion4')->first();
    });

    $footerportion4socialsData = Cache::rememberForever('footerportion4socialsData',  function () {
        return DB::table('footerportion4socials_view')->get();
    });


    $reviewData =  DB::table('review_view')->get(); 

    $reviewsData = DB::table('reviews_view')->get(); 

    $genericbrandpicData = Cache::rememberForever('genericbrandpicData',  function () {
        return  DB::table('genericbrandpic')->select('genericBrandPicId', 'genericBrandId', 'picPath')->get();
    });

    $genericstrengthCompactData = Cache::rememberForever('genericstrengthCompactData',  function () {
        return  DB::table('genericbrandstrength_compact_view')->get();
    });

    $categoryData = Cache::rememberForever('categoryData',  function () {
        return  DB::table('category')->get(); 
    });

    $menu_categories_f_Data = Cache::rememberForever('menu_categories_f_Data',  function () {
        return  DB::table('menu_categories_f')->get(); 
    });

    $diseasecategoryData = Cache::rememberForever('diseasecategoryData',  function () {
        return  DB::table('diseasecategory')->get();
    });


    $footer_slider_best_selling_product = Cache::rememberForever('footer_slider_best_selling_product',  function () {
        return DB::table('slider_best_selling_products_view')->where('isFrontendVisible', 1)->where('genericBrandId','!=', null )->distinct('genericBrandId')->take(3)->inRandomOrder()->get();
    });

    $footer_slider_new_selling_product = Cache::rememberForever('footer_slider_new_selling_product',  function () {
        return DB::table('slider_new_selling_products_view')->where('isFrontendVisible', 1)->where('genericBrandId','!=', null )->distinct('genericBrandId')->take(3)->inRandomOrder()->get();
    });

    $topoffooter4thportion_category_products_data = Cache::rememberForever('topoffooter4thportion_category_products_data',  function () {
        return DB::table('topoffooter4thportion_category_products_view')->where('isFrontendVisible', 1)->where('genericBrandId','!=', null )->distinct('genericBrandId')->take(3)->inRandomOrder()->get();
    });

    $bottomfooter_data = Cache::rememberForever('bottomfooter_data',  function () {
        return DB::table('bottomfooter')->get();
    });

    $topoffooter3rdportion_category_products_data = Cache::rememberForever('topoffooter3rdportion_category_products_data',  function () {
        return DB::table('topoffooter3rdportion_category_products_view')->where('isFrontendVisible', 1)->where('genericBrandId','!=', null )->distinct('genericBrandId')->take(3)->inRandomOrder()->get();
    });

    $topoffooter3rdportion_category_products_data = Cache::rememberForever('topoffooter3rdportion_category_products_data',  function () {
        return DB::table('topoffooter3rdportion_category_products_view')->where('isFrontendVisible', 1)->where('genericBrandId','!=', null )->distinct('genericBrandId')->take(3)->inRandomOrder()->get();
    });


    
    $wishlistData = DB::table('wishlist_view')->get();
    $compareData = DB::table('compare')->get();

?>