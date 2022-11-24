<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Input;
use App\UserGenericInquiry;

use DB;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller {

	public function basic_email() {
		$data = array('name' => "Multiplexer Lab");

		Mail::send(['text' => 'mail'], $data, function ($message) {
			$message->to('miral.trainer@gmail.com', 'Multiplexer Lab')->subject
				('Laravel Basic Testing Mail');
			$message->from('info@multiplexer-lab.com', 'Multiplexer Lab');
		});
		echo "Basic Email Sent. Check your inbox.";
	}

	// working on that================================
	// working on that================================
	public function html_email() 
	{

		 // $name = $request->input('name');
		// var_dump($_GET);

		// $cname = $_GET["name"];
		// $cemail = $_GET["email"];
		// $cphone = $_GET["telefon"];
		// $cwebsite = $_GET["website"];
		// $cmessage = $_GET["message"];

		// $data(array) – array of data to pass to view
		$data = array(
						'cname' => $_GET["name"],
						'cmail'=>$_GET["email"],
						'cphone'=>$_GET["telefon"],
						'cwebsite'=>$_GET["website"],
						'cmessage'=>$_GET["message"],
						'caddress'=>$_GET["address"]

					);

		

		Mail::send('mail', $data, function ($message) {
			$message->to('miral.trainer@gmail.com', 'Multiplexer Lab')->subject
				('Multiplexer Lab Contact');
			$message->from('info@multiplexer-lab.com', $_GET["name"]);
		});

		Mail::send('mail', $data, function ($message) {
			$message->to('saifuroracle@gmail.com', 'Multiplexer Lab')->subject
				('Multiplexer Lab Contact');
			$message->from('info@multiplexer-lab.com', $_GET["name"]);
		});

		echo "<script type='text/javascript'>alert('Message Sent!');</script>";
		echo "<script>location.href='/?#contactus';</script>";

		// header('/');
		// Alert::info("<strong>Warning!</strong> This is your message.");
		// myFunction();
		// Route::view('/');
		// echo myFunction();
	}




	public function attachment_email() {
		$data = array('name' => "Multiplexer Lab");
		Mail::send('mail', $data, function ($message) {
			$message->to('info@multiplexer-lab.com', 'Tutorials Point')->subject
				('Laravel Testing Mail with Attachment');
			// $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
			// $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
			$message->from('info@multiplexer-lab.com', 'Multiplexer Lab');
		});
		echo "Email Sent with attachment. Check your inbox.";
	}


	public function customerPriceInquireRequestMailSend(Request $request) 
	{
		
		// setSessionLanguage();
        $inputs = $request->all();

		$prescriptionLinks = '';
		
		if ($request->prescriptionPath==null){
			$prescriptionPathData=array
			(
				'inquirerId'=>$request->inquirerId,
				'genericPackSizeId'=>$request->genericPackSizeId,
				'message'=>$request->message,
				'isPrescription'=>0,
			);

			UserGenericInquiry::create($prescriptionPathData);
		} 


        if ($request->prescriptionPath!=null) 
        {
            $batchNumber = DB::table('usergenericinquiry')->selectRaw('max(ifnull(batch, 0)) as batchNumber')->pluck('batchNumber')->first();
            $batchNumber += 1 ;
            
            $index = 0;
            foreach($request->prescriptionPath as $prescription=>$v)
            {
                $index++;
                $prescriptionPathData=array
                (
                    'inquirerId'=>$request->inquirerId,
                    'batch'=>$batchNumber,
                    'prescriptionPath'=>$request->prescriptionPath[$prescription],
                    'genericPackSizeId'=>$request->genericPackSizeId,
                    'message'=>$request->message,
                    'isPrescription'=>0,
                );

                // dd($prescriptionPathData);
                $lastCreatedUserGenericInquiryId = UserGenericInquiry::create($prescriptionPathData)->userGenericInquiryId;
                $randomNumber = rand(99,99999);
                
                $file = $prescriptionPathData['prescriptionPath'];
                $file->move('uploads/prescriptions/', 'prescription_'.$lastCreatedUserGenericInquiryId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

                UserGenericInquiry::find($lastCreatedUserGenericInquiryId)->update(['prescriptionPath'=>'/uploads/prescriptions/'.'prescription_'.$lastCreatedUserGenericInquiryId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]);

                $prescriptionLink = '/uploads/prescriptions/'.'prescription_'.$lastCreatedUserGenericInquiryId.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
                $prescriptionLinks = $prescriptionLinks.'<li>'.'<a href="'.url('/').$prescriptionLink.'" target="_blank">'.'Click link file_'.$index.'</a></li>';
            }
        }

        $genericpacksizeData = DB::table('genericpacksizes_view')->where('genericPackSizeId', $request->genericPackSizeId)->first();
        $userData = DB::table('users_view')->where('id', $request->inquirerId)->first();
        $product = $genericpacksizeData->genericBrand.' ('.$genericpacksizeData->genericName.' '.$genericpacksizeData->genericStrength.'), '.$genericpacksizeData->genericPackSize.'\'s '.$genericpacksizeData->packType.' | '.$genericpacksizeData->dosageForm.' | '.$genericpacksizeData->genericCompany;

        DB::table('notifications_admin')->insert([
          'inquirerId' => $request->inquirerId, 
          'message' => $userData->email.' price inquired for '.$product,
          'message2' => $userData->email.' price inquired for '.$product,
        ]);




        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $request->inquirerId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $request->inquirerId)->pluck('name')->first();
        
        $subject = 'Your price inquiry for '.$product.' sent!';
		$bodyMessage = 'Your price inquiry product is:'.'<br>'
										.'Generic Brand: '.$genericpacksizeData->genericBrand .'<br>'
										.'Generic Name: '.$genericpacksizeData->genericName .'<br>'
										.'Generic Strength: '.$genericpacksizeData->genericStrength .'<br>'
										.'Pack Size: '.$genericpacksizeData->genericPackSize .'<br>'
										.'Pack Type: '.$genericpacksizeData->packType .'<br>'
										.'Dosage Form: '.$genericpacksizeData->dosageForm .'<br>'
										.'Generic Company: '.$genericpacksizeData->genericCompany .'<br><br>'
										.'<strong>User Information:</strong> <br>'
										.'Name: '. $mailReceiverName.'<br>'
										.'Email: '. $mailReceiverEmail.'<br>'
										.'Message: '. $request->message.'<br>'
										.'<br><br> Prescription/Document Links: '.'<ul>'.$prescriptionLinks.'</ul>'
										.'<br><p style="text-align: justify;">We will check and provide price information soon. Please check your profile notification or email.</p>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
		// =================mail sending=============
		


		return redirect()->back()->with('successMsg', 'Successfully price inquiry mail sent. Please keep an eye on your email. We will contact you soon!');
	}

	


}
