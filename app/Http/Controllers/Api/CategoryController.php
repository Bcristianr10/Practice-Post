<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Example Scope: filter(Builder $query)
        //http://api.test/v1/categories?filter[name]=u
        //http://api.test/v1/categories?filter[name]=u&filter[slug]=u
        $category = Category::included()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();
        //much information use collection method
        return CategoryResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255',
            'slug'=> 'required|max:255|unique:categories',
        ]);

        $category = Category::create($request->all());

        return CategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        // Example Scope:included(Builder $query)
        //api.test o post.test
        // http://api.test/v1/categories/4?included=post
        // http://api.test/v1/categories/4?included=posts
        // http://api.test/v1/categories/4?included=posts.user
        $categorys = Category::included()->findOrFail($category);
        //few information use make method when one data
        return CategoryResource::make($categorys);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=> 'required|max:255',
            'slug'=> 'required|max:255|unique:categories,slug,'.$category->id,
        ]);

        $category->update($request->all());

        return CategoryResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return CategoryResource::make($category);
    }
}
