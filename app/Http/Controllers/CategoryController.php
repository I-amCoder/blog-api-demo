<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BlogCategory::all();
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        BlogCategory::create([
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'isActive' => $request->input('isActive'),
        ]);

        return response()->json([
            'success' => true,
            'Message' => 'Category Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = BlogCategory::find($id);
        if ($category) {
            return response()->json([
                'Category' => $category,

            ], 200,);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        BlogCategory::where('id', $id)->update([
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'isActive' => $request->input('isActive'),
        ]);

        return response()->json([
            'success' => true,
            'Message' => 'Category Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'Message' => 'Category Deleted Successfully'
        ]);
    }
}
