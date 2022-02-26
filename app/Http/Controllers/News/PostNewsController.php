<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News\NewsPost;
use App\Models\Settings\SiteSetting;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;

class PostNewsController extends Controller
{
    use Generics;
    //
    public function __construct(User $user, NewsPost $newsPost){
        $this->user = $user;
        $this->newsPost = $newsPost;
    }

    public function postNewsInterface(){

        $users = $this->user->getUsersWithConditionPaginate(8, [
            ['account_type', 'user'],
            ['status', 'active'],
        ]);

        $view = [
            'users'=>$users,
        ];

        return view('backend.post_news', $view);
    }

    public function postNews(Request $request){
        try {

            $request->validate([
                'news_tile' => 'required',
                'news_body' => 'required',
            ]);

            $news_post = new NewsPost();
            $news_post->unique_id = $this->createUniqueId('news_posts', 'unique_id');
            $news_post->user_unique_id = $request->userId;
            $news_post->message_title = $request->news_tile;
            $news_post->message_body = $request->news_body;
            $news_post->read_status = 'unread';

            if($news_post->save()){
                Alert::success('Success', 'News Post posted successfully');
                return redirect()->back(); 
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
           
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

}
