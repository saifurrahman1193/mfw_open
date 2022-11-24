<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use Helper;


class SearchController_F extends Controller
{

    
    public function autoCompleteAjax(Request $request, $language)
    {
        $search=  $request->term;

        // $genericBrandData = DB::table('genericbrand_view')->pluck('genericBrand'))->unique())->sortBy('genericBrand')
        
        // $genericBrands = DB::table('search_view')->where('genericBrand','LIKE',"%{$search}%")->orderBy('created_at','DESC')->limit(5)->get();
        

        
        $genericBrands = DB::table('search_view')

                        ->where('genericBrand','LIKE',"%{$search}%")
                        ->orWhere('genericCompany','LIKE',"%{$search}%")
                        ->orWhere('genericName','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompany','LIKE',"%{$search}%")
                        ->orWhere('category','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategory','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosage','LIKE',"%{$search}%")

                        ->orWhere('genericBrandCN','LIKE',"%{$search}%")
                        ->orWhere('genericCompanyCN','LIKE',"%{$search}%")
                        ->orWhere('genericNameCN','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompanyCN','LIKE',"%{$search}%")
                        ->orWhere('categoryCN','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategoryCN','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosageCN','LIKE',"%{$search}%")

                        ->orWhere('genericBrandRU','LIKE',"%{$search}%")
                        ->orWhere('genericCompanyRU','LIKE',"%{$search}%")
                        ->orWhere('genericNameRU','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompanyRU','LIKE',"%{$search}%")
                        ->orWhere('categoryRU','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategoryRU','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosageRU','LIKE',"%{$search}%")
                        
                        ->orWhere('searchTags','LIKE',"%{$search}%")
                        ->orWhere('searchTagsCN','LIKE',"%{$search}%")
                        ->orWhere('searchTagsRU','LIKE',"%{$search}%")

                        ->orWhere('categoryId', (int) Request('categoryId'))


                        ->groupBy('genericBrandId')
                        // ->limit(5)
                        ->get();
                        // ->paginate(5);

        $genericBrandSingle = DB::table('search_view')->where('genericBrand','LIKE',"%{$search}%")->where('isFrontendVisible', 1)->first();
        $genericBrandSingleFound = 0;
        if (isset($genericBrandSingle->genericBrand) && $genericBrandSingle->genericBrand!=null) {
            $genericBrandSingleFound=1;
        }
        


        if(!$genericBrands->isEmpty())
        {
            $serial = 1;
            if($genericBrandSingleFound==1)
            {
                $genericBrands = $genericBrands->where('genericBrandId', '!=', $genericBrandSingle->genericBrandId);
                $row_set[] = self::processGenericBrandObjForSearch($language, $genericBrandSingle, $serial);
                $serial=2;
            }else{
                $serial=1; 
            }

            $genericBrands = $genericBrands->where('isFrontendVisible', 1);
            
            foreach($genericBrands as $genericbrand)
            {
                $row_set[] = self::processGenericBrandObjForSearch($language, $genericbrand, $serial);
                $serial++;
            }
        }
        
        echo json_encode($row_set); 
    }


    public function autoCompleteAjax2(Request $request, $language)
    {
        // dd((int) (int) Request('categoryId'));
        $search=  $request->term;

        // $genericBrandData = DB::table('genericbrand_view')->pluck('genericBrand'))->unique())->sortBy('genericBrand')
        
        // $genericBrands = DB::table('search_view')->where('genericBrand','LIKE',"%{$search}%")->orderBy('created_at','DESC')->limit(5)->get();
        
        // $genericBrands = DB::table('search_view')->where('categoryId', (int) Request('categoryId'))->get();

        $genericBrands = DB::table('search_view')

                        ->orWhere('genericBrand','LIKE',"%{$search}%")
                        ->orWhere('genericCompany','LIKE',"%{$search}%")
                        ->orWhere('genericName','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompany','LIKE',"%{$search}%")
                        ->orWhere('category','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategory','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosage','LIKE',"%{$search}%")

                        ->orWhere('genericBrandCN','LIKE',"%{$search}%")
                        ->orWhere('genericCompanyCN','LIKE',"%{$search}%")
                        ->orWhere('genericNameCN','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompanyCN','LIKE',"%{$search}%")
                        ->orWhere('categoryCN','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategoryCN','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosageCN','LIKE',"%{$search}%")

                        ->orWhere('genericBrandRU','LIKE',"%{$search}%")
                        ->orWhere('genericCompanyRU','LIKE',"%{$search}%")
                        ->orWhere('genericNameRU','LIKE',"%{$search}%")
                        ->orWhere('globalTradeNameCompanyRU','LIKE',"%{$search}%")
                        ->orWhere('categoryRU','LIKE',"%{$search}%")
                        ->orWhere('diseaseCategoryRU','LIKE',"%{$search}%")
                        ->orWhere('indicationanddosageRU','LIKE',"%{$search}%")
                        
                        ->orWhere('searchTags','LIKE',"%{$search}%")
                        ->orWhere('searchTagsCN','LIKE',"%{$search}%")
                        ->orWhere('searchTagsRU','LIKE',"%{$search}%")


                        ->groupBy('genericBrandId')
                        // ->limit(5)
                        ->get();

                        // ->paginate(5);
        $genericBrands = $genericBrands->where('categoryId', (int) Request('categoryId'));

        $genericBrandSingle = DB::table('search_view')->where('categoryId', (int) Request('categoryId'))->where('genericBrand','LIKE',"%{$search}%")->where('isFrontendVisible', 1)->first();

        // dd($genericBrands);

        $genericBrandSingleFound = 0;
        if (isset($genericBrandSingle->genericBrand) && $genericBrandSingle->genericBrand!=null) {
            $genericBrandSingleFound=1;
        }


        if(!$genericBrands->isEmpty())
        {
            $serial = 1;
            if($genericBrandSingleFound==1)
            {
                $genericBrands = $genericBrands->where('genericBrandId', '!=',$genericBrandSingle->genericBrandId);
                $row_set[] = self::processGenericBrandObjForSearch($language, $genericBrandSingle, $serial);
                $serial=2;
            }else{
                $serial=1;
            }
            foreach($genericBrands as $genericbrand)
            {
                $row_set[] = self::processGenericBrandObjForSearch($language, $genericbrand, $serial);
                $serial++;
            }
        }
        if (isset($row_set)) {
            echo json_encode($row_set); 
        }
        else {
            echo json_encode([]); 
        }
        
    }

    public function processGenericBrandObjForSearch($language, $genericbrand, $serial){
        if ($language=='en') 
        {
            $new_row['title']= $genericbrand->genericBrand.' ('.$genericbrand->genericName.' '.$genericbrand->genericStrength.')';
            $new_row['genericcompany']= $genericbrand->genericCompany;
            $new_row['genericname']= $genericbrand->genericName;
            $new_row['originator']= $genericbrand->globalTradeNameCompany;
        }
        else if ($language=='cn') 
        {
            $new_row['title']= $genericbrand->genericBrandCN.' ('.$genericbrand->genericNameCN.' '.$genericbrand->genericStrengthCN.')';
            $new_row['genericcompany']= $genericbrand->genericCompanyCN;
            $new_row['genericname']= $genericbrand->genericNameCN;
            $new_row['originator']= $genericbrand->globalTradeNameCompanyCN;
        }
        else if ($language=='ru') 
        {
            $new_row['title']= $genericbrand->genericBrandRU.' ('.$genericbrand->genericNameRU.' '.$genericbrand->genericStrengthRU.')';
            $new_row['genericcompany']= $genericbrand->genericCompanyRU;
            $new_row['genericname']= $genericbrand->genericNameRU;
            $new_row['originator']= $genericbrand->globalTradeNameCompanyRU;
        }
        
        // $new_row['image']= Helper::catch_first_image($genericbrand->picPath);
        $new_row['serial']= $serial;
        $new_row['image']= asset($genericbrand->picPath);
        // $new_row['url']= url($genericbrand->picPath);
        $new_row['url']= url('/'.$language.'/productDetailsPageCaller/'.$genericbrand->genericBrandId);
        // $new_row['genericBrandId']= url($genericbrand->genericBrandId);
        
        return $new_row;
    }


}
