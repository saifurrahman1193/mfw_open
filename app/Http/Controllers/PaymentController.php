<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PaymentMethod;
use App\PaymentSummary;
use App\PaymentPrice;
use App\PaymentAccountDetails;



use DB;


class PaymentController extends Controller
{

    public function paymentsettings()
    {
        $paymentmethodData = DB::table('paymentmethod_view')->get();
        $paymentsummaryData = DB::table('paymentsummary')->get();
        $countryData = DB::table('country')->get();
        $paymentpriceData = DB::table('paymentprice_view')->get();

        return view('frontend.paymentsettings', compact( 'paymentmethodData', 'paymentsummaryData', 'countryData', 'paymentpriceData'));
    }


    




    // ==============payment methods==================
    // ==============payment methods==================
    public function paymentMethodInsert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'paymentMethod' => 'required|unique:paymentmethod'
            ],
            [  
                'paymentMethod.unique' => 'Duplicate record already exist!',
            ]
        );

        $inputs = $request->all();
        $inputs = PaymentMethod::create($inputs);
        return back()->with('successMsg', 'New payment method successfully added!');
    }

    public function paymentMethodEdit($paymentMethodId)
    {
        $paymentmethodData = DB::table('paymentmethod_view')->where('paymentMethodId', $paymentMethodId)->first();
        $paymentsummaryData = DB::table('paymentsummary')->where('paymentMethodId', $paymentMethodId)->get();
        $paymentaccountdetailsData = DB::table('paymentaccountdetails')->where('paymentMethodId', $paymentMethodId)->get();

        return view('frontend.paymentmethodupdate', compact('paymentmethodData', 'paymentsummaryData', 'paymentaccountdetailsData'));
    }


    public function paymentMethodUpdate(Request $request, $paymentMethodId)
    {
        // dd($request->all());
        // dd($request->oldPicPath);
        
        $this->validate(
            $request,
            [  
                'paymentMethod' => 'required|unique:paymentmethod,paymentMethodId,'.$request->paymentMethodId.',paymentMethodId'
            ],
            [  
                'paymentMethod.unique' => 'Duplicate record already exist!',
            ]
        );

        // delete childs
        PaymentSummary::where('paymentMethodId', $paymentMethodId)->delete(); 

        // update parent
        PaymentMethod::find($request->paymentMethodId)->update($request->all()); 

        // dd($request->paymentSummary);
        // update child
        if ($request->paymentSummary!=null) 
        {
            foreach($request->paymentSummary as $paymentSummarys=>$v)
            {
                $paymentSummarysData=array
                (
                    'paymentMethodId'=>$paymentMethodId,
                    'paymentSummary'=>$request->paymentSummary[$paymentSummarys],
                    'paymentSummaryCN'=>$request->paymentSummaryCN[$paymentSummarys],
                    'paymentSummaryRU'=>$request->paymentSummaryRU[$paymentSummarys],
                );
                PaymentSummary::insert($paymentSummarysData);
            }
        }

        // delete childs
        PaymentAccountDetails::where('paymentMethodId', $paymentMethodId)->delete(); 

        // update child
        if ($request->paymentAccountDetails!=null) 
        {
            foreach($request->paymentAccountDetails as $paymentAccountDetails=>$v)
            {
                $paymentAccountDetailsData=array
                (
                    'paymentMethodId'=>$paymentMethodId,
                    'paymentAccountDetailsTitle'=>$request->paymentAccountDetailsTitle[$paymentAccountDetails],
                    'paymentAccountDetails'=>$request->paymentAccountDetails[$paymentAccountDetails],
                    'paymentAccountDetailsCN'=>$request->paymentAccountDetailsCN[$paymentAccountDetails],
                    'paymentAccountDetailsRU'=>$request->paymentAccountDetailsRU[$paymentAccountDetails],
                );
                
                PaymentAccountDetails::insert($paymentAccountDetailsData);
                $paymentAccountDetailsId = (int)(DB::getPdo()->lastInsertId());
                // dd($paymentAccountDetailsId);
                // dd($request->picPath[$paymentAccountDetails]);
                // $file = $request->picPath[$paymentAccountDetails];

                if(isset($request->oldPicPath[$paymentAccountDetails]) && $request->oldPicPath[$paymentAccountDetails] != null)
                {
                    PaymentAccountDetails::where('paymentAccountDetailsId', $paymentAccountDetailsId)
                                            ->update([
                                                'picPath' => $request->oldPicPath[$paymentAccountDetails]
                                            ]);
                }

                

                if (isset($request->picPath[$paymentAccountDetails])) 
                {
                    $file = $request->picPath[$paymentAccountDetails];
                    $file->move('uploads/paymentaccountdetails/', 'paymentMethodId-'.$paymentMethodId.'.'.'-accountdetailId-'.$paymentAccountDetailsId.'.'.$file->getClientOriginalExtension());
                    PaymentAccountDetails::where('paymentAccountDetailsId', $paymentAccountDetailsId)
                                            ->update([
                                                'picPath' => '/uploads/paymentaccountdetails/'.'paymentMethodId-'.$paymentMethodId.'.'.'-accountdetailId-'.$paymentAccountDetailsId.'.'.$file->getClientOriginalExtension()
                                            ]);
                }

                

                
                
            }
        }

        return back()->with('successMsg', 'Payment method successfully updated!');
    }

    public function paymentaccountdetailpicDelete($paymentAccountDetailsId)
    {
        DB::table('paymentaccountdetails')->where('paymentAccountDetailsId', $paymentAccountDetailsId)->update([
            'picPath' => ''
        ]);

        return back()->with('successMsg', 'Payment account detail pic deleted!');
    }

        


    public function paymentMethodDelete($paymentMethodId)
    {
        PaymentMethod::find($paymentMethodId)->delete(); 
        return back()->with('successMsg', 'Payment method successfully deleted!');
    }

    // ==============payment methods==================
    // ==============payment methods==================






// 'department' => 'unique_with:department,branchId,'.$request->departmentId.'=departmentId'



    // ==============payment price==================
    // ==============payment price==================
    public function paymentPriceInsert(Request $request)
    {
        $this->validate(
            $request,
            [  
                'countryId' => 'required|unique:paymentprice'
            ],
            [  
                'countryId.unique' => 'Duplicate record already exist!',
            ]
        );

        $inputs = $request->all();
        $inputs = PaymentPrice::create($inputs);
        return back()->with('successMsg', 'New country successfully added!');
    }

    public function paymentPriceEdit($countryId)
    {
        $paymentpriceData = DB::table('paymentprice_view')->where('countryId', $countryId)->get();
        $paymentmethodData = DB::table('paymentmethod')->get();


        return view('frontend.paymentpriceupdate', compact('paymentpriceData', 'paymentmethodData'));
    }


    public function paymentPriceUpdate(Request $request, $countryId)
    {
        

        // delete datas
        PaymentPrice::where('countryId', $countryId)->delete(); 

        // add datas

        if ($request->paymentMethodId!=null) 
        {
            foreach($request->paymentMethodId as $paymentMethodIds=>$v)
            {
                $paymentMethodIdsData=array
                (
                    'countryId'=>$countryId,
                    'paymentMethodId'=>$request->paymentMethodId[$paymentMethodIds],
                    'transactionFee'=>$request->transactionFee[$paymentMethodIds],
                );
                
                PaymentPrice::insert($paymentMethodIdsData);
            }

        }


        return back()->with('successMsg', 'Payment price successfully updated!');
    }


    public function paymentPriceDelete($countryId)
    {
       PaymentPrice::where('countryId', $countryId)->delete();
        return back()->with('successMsg', 'Payment price successfully deleted!');
    }

    // ==============payment price==================
    // ==============payment price==================


    public function getpaymentaccountdetailstitlesagainstpaymentmethod($paymentMethodId)
    {
        $paymentaccountdetails = DB::table("paymentaccountdetails")->where("paymentMethodId",$paymentMethodId)->get();
        return json_encode($paymentaccountdetails);
    }

}
