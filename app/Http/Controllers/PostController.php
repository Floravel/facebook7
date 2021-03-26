<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use http\Url;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class PostController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostResource
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'data.attributes.body' => 'required',
            'data.attributes.title' => 'required',
            'data.attributes.user_id' => 'required',
        ]);

        $user = $request->user();


        $post = $request->user()->posts()->create($data['data']['attributes']);
        $post = $request->user()->posts()->create($data['data']['attributes']);
        $post = $request->user()->posts()->create($data['data']['attributes']);

/*        dd(($request->user()->posts()->skip(1)->first()));*/

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
