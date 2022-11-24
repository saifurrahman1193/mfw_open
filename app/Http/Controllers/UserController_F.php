<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\UserRoles;



use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


// use Illuminate\Foundation\Auth\AuthenticatesUsers;

// login
use Input;
use Redirect;
use Route;
use App\UserGenericInquiry;


use \Gumlet\ImageResize;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Crypt;

class UserController_F extends Controller
{

    public function index()
    {
        $users = DB::table('user_personal_info_with_role_modules_view')->get();
        $roles = DB::table('roles')->select('roleId', 'role', 'description')->get();
        return view('user.index', compact('users', 'roles'));
    }

    public function userRoles()
    {
        $users = DB::table('users')->get();
        return view('user/userRoles', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerregistration($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
          
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return  DB::table('genericbrand_view')->get();
        });
        
        if(Auth::check()) { return redirect(route('home_f', $language)); } 


        return view('frontend.register_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    public function customerLogout(Request $request,  $language ) 
    {
        Auth::logout();
        return redirect()->route('home_f', $language);
    }


    public function customerLogin($language)
    {
      
      // setSessionLanguage();
      include(app_path().'/includes/commonsqlqueriesforfrontend.php');

      $genericbrandData = Cache::remember('genericbrandData', 100, function () {
          return  DB::table('genericbrand_view')->get();
      }); 

      if(Auth::check()) { return redirect(route('home_f', $language)); } 
         
        return view('frontend.login_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData' , 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }

    public function customerLoginPost(Request $request, $language)
    {
            // setSessionLanguage();

                // Creating Rules for Email and Password
            $rules = array(
              'emailOrPhone' => 'required', // make sure the email is an actual email
              'password' => 'required'
              );

              $requestData = $request->all();
              // dd($requestData);

              // modify somehow
              $phone = $requestData['emailOrPhone'];

              // dd(DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->get());

              if (DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->count())  // if it is phone then get mail using phone
              {
                  $requestData['emailOrPhone'] = DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->pluck('email')->first();
              } 


              

              // dd($requestData);


              // password has to be greater than 3 characters and can only be alphanumeric and);
              // checking all field
              $validator = Validator::make($requestData , $rules);
              // if the validator fails, redirect back to the form
              if ($validator->fails())
              {
              return Redirect::to('login', $language)->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
              }
              else
              {

                  $userinfo = DB::table('users_view')->where('email', $requestData['emailOrPhone'])->first();

                  if( ! isset($userinfo))
                  {
                      return redirect(route('customerLogin', $language))->with('invalidUser', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->passwordChangedCount>=3)
                  {

                     // notifications_admin=============
                        DB::table('notifications_admin')->insert([
                          [
                              'loginLimitCrosserId' => $userinfo->id, 
                              'message' => $userinfo->email.' user crossed password change limit!',
                              'message2' => $userinfo->email.' user crossed password change limit!',
                          ],
                      ]);
                      // notifications_admin=============

                      return redirect(route('customerLogin', $language))->with('passwordChangeLimitCrossed', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->isEmailVerified!=1)
                  {
                      return redirect(route('customerLogin', $language))->with('emailnotverified', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->isDeleted==1)
                  {
                      return redirect(route('customerLogin', $language))->with('isDeleted', 1); 
                  }

                  // create our user data for the authentication
                  $userdata = array(
                    'email' => $requestData['emailOrPhone'] ,
                    'password' => Input::get('password')
                  );
                  // attempt to do the login
                  if (Auth::attempt($userdata))
                  {
                  // validation successful
                  // do whatever you want on success
                    return redirect(Route('home_f', $language ));
                    // return Redirect::back();
                  }
                  else
                  {
                      return redirect(route('customerLogin', $language))->with('invalidUser', 1); 
                  }
              }
    }

    public function customerLoginPost2(Request $request, $language, $genericBrandId)
    {

          // setSessionLanguage();

              // Creating Rules for Email and Password
          $rules = array(
            'emailOrPhone' => 'required', // make sure the email is an actual email
            'password' => 'required'
            );

            $requestData = $request->all();
            // dd($requestData);

            // modify somehow
            $phone = $requestData['emailOrPhone'];
            // dd($phone);
            // dd(DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->count());

            if (DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->count())  // if it is phone then get mail using phone
            {
                $requestData['emailOrPhone'] = DB::table('login_users_view')->where('phone', $phone)->orWhere('mergedPhone', $phone)->pluck('email')->first();
            } 

            

            // dd($requestData);
              // password has to be greater than 3 characters and can only be alphanumeric and);
            // checking all field
            $validator = Validator::make($requestData , $rules);
            // if the validator fails, redirect back to the form
            if ($validator->fails())
              {
              return Redirect::to('login', $language)->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
              }
              else
              {

                $userinfo = DB::table('users_view')->where('email', $requestData['emailOrPhone'])->first();
                if( ! isset($userinfo))
                  {
                      return redirect(route('customerLogin',$language))->with('invalidUser', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->passwordChangedCount>=3)
                  {

                     // notifications_admin=============
                        DB::table('notifications_admin')->insert([
                          [
                              'loginLimitCrosserId' => $userinfo->id, 
                              'message' => $userinfo->email.' crossed password change limit!',
                              'message2' => $userinfo->email.' crossed password change limit!',
                          ],
                      ]);
                      // notifications_admin=============

                      return redirect(route('customerLogin', $language))->with('passwordChangeLimitCrossed', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->isEmailVerified!=1)
                  {
                      return redirect(route('customerLogin', $language))->with('emailnotverified', 1); 
                  }

                  if( isset($userinfo) and  $userinfo->isDeleted==1)
                  {
                      return redirect(route('customerLogin', $language))->with('isDeleted', 1); 
                  }


              // create our user data for the authentication
              $userdata = array(
                    'email' => $requestData['emailOrPhone'] ,
                    'password' => Input::get('password')
                  );
              // attempt to do the login
              if (Auth::attempt($userdata))
                {
                // validation successful
                // do whatever you want on success
                  // return redirect(Route('home_f'));
                  session()->flash('cstomerloginforpriceinquiry', 1);
                  return redirect()->route('productDetailsPageCaller', array($language, $genericBrandId));
                }
                else
                {
                // validation not successful, send back to form
                  return redirect(route('customerLogin', $language))->with('invalidUser', 1); 
                  
                }
            }
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerRegistrationInsert(Request $request, $language)
    {
        // dd($request->all());

        // setSessionLanguage();
        $todayNumberOfYear = carbondatetimeToDayNumberOfYear(\Carbon\Carbon::now());

        $this->validate($request, [
                'email' => 'required|email|unique:users',
                'phone' => 'required|min:4|max:11|unique_with:users,phoneCode',
                'password' => 'required|min:6',
                'confirmpassword' => 'required_with:password|same:password',
                'cn1' => 'required|numeric',
                'cn2' => 'required|numeric',
                'cn3' => 'required|numeric',
                'isFormValidToSubmit' => 'required|numeric',
                'td' => 'required|string',
                'tddn_'.$todayNumberOfYear => 'required|numeric',
            ],
            [ 
                'confirmpassword.required_with' => 'Confirm password required!',
                'confirmpassword.same' => 'Password & confirm password must match!',
                'phone.unique_with' => 'Same phone already exist!',
            ]
        );

      $todaydateYmd = carbondatetimeToYmd(\Carbon\Carbon::now());


      if ($todaydateYmd != $request->td) {
        return back();
      }

      if ($todayNumberOfYear != request('tddn_'.$todayNumberOfYear)) {
        return back();
      }



        $inputs = $request->all();
        
        $lastCreatedUserId = User::create($inputs)->id;

        // UserRoles::create([
        //     'userId'=>$lastCreatedUserId,
        //     'roleId'=>3  // 3 = customer role
        // ]);



        if(Input::hasFile('photoPath')){

            // echo 'Uploaded';
            $file = Input::file('photoPath');
            
            // $imgSize = $file->getSize()/1024;  // byte/1024 = KB

            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/users/', 'userId-'.$lastCreatedUserId.'.'.$file->getClientOriginalExtension());
            User::find($lastCreatedUserId)->update(['photoPath' => '/uploads/users/'.'userId-'.$lastCreatedUserId.'.'.$file->getClientOriginalExtension()]);

            /////////////////////////////////////////
            // compressing image================== //
            /////////////////////////////////////////
            // $image = new ImageResize('uploads/users/'.'userId-'.$lastCreatedUserId.'.'.$file->getClientOriginalExtension());


            // include(app_path().'/includes/image_compress_logics.php');

            
            // unlink('uploads/users/'.'userId-'.$lastCreatedUserId.'.'.$file->getClientOriginalExtension());
            // $image->save('uploads/users/'.'userId-'.$lastCreatedUserId.'.'.$file->getClientOriginalExtension());

        }

        // after signup automatically login=====================
        // Auth::loginUsingId($lastCreatedUserId);



          // =========================notifications=======================
          // notifications_admin=============
          DB::table('notifications_admin')->insert([
              [
                  'registerUserId' => $lastCreatedUserId,
                  'message' => $request->email.' customer has been registered!',
                  'message2' => $request->email.' customer has been registered!',
              ],
          ]);
          // notifications_admin=============

          

        // sending email verify link
        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailReceiverEmail = $request->email;
        $mailReceiverName = $usersdata->where('email', $request->email)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        
        $subject = $mailReceiverName.'\'s user verification confirmation!';
        $bodyMessage = 'Welcome to Medicine For World (MFW)!<br> Please click the below link to complete your registration.'.' <br><br>'.'<h2> <a href="'.url('/').'/'.$language.'/dynamicUserEmailVerificationFromEncryption'.'/'.Crypt::encrypt($request->email).'">Verification Link!</a> </h2>'.' <br> Or go to this link : '.url('/').'/'.$language.'/dynamicUserEmailVerificationFromEncryption'.'/'.Crypt::encrypt($request->email);
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============


        return redirect(Route('customerLogin', [$language,'emailverifiedlinksent'=> 1 ]))->with('successMsg', 'Registration complete!');
    }

    public function dynamicUserEmailVerificationFromEncryption($language, $email)
    {
        // setSessionLanguage();
        $email = Crypt::decrypt($email);

        DB::table('users')->where('email', $email)->update([
          'isEmailVerified' => 1
        ]);
          
        return redirect()->route('customerLogin', [$language,'userVerified'=> 1 ]); 
    }





    // customer prescription======
    public function customerPrescriptions(Request $request, $language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();
         
        $genericbrandData = DB::table('genericbrand_view')->get(); 
        $genericpacksizesData = DB::table('genericpacksizes_view')->get(); 
        

        
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        $notificationData = DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get();


        // $usergenericinquiryData = DB::table('usergenericinquiry_view')->where('inquirerId', Auth::user()->id)->whereNotNull('prescriptionPath')->get();
        $usergenericinquiryData = DB::table('usergenericinquiry_view')->where('inquirerId', Auth::user()->id)->get();

        return view('frontend.prescriptionlist_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData', 'userData', 'usergenericinquiryData', 'notificationData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData' , 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'genericpacksizesData'));
    }


    public function customerPrescriptionInsert(Request $request, $language)
    {

        // setSessionLanguage();
        $inputs = $request->all();

        $prescriptionLinks = '';


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
                    'isPrescription'=>1,
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
          'documentAdderId' => $request->inquirerId, 
          'message' => $userData->email.' added prescription/document for '.$product,
          'message2' => $userData->email.' added prescription/document for '.$product,
        ]);




        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $request->inquirerId)->pluck('email')->first();
        $mailReceiverName  = $usersdata->where('id', $request->inquirerId)->pluck('name')->first();
        
        $subject = $mailReceiverName.'\'s prescription/document successfully uploaded for '.$product;
        $bodyMessage = 'Your prescription/document uploaded for '.$product.'<br><br> Message: '.$request->message.'<br><br> Prescription/Document Links: '.'<ul>'.$prescriptionLinks.'</ul>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============


    
        return back()->with('message', 'Successfully prescription added!')->with('prescriptionUploaded', 1);
    }
    // customer prescription======




    // ===================================order history===============================
    // ===================================order history===============================
    // customer prescription======
    public function customerOrderHistory($language)
    {
      include(app_path().'/includes/commonsqlqueriesforfrontend.php');

      // setSessionLanguage();
        // prerequisite data
         
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return DB::table('genericbrand_view')->get(); 
        });

        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
       


        // main data
        $cartData = DB::table('cart_view')->where('customerId', Auth::user()->id)->get();
        $cartdetailsData = DB::table('cartdetails_view')->where('customerId', Auth::user()->id)->get();
        $deliverymethodsData = Cache::remember('deliverymethodsData', 100, function () {
            return DB::table("deliverymethod")->get(); 
        });
        
        $genericpacksizes_with_customer_price_Data = DB::table('genericpacksizes_with_customer_price_view')->where('customerId', Auth::user()->id)->get();
        $usdToCurrencyRate = $countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first();
        
        
        $cartarejectreasonsData = Cache::remember('cartarejectreasonsData', 100, function () {
            return DB::table("cartarejectreasons")->get();
        });
        $cartarejectsolutionsData = Cache::remember('cartarejectsolutionsData', 100, function () {
          return DB::table("cartarejectsolutions")->get(); 
        });

        $cartapprovesData = DB::table("cartapproves_view")->get();

        $cartpaymentreceiptmessagesData = DB::table('cartpaymentreceiptmessages')->get();
        $trackingData = DB::table('tracking')->get();
        $cartdeliveryinfoData = DB::table('cartdeliveryinfo')->get();
        $paymentsummaryData = DB::table('paymentsummary')->get();

        $trackingpicturesData = DB::table('trackingpictures')->get();

        

        return view('frontend.orderhistory_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData', 'userData',  'notificationData', 'cartData', 'deliverymethodsData', 'cartdetailsData', 'genericpacksizes_with_customer_price_Data', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData' , 'cartarejectreasonsData', 'cartarejectsolutionsData', 'cartapprovesData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data', 'cartpaymentreceiptmessagesData', 'trackingData', 'cartdeliveryinfoData', 'paymentsummaryData', 'trackingpicturesData'));

    }

    
    // ===================================order history===============================
    // ===================================order history===============================




    // ===================================profile update===============================
    // ===================================profile update===============================
    // customer prescription======
    public function profileUpdate($language)
    {
      include(app_path().'/includes/commonsqlqueriesforfrontend.php');

      // setSessionLanguage();
        // prerequisite data

        
          
        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return  DB::table('genericbrand_view')->get();
        }); 

       
        $userData = DB::table('users')->where('id', Auth::user()->id)->first();
        $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');

        return view('frontend.profileupdate_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'wishlistData', 'compareData', 'userData',  'notificationData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData', 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }

    public function useprofilepicDelete($language, $userId)
    {
        DB::table('users')->where('id', $userId)->update([
            'photoPath' => ''
        ]);

        return back()->with('successMsg', 'Profile pic deleted!');
    }

    public function customerAccountDelete($language)
    {
      include(app_path().'/includes/commonsqlqueriesforfrontend.php');

      // setSessionLanguage();

      DB::table('users')->where('id', Auth::user()->id)->update(
        [
          'isDeleted' => 1
        ]
      );


      


      // =================mail sending=============
      // =================mail sending=============
      $mailsettingsData = DB::table('mailsettings')->first();
      $usersdata = DB::table('users_view')->get();
      
      $mailSenderEmail = $mailsettingsData->mail;
      $mailSenderName = 'Medicine For World';
      $mailReceiverEmail = $usersdata->where('id', Auth::user()->id)->pluck('email')->first();
      $mailReceiverName = $usersdata->where('id', Auth::user()->id)->pluck('name')->first();
      
      $subject = $mailReceiverName.'\'s has been profile deleted successfully.';
      $bodyMessage = 'Your profile deleted successfully.';

      $website = $mailsettingsData->website;
      $contactMails = $mailsettingsData->contactMails;
      $numberTitle = $mailsettingsData->numberTitle;
      $number = $mailsettingsData->number;
      $logo = $mailsettingsData->logo;
      
      
      mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
      // =================mail sending=============
      // =================mail sending=============


      DB::table('notifications_admin')->insert([
        'profileDeleterId' => Auth::user()->id,
        'message' => $mailReceiverEmail.'\'s profile deleted successfully.',
        'message2' => $mailReceiverEmail.'\'s profile deleted successfully.',
    ]);
      

      Auth::logout();
      return redirect()->route('home_f', $language);
    }


    


    public function customerRegistrationUpdate(Request $request, $language)
    {
        $this->validate(
            $request,
            [  
              'photoPath'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF',
              'phone' => 'required|unique_with:users,phoneCode,'.$request->id.'=id',
            ],
            [ 
              'phone.unique_with' => 'Same phone already exist!',
            ]
        );

        $passwordChange=0;

        if ($request->password != null) 
        {
            User::find(Auth::user()->id)->update($request->all()); 
            $passwordChange=1;
        }
        else {
            User::find(Auth::user()->id)->update($request->except(['_token','_method', 'password'])); 
        }

        if(Input::hasFile('photoPath')){
            $file = Input::file('photoPath');
            // $imgSize = $file->getSize()/1024;  // byte/1024 = KB

            $file->move('uploads/users/', 'userId-'.Auth::user()->id.'.'.$file->getClientOriginalExtension());

            User::where('id', Auth::user()->id)->update(['photoPath'  => '/uploads/users/'.'userId-'.Auth::user()->id.'.'.$file->getClientOriginalExtension()]);
        }

        // ==============Notification===========
        DB::table('notifications_admin')->insert([
            'profileUpdaterId' => $request->id,
            'message' => $request->email.' profile has been successfully updated.',
            'message2' => $request->email.' profile has been successfully updated.',
        ]);

        DB::table('notifications')->insert([
            'receiverId' => $request->id,
            'isProfileUpdate' => 1,
            'message' => 'Your profile has been successfully updated.',
            'message2' => 'Your profile has been successfully updated.',
        ]);
        // ==============Notification============

        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $request->id)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $request->id)->pluck('name')->first();
        
        $subject = $mailReceiverName.'\'s profile has been updated';
        $bodyMessage = 'Your profile has been updated';

        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
        // =================mail sending=============

        if ($passwordChange==1) {
          return back()->with('successMsg', 'Your profile successfully updated!')->with('passwordChanged', 1)->with('profileUpdated', 1);
        } else {
          return back()->with('successMsg', 'Your profile successfully updated!')->with('profileUpdated', 1);
        }
        
    }
    // ===================================profile update===============================
    // ===================================profile update===============================

}
