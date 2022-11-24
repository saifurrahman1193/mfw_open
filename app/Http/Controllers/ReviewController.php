<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Review;
use DB;
use Auth;

class ReviewController extends Controller
{

    public function customerWriteAReview(Request $request)
    {
        $this->validate($request, [
            'manualName'  => 'required',
            'manualEmail'  => 'required',
            'manualCountryCode'  => 'required',
            'manualPhone'  => 'required',
        ]);

        // setSessionLanguage();
        $inputs = $request->all();
        Review::create($inputs);

        $reviewId = DB::getPdo()->lastInsertId();

        $genericbrandData = DB::table('genericbrand_view')->where('genericBrandId', $request->genericBrandId)->first();
        $product = $genericbrandData->genericBrand.' ('.$genericbrandData->genericName.') | '.$genericbrandData->genericCompany;


        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';

        // if (Auth::check()) {
        //     $usersdata = DB::table('users_view')->get();
        //     $mailReceiverEmail = $usersdata->where('id', $request->reviewerId)->pluck('email')->first();
        //     $mailReceiverName = $usersdata->where('id', $request->reviewerId)->pluck('name')->first();
        // }
        $mailReceiverName = $request->manualName;
        $mailReceiverEmail = $request->manualEmail;
        
        $subject = $mailReceiverName.'\'s submitted review for '.$product;
        $bodyMessage = 'You submitted review for '.$product;

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============


        // =========================notifications=======================
        // notifications_admin=============
        DB::table('notifications_admin')->insert([
            [
                'reviewerId' => (Auth::check() ? Auth::user()->id : null),
                'reviewId' => $reviewId,
                'genericBrandId' => $request->genericBrandId,
                'message' => $mailReceiverEmail.'\'s submitted review for '.$product,
                'message2' => $mailReceiverEmail.'\'s submitted review for '.$product,
            ],
        ]);
        // notifications_admin=============


        
        return back()->with('message', 'Successfully review submitted!')->with('customerWriteAReview', 1);
    }




}
