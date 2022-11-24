<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
class ReportController extends Controller
{
    public function casehistoryreport()
    {
        return view('reports.casehistory');
    }

    public function casehistoryreportgenerator()
    {
        if (request()->has('customerId') && request('customerId')!=null) {
            $casehistoryReport = DB::table('casehistory_view')->where('isDeliveryConfirmed', 1)->where('customerId', request('customerId'))->get();
        }
        else if (request()->has('date') && request('date')!=null) {
            $casehistoryReport = DB::table('casehistory_view')->where('isPaymentConfirm', 1)->where('remindingAlarmDate', request('date'))->get();
        } else {
            $casehistoryReport = DB::table('casehistory_view')->where('isPaymentConfirm', 1)->get();
        }
        return datatables()->of($casehistoryReport)->make(true);
    }
    
    public function casehistoryreportmailsend(Request $request)
    {
        // dd($request->all());
        $mailsettingsData = DB::table('mailsettings')->first();
        $cartData = DB::table('cart')->where('cartId', $request->cartId)->first();
        $usersdata = DB::table('users_view')->get();

        $mailReceiverEmail = $usersdata->where('id', $cartData->customerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $cartData->customerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = $mailReceiverName.'\'s updates/reminding!';
        $bodyMessage = $request->emailBody;
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;


        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);

        $remindingAlarmCount=$cartData->remindingAlarmCount+1;
        DB::table('cart')->where('cartId', $request->cartId)->update(['remindingAlarmCount'=>$remindingAlarmCount]);
        return back()->with('successMsg', 'Successfully Mail Sent!');
    }





    public function priceinquiryreport()
    {
        return view('reports.priceinquiryreport');
    }


    public function priceinquiryreportgenerator()
    {
        if (request()->has('date') && request('date')!=null) 
        {
            $priceinquiryreport = DB::table('priceinquiryreport_view')->where( 'inquiryDate', request('date'))->get();
        } 
        else 
        {
            $priceinquiryreport = DB::table('priceinquiryreport_view')->get();
        }
        return datatables()->of($priceinquiryreport)->make(true);
    }


    public function paymentconfirmationreport()
    {
        return view('reports.paymentconfirmationreport');
    }


    public function paymentconfirmationreportgenerator()
    {
        if (request()->has('date') && request('date')!=null) {
                $paymentconfirmationreport = DB::table('casehistory_view')->where('isPaymentConfirm', 1)->where('paymentConfirmDateWithDash', request('date'))->orderBy('paymentConfirmDateYear', 'desc')->orderBy('paymentConfirmDateMonth', 'desc')->orderBy('paymentConfirmDateDay', 'desc')->get();
        } else {
                $paymentconfirmationreport = DB::table('casehistory_view')->where('isPaymentConfirm', 1)->orderBy('paymentConfirmDateYear', 'desc')->orderBy('paymentConfirmDateMonth', 'desc')->orderBy('paymentConfirmDateDay', 'desc')->get();
        }
        
        return datatables()->of($paymentconfirmationreport)->make(true);
    }


    public function allcustomersdata()
    {
        return view('reports.allcustomersdata');
    }


    public function allcustomersdatagenerator()
    {
        if (request()->has('customerId') && request('customerId')!=null) 
        {
            $paymentconfirmationreport = DB::table('allcustomersdatareport_view')->where('id', request('customerId'))->get();
        } 
        else 
        {
            $paymentconfirmationreport = DB::table('allcustomersdatareport_view')->get();
        }
        return datatables()->of($paymentconfirmationreport)->make(true);
    }


    public function allcustomersdatareportpriceinquireremidermailsend(Request $request)
    {
        // dd($request->all());
        $mailsettingsData = DB::table('mailsettings')->first();
        $usergenericinquiryData = DB::table('usergenericinquiry')->where('userGenericInquiryId', $request->userGenericInquiryId)->first();
        $usersdata = DB::table('users_view')->get();

        // dd($usergenericinquiryData);

        $mailReceiverEmail = $usersdata->where('id', $usergenericinquiryData->inquirerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $usergenericinquiryData->inquirerId)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $subject = $mailReceiverName.'\'s reminding!';
        $bodyMessage = $request->emailBody;
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;


        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);

        $sendingMailCount=$usergenericinquiryData->sendingMailCount+1;
        DB::table('usergenericinquiry')->where('userGenericInquiryId', $request->userGenericInquiryId)->update(['sendingMailCount'=>$sendingMailCount]);
        return back()->with('successMsg', 'Successfully Mail Sent!');
    }




    // ==============products report================
    // ==============products report================

    public function productsreport()
    {
        $productsreportData = DB::table('productsreport_view')->get();
        $countryData = DB::table('product_sold_countries_view')->get();
        $cartdetailsData = DB::table('cartdetails_view')->get();

        return view('reports.productsreport', compact('productsreportData', 'countryData', 'cartdetailsData'));
    }

    
    public function productsreportgenerator()
    {
        $reviewData = DB::table('review')->get();
        $cartdetailsData = DB::table('cartdetails_view')->get();

        // initial loading
        // which product sold how many times 
        $productsreport = DB::table('productsreport_view')->get();

        if(request()->has('isInitialLoading') and request('isInitialLoading')==1)
        {
            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                return $record;
            });
        }
        else if( request()->has('filter1') && request('filter1')==1)
        {
            $genericBrandId = request('genericBrandId');
            $productsreport = $productsreport->where('genericBrandId', $genericBrandId);
            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                return $record;
            });
        }
        else if( request()->has('filter1withDateRange') && request('filter1withDateRange')==1 && request()->has('date1') && request()->has('date2') )
        {
            $genericBrandId = request('genericBrandId');
            if ($genericBrandId!=-1) // -1 = all products
            {
                $productsreport = $productsreport->where('genericBrandId', $genericBrandId);
            } 

            $date1 = dmyToYmd(request('date1'));
            $date2 = dmyToYmd(request('date2'));

            // dd($date1);

            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData, $date1, $date2) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);

                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                return $record;
            });
            
        }
        else if( request()->has('filter2') && request('filter2')==1)
        {
            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                return $record;
            });
            $productsreport = $productsreport->where('soldQty','<',1);
        }
        else if( request()->has('filter3') && request('filter3')==1)
        {
            $productsreport = $productsreport->where('totalInquired','>',0);

            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                return $record;
            });
            $productsreport = $productsreport->where('soldQty','<',1);
        }
        else if( request()->has('filter4') && request('filter4')==1)
        {
            $country = request('country');
            
            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData, $country) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                if(Str::is("*{$country}*", $record->country) )
                {
                    return $record;
                }
            });

            $productsreport = $productsreport->where('country', '!=', null);
            // dd($productsreport);
        }
        else if( request()->has('filter4withDateRange') && request('filter4withDateRange')==1 && request()->has('date1') && request()->has('date2') )
        {
            $country = request('country');

            $date1 = dmyToYmd(request('date1'));
            $date2 = dmyToYmd(request('date2'));

            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData, $date1, $date2, $country) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);

                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                if(Str::is("*{$country}*", $record->country) )
                {
                    return $record;
                }
            });

            $productsreport = $productsreport->where('country', '!=', null);
        }
        else if( request()->has('filter5') && request('filter5')==1)
        {
            $genericCompanyId = request('companyId');
            $productsreport = $productsreport->where('genericCompanyId', $genericCompanyId);

            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $record->genericPackSizeId);

                return $record;
            });
        }
        else if( request()->has('filter5withDateRange') && request('filter5withDateRange')==1 && request()->has('date1') && request()->has('date2') )
        {
            $genericCompanyId = request('companyId');
            $productsreport = $productsreport->where('genericCompanyId', $genericCompanyId);
        
            $date1 = dmyToYmd(request('date1'));
            $date2 = dmyToYmd(request('date2'));

            $productsreport = $productsreport->map(function ($record) use($reviewData, $cartdetailsData, $date1, $date2) 
            {
                $record->rating = (int) self::getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);
                $record->totalReview =  self::getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $record->genericBrandId);

                $record->soldQty =  self::getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);
                $record->sellingPrice =  self::getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                $record->country = self::getCountryListFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $record->genericPackSizeId, $date1, $date2);

                return $record;
            });
            
        }

        
        return datatables()->of($productsreport)->make(true);
    }


    public function getRatingFromGeneriBrandIdAndReviewIsApproved($reviewData, $genericBrandId)
    {
        $rating = $reviewData
                    ->where('genericBrandId', $genericBrandId)
                    ->where('isApproved', 1)
                    ->avg('rating');
        return $rating;
    }

    public function getTotalReviewFromGeneriBrandIdAndReviewIsApproved($reviewData, $genericBrandId)
    {
        $rating = $reviewData
                    ->where('genericBrandId', $genericBrandId)
                    ->where('isApproved', 1)
                    ->count('rating');
        return $rating;
    }

    public function getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $genericPackSizeId)
    {
        $soldQty = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->sum('qty');
        return $soldQty;
    }

    public function getSoldQtyFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $genericPackSizeId, $date1, $date2)
    {
        $soldQty = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->where('paymentConfirmDate', '>=', $date1)
                    ->where('paymentConfirmDate', '<=', $date2)
                    ->sum('qty');
        return $soldQty;
    }

    public function getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $genericPackSizeId)
    {
        $sellingPrice = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->sum('cartsubtotalwithdiscount');
        return $sellingPrice;
    }

    public function getCartSubTotalWithDiscountFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $genericPackSizeId, $date1, $date2)
    {
        $sellingPrice = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->where('paymentConfirmDate', '>=', $date1)
                    ->where('paymentConfirmDate', '<=', $date2)
                    ->sum('cartsubtotalwithdiscount');
        return $sellingPrice;
    }


    public function getCountryListFromGenericPackSizeIdAndIsPaymentConfirm($cartdetailsData, $genericPackSizeId)
    {
        $countryList = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->unique('country');
        $countryList = $countryList->sortBy('country');
        $countryList = $countryList->pluck('country')->implode(':');

        return $countryList;
    }

    public function getCountryListFromGenericPackSizeIdAndIsPaymentConfirmWDRange($cartdetailsData, $genericPackSizeId, $date1, $date2)
    {
        $countryList = $cartdetailsData
                    ->where('genericPackSizeId', $genericPackSizeId)
                    ->where('isPaymentConfirm', 1)
                    ->where('paymentConfirmDate', '>=', $date1)
                    ->where('paymentConfirmDate', '<=', $date2)
                    ->unique('country');
        $countryList = $countryList->sortBy('country');
        $countryList = $countryList->pluck('country')->implode(':');

        return $countryList;
    }







    public function uploadingthirdpartdataindex()
    {
        return view('reports.uploadingthirdpartydataindex');
    }
    public function uploadingthirdpartdataindexgenerator()
    {
        $thirdpartydataReport = DB::table('thirdpartydata_view')->get();
        return datatables()->of($thirdpartydataReport)->make(true);
    }
    

    public function uploadingthirdpartydata_c()
    {
        DB::table('thirdpartydata')->insert([
            'created_at' => now()
        ]);

        $thirdpartydataId = DB::getPdo()->lastInsertId();

        return redirect(route('uploadingthirdpartydata_e', $thirdpartydataId));
    }

    public function uploadingthirdpartydata_e($thirdpartydataId)
    {
        $supplierData = DB::table('supplier')->get();
        $cartData = DB::table('cart_view')->get();

        $thirdpartydata = DB::table('thirdpartydata')->where('thirdpartydataId', $thirdpartydataId)->first();
        $thirdpartydata_cartsData = DB::table('thirdpartydata_carts_view')->where('thirdpartydataId', $thirdpartydataId)->get();
        $thirdpartydata_filesData = DB::table('thirdpartydata_files')->where('thirdpartydataId', $thirdpartydataId)->get();
        
        return view('reports.uploadingthirdpartydata_e', compact('supplierData', 'cartData', 'thirdpartydata', 'thirdpartydata_cartsData', 'thirdpartydata_filesData'));
    }

    public function uploadingthirdpartydata_e_update(Request $request, $thirdpartydataId)
    {
        DB::table('thirdpartydata_carts')->where('thirdpartydataId', $thirdpartydataId)->delete(); 

        DB::table('thirdpartydata')->where('thirdpartydataId', $thirdpartydataId)
        ->update([
            'purchasingDate'=> dmyToYmd($request->purchasingDate),
            'supplierId'=> $request->supplierId,
            'purchaseAmount'=> $request->purchaseAmount,
        ]);


        if ($request->cartId != null) 
        {
            foreach($request->cartId as $cartIds=>$v)
            {
                DB::table('thirdpartydata_carts')->insert([
                    'cartId'=>$request->cartId[$cartIds],
                    'thirdpartydataId'=>$thirdpartydataId,
                ]);
            }
        }

        if ($request->filePath != null) 
        {
            foreach($request->filePath as $filePaths=>$v)
            {
                DB::table('thirdpartydata_files')->insert([
                    'thirdpartydataId'=>$thirdpartydataId,
                ]);

                $thirdpartdata_filesId = DB::getPdo()->lastInsertId();

                $file = $request->filePath[$filePaths];
                $file->move('uploads/thirdpartydata/', 'thirdpartdata_filesId-'.$thirdpartdata_filesId.'.'.$file->getClientOriginalExtension());

                
                DB::table('thirdpartydata_files')->where('thirdpartdata_filesId', $thirdpartdata_filesId)
                ->update([
                    'filePath'=> '/uploads/thirdpartydata/'.'thirdpartdata_filesId-'.$thirdpartdata_filesId.'.'.$file->getClientOriginalExtension(),
                ]);
                
            }
        }

        return back()->with('successMsg', 'Successfully saved!');
    }


    public function uploadingthirdpartydata_delete_file($thirdpartdata_filesId)
    {
        DB::table('thirdpartydata_files')->where('thirdpartdata_filesId', $thirdpartdata_filesId)->delete();
        return back()->with('successMsg', 'Successfully deleted!');
    }

    public function uploadingthirdpartydata_delete($thirdpartydataId)
    {
        DB::table('thirdpartydata')->where('thirdpartydataId', $thirdpartydataId)->delete();
        return back()->with('successMsg', 'Successfully deleted!');
    }

    

    
}
