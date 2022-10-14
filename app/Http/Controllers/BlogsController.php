<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::all();
        return response()->json([
            "success" => true,
            "message" => "Get All Blogs",
            "data" => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'required',
            'summary' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        Blog::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'summary' => $request->input('summary'),
            'content' => $request->input('content'),
            'published' => $request->input('published'),
            'published_at' => $request->input('published') ? now() : null,
            'blog_category_id' => $request->input('blog_category_id'),
            'user_id' => 1
        ]);
        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            return response()->json(
                [
                    'data' => [
                        'blog' => $blog,
                        'comments' => $blog->comments
                    ]
                ],
                200,
            );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Not found'
            ], 404);
        }
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
        $rules = [
            'title' => 'required|string',
            'slug' => 'required',
            'summary' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        Blog::where('id', $id)->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'summary' => $request->input('summary'),
            'content' => $request->input('content'),
            'published' => $request->input('published'),
            'published_at' => $request->input('published') ? now() : null,
            'blog_category_id' => $request->input('blog_category_id'),
            'user_id' => 1
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Blog updated Successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {

            $blog->delete();
            return response()->json([
                'success' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Blog Not found with id ' . $id
            ], 404);
        }
    }
}
