<?php

namespace App\Http\Controllers;

use App\Category;
use App\Dislike;
use App\Like;
use App\Post;
use App\Profile;
use App\Comment;
use App\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;



class PostController extends Controller
{
    public function post()
    {
        $categories = Category::all();
        return view('post.post', ['categories' => $categories]);

    }

    public function addpost(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',


        ]);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->post_title = $request->input('post_title');
        $post->post_body = $request->input('post_body');
        $post->category_id = $request->input('category_id');


        if (input::hasFile('post_image')) {
            $file = input::file('post_image');
            $file->move(public_path() . '/posts/', $file->
            getClientOriginalName());
            $url = URL::to("/") . '/posts/' . $file->
                getClientOriginalName();

        }
        $post->post_image = $url;


        $post->save();
        return redirect()->to('/home')->with('response', 'Post  Added Successfully');


    }

    public function view($post_id)
    {
        $posts = Post::where('id', '=', $post_id)->get();
        $likePost = Post::find($post_id);
        $likeCtr = Like::where(['post_id' => $likePost->id])->count();
        $dislikeCtr = Dislike::where(['post_id' => $likePost->id])->count();


        $categories = Category::all();
        $comments = DB::table('users')
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('users.name', 'comments.*')
            ->where(['posts.id' => $post_id])
            ->get();

        return view('post.view', ['posts' => $posts, 'categories' => $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr, 'comments' => $comments]);

    }


    public function edit($post_id)
    {
        $categories = Category::all();
        $posts = Post::find($post_id);
        $category = Category::find($posts->category_id);
        return view('post.edit', ['categories' => $categories, 'posts' => $posts, 'category' => $category]);
    }

    public function editpost(Request $request, $post_id)
    {
        $validator = Validator::make($request->all(), [

            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',


        ]);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->post_body = $request->input('post_body');
        $post->category_id = $request->input('category_id');


        if (input::hasFile('post_image')) {
            $file = input::file('post_image');
            $file->move(public_path() . '/posts/', $file->
            getClientOriginalName());
            $url = URL::to("/") . '/posts/' . $file->
                getClientOriginalName();

        }
        $post->post_image = $url;

        $data = array(
            'post_title' => $post->post_title,
            'user_id' => $post->user_id,
            'post_body' => $post->post_body,
            'category_id' => $post->category_id,
            'post_image' => $post->post_image,

        );
        Post::where('id', $post_id)->update($data);
        $post->update($data);
        return redirect()->to('/home')->with('response', 'Post  Updated Successfully');

    }

    public function deletepost($post_id)
    {
        Post::where('id', $post_id)->delete();
        return redirect()->to('/home')->with('response', 'Post Deleted Successfully');

    }

    public function category($cat_id)
    {
        $categories = Category::all();
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.*')
            ->where(['categories.id' => $cat_id])
            ->get();

        return view('categories.catogoriesposts', ['categories' => $categories, 'posts' => $posts]);
    }

//    public function like($id){
//       $loggedin_user = auth()->user()->id;
//       $like_user = Like::where(['user_id' => $loggedin_user, 'post_id'=>$id])->first();
//       if(empty($like_user)  && empty($like_user->user_id)){
//           $user_id = auth()->user()->id;
//           $email = auth()->user()->email;
//           $post_id = $id;
//           $like = new Like;
//           $like->user_id = $user_id;
//           $like->email = $email;
//           $like->post_id = $post_id;
//           $like->save();
//           return redirect('/view/{$id}');
//
//
//       }
//       else{
//           return redirect('/view/{$id}');
//       }
//    }

    public function like($id)
    {
        $loggedin_user = auth()->user()->id;
        $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if (empty($like_user) && empty($like_user->user_id)) {
            $user_id = auth()->user()->id;
            $email = auth()->user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect('/view/{$id}');
        } else {
            return redirect('/view/{$id}');

        }

    }

    public function dislike($id)
    {
        $loggedin_user = auth()->user()->id;
        $like_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if (empty($like_user) && empty($like_user->user_id)) {
            $user_id = auth()->user()->id;
            $email = auth()->user()->email;
            $post_id = $id;
            $dislike = new Dislike;
            $dislike->user_id = $user_id;
            $dislike->email = $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect('/view/{$id}');
        } else {
            return redirect('/view/{$id}');

        }

    }

    public function comment(Request $request, $post_id)
    {
        $validator = Validator::make($request->all(), [

            'comment' => 'required',
        ]);
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post_id;

        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect('/view/{$post_id}')->with('response', 'Comment Added Successfully');

    }

    public function search(Request $request)
    {
        $user_id = auth()->user()->id;
      $profile = Profile::find('$user_id');
      $keyword = $request->input('search');
      $posts = Post::where('post_title','Like','%'.$keyword.'%')->get();

      return view('post.searchposts',['profile'=> $profile, 'posts' => $posts]);

    }
}
