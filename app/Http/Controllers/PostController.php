<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $post;
    private $category;
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $all_categories = Category::all();
        // $all_categories = $this->category->all();
        return view('users.posts.create')
                ->with('all_categories',$all_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        #save data to post table
        $this->post->user_id = Auth::user()->id;
        $this->post->image = $this->saveImage($request);
        $this->post->title = $request->title;
        $this->post->author = $request->author;
        $this->post->publisher = $request->publisher;
        $this->post->description = $request->description;
        $this->post->save();

       #save data to category_post table // save selected categories
        // foreach($request->category as $category_id):
        //     $category_post[] = ["category_id"=>$category_id];
        // endforeach;

        // $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

     public function saveImage($request){
        #rename the file
            $image_name = time().".".$request->image->extension();
            #1667992480.png
        #save the file
            $request->image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name);
            #public/images/1667992480.png
        #return the file name to save to the database

        return $image_name;
    }


    public function show(Post $post)
    {
        //
        $post = $this->post->findOrFail($id);
        return view('users.posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $post = $this->post->findOrFail($id); // get the specific post
        $all_categories = Category::all(); // get all categories
        $selected_categories = [];

        foreach($post->categoryPost as $category_post):
            $selected_categories[] = $category_post->category_id; // get all the selected categories of this post
        endforeach;

        return view('users.posts.edit')
                ->with('post',$post)
                ->with('all_categories',$all_categories)
                ->with('selected_categories',$selected_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $post = $this->post->findOrFail($id); // get the specific post
        $post->title = $request->title;
        $post->author = $request->author;
        $post->publisher = $request->publisher;
        $post->description = $request->description;
        if($request->image): // if the user wants to change the imag
            #delete image
            $this->deleteImage($post->image);
            #upload image
            $post->image = $this->saveImage($request);
        endif;
        $post->save(); // this is only updating the post in post table

        // update categories
            // delete all categories from that certain post
        $post->categoryPost()->delete();

        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;

        $post->categoryPost()->createMany($category_post);

        return redirect()->route('posts.show',$id);
    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER.$image_name;
                    #public/images/123345.jpeg

        if (Storage::disk('local')->exists($image_path)) {
            Storage::disk('local')->delete($image_path);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post = $this->post->findOrFail($id); // find the post
        $this->deleteImage($post->image); // delete the image of that post
        $post->delete(); // delete entire post

        return redirect()->route('index'); // go back to index page if successful
    }
}
