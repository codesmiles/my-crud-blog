<?php

namespace App\Http\Controllers;

use Whoops\Run;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->filter(request(['title','search']))->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required',
            // 'user_id' => ['required', Rule::exists('users', 'id')]
            "user_id" => ['required', Rule::unique('posts')->where('user_id', $request->user_id)]
            
        ]);
        return Post::create($fields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Post::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Post::find($id)->delete();
    }
}
