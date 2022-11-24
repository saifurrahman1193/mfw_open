<?php

namespace App\Http\Controllers;

use DB;

use Validator;
use App\Generic;
use App\Category;
use App\PackTypes;
use App\DosageForm;
use \Input as Input;
use App\GenericBrand;
use App\GenericCompany;
use \Gumlet\ImageResize;
use App\DiseaseCategory;
use App\GenericBrandPic;
use App\GenericStrength;
use App\GenericPackSizes;
use App\GenericBrandVideos;
use Illuminate\Http\Request;

use App\Genericforallproduct;

use App\SupplierGenericPrices;


use App\GenericBrandDiseaseCategory;


use Illuminate\Support\Facades\Auth;




use Illuminate\Support\Facades\Cache;
use App\GenPackSizeGlobalMarketPrices;


class GenericsController extends Controller
{

    // generic settings page start====================
    // generic settings page start====================

    public function genericSettingIndex()
    {
        $genericCompanyData = DB::table('genericcompany_view')->get();
        $diseaseCategoryData = DB::table('diseasecategory_view')->get();
        $categoryData = DB::table('category')->get();

        $dosageForms = DB::table('dosageform_view')->get();
        $genericstrengths = DB::table('genericstrength_view')->get();

        $packtypeData = DB::table('packtypes_view')->get();


        return view('generics/genericsSettings', compact('genericCompanyData', 'diseaseCategoryData', 'dosageForms', 'genericstrengths', 'packtypeData', 'categoryData'));
    }



        // generic settings => generic company  portion  start ====================
        // generic settings => generic company  portion  start ====================

        public function genericCompanyInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericCompany' => 'required|unique:genericcompany'
                ],
                [  
                    'genericCompany.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = GenericCompany::create($inputs);
            return redirect(Route('generics.settings.index').'?#genericcompanytable')->with('successMsg', 'New Generic Company successfully added!');
        }

        public function genericCompanyUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericCompany' => 'required|unique:genericcompany,genericCompany,'.$request->genericCompanyId.',genericCompanyId'
                ],
                [  
                    'genericCompany.unique' => 'Duplicate record already exist!',
                ]
            );

            GenericCompany::find($request->genericCompanyId)->update($request->all()); 
            return redirect(Route('generics.settings.index').'?#genericcompanytable')->with('successMsg', 'Generic Company successfully updated!');
        }

        public function genericCompanyDelete($genericCompanyId)
        {
            GenericCompany::find($genericCompanyId)->delete(); 
            return redirect(Route('generics.settings.index').'?#genericcompanytable')->with('successMsg', 'Generic Company successfully deleted!');
        }

        // generic settings => generic company  portion  end ====================
        // generic settings => generic company  portion  end ====================



        // generic settings => category  portion  start ====================
        // generic settings => category  portion  start ====================

        public function categoryInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'category' => 'required|unique:category'
                ],
                [  
                    'category.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = Category::create($inputs);
            return redirect(Route('generics.settings.index').'?#categorytable')->with('successMsg', 'New Category successfully added!');
        }

        public function categoryUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'category' => 'required|unique:category,category,'.$request->categoryId.',categoryId'
                ],
                [  
                    'category.unique' => 'Duplicate record already exist!',
                ]
            );

            Category::find($request->categoryId)->update($request->all()); 
            return redirect(Route('generics.settings.index').'?#categorytable')->with('successMsg', 'Category successfully updated!');
        }

        public function categoryDelete($categoryId)
        {
            Category::find($categoryId)->delete(); 
            return redirect(Route('generics.settings.index').'?#categorytable')->with('successMsg', 'Category successfully deleted!');
        }

        // generic settings =>  category  portion  end ====================
        // generic settings =>  category  portion  end ====================





        // generic settings => disease category  portion  start ====================
        // generic settings => disease category  portion  start ====================

        public function diseaseCategoryInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'diseaseCategory' => 'required|unique:diseasecategory'
                ],
                [  
                    'diseaseCategory.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = DiseaseCategory::create($inputs);
            return redirect(Route('generics.settings.index').'?#diseasecategorytable')->with('successMsg', 'New Disease Category successfully added!');
        }

        public function diseaseCategoryUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'diseaseCategory' => 'required|unique:diseasecategory,diseaseCategory,'.$request->diseaseCategoryId.',diseaseCategoryId'
                ],
                [  
                    'diseaseCategory.unique' => 'Duplicate record already exist!',
                ]
            );

            DiseaseCategory::find($request->diseaseCategoryId)->update($request->all()); 
            return redirect(Route('generics.settings.index').'?#diseasecategorytable')->with('successMsg', 'Disease Category successfully updated!');
        }

        public function diseaseCategoryDelete($diseaseCategoryId)
        {
            DiseaseCategory::find($diseaseCategoryId)->delete(); 
            return redirect(Route('generics.settings.index').'?#diseasecategorytable')->with('successMsg', 'Disease Category successfully deleted!');
        }

        // generic settings => disease category  portion  end ====================
        // generic settings => disease category  portion  end ====================




        // generic settings => generic portion  start ====================
        // generic settings => generic portion  start ====================

        public function genericIndex()
        {
            $genericsData = DB::table('generic_view')->get();

            return view('generics/genericlist', compact( 'genericsData'));
        }

        public function genericInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericName' => 'required|unique:generic'
                ],
                [  
                    'genericName.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = Generic::create($inputs);
            return redirect(Route('generics.generics.index'))->with('successMsg', 'New generic successfully added!');
        }

        
        public function genericUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericName' => 'required|unique:generic,genericName,'.$request->genericId.',genericId'
                ],
                [  
                    'genericName.unique' => 'Duplicate record already exist!',
                ]
            );

            Generic::find($request->genericId)->update($request->all()); 
            return redirect(Route('generics.generics.index'))->with('successMsg', 'Generic successfully updated!');
        }

        public function genericDelete($genericId)
        {
            Generic::find($genericId)->delete(); 
            return redirect(Route('generics.generics.index'))->with('successMsg', 'Generic successfully deleted!');
        }

        // generic settings => generic portion  end ====================
        // generic settings => generic portion  end ====================




        // generic settings => dosage form portion  start ====================
        // generic settings => dosage form portion  start ====================

        public function dosageFormInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'dosageForm' => 'required|unique:dosageform'
                ],
                [  
                    'dosageForm.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = DosageForm::create($inputs);
            return redirect(Route('generics.settings.index').'?#dosageformtable')->with('successMsg', 'New Dosage Form successfully added!');
        }

        public function dosageFormUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'dosageForm' => 'required|unique:dosageform,dosageForm,'.$request->dosageFormId.',dosageFormId'
                ],
                [  
                    'dosageForm.unique' => 'Duplicate record already exist!',
                ]
            );

            DosageForm::find($request->dosageFormId)->update($request->all()); 
            return redirect(Route('generics.settings.index').'?#dosageformtable')->with('successMsg', 'Dosage Form successfully updated!');
        }

        public function dosageFormDelete($dosageFormId)
        {
            DosageForm::find($dosageFormId)->delete(); 
            return redirect(Route('generics.settings.index').'?#dosageformtable')->with('successMsg', 'Dosage Form successfully deleted!');
        }

        // generic settings => dosage form portion  end ====================
        // generic settings => dosage form portion  end ====================




        // generic settings => generic strength  portion  start ====================
        // generic settings => generic strength  portion  start ====================

        public function genericStrengthInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericStrength' => 'required|unique:genericstrength'
                ],
                [  
                    'genericStrength.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = GenericStrength::create($inputs);
            return redirect(Route('generics.settings.index').'?#genericstrengthtable')->with('successMsg', 'New Generic strength successfully added!');
        }

        public function genericStrengthUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'genericStrength' => 'required|unique:genericstrength,genericStrength,'.$request->genericStrengthId.',genericStrengthId'
                ],
                [  
                    'genericStrength.unique' => 'Duplicate record already exist!',
                ]
            );

            GenericStrength::find($request->genericStrengthId)->update($request->all()); 
            return redirect(Route('generics.settings.index').'?#genericstrengthtable')->with('successMsg', 'Generic strength successfully updated!');
        }

        public function genericStrengthDelete($genericStrengthId)
        {
            GenericStrength::find($genericStrengthId)->delete(); 
            return redirect(Route('generics.settings.index').'?#genericstrengthtable')->with('successMsg', 'Generic strength successfully deleted!');
        }

        // generic settings => generic strength  portion  end ====================
        // generic settings => generic strength  portion  end ====================







        // generic settings => pack types  portion  start ====================
        // generic settings => pack types  portion  start ====================

        public function packTypeInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'packType' => 'required|unique:packtypes'
                ],
                [  
                    'packType.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = PackTypes::create($inputs);

            $packTypeId = DB::getPdo()->lastInsertId();

            // dd($packTypeId);
            

            if($request->weightGM != null)
            {
                DB::table('weight')->insert([
                    'weightGM' => $request->weightGM ,
                    'packTypeId' => $packTypeId 
                ]);
            }

            return redirect(Route('generics.settings.index').'?#packtypestable')->with('successMsg', 'New Pack type successfully added!');
        }

        public function packTypeUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'packType' => 'required|unique:packtypes,packType,'.$request->packTypeId.',packTypeId'
                ],
                [  
                    'packType.unique' => 'Duplicate record already exist!',
                ]
            );

            PackTypes::find($request->packTypeId)->update($request->all()); 

            if($request->weightGM != null)
            {
                DB::table('weight')
                ->where('packTypeId', $request->packTypeId)
                ->update([
                    'weightGM' => $request->weightGM ,
                ]);
            }

            return redirect(Route('generics.settings.index').'?#packtypestable')->with('successMsg', 'Pack type successfully updated!');
        }

        public function packTypeDelete($packTypeId)
        {
            PackTypes::find($packTypeId)->delete(); 
            return redirect(Route('generics.settings.index').'?#packtypestable')->with('successMsg', 'Pack Type successfully deleted!');
        }

        // generic settings => pack types  portion  end ====================
        // generic settings => pack types  portion  end ====================




        // generic settings => generic pack sizes  portion  start ====================
        // generic settings => generic pack sizes  portion  start ====================

        public function genericBrandPriceListIndex()
        {
            $genericPackSizesData = DB::table('genericpacksizes_view')->get();
            $genericbrandpicData = DB::table('genericbrandpic')->get();
            $availabilitytypeData = DB::table('availabilitytype')->get();
            $genpacksizeglobalmarketpricesData = DB::table('genpacksizeglobalmarketprices')->get();
            $sppliergenericpricesData = DB::table('sppliergenericprices_view')->get();

            return view('generics/genericpacksizelist', compact( 'genericPackSizesData', 'availabilitytypeData', 'genericbrandpicData', 'genpacksizeglobalmarketpricesData', 'sppliergenericpricesData'));
        }


        public function genericPackSizesCreate()
        {
            $packTypesData = DB::table('packtypes')->get();
            $genericbrandData = DB::table('genericbrand')->get();
            $generic_Data = DB::table('generic_view')->get();
            $genericstrengthData = DB::table('genericstrength')->get();
            $availabilitytypeData = DB::table('availabilitytype')->get();
            $dosageformData = DB::table('dosageform')->get();

            return view('generics.genericPackSizesCreate', compact('packTypesData', 'genericbrandData', 'generic_Data', 'genericstrengthData', 'availabilitytypeData', 'dosageformData'));
        }


        public function genericPackSizesInsert(Request $request)
        {
            
            $inputs = $request->all();

            // dd($inputs);
            
            $lastCreatedGenericPackSizeId = GenericPackSizes::create($inputs)->genericPackSizeId;

            if ($request->site!=null) 
            {
                foreach($request->site as $sites=>$v)
                {
                    $sitesData=array
                    (
                        'genericPackSizeId'=>$lastCreatedGenericPackSizeId,
                        'site'=>$request->site[$sites],
                        'price'=>$request->price[$sites],
                    );
                    GenPackSizeGlobalMarketPrices::insert($sitesData);
                }
            }


            if ($request->moq!=null) 
            {
                foreach($request->moq as $moqs=>$v)
                {
                    $moqsData=array
                    (
                        'genericPackSizeId'=>$lastCreatedGenericPackSizeId,
                        'supplierId'=>$request->supplierId[$moqs],
                        'moq'=>$request->moq[$moqs],
                        'buyingPrice'=>$request->buyingPrice[$moqs],
                        'buyingDate'=>dmyToYmd($request->buyingDate[$moqs]),
                        'note'=>$request->note[$moqs],
                    );
                    SupplierGenericPrices::insert($moqsData);
                }
            }

                Generic::where('genericId', $request->genericId)->update(['avgPriceOfOriginator'=>$request->avgPriceOfOriginator]);

            return back()->with('successMsg', 'Generic pack sizes successfully added !!');
        }



        public function genericPackSizesEdit($genericPackSizeId)
        {
            $generic_Data = DB::table('generic_view')->get();

            $packTypesData = DB::table('packtypes')->get();
            $genericbrandData = DB::table('genericbrand')->get();
            $genericpacksizesData = DB::table('genericpacksizes_view')->where('genericPackSizeId', $genericPackSizeId)->first();

            $genpacksizeglobalmarketpricesData = DB::table('genpacksizeglobalmarketprices')->get();
            $suppliergenericpricesData = DB::table('sppliergenericprices_view')->get();
            $genericstrengthData = DB::table('genericstrength')->get();
            $availabilitytypeData = DB::table('availabilitytype')->get();
            $dosageformData = DB::table('dosageform')->get();


            return view('generics.genericPackSizesEdit', compact('packTypesData', 'genericbrandData', 'genericpacksizesData', 'genpacksizeglobalmarketpricesData', 'generic_Data', 'suppliergenericpricesData', 'genericstrengthData', 'availabilitytypeData', 'dosageformData'));
        }


        public function genericPackSizesUpdate(Request $request, $genericPackSizeId)
        {
            // dd($request->all());

            GenericPackSizes::find($genericPackSizeId)->update($request->all()); 

            GenPackSizeGlobalMarketPrices::where('genericPackSizeId', $genericPackSizeId)->delete();
            SupplierGenericPrices::where('genericPackSizeId', $genericPackSizeId)->delete();

            

            if ($request->site!=null) 
            {
                foreach($request->site as $sites=>$v)
                {
                    $sitesData=array
                    (
                        'genericPackSizeId'=>$genericPackSizeId,
                        'site'=>$request->site[$sites],
                        'price'=>$request->price[$sites]
                    );
                    GenPackSizeGlobalMarketPrices::insert($sitesData);
                }
            }


            if ($request->moq!=null) 
            {
                foreach($request->moq as $moqs=>$v)
                {
                    $moqsData=array
                    (
                        'genericPackSizeId'=>$genericPackSizeId,
                        'supplierId'=>$request->supplierId[$moqs],
                        'moq'=>$request->moq[$moqs],
                        'buyingPrice'=>$request->buyingPrice[$moqs],
                        'buyingDate'=>dmyToYmd($request->buyingDate[$moqs]),
                        'note'=>$request->note[$moqs],
                    );
                    SupplierGenericPrices::insert($moqsData);
                }
            }

            Generic::where('genericId', $request->genericId)->update(['avgPriceOfOriginator'=>$request->avgPriceOfOriginator]);
            // GenericPackSizes::find($request->genericPackSizeId)->update(['genericStrengthId'=> $request->genericStrengthId]);

            
            return back()->with('successMsg', 'Generic pack size & Prices successfully updated !!');
        }



        public function genericPackSizesDelete($genericPackSizeId)
        {
            GenPackSizeGlobalMarketPrices::where('genericPackSizeId', $genericPackSizeId)->delete(); 
            GenericPackSizes::where('genericPackSizeId', $genericPackSizeId)->delete(); 

            return back()->with('successMsg', 'Generic Pack Size successfully deleted!');
        }


        public function getGenericBrands($genericId) {
            $genericBrands = DB::table("genericbrand_view")->where("genericId",$genericId)->select('genericBrandId', 'genericBrand','genericCompany','dosageForm')->orderBy("genericBrand")->get();
            // return json_encode($genericBrands);
             $response = ["data" => $genericBrands];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
            // return json_encode($genericBrands);
        }

        // generic settings => generic pack sizes  portion  end ====================
        // generic settings => generic pack sizes  portion  end ====================




        // generic settings => generic brand  portion  start ====================
        // generic settings => generic brand  portion  start ====================

        public function genericBrandListIndex()
        {
            $genericbrandData = DB::table('genericbrand_view')->get();
            $genericbrandpicData = DB::table('genericbrandpic')->get();
            $diseasecategoryData = DB::table('diseasecategory')->get();
            $genericbrandvideosData = DB::table('genericbrandvideos')->get();
            
            return view('generics/genericbrandlist', compact( 'genericbrandData', 'diseasecategoryData', 'genericbrandpicData', 'genericbrandvideosData'));
        }

        
        public function genericBrandCreate()
        {
            $genericData = DB::table('generic')->get();
            $genericcompanyData = DB::table('genericcompany')->get();
            $diseasecategoryData = DB::table('diseasecategory')->get();
            $genericstrengthData = DB::table('genericstrength')->get();

            return view('generics.genericBrandCreate', compact('genericData', 'genericcompanyData', 'diseasecategoryData', 'genericstrengthData'));
        }


        public function genericBrandInsert(Request $request)
        {

            $this->validate(
                $request,
                [  
                    'genericBrand' => 'required|unique:genericbrand'
                ],
                [  
                    'genericBrand.unique' => 'Duplicate record already exist!',
                ]
            );

            
            $inputs = $request->all();
            
            // dd($request->all());

            $lastCreatedGenericBrandId = GenericBrand::create($inputs)->genericBrandId;


            return redirect(route('generic.settings.brand.edit',$lastCreatedGenericBrandId));
        }



        public function genericBrandEdit($genericBrandId)
        {
            $genericData = DB::table('generic')->get();
            $genericcompanyData = DB::table('genericcompany')->get();
            $diseasecategoryData = DB::table('diseasecategory')->get();
            $genericstrengthData = DB::table('genericstrength')->get();
            $genericbrandData = DB::table('genericbrand_view')->where('genericBrandId', $genericBrandId)->first();

            $genericbranddiseasecategoryData = DB::table('genericbranddiseasecategory_view')->get();

            $genericbrandpicData = DB::table('genericbrandpic')->get();
            $genericbrandvideosData = DB::table('genericbrandvideos')->where('genericBrandId',$genericBrandId)->get();

            
            return view('generics.genericBrandEdit', compact('genericData', 'genericcompanyData', 'diseasecategoryData', 'genericstrengthData', 'genericbrandData', 'genericbranddiseasecategoryData', 'genericbrandpicData', 'genericbrandvideosData'));
        }

        public function genericBrandVideoDelete($genericBrandId)
        {
            DB::table('genericbrand')->where('genericBrandId', $genericBrandId)->update([
                'videourl' => ''
            ]);

            return back()->with('successMsg', 'Video deleted!');
        }

        public function genericbrandvideothumbnaildeletenew($genericbrandVideoId)
        {
            DB::table('genericbrandvideos')->where('genericbrandVideoId', $genericbrandVideoId)->update([
                'thumbnailUrl' => ''
            ]);

            return back()->with('successMsg', 'Video thumbnail deleted!');
        }

        

        public function genericBrandVideoThumbnailDelete($genericBrandId)
        {
            DB::table('genericbrand')->where('genericBrandId', $genericBrandId)->update([
                'videothumb' => ''
            ]);

            return back()->with('successMsg', 'Video thumbnail deleted!');
        }

        public function genericBrandyoutubevideothumbDelete($genericBrandId)
        {
            DB::table('genericbrand')->where('genericBrandId', $genericBrandId)->update([
                'youtubevideothumb' => ''
            ]);

            return back()->with('successMsg', 'Youtube Video thumbnail deleted!');
        }

        public function genericBranddailymotionvideothumbDelete($genericBrandId)
        {
            DB::table('genericbrand')->where('genericBrandId', $genericBrandId)->update([
                'dailymotionvideothumb' => ''
            ]);

            return back()->with('successMsg', 'Dailymotion Video thumbnail deleted!');
        }

        public function genericBrandvimeovideothumbDelete($genericBrandId)
        {
            DB::table('genericbrand')->where('genericBrandId', $genericBrandId)->update([
                'vimeovideothumb' => ''
            ]);

            return back()->with('successMsg', 'Dailymotion Video thumbnail deleted!');
        }

        

        


        public function genericBrandUpdate(Request $request, $genericBrandId)
        {


            // 0. update generic brand videos
            // generic brand videos update============
            GenericBrandVideos::where('genericBrandId', $genericBrandId)->delete(); 

            if ( ($request->oldvideoUrl!=null && $request->oldthumbnailUrl!=null) || ( $request->oldvideoUrl!=null && $request->thumbnailUrl!=null)  ) 
            {

                foreach($request->oldvideoUrl as $videoUrls=>$v)
                {
                    $videoUrlsData=array
                    (
                        'genericBrandId' => $genericBrandId,
                    );

                    $genericbrandVideoId = GenericBrandVideos::create($videoUrlsData)->genericbrandVideoId;

                    // videoUrl
                    if( isset($request->oldvideoUrl[$videoUrls]) and $request->oldvideoUrl[$videoUrls]!= null ){
                        GenericBrandVideos::find($genericbrandVideoId)->update([
                                        'videoUrl' => $request->oldvideoUrl[$videoUrls]
                                    ]);
                    }
                    // videoUrl
                 
                    // thumbnailUrl
                    if( isset($request->oldthumbnailUrl[$videoUrls]) and $request->oldthumbnailUrl[$videoUrls]!= null ){
                        GenericBrandVideos::find($genericbrandVideoId)->update([
                                        'thumbnailUrl' => $request->oldthumbnailUrl[$videoUrls]
                                    ]);
                    }
                    // thumbnailUrl
                }
            }




            if ($request->videoUrl!=null  and $request->thumbnailUrl!=null ) 
            {
                foreach($request->videoUrl as $videoUrls=>$v)
                {

                    $videoUrlsData=array
                    (
                        'genericBrandId' => $genericBrandId,
                    );

                    $genericbrandVideoId = GenericBrandVideos::create($videoUrlsData)->genericbrandVideoId;

                    // videoUrl

                    if( isset($request->videoUrl[$videoUrls]) and $request->videoUrl[$videoUrls]!= null ){
                        $file = $request->videoUrl[$videoUrls];

            
                        $file->move('uploads/videos/genericbrand/', $genericBrandId.'_'.$genericbrandVideoId.'.'.$file->getClientOriginalExtension());
                        DB::table('genericbrandvideos')->where('genericbrandVideoId', $genericbrandVideoId)
                            ->update([
                                'videoUrl' => '/uploads/videos/genericbrand/'.$genericBrandId.'_'.$genericbrandVideoId.'.'.$file->getClientOriginalExtension()
                                ]);
                    }

                    // thumbnailUrl
                    if( isset($request->thumbnailUrl[$videoUrls]) and $request->thumbnailUrl[$videoUrls]!= null )
                    {
                        $file = $request->thumbnailUrl[$videoUrls];

            
                        $file->move('uploads/videos/genericbrand/', $genericBrandId.'_'.$genericbrandVideoId.'_thumb'.'.'.$file->getClientOriginalExtension());
                        DB::table('genericbrandvideos')->where('genericbrandVideoId', $genericbrandVideoId)
                            ->update([
                                'thumbnailUrl' => '/uploads/videos/genericbrand/'.$genericBrandId.'_'.$genericbrandVideoId.'_thumb'.'.'.$file->getClientOriginalExtension()
                                ]);
                    }
                    // thumbnailUrl

                }
            }




            // 1. delete the pictures first==============

            $genericbrandpics = DB::table('genericbrandpic')->where('genericBrandId', $genericBrandId)->pluck('picPath');
            // $totalPics = count($genericbrandpics);
            // if ($totalPics>0) 
            // {
            //     for ($i = 0; $i < $totalPics; $i++) 
            //     {
            //         unlink($genericbrandpics[$i]);
            //     }
            // }


            // GenericBrandPic::where('genericBrandId', $genericBrandId)->delete(); 

            GenericBrandDiseaseCategory::where('genericBrandId', $genericBrandId)->delete(); 


            // 2. update parent generic brand table==============

            GenericBrand::find($genericBrandId)->update($request->all());

            if( isset($request->videourl) and $request->videourl!= null ){
                $file = $request->videourl;
    
                $file->move('uploads/videos/genericbrand/', $genericBrandId.'.'.$file->getClientOriginalExtension());
                DB::table('genericbrand')->where('genericBrandId', $genericBrandId)
                    ->update([
                        'videourl' => '/uploads/videos/genericbrand/'.$genericBrandId.'.'.$file->getClientOriginalExtension()
                        ]);
            }




            // 3. update disease category
            // generic brand disease categories update============
            if ($request->diseaseCategoryId!=null) 
            {
                foreach($request->diseaseCategoryId as $diseaseCategoryIds=>$v)
                {
                    $diseaseCategoryIdsData=array
                    (
                        'genericBrandId'=>$genericBrandId,
                        'diseaseCategoryId'=>$request->diseaseCategoryId[$diseaseCategoryIds],
                    );
                    GenericBrandDiseaseCategory::insert($diseaseCategoryIdsData);
                }
            }

            



            // 4. update child generic brand pic table==============

            if ($request->picPath!=null) 
            {
                foreach($request->picPath as $picpath=>$v)
                {
                    $brandPicsData=array
                    (
                        'genericBrandId'=>$genericBrandId,
                        'picPath'=>$request->picPath[$picpath],
                    );
                    $lastCreatedGenericBrandPicId = GenericBrandPic::create($brandPicsData)->genericBrandPicId;
                    
                    $file = $brandPicsData['picPath'];
                    $imgSize = $file->getSize()/1024;  // byte/1024 = KB
                    $file->move('uploads/genericbrands/', 'genericBrandId-'.$genericBrandId.'_genericBrandPicId-'.$lastCreatedGenericBrandPicId.'.'.$file->getClientOriginalExtension());

                    GenericBrandPic::where('genericBrandPicId', $lastCreatedGenericBrandPicId)->update(['picPath'=>'/uploads/genericbrands/'.'genericBrandId-'.$genericBrandId.'_genericBrandPicId-'.$lastCreatedGenericBrandPicId.'.'.$file->getClientOriginalExtension()]);



                    // /////////////////////////////////////////
                    // // compressing image================== //
                    // /////////////////////////////////////////
                    // $image = new ImageResize('uploads/genericbrands/'.'genericBrandId-'.$genericBrandId.'_genericBrandPicId-'.$lastCreatedGenericBrandPicId.'.'.$file->getClientOriginalExtension());

                    // if ($imgSize>2000) 
                    // { 
                    //     $image->scale(25); 
                    // }
                    // elseif ($imgSize>1000) 
                    // { 
                    //     $image->scale(45); 
                    // }
                    // elseif ($imgSize>500) 
                    // { 
                    //     $image->scale(60); 
                    // }
                    
                    // unlink('uploads/genericbrands/'.'genericBrandId-'.$genericBrandId.'_genericBrandPicId-'.$lastCreatedGenericBrandPicId.'.'.$file->getClientOriginalExtension());
                    // $image->save('uploads/genericbrands/'.'genericBrandId-'.$genericBrandId.'_genericBrandPicId-'.$lastCreatedGenericBrandPicId.'.'.$file->getClientOriginalExtension());


                }
            }


            if(Input::hasFile('videothumb')){
                $file = Input::file('videothumb');
                $file->move('uploads/videos/thumb/', 'genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension());
                GenericBrand::find($genericBrandId)->update(['videothumb' => '/uploads/videos/thumb/'.'genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension()]);
            }

            if(Input::hasFile('youtubevideothumb')){
                $file = Input::file('youtubevideothumb');
                $file->move('uploads/videos/thumb/', 'youtube_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension());
                GenericBrand::find($genericBrandId)->update(['youtubevideothumb' => '/uploads/videos/thumb/'.'youtube_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension()]);
            }

            if(Input::hasFile('dailymotionvideothumb')){
                $file = Input::file('dailymotionvideothumb');
                $file->move('uploads/videos/thumb/', 'dailymotion_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension());
                GenericBrand::find($genericBrandId)->update(['dailymotionvideothumb' => '/uploads/videos/thumb/'.'dailymotion_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension()]);
            }

            if(Input::hasFile('vimeovideothumb'))
            {
                $file = Input::file('vimeovideothumb');
                $file->move('uploads/videos/thumb/', 'vimeo_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension());
                GenericBrand::find($genericBrandId)->update(['vimeovideothumb' => '/uploads/videos/thumb/'.'vimeo_genericBrandId-'.$genericBrandId.'.'.$file->getClientOriginalExtension()]);
            }

            return back()->with('successMsg', 'Generic brand successfully updated !!');
        }

        public function genericBrandMetaUpdate($genericBrandId){
            $updates = [
                'pageTitle' => null,
                'pageTitleCN' => null,
                'pageTitleRU' => null,
                'meta_keywords' => null,
                'meta_keywordsCN' => null,
                'meta_keywordsRU' => null,
                'meta_description' => null,
                'meta_descriptionCN' => null,
                'meta_descriptionRU' => null,
                'alt_tag' => null,
                'alt_tag_CN' => null,
                'alt_tag_RU' => null,               
            ];

            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update($updates);

            return back()->with('successMsg', 'Meta section successfully updated !!');

        }

        public function genericBrandMetaUpdateAll($genericBrandId){
            $updates = [
                'pageTitle' => null,
                'pageTitleCN' => null,
                'pageTitleRU' => null,
                'meta_keywords' => null,
                'meta_keywordsCN' => null,
                'meta_keywordsRU' => null,
                'meta_description' => null,
                'meta_descriptionCN' => null,
                'meta_descriptionRU' => null,
                'alt_tag' => null,
                'alt_tag_CN' => null,
                'alt_tag_RU' => null,               
            ];

            DB::table('genericbrand')
            // ->where('genericBrandId',$genericBrandId)
            ->update($updates);

            return back()->with('successMsg', 'Meta section successfully updated !!');

        }

        public function genericBrandMetaTitleUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('pageTitle' => null));

            return back()->with('successMsg', 'Meta Title successfully updated !!');

        }

        public function genericBrandMetaTitleCNUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('pageTitleCN' => null));

            return back()->with('successMsg', 'Meta Title CN successfully updated !!');

        }

        public function genericBrandMetaTitleRUUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('pageTitleRU' => null));

            return back()->with('successMsg', 'Meta Title RU successfully updated !!');

        }

        public function genericBrandMetaKeywordUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_keywords' => null));

            return back()->with('successMsg', 'Meta Keywords successfully updated !!');

        }
        public function genericBrandMetaKeywordCNUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_keywordsCN' => null));

            return back()->with('successMsg', 'Meta Keywords CN successfully updated !!');

        }
        public function genericBrandMetaKeywordRUUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_keywordsRU' => null));

            return back()->with('successMsg', 'Meta Keywords RU successfully updated !!');

        }

        public function genericBrandMetaDescUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_description' => null));

            return back()->with('successMsg', 'Meta Description successfully updated !!');

        }
        public function genericBrandMetaDescUpdateCN($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_descriptionCN' => null));

            return back()->with('successMsg', 'Meta Description CN successfully updated !!');

        }
        public function genericBrandMetaDescUpdateRU($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('meta_descriptionRU' => null));

            return back()->with('successMsg', 'Meta Description RU successfully updated !!');

        }

        public function genericBrandAltTagUpdate($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('alt_tag' => null));

            return back()->with('successMsg', 'Alt tag successfully updated !!');

        }
        public function genericBrandAltTagUpdateCN($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('alt_tag_CN' => null));

            return back()->with('successMsg', 'Alt tag CN successfully updated !!');

        }
        public function genericBrandAltTagUpdateRU($genericBrandId){
            DB::table('genericbrand')
            ->where('genericBrandId',$genericBrandId)
            ->update(array('alt_tag_RU' => null));

            return back()->with('successMsg', 'Alt tag RU successfully updated !!');

        }




        public function genericBrandUpdate2(Request $request, $genericBrandId)
        {

            if (isset($request->indicationanddosage) || isset($request->indicationanddosageCN) || isset($request->indicationanddosageRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "indicationanddosage" =>  trim($request->indicationanddosage),
                    "indicationanddosageCN" =>  trim($request->indicationanddosageCN),
                    "indicationanddosageRU" =>  trim($request->indicationanddosageRU)
                ]);
            }
            else if (isset($request->sideeffects) || isset($request->sideeffectsCN) || isset($request->sideeffectsRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "sideeffects" =>  trim($request->sideeffects),
                    "sideeffectsCN" =>  trim($request->sideeffectsCN),
                    "sideeffectsRU" =>  trim($request->sideeffectsRU)
                ]);
            }
            else if (isset($request->prescribinginformation) || isset($request->prescribinginformationCN) || isset($request->prescribinginformationRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "prescribinginformation" =>  trim($request->prescribinginformation),
                    "prescribinginformationCN" =>  trim($request->prescribinginformationCN),
                    "prescribinginformationRU" =>  trim($request->prescribinginformationRU)
                ]);
            }
            else if (isset($request->additionalinformation) || isset($request->additionalinformationCN) || isset($request->additionalinformationRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "additionalinformation" =>  trim($request->additionalinformation),
                    "additionalinformationCN" =>  trim($request->additionalinformationCN),
                    "additionalinformationRU" =>  trim($request->additionalinformationRU)
                ]);
            }
            else if (isset($request->faq) || isset($request->faqCN) || isset($request->faqRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "faq" =>  trim($request->faq),
                    "faqCN" =>  trim($request->faqCN),
                    "faqRU" =>  trim($request->faqRU)
                ]);
            }
            else if (isset($request->suggestion) || isset($request->suggestionCN) || isset($request->suggestionRU)) 
            {
                GenericBrand::find($genericBrandId)->update([
                    "suggestion" =>  trim($request->suggestion),
                    "suggestionCN" =>  trim($request->suggestionCN),
                    "suggestionRU" =>  trim($request->suggestionRU)
                ]);
            }

            return back()->with('successMsg', 'Generic brand successfully updated !!');
        }








        public function genericBrandDelete($genericBrandId)
        {

            $genericbrandpics = DB::table('genericbrandpic')->where('genericBrandId', $genericBrandId)->pluck('picPath');

            $totalPics = count($genericbrandpics);
            if ($totalPics>0) 
            {
                for ($i = 0; $i < $totalPics; $i++) 
                {
                    try {
                        unlink($genericbrandpics[$i]);
                    } catch (\Throwable $th) {
                    }
                }
            }

            
            GenericBrandPic::where('genericBrandId', $genericBrandId)->delete(); 

            GenericBrand::where('genericBrandId', $genericBrandId)->delete(); 

            return redirect(Route('generics.genericBrandListIndex.index'))->with('successMsg', 'Generic brand successfully deleted!');
        }


        public function genericBrandPicDelete($genericBrandPicId)
        {
            $genericBrandPicPath = DB::table('genericbrandpic')->where('genericBrandPicId', $genericBrandPicId)->pluck('picPath')->first();
            try {
                unlink($genericBrandPicPath);
            } catch (\Throwable $th) {
                //throw $th;
            }
            
            GenericBrandPic::where('genericBrandPicId', $genericBrandPicId)->delete(); 

            $response = ["success" => true, 'message'=> 'deleted successfully'];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
            
        }

        // generic settings => generic brand  portion  end ====================
        // generic settings => generic brand  portion  end ====================






    // generic settings page end====================
    // generic settings page end====================



    // files==========================================
    // files==========================================
    public function filesListIndex()
    {
        $genericpacksizesData = DB::table('genericpacksizes_view')->get();
        $filesData = DB::table('files_view')->get();
        
        return view('generics.filesListIndex', compact('genericpacksizesData', 'filesData'));
    }

    public function filesInsert(Request $request)
    {
        DB::table('files')->insert([
            'genericPackSizeId' => $request->genericPackSizeId,
            'purpose' => $request->purpose,
        ]);

        $lastFileId = DB::getPdo()->lastInsertId();

        if( isset($request->filePath) and $request->filePath!= null ){
            $randomNumber  = rand(9999,9999999);
            $file = $request->filePath;

            $file->move('uploads/files/', $lastFileId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());
            DB::table('files')->where('fileId', $lastFileId)
                ->update([
                    'filePath' => '/uploads/files/'.$lastFileId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()
                    ]);
        }
        
        return back()->with('successMsg', 'File successfully added!');
    }


    
    public function fileUpdate(Request $request)
    {
        $this->validate(
            $request,
            [  
                'purpose' => 'required'
            ],
            
        );

        DB::table('files')->where('fileId', $request->fileId)->update($request->except(['_token','_method'])); 
        return back()->with('successMsg', 'File successfully updated!');
    }

    public function filesDelete($fileId)
    {
        DB::table('files')->where('fileId', $fileId)->delete(); 
        return back()->with('successMsg', 'File successfully deleted!');
    }
    // files==========================================
    // files==========================================



    // generic for all product==========================================
    // generic for all product==========================================
    public function genericforallproduct()
    {
        return view('generics.genericforallproduct');
    }

    public function getGenericforallproducts()
    {
        $genericforallproducts = DB::table('genericforallproduct_view')->get();

        $response = ["status" => "Success", "data"=> $genericforallproducts];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function getGenericforallproduct($genericforallproductId)
    {
        $genericforallproduct = DB::table('genericforallproduct_view')->where('genericforallproductId', $genericforallproductId)->first();
        $response = ["status" => "Success", "data"=> $genericforallproduct];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function getGenericforallproductwithgenericid($genericId)
    {
        $genericforallproduct = DB::table('genericforallproduct_view')->where('genericId', $genericId)->first();
        $response = ["status" => "Success", "data"=> $genericforallproduct];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function getGenericBrandswithgenericid($genericId)
    {
        $data = DB::table('genericbrand_view')->where('genericId', $genericId)->get();
        $response = ["status" => "Success", "data"=> $data];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    

    

    public function addupdateGenericforallproduct(Request $request)
    {
        if(isset($request->generic['genericforallproductId']) and $request->generic['genericforallproductId'] != null)
        {   
            $validator = Validator::make($request->generic, [
                'genericId' => 'required|numeric|unique:genericforallproduct,genericId,'.$request->generic['genericforallproductId'].',genericforallproductId',
                'metaTitle' =>  'required|unique:genericforallproduct,metaTitle,'.$request->generic['genericforallproductId'].',genericforallproductId',
                'metaTitleCN' => 'required|unique:genericforallproduct,metaTitleCN,'.$request->generic['genericforallproductId'].',genericforallproductId',
                'metaTitleRU' => 'required|unique:genericforallproduct,metaTitleRU,'.$request->generic['genericforallproductId'].',genericforallproductId',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }

            $inputs = $request->generic;
            unset($inputs['genericName']);
            unset($inputs['genericNameCN']);
            unset($inputs['genericNameRU']);
            Genericforallproduct::where('genericforallproductId', $request->generic['genericforallproductId'])->update($inputs);
    
            $response = ["status" => "Success", "data" => "Successfully Updated!"];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }
        else
        {
            $validator = Validator::make($request->generic, [
                'genericId' => 'required|numeric|unique:genericforallproduct',
                'metaTitle' => 'required',
                'metaTitleCN' => 'required',
                'metaTitleRU' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }
    
            
            $inputs = $request->generic;
            unset($inputs['genericName']);
            unset($inputs['genericNameCN']);
            unset($inputs['genericNameRU']);
            Genericforallproduct::create($inputs);
    
            $response = ["status" => "Success", "data" => "Genericforallproduct successfully saved!"];
            return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
        }

    }


    public function updateGenericforallproductvisibility(Request $request, $genericforallproductId, $isViewable)
    {
        Genericforallproduct::where('genericforallproductId', $genericforallproductId)
                            ->update([
                                'isViewable' => $isViewable
                            ]);

        $response = ["status" => "Success", "data" => "Successfully Updated!"];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    


    public function deleteGenericforallproduct($genericforallproductId)
    {
        DB::table('genericforallproduct')->where('genericforallproductId', $genericforallproductId)->delete();

        $response = ["status" => "Success", "data" => "Genericforallproduct Successfully Deleted!"];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function getAllGenerics()
    {
        $getAllGenerics =  DB::table('generic')->orderBy('genericName')->get();

        $response = ["status" => "Success", "data"=> $getAllGenerics];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function generic_medicine($language, $metaTitle, $genericId)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');

        $genericforallproducts = Cache::rememberForever('generic_medicine_genericforallproducts',  function () {
            return DB::table('genericforallproduct_view')->get(); 
        });

        $genericforallproduct = $genericforallproducts->where('genericId', $genericId)->first();

        $genericbrands = Cache::rememberForever('generic_medicine_genericbrands',  function () {
                return DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
        });

        $genericbrands = $genericbrands->where('genericId', $genericId);

        if (Auth::check()) 
        {
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            return view('frontend.genericforallproduct', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandpicData',   'wishlistData', 'compareData', 'userData', 'genericstrengthCompactData', 'notificationData', 'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'reviewData', 'reviewsData', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericforallproducts', 'genericbrands', 'genericId', 'genericforallproduct'));
        }
        else
        {
            return view('frontend.genericforallproduct', compact('categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandpicData',    'countryData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericstrengthCompactData', 'reviewData', 'reviewsData', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericforallproducts', 'genericbrands', 'genericId', 'genericforallproduct'));
        }

    }


    // generic for all product==========================================
    // generic for all product==========================================


}
