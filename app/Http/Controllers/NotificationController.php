<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
       
        $applications = Notification::where('notifiable_id', auth()->id())->latest()->paginate(15);

        return view('notifications', ['applications' => $applications]);

    }

    public function generate($id){

        $notification=Notification::FindOrFail(decrypt($id));
        if($notification){
            $notification->read_at=now();
            $notification->update();
        }

        return redirect()->route('notifications.index');
    }
}
