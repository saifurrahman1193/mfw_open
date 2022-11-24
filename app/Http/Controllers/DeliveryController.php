<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Weight;
use App\DeliveryMethod;
use App\DeliverySummary;
use App\DeliveryPrice;

use DB;


class DeliveryController extends Controller
{

    public function deliverysettings()
    {
        $packtypeData = DB::table('packtypes_view')->get();
        $weightData = DB::table('weight_view')->get();
        $deliverymethodData = DB::table('deliverymethod_view')->get();
        $deliverysummaryData = DB::table('deliverysummary')->get();
        $countryData = DB::table('country')->get();
        $deliverypriceData = DB::table('deliveryprice_view')->get();

        return view('frontend.deliverysettings', compact('packtypeData', 'weightData', 'deliverymethodData', 'deliverysummaryData', 'countryData', 'deliverypriceData'));
    }


    // ==============weights==================
    // ==============weights==================
    public function weightInsert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'packTypeId' => 'required|unique:weight'
            ],
            [  
                'packTypeId.unique' => 'Duplicate record already exist!',
            ]
        );

        $inputs = $request->all();
        $inputs = Weight::create($inputs);
        return back()->with('successMsg', 'New weight successfully added!');
    }

    public function weightUpdate(Request $request)
    {
        $this->validate(
            $request,
            [  
                'packTypeId' => 'required|unique:weight,packTypeId,'.$request->weightId.',weightId'
            ],
            [  
                'packTypeId.unique' => 'Duplicate record already exist!',
            ]
        );

        Weight::find($request->weightId)->update($request->all()); 
        return back()->with('successMsg', 'Weight successfully updated!');
    }


    public function weightDelete($weightId)
    {
        Weight::find($weightId)->delete(); 
        return back()->with('successMsg', 'Weight successfully deleted!');
    }

    // ==============weights==================
    // ==============weights==================




    // ==============delivery methods==================
    // ==============delivery methods==================
    public function deliveryMethodInsert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'deliveryMethod' => 'required|unique:deliverymethod'
            ],
            [  
                'deliveryMethod.unique' => 'Duplicate record already exist!',
            ]
        );

        $inputs = $request->all();
        $inputs = DeliveryMethod::create($inputs);
        return back()->with('successMsg', 'New delivery method successfully added!');
    }

    public function deliveryMethodEdit($deliveryMethodId)
    {
        $deliverymethodData = DB::table('deliverymethod_view')->where('deliveryMethodId', $deliveryMethodId)->first();
        $deliverysummaryData = DB::table('deliverysummary')->where('deliveryMethodId', $deliveryMethodId)->get();

        return view('frontend.deliverymethodupdate', compact('deliverymethodData', 'deliverysummaryData'));
    }


    public function deliveryMethodUpdate(Request $request, $deliveryMethodId)
    {
        // dd($request->deliverySummary);

        $this->validate(
            $request,
            [  
                'deliveryMethod' => 'required|unique:deliverymethod,deliveryMethodId,'.$request->deliveryMethodId.',deliveryMethodId'
            ],
            [  
                'deliveryMethod.unique' => 'Duplicate record already exist!',
            ]
        );

        // delete childs
        DeliverySummary::where('deliveryMethodId', $deliveryMethodId)->delete(); 

        // update parent
        DeliveryMethod::find($request->deliveryMethodId)->update($request->all()); 

        // dd($request->deliverySummary);
        // update child
        if ( isset($request->deliverySummary) && $request->deliverySummary!=null) 
        {
            foreach($request->deliverySummary as $deliverySummarys=>$v)
            {
                $deliverySummarysData=array
                (
                    'deliveryMethodId'=>$deliveryMethodId,
                    'deliverySummary'=>$request->deliverySummary[$deliverySummarys],
                    'deliverySummaryCN'=>$request->deliverySummaryCN[$deliverySummarys],
                    'deliverySummaryRU'=>$request->deliverySummaryRU[$deliverySummarys],
                );
                DeliverySummary::insert($deliverySummarysData);
            }
        }

        return back()->with('successMsg', 'Delivery method successfully updated!');
    }


    public function deliveryMethodDelete($deliveryMethodId)
    {
        DeliveryMethod::find($deliveryMethodId)->delete(); 
        return back()->with('successMsg', 'Delivery method successfully deleted!');
    }

    // ==============delivery methods==================
    // ==============delivery methods==================






// 'department' => 'unique_with:department,branchId,'.$request->departmentId.'=departmentId'



    // ==============delivery price==================
    // ==============delivery price==================
    public function deliveryPriceInsert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'countryId' => 'required|unique:deliveryprice'
            ],
            [  
                'countryId.unique' => 'Duplicate record already exist!',
            ]
        );

        $inputs = $request->all();
        $inputs = DeliveryPrice::create($inputs);
        return back()->with('successMsg', 'New delivery price successfully added!');
    }

    public function deliveryPriceEdit($countryId)
    {
        $deliverypriceData = DB::table('deliveryprice_view')->where('countryId', $countryId)->get();
        $deliverymethodData = DB::table('deliverymethod')->get();


        return view('frontend.deliverypriceupdate', compact('deliverypriceData', 'deliverymethodData'));
    }


    public function deliveryPriceUpdate(Request $request, $countryId)
    {
        

        // delete datas
        DeliveryPrice::where('countryId', $countryId)->delete(); 

        // add datas

        if ($request->deliveryMethodId!=null) 
        {
            foreach($request->deliveryMethodId as $deliveryMethodIds=>$v)
            {
                $deliveryMethodIdsData=array
                (
                    'countryId'=>$countryId,
                    'deliveryMethodId'=>$request->deliveryMethodId[$deliveryMethodIds],
                    'deliveryPriceInitial'=>$request->deliveryPriceInitial[$deliveryMethodIds],
                    'deliveryPriceIncrement'=>$request->deliveryPriceIncrement[$deliveryMethodIds],
                );
                DeliveryPrice::insert($deliveryMethodIdsData);
            }
        }


        return back()->with('successMsg', 'Delivery price successfully updated!');
    }


    public function deliveryPriceDelete($countryId)
    {
       DeliveryPrice::where('countryId', $countryId)->delete();
        return back()->with('successMsg', 'Delivery price successfully deleted!');
    }

    // ==============delivery price==================
    // ==============delivery price==================


}
