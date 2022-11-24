<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Input;
use DB;
use Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function change_passsword_f($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();

        $genericbrandData = Cache::remember('genericbrandData', 100, function () {
            return  DB::table('genericbrand_view')->get();
        }); 

        return view('frontend.change_passsword_f', compact('countryData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'genericbrandData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'genericbrandpicData', 'genericstrengthCompactData' , 'reviewData', 'reviewsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
    }

    public function change_passsword_f_from_mail(Request $request, $language)
    {
        // setSessionLanguage();
        // dd($request->all());
        $isEmailExist = DB::table('users')->where('email', $request->email)->count('email');
        // dd($isEmailExist);
        if ($isEmailExist==0) 
        {
            return back()->with('invalidMail', 1);
        } 

        // dd($request->password);
        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailReceiverEmail = $request->email;
        $mailReceiverName = $usersdata->where('email', $request->email)->pluck('name')->first();
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';
        
        $subject = $mailReceiverName.'\'s password change confirmation!';
        $bodyMessage = 'Please click the below link to update your password:'.' <br><br>'.'<strong><h2> <a href="'.url('/').'/'.$language.'/dynamicChangepasswordFromEncryption'.'/'.Crypt::encrypt($request->email).'/'.Crypt::encrypt($request->password).'">Verification Link!</a></strong></h2>';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        try {
            mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
            // =================mail sending=============
            // =================mail sending=============
            
            return redirect()->route('customerLogin', $language)->with('passwordresetlinksent', 1);
        } catch (\Throwable $th) {
            return redirect()->route('customerLogin', $language)->with('passwordresetlinksent', 1);
        } 

    }

    public function dynamicChangepasswordFromEncryption($language='en', $email, $password)
    {
        // dd(Crypt::decrypt($email));
        // setSessionLanguage();

        $email = Crypt::decrypt($email);
        $password = Crypt::decrypt($password);

        $passwordChangedCount = DB::table('users')->where('email', $email)->pluck('passwordChangedCount')->first();
        $userId = DB::table('users')->where('email', $email)->pluck('id')->first();


        $passwordChangedCount =  isset($passwordChangedCount) && $passwordChangedCount>0 ? $passwordChangedCount : 0 ;
        $passwordChangedCount =  $passwordChangedCount+1 ;
        
        DB::table('users')->where('email', $email)->update([
          'password' => bcrypt($password),
          'passwordChangedCount' => $passwordChangedCount,
        ]);
        //   dd($passwordChangedCount);

        DB::table('notifications_admin')->insert([
            [
                'passwordChagerId' => $userId, 
                'message' => $email.' changed password '.$passwordChangedCount.' times',
                'message2' => $email.' changed password '.$passwordChangedCount.' times',
            ],
        ]);

        if ($passwordChangedCount>=3) 
        {
            DB::table('notifications_admin')->insert([
                [
                    'loginLimitCrosserId' => $userId, 
                    'message' => $email.' crossed password change limit',
                    'message2' => $email.' crossed password change limit',
                ],
            ]);
        }

        return redirect()->route('customerLogin', $language); 
    }

    



    public function index()
    {
        // $user_module_check = null;
        // if (Auth::check()) 
        // {
        //     $user_module_check = DB::table('user_roles_modules_view')
        //                            ->where('userId', auth::user()->id )
        //                            ->where('moduleId', 1)  
        //                            ->pluck('moduleId')
        //                            ->first();
        // }
        
        // if ($user_module_check===null) 
        // {
        //     if (Auth::check()) 
        //     {
        //         return back();
        //     }
        //     else 
        //     {
        //         return redirect('/bismillah-mfwadmin');
        //     }
        // }
        // else 
        // {
        //     return view('dashboard');
        // }
        return view('dashboard');

    }

    public function dashboardData()
    {
        $dashboardData = DB::table('dashboard_data_view')->first();
        
        $response = ["status" => "Success", 'data' =>$dashboardData ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
    }

    public function getSalesByDiseaseCategory()
    {
        $salesbydiseasecategory_data = DB::table('salesbydiseasecategory_view')->get();
        
        $response = ["status" => "Success", 'data' =>$salesbydiseasecategory_data ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
    }

    public function getSalesByCategory()
    {
        $salesbycategory_data = DB::table('salesbycategory_view')->get();
        
        $response = ["status" => "Success", 'data' =>$salesbycategory_data ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
    }




    public function adminLoginPost(Request $request)
    {
        // Creating Rules for Email and Password
        $rules = array(
          'email' => 'required|email', // make sure the email is an actual email
          'password' => 'required'
          );
          // password has to be greater than 3 characters and can only be alphanumeric and);
          // checking all field
          $validator = Validator::make(Input::all() , $rules);
          // if the validator fails, redirect back to the form
          if ($validator->fails())
            {
                return Redirect::to('admin')->withErrors($validator)->withInput(Input::except('password'));
                 // send back all errors to the login form
                 // send back the input (not the password) so that we can repopulate the form
            }
            else
            {
            // create our user data for the authentication
            $userdata = array(
              'email' => Input::get('email') ,
              'password' => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata))
              {
              // validation successful
              // do whatever you want on success
                return redirect(Route('dashboard'));
                // return Redirect::back();
              }
              else
              {
              // validation not successful, send back to form
                return back();
              }
          }
    }

    public function getTime()
    {
        return now();
    }


    public function superadminconfig()
    {
        return view('admin.superadminconfig');
    }

    // ======================== backup ==============================
    // ======================== backup ==============================
    public function storageBackup()
    {
        
        try {
            

            // php.ini has enabled extension called ext-zip.
            $zip_file = 'storage_backup.zip';

            try {
                \unlink($zip_file);
            } catch (\Throwable $th) {
            }

            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            
            // if ( preg_match("/127.0/", Request::ip() ) ){
            //     $path = public_path('uploads'); 
            // }
            // else {
            //     $path = 'uploads' ;
            // }
            $path = 'uploads' ;

            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file)
            {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath     = $file->getRealPath();

                    // extracting filename with substr/strlen
                    $relativePath = 'uploads/' . substr($filePath, strlen($path) + 1);

                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();

                
        
            return response()->download($zip_file);
            
            // $response = ["status" => "Success"];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storageBackupDelete()
    {
        try {
            \unlink('storage_backup.zip');
        } catch (\Throwable $th) {
        }
    }

    public function serverDBBackup()
    {
        
        try {

            $database = config('app.db');

            // dd(config('app.db'));
            $user = config('app.dbuser');
            $pass = config('app.dbpass');
            $host = config('app.dbhost');
            $dir = 'server_db_backup.sql';

            try {
                unlink($dir);
            } catch (\Throwable $th) {
            }

            // echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
            // mysqldump -u [user name] –p [password] [options] [database_name] [tablename] > [dumpfilename.sql]
            // --add-drop-database --databases 
            // mysqldump --user=root --password=bismib_fashion@_mysql --host=localhost --events --routines --triggers elaravel_v2 --result-file=db_backup_new.sql 2>&1
            exec("mysqldump  --user={$user} --password={$pass} --host={$host} --events --routines --triggers  {$database}  --result-file={$dir} 2>&1", $output);

            $tableViewsCounts = DB::select('SELECT count(TABLE_NAME) AS TOTALNUMBEROFTABLES FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?', [$database]);
            $tableViewsCounts = $tableViewsCounts[0]->TOTALNUMBEROFTABLES;
            
            $viewsCounts = DB::select('SELECT count(TABLE_NAME) AS TOTALNUMBEROFVIEWS FROM INFORMATION_SCHEMA.TABLES WHERE  TABLE_TYPE LIKE "VIEW" AND TABLE_SCHEMA = ?', [$database]);
            $viewsCounts = $viewsCounts[0]->TOTALNUMBEROFVIEWS;

            $tablesCount = $tableViewsCounts-$viewsCounts;


            $proceduresCounts = DB::select('SELECT count(TYPE) AS proceduresCounts FROM mysql.proc WHERE  TYPE="PROCEDURE" AND db = ?', [$database]);
            $proceduresCounts = $proceduresCounts[0]->proceduresCounts;

            $functionsCounts = DB::select('SELECT count(TYPE) AS functionsCounts FROM mysql.proc WHERE  TYPE="FUNCTION" AND db = ?', [$database]);
            $functionsCounts = $functionsCounts[0]->functionsCounts;

            $projectURL = url('/');
            $deviceIP = \Request::ip();

            $init_command = PHP_EOL.'-- '.$database.' Database Backup Generated time = '.YmdTodmYPm(\Carbon\Carbon::now()). PHP_EOL.PHP_EOL.
                            '-- Project URL = '.$projectURL.PHP_EOL.
                            '-- Device IP = '.$deviceIP.PHP_EOL.PHP_EOL.
                            '-- =============Objects Counting Start================= '.PHP_EOL.PHP_EOL.
                            '-- Total Tables + Views = '.$tableViewsCounts.PHP_EOL.
                            '-- Total Tables = '.$tablesCount.PHP_EOL.
                            '-- Total Views = '.$viewsCounts.PHP_EOL.PHP_EOL.
                            '-- Total Procedures = '.$proceduresCounts.PHP_EOL.
                            '-- Total Functions = '.$functionsCounts.PHP_EOL.
                            '-- =============Objects Counting End================= '.PHP_EOL.
                            PHP_EOL.PHP_EOL.
                            'SET FOREIGN_KEY_CHECKS=0; '. PHP_EOL.
                            'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'. PHP_EOL.
                            'START TRANSACTION;'. PHP_EOL.
                            'SET time_zone = "+06:00";'.PHP_EOL.
                            'drop database if exists '.$database.';'. PHP_EOL.
                            'CREATE DATABASE IF NOT EXISTS '.$database.' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;'. PHP_EOL.
                            'use '.$database.';'.PHP_EOL; 
                
            $data = file_get_contents($dir);

            $append_command = PHP_EOL.'SET FOREIGN_KEY_CHECKS=1;'.PHP_EOL.'COMMIT;'.PHP_EOL;
            // dd($data);
            file_put_contents ( $dir , $init_command.$data.$append_command);

            return response()->download($dir);
        } catch (\Throwable $th) {
        }
    }

    public function serverDBBackupDelete()
    {
        try {
            \unlink('server_db_backup.sql');
        } catch (\Throwable $th) {
        }
    }

  

    
    // ======================== backup ==============================
    // ======================== backup ==============================

    
    
    // ======================== cache remove ==============================
    // ======================== cache remove ==============================
    public function cacheRemove()
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');
            return '<h1>Cache successfully cleared</h1>';
        } catch (\Throwable $th) {
        }
    }
    // ======================== cache remove ==============================
    // ======================== cache remove ==============================




    public function languageOnOffSettings($languageId, $onOffId)
    {
        $onOffId = (int) $onOffId;
        if( $onOffId == 1) {
            $onOffId = 0; 
        }
        else {
            $onOffId=1;
        }

        DB::table('languagesettings')->where('languagesettingsId', $languageId)->update([
            'isOn' => $onOffId
        ]);
        return back();
    }




    public function readatadminallnotifications(){
        DB::table('notifications_admin')->update([
            'read_at' =>  \Carbon\Carbon::now()
        ]);
        return back();
    }

    public function readatallcustomersallnotifications(){
        DB::table('notifications')->update([
            'read_at' =>  \Carbon\Carbon::now()
        ]);
        return back();
    }

    public function readatspecificcustomersallnotifications($customerId){
        DB::table('notifications')->where('receiverId', $customerId)->update([
            'read_at' =>  \Carbon\Carbon::now()
        ]);
        return back();
    }


    
    public function systemEnvironment(){
        return view('admin.systemenvironment');
    }

    public function getMostProtectedPassword()
    {
        $mostProtectedPassword = DB::table('mostprotectedpassword')->pluck('password')->first();

        $response = ["status" => "Success", "password" => $mostProtectedPassword];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
    }

    public function md5MatchForMostProtectedPassword(Request $request)
    {
        $password = $request->password;
        $password = md5($password);

        $mostProtectedPassword = DB::table('mostprotectedpassword')->pluck('password')->first();

        
        if (trim($mostProtectedPassword)==trim($password)) 
        {
            $response = ["status" => "Success"];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        }
        $response = ["status" => "Failure" ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);

    }

    



    // DB Automated Backups Management
    // DB Automated Backups Management

    public function dbAutomatedBackupManagement(){
        return view('admin.dbAutomatedBackupManagement');
    }

    public function getDBAutomatedBackups(Request $request)
    {
        if (Auth::check()) 
        {
            try {
                $dir = public_path().'/DB_Backups/';
                $fileList = array_diff(scandir($dir), array('.', '..'));
                $collection = collect($fileList);

                $collection = $collection->map(function ($item, $key) {
                    return [
                        'fileName' => $item,
                        'date' => YmdTodmYDay(str_replace(["server_db_backup_", ".sql"],"",$item))
                    ];
                });

                $response = ["status" => "Success", "files" => $collection];
                return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
            } catch (\Throwable $th) {
                $response = ["status" => "Failure" ];
                return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
            }
        } 
        else{
            $response = ["status" => "Failure" ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
    }  

    public function deleteDBBackupFile(Request $request)
    {
        if (Auth::check()) 
        {
            try {
                unlink($request->url);

                $response = ["status" => "Success"];
                return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
            } catch (\Throwable $th) {
                $response = ["status" => "Failure" ];
                return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
            }
        } 
        else{
            $response = ["status" => "Failure" ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
    }  

    

    // DB Automated Backups Management
    // DB Automated Backups Management



    // Block List Management
    // Block List Management
    public function blockList()
    {
        return view('admin.blockList');
    }

    public function block_list_data(Request $request)
    {
        if (Auth::check()) 
        {
            $blockPersons = DB::table('blocklist_persons_view')->get();
            $blockReasons = DB::table('blocklist_view')->get();
            $response = ["status" => "Success", "blockPersons" => $blockPersons, "blockReasons" => $blockReasons];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } 
        $response = ["status" => "Failure" ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
    } 
    
    public function unblockAPerson(Request $request)
    {
        if (Auth::check()) 
        {
            $email = $request->postData['email'];

            DB::table('blocklist')->where('email', $email )->delete();
            
            $response = ["status" => "Success"];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } 
        $response = ["status" => "Failure" ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
    }  

    public function unblockAPersonWBlockTypeId(Request $request)
    {
        if (Auth::check()) 
        {
            $email = $request->postData['email'];
            $blockTypeId = $request->postData['blockTypeId'];

            DB::table('blocklist')->where('email', $email )->where('blockTypeId', $blockTypeId )->delete();
            
            $response = ["status" => "Success"];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } 
        $response = ["status" => "Failure" ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
    } 
    
    // Block List Management
    // Block List Management



    // Log Management
    // Log Management
    
    public function logManagement(Request $request)
    {
        return view('admin.logManagement');
    } 

    public function getLogData(Request $request, $logName)
    {
        if (Auth::check() && $logName!= null) 
        {
            $logFile = file(storage_path().'/logs/db_backup_scheduler_log.log');
            $logCollection = [];
            // Loop through an array, show HTML source as HTML source; and line numbers too.
            foreach ($logFile as $line_num => $line) {
               $logCollection[] = array('line'=> $line_num+1, 'content'=> str_replace('\n', '', str_replace('[]', '', substr($line, strpos($line,'{'), strpos($line,'}')))) );
            //    $logCollection[] = array('line'=> $line_num+1, 'content'=> json_encode($line) );
            }

            // dd($logCollection);

            $response = ["status" => "Success", "data" => $logCollection];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } 
        $response = ["status" => "Failure" ];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
    } 
    // Log Management
    // Log Management



}
