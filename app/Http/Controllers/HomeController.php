<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{

    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = Post::latest()->get(); // get all posts from the post table
        $home_posts = []; //container for later
        //$suggested_users = $this->getSuggestedUsers();

        // foreach($all_posts as $post):
        //     if($post->user->isFollowed() OR  $post->user->id === Auth::user()->id): // filter posts
        //         $home_posts[] = $post;
        //     endif;
        // endforeach;


        return view('users.home')
                ->with('all_posts',$home_posts);
                //->with('suggested_users',$suggested_users);
    }

    // public function getSuggestedUsers(){
    //     $all_users = $this->user->all(); // get all users from user table
    //     $suggested_users = []; // container for later
    //     foreach($all_users as $user):
    //         if(!$user->isFollowed()): //if the user is NOT ( ! ) followed
    //             $suggested_users[] = $user;
    //         endif;
    //     endforeach;

    //     return $suggested_users;
    // }
}
