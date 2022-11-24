<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\UserRoles;



use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use Input;
use \Gumlet\ImageResize;

use \Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = DB::table('user_personal_info_with_role_modules_view')->where('isCustomer', 0)->get();
        $roles = DB::table('roles')->select('roleId', 'role', 'description')->get();
        return view('user.index', compact('users', 'roles'));
    }

    public function userRoles()
    {
        $users = DB::table('users')->get();
        return view('user/userRoles', compact('users'));
    }
    

   
    public function create()
    {
        $users = User::all();
        return view('user.create', compact('users'));
    }


    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
        ]);


        $inputs = $request->all();
        
        $lastCreatedUserId = User::create($inputs)->id;

        if ($request->roleId!=null) 
        {
            foreach($request->roleId as $role=>$v)
            {
                $roleData=array
                (
                    'userId'=>$lastCreatedUserId,
                    'roleId'=>$request->roleId[$role],
                );
                UserRoles::insert($roleData);
            }
        }

        return redirect(Route('user.index'))->with('successMsg', 'User successfully added !!');
    }

    
    public function userEdit($userId)
    {
        $user = DB::table('user_personal_info_view')->where('userId','=', $userId)->first();
        return view('user.userEdit', compact('user'));
    }


    public function userUpdate(Request $request, $userId)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users,id'.$request->id.',id',
        ]);

        // only updates password and role initializing
        if ($request->password != null) 
        {
            User::where('id', $userId)->update([
                'password'=>Hash::make($request->password),
            ]);
        }

        UserRoles::where('userId', $userId)->delete();

        if ($request->roleId!=null) 
        {
            foreach($request->roleId as $role=>$v)
            {
                $roleData=array
                (
                    'userId'=>$userId,
                    'roleId'=>$request->roleId[$role],
                );
                UserRoles::insert($roleData);
            }
        }

        return redirect(Route('user.index'))->with('successMsg', 'User successfully updated !!');
    }

    
    public function destroy($id)
    {
        User::find($id)->delete(); 

        return back()->with('successMsg', 'User successfully deleted !!');
    }


    // customers
    public function customers()
    {
        $users = DB::table('users_view')->where('isCustomer', 1)->get();

        if (request()->has('customerId') and request('customerId')!=null) 
        {
            DB::table('notifications_admin')->where('loginLimitCrosserId', request('customerId'))->update(['read_at' => now()]);
            $users = $users->where('id', request('customerId'));
        } 

        if(request('customerId') and request('loginLimitCrosser'))
        {
            DB::table('notifications_admin')->where('loginLimitCrosserId', request('customerId'))->update(['read_at' => now()]);
        }
        if(request('customerId') and request('registerUser'))
        {
            DB::table('notifications_admin')->where('registerUserId', request('customerId'))->update(['read_at' => now()]);
        }

        if(request('customerId') and request('passwordChagerId'))
        {
            DB::table('notifications_admin')->where('passwordChagerId', request('customerId'))->update(['read_at' => now()]);
        }

        if(request('customerId') and request('profileDeleterId'))
        {
            DB::table('notifications_admin')->where('profileDeleterId', request('customerId'))->update(['read_at' => now()]);
        }
        
        return view('customers.customers', compact('users'));
    }

    public function customersEnable($userId)
    {
        DB::table('users')->where('id', $userId)->update([ 'passwordChangedCount'=> 0]);

        $user = DB::table('users')->where('id', $userId)->first();

        // ==============Notification===========
        DB::table('notifications')->insert([
            'receiverId' => $userId,
            'message' => $user->name.'\'s crossing password limit enabled!',
            'message2' => $user->name.'\'s crossing password limit enabled!',
            
        ]);

        DB::table('notifications_admin')->insert([
            [
                'loginLimitCrosserId' => $userId,
                'message' => $user->name.'\'s crossing password limit enabled!',
                'message2' => $user->name.'\'s crossing password limit enabled!',
            ],
        ]);
        // ==============Notification============


        // =================mail sending=============
        // =================mail sending=============
        $mailsettingsData = DB::table('mailsettings')->first();
        $usersdata = DB::table('users_view')->get();
        
        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName = 'Medicine For World';
        $mailReceiverEmail = $usersdata->where('id', $userId)->pluck('email')->first();
        $mailReceiverName = $usersdata->where('id', $userId)->pluck('name')->first();
        
        $subject = $user->name.'\'s crossing password limit enabled!';
		$bodyMessage = $user->name.'\'s crossing password limit enabled!';
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;
        
        
        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        // =================mail sending=============
		// =================mail sending=============






        return redirect(route('customers.customers'));
    }


    public function customerProfileUpdate($userId)
    {
        $userData = DB::table('users')->where('id', $userId)->first();
        $countryData =DB::table('country')->get();

        return view('customers.customeredit', compact('userData', 'countryData'));
    }

    public function customerProfileUpdateSave(Request $request)
    {
        User::find($request->id)->update($request->all()); 

        if(Input::hasFile('photoPath')){
            $file = Input::file('photoPath');
            $imgSize = $file->getSize()/1024;  // byte/1024 = KB
            $randomNumber = rand(999,99999);
            $file->move('uploads/users/', 'userId-'.$request->id.'_'.$randomNumber.'.'.$file->getClientOriginalExtension());

            User::where('id', $request->id)->update(['photoPath'  => '/uploads/users/'.'userId-'.$request->id.'_'.$randomNumber.'.'.$file->getClientOriginalExtension()]);
            // $image = new ImageResize('uploads/users/'.'userId-'.$request->id.'.'.$file->getClientOriginalExtension());
            // include(app_path().'/includes/image_compress_logics.php');
            // unlink('uploads/users/'.'userId-'.$request->id.'.'.$file->getClientOriginalExtension());
            // $image->save('uploads/users/'.'userId-'.$request->id.'.'.$file->getClientOriginalExtension());
        }

        return back()->with('successMsg', 'Customer profile successfully updated!');
    }


    public function admin_to_customer_send_mail(Request $request)
    {

        DB::table('users')->where('id', $request->userId)
            ->update([
                'isEmailSent' => 1
            ]);
        $userData = DB::table('users')->where('id', $request->userId)->first();
        $mailsettingsData = DB::table('mailsettings')->first();

        $mailSenderEmail = $mailsettingsData->mail;
        $mailSenderName  = 'Medicine For World';

        $mailReceiverEmail = $userData->email;
        $mailReceiverName  = $userData->name;

        $subject = $request->emailSubject;
        $bodyMessage = $request->emailBody;
        $website = $mailsettingsData->website;
        $contactMails = $mailsettingsData->contactMails;
        $numberTitle = $mailsettingsData->numberTitle;
        $number = $mailsettingsData->number;
        $logo = $mailsettingsData->logo;


        mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);

        return back()->with('successMsg', 'Successfully Mail Sent!');
    }

}
