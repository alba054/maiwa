<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;


class PostController extends Controller
{
   
    public function index()
    {
        return view('post.index',[
            'datas' => Post::latest()->get()
        ]);
    }

    public function create()
    {
        return view('post.create',[
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png|max:2048',
            'title' => 'required|unique:posts,title',
            'detail' => 'required|min:20',
            'tags' => 'required|array'
        ]);

        $data['title'] = $request['title'];
        $data['detail'] = $request['detail'];
        $data['images'] = $this->handleImageIntervention($request['image']);
		// $data['tags'] = implode(",", $request['tags']);
		$data['slug'] = Str::slug($request['title']);


        $post = Post::create($data);
        $post->tags()->sync($request['tags']);
        Session::flash('message', "Created Post Successfully");
        return redirect()->route('posts.index');
    }

    
    public function show(Post $post)
    {
        return view('post.detail',[
            'post' => $post
        ]);
    }

    
    public function edit(Post $post)
    {
        // return $post;
        return view('post.edit',[
            'tags' => Tag::orderBy('name')->get(),
            'post' => $post
        ]);
    }

    
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
            'title' => 'required|unique:posts,title,'.$post->id,
            'detail' => 'required|min:20',
            'tags' => 'required|array'
        ]);

        $data['title'] = $request['title'];
        $data['detail'] = $request['detail'];
        if ($request['images']) {
            $data['images'] = $this->handleImageIntervention($request['image']);
        }
		// $data['tags'] = implode(",", $request['tags']);
		$data['slug'] = Str::slug($request['title']);


        $post->update($data);
        $post->tags()->sync($request['tags']);
        Session::flash('message', "Updated Post Successfully");
        return redirect()->route('posts.index');
    }

    
    public function destroy($id)
    {
        $delete = Post::find($id)->delete();

        Session::flash('message', "Deleted Post Successfully");
        return redirect()->back();
    }

    public function handleImageIntervention($res_foto)
    {
        $res_foto->store('public/photos');
        $imageName = $res_foto->hashName();
        $data['foto'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(500, 300);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }

}
