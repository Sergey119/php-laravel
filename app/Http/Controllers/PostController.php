<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search){
            $posts = Post::join('users', 'author_id', '=', 'users.id')
                ->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('des', 'like', '%'.$request->search.'%')
                ->orWhere('users.name', 'like', '%'.$request->search.'%')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            return view('post.index', compact('posts'));
        }

        $posts = Post::join('users', 'author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(4);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->short_title =
            Str::length($request->title)>20 ?
                Str::substr($request->title, 0, 20) . '...' :
                    $request->title;
        $post->des = $request->des;

        $post->author_id = Auth::user()->id;

        if ($request->file('image'))
        {
           $path = Storage::putFile('public', $request->file('image'));
           $url = Storage::url($path);
           $post->img = $url;
        }

        $post->save();

        //Функция "->with(...)" не работает
        return redirect()->route('post.index')->with('success', 'Пост успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::join('users', 'author_id', '=', 'users.id')->find($id);

        if (!$post) {
            return redirect()->route('post.index')
                ->withErrors('Пост не найден');
        }

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')
                ->withErrors('Вы не можете редактировать данный пост');
        }

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')
                ->withErrors('Вы не можете редактировать данный пост');
        }

        $post->title = $request->title;
        $post->short_title =
            Str::length($request->title)>30 ?
                Str::substr($request->title, 0, 30) . '...' :
                    $request->title;
        $post->des = $request->des;

        if ($request->file('image'))
        {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->update();
        $id = $post->post_id;

        //Функция "->with(...)" не работает
        return redirect()->route('post.show', compact('id'))->with('success', 'Пост успешно изменен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')
                ->withErrors('Вы не можете удалить данный пост');
        }
        $post->delete();
        //Функция "->with(...)" не работает
        return redirect()->route('post.index')->with('success', 'Пост успешно удален!');
    }
}
