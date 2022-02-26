<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\SiteSetting;
use App\Models\User;
use App\Models\News\NewsPost;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function __construct(SiteSetting $setting, User $user, NewsPost $newsPost){
        $this->setting = $setting;
        $this->user = $user;
        $this->newsPost = $newsPost;
    }

    public function notificationInterface(){

        $user = Auth::user();

        $posts = $this->newsPost->getAllNewsPost([
            ['user_unique_id', $user->unique_id],
        ]);

        $view = [
            'posts'=>$posts,
        ];

        return view('backend.notification', $view);
    }

    public function singleNotificationInterface($unique_id = null){

        $posts = $this->newsPost->getSingleNewsPost([
            ['unique_id', $unique_id],
        ]);

        $posts->read_status = 'read';
        $posts->save();

        $view = [
            'posts'=>$posts,
        ];

        return view('backend.read_notification', $view);
    }
}
