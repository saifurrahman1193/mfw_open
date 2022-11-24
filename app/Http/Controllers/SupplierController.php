<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Position;
use App\SocialMedia;
use App\SupplierSocialMedia;
use App\Supplier;
use Input;

use DB;


class SupplierController extends Controller
{

    // supplier settings page start====================
    // supplier settings page start====================

    public function postions()
    {
        $positionsData = DB::table('position_view')->get();
        return view('suppliers.positions', compact('positionsData'));
    }



        // supplier settings => sposition  portion  start ====================
        // supplier settings => sposition  portion  start ====================

        public function positionInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'position' => 'required|unique:position'
                ],
                [  
                    'position.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = Position::create($inputs);
            return back()->with('successMsg', 'New sposition successfully added!');
        }


        public function positionUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'position' => 'required|unique:position,position,'.$request->positionId.',positionId'
                ],
                [  
                    'position.unique' => 'Duplicate record already exist!',
                ]
            );

            Position::find($request->positionId)->update($request->all()); 
            return back()->with('successMsg', 'Position successfully updated!');
        }


        public function positionDelete($positionId)
        {
            Position::find($positionId)->delete(); 
            return back()->with('successMsg', 'Position successfully deleted!');
        }

        // supplier settings => sposition  portion  end ====================
        // supplier settings => sposition  portion  end ====================




        // supplier settings => sposition  portion  start ====================
        // supplier settings => sposition  portion  start ====================

        public function socialmedias()
        {
            $socialmediaData = DB::table('socialmedia_view')->get();
            return view('suppliers.socialmedias', compact('socialmediaData'));
        }


        public function socialMediaInsert(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'socialMedia' => 'required|unique:socialmedia'
                ],
                [  
                    'socialMedia.unique' => 'Duplicate record already exist!',
                ]
            );

            $inputs = $request->all();
            $inputs = SocialMedia::create($inputs);
            return back()->with('successMsg', 'New social media successfully added!');
        }


        public function socialMediaUpdate(Request $request)
        {
            $this->validate(
                $request,
                [  
                    'socialMedia' => 'required|unique:socialmedia,socialMedia,'.$request->socialMediaId.',socialMediaId'
                ],
                [  
                    'socialMedia.unique' => 'Duplicate record already exist!',
                ]
            );

            SocialMedia::find($request->socialMediaId)->update($request->all()); 

            if(Input::hasFile('picPath'))
            {

                $file = Input::file('picPath');
                $file->move('uploads/socialmedias/', 'socialMediaId-'.$request->socialMediaId.'.'.$file->getClientOriginalExtension());

                SocialMedia::where('socialMediaId', $request->socialMediaId)->update(['picPath'  => '/uploads/socialmedias/'.'socialMediaId-'.$request->socialMediaId.'.'.$file->getClientOriginalExtension()]);
            }

            return back()->with('successMsg', 'Social Media successfully updated!');
        }


        public function socialMediaDelete($socialMediaId)
        {
            SocialMedia::find($socialMediaId)->delete(); 
            return back()->with('successMsg', 'Social Media successfully deleted!');
        }

        // supplier settings => sposition  portion  end ====================
        // supplier settings => sposition  portion  end ====================



        public function supplierIndex()
        {
            if (request()->has('supplierId') && request('supplierId') != null) {
                $supplierData = DB::table('supplier_view')->where('supplierId', request('supplierId'))->get();
            }
            else{
                $supplierData = DB::table('supplier_view')->get();
            }
            return view('suppliers.suppliers', compact('supplierData'));
        }


        // supplier settings => Supplier  portion  start ====================
        // supplier settings => Supplier  portion  start ====================

        public function supplierCreate()
        {
            $positionsData = DB::table('position')->get();
            $countryData= DB::table('country')->get();
            $genericcompanyData= DB::table('genericcompany')->get();
            $socialMediaData= DB::table('socialmedia')->get();

            $generic_brand_packsizes_Data = DB::table('generic_brand_packsizes_view')->get();

            return view('suppliers.supplierCreate', compact('countryData', 'genericcompanyData', 'socialMediaData', 'generic_brand_packsizes_Data', 'positionsData'));
        }


        public function supplierInsert(Request $request)
        {

            // 1. insert supplier data 
            
            $inputs = $request->all();
            
            $lastCreatedSupplierId = Supplier::create($inputs)->supplierId;

            // 3. insert generic price data 
            if ($request->socialMediaId!=null) 
            {
                foreach($request->socialMediaId as $socialMediaIds=>$v)
                {
                    $socialMediaIdsData=array
                    (
                        'supplierId'=>$lastCreatedSupplierId,
                        'socialMediaId'=>$request->socialMediaId[$socialMediaIds],
                        'supplierSocialNameOrId'=>$request->supplierSocialNameOrId[$socialMediaIds]
                    );
                    SupplierSocialMedia::insert($socialMediaIdsData);
                }
            }

            return back()->with('successMsg', 'Supplier successfully added !!');
        }

                public function getGenericBrands($genericId) {
                    $genericBrands = DB::table("generic_brand_packsizes_view")->where("genericId",$genericId)->orderBy("genericBrand")->pluck("genericBrand","genericBrandId");
                    $genericBrands = $genericBrands->unique('genericBrandId');

                    return json_encode($genericBrands);
                }

                public function getGenericPackSizes($genericBrandId) {
                    $genericPackSizes = DB::table("generic_brand_packsizes_view")->where("genericBrandId",$genericBrandId)->orderBy('packType','genericPackSize')->pluck("genericPackSize2","genericPackSizeId");
                    $genericPackSizes = $genericPackSizes->unique('genericPackSizeId');
                    // $genericPackSizes = $genericPackSizes->concat(['genericPackSize' => $genericPackSizes->packType]);

                    return json_encode($genericPackSizes);
                }



        public function supplierEdit($supplierId)
        {
            $positionsData = DB::table('position')->get();

            $countryData= DB::table('country')->get();
            $genericcompanyData= DB::table('genericcompany')->get();
            $socialMediaData= DB::table('socialmedia')->get();

            $supplierData =  DB::table('supplier_view')->where('supplierId', $supplierId)->first();

            $suppliersocialmediaData = DB::table('suppliersocialmedia_view')->where('supplierId', $supplierId)->get();

            return view('suppliers.supplierEdit', compact('countryData', 'genericcompanyData', 'socialMediaData', 'supplierData', 'suppliersocialmediaData', 'positionsData'));
        }

        public function supplierUpdate(Request $request, $supplierId)
        {
            SupplierSocialMedia::where('supplierId', $supplierId)->delete();
            Supplier::find($supplierId)->update($request->all()); 

            if ($request->socialMediaId!=null) 
            {
                foreach($request->socialMediaId as $socialMediaIds=>$v)
                {
                    $socialMediaIdsData=array
                    (
                        'supplierId'=>$supplierId,
                        'socialMediaId'=>$request->socialMediaId[$socialMediaIds],
                        'supplierSocialNameOrId'=>$request->supplierSocialNameOrId[$socialMediaIds]
                    );
                    SupplierSocialMedia::insert($socialMediaIdsData);
                }
            }

            return back()->with('successMsg', 'Supplier successfully updated !!');
        }


        public function supplierDelete($supplierId)
        {
            Supplier::find($supplierId)->delete(); 
            return back()->with('successMsg', 'Supplier successfully deleted!');
        }

        // supplier settings => Supplier  portion  end ====================
        // supplier settings => Supplier  portion  end ====================




    // supplier settings page end====================
    // supplier settings page end====================

}
