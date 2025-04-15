<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stripe;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userData = session()->get('userData');
            if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
                return redirect()->intended('admin');
            }
            // let the request continue through the stack
            return $next($request);
        });
    }


// Get unread notification count for the admin
    public function getUnreadCount($admin_id)
    {
        // echo $admin_id;die;
        $unreadCount = Notification::where('receiver_id', $admin_id)
                                   ->where('status', '1') // 1 for unread
                                   ->where('noti_type', 'admin')
                                   ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    public function fetchAllNotifications($adminId)
    {
       
        $notifications = Notification::where('notifications.receiver_id', $adminId)
        ->join('users', 'users.id', '=', 'notifications.sender_id')
            ->orderBy('notifications.created_at', 'desc')
            ->select('notifications.*', 'users.id as sender_id', 'users.first_name','users.last_name')
            ->get();


            foreach ($notifications as $notification) {
                // Get the replies for each notification
                $notification->replies = Notification::where('notifications.parent_notification_id', $notification->id)
                    ->join('admin', 'admin.id', '=', 'notifications.sender_id')
                    ->select('notifications.*', 'admin.name')
                    ->get();
            }
            // echo "<pre>";
            // print_r($notification->replies);die;

        // Return the notifications to the view
        return view('admin.notifications.index', compact('notifications'));
    }

    public function sendNotification(Request $request)
    {
        $notification = new Notification();
        $notification->sender_id = $request->admin_id;
        $notification->receiver_id = $request->user_id;
        $notification->noti_msg = $request->message;
        $notification->status = '1';  // Unread
        $notification->noti_type = 'admin'; // Type of notification
        $notification->parent_notification_id = $request->parent_notification_id;
        $notification->save();

         // If the notification has a parent (i.e., it's a reply), mark the parent as read
    if ($request->parent_notification_id) {
        // Find the original notification (parent)
        $parentNotification = Notification::find($request->parent_notification_id);
        
        // If the parent notification exists, mark it as read (status = 0)
        if ($parentNotification) {
            $parentNotification->status = '0'; // Mark as read
            $parentNotification->save();
        }
    }

        $redirectUrl = url("/admin/notifications/{$request->admin_id}");

    // Redirect to the notifications page with a success message
    return redirect($redirectUrl)->with('status', 'Message sent successfully!');
    }

}