<?php
namespace App\Http\Controllers;

use DB;
use App\Notifications;
use Auth;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public function adminNotifications()
    {
        $notifications_admin = DB::table('notifications_admin')->get();
        return view('admin.notifications', compact('notifications_admin'));
    }


    public function productPricesForUsersAssign($userId)
    {
        
        DB::table('notifications_admin')->where('priceAddUpdateDeletedForUserId', $userId)->update(['read_at' => \Carbon\Carbon::now()]);
        return redirect(route('productPricesForUsers.assign', $userId));
    }

    public function profileUpdateNotificationsForCustomer($notificationId)
    {
        DB::table('notifications')->where('notificationId', $notificationId)->update(['read_at' => \Carbon\Carbon::now()]);
        return redirect(route('profileUpdate', [app()->getLocale()] ));
    }

    public function profileUpdateNotificationsForAdmin($userId)
    {
        DB::table('notifications_admin')->where('profileUpdaterId', $userId)->update(['read_at' => \Carbon\Carbon::now()]);
        return redirect(route('customers.customers', ['customerId' => $userId]));
    }

    public function documentAddedNotificationsForAdmin($userId)
    {
        DB::table('notifications_admin')->where('documentAdderId', $userId)->update(['read_at' => \Carbon\Carbon::now()]);
        return redirect(route('productPricesForUsers.assign', $userId));
    }

    




}
