<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\File;

class PostController extends Controller
{

    public function index()
    {
     $Post = Post::with(['user','categories'])->get();
      return response()->json(['Post'=>$Post],200);
   
    }

    public function store(Request $request)
    {
        $Post =  new Post;
        $Post->user_id = $request->user_id;
        $Post->categories_id = $request->categories_id;
        $Post->title= $request->title;
        $Post->description = $request->description;
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$filename);
        $path ="$filename";
        $Post->image=$path;
        $Post->slug = Str::slug($request->title);
        $Post->save();
        return response()->json([
         'status'=> 200,
         'data' =>$Post
       ],200);

    }
    public function searchData($term){
     $title = Post::whereLike('title',$term)
     ->whereLike('description',$term)
     ->get();
     if(count($title)){
        return response()->json(['data'=>$title],200);
     }else{
        return response()->json(['data'=>'404 Not Found'],404);
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
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
    }
}
