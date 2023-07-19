<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);


        }



    public function index(Request $request)
    {


        $data = Category::query()->get();
        $word = $request->search;
   /* $category=Category::all();
      //  $data = $data->where('name', 'LIKE', '%' . $word . '%')->first();

        if (app()->getLocale() == 'en') {
            $data = $data->where('name', 'LIKE', '%' . $word . '%')->first();
        }

        if (app()->getLocale() == 'ar') {
            $data = $data->where('name', 'LIKE', '%' . $word . '%')->first();
        }
*/

        return view('layouts.dashboard.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('layouts.dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name.*' => 'required|unique:categories,name',

        ]);




        $category = new Category();

        $category->setTranslation('name', 'en', $request->name_en);
        $category->setTranslation('name', 'ar', $request->name_ar);
        $category->setTranslation('description', 'en', $request->description_en);
        $category->setTranslation('description', 'ar', $request->description_ar);
        $category->save();
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('layouts.dashboard.categorie
        s.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('layouts.dashboard.categories.edit', compact('category',));
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
        $rules=[
            'name_en'=>'required',
            'name_ar'=>'required'
            ];
if($request->has('description_en') || $request->has('description_ar')){
    $rules+=[
           'description_en'=>'required',
           'description_ar'=>'required'
           ];
}

        $request->validate($rules);


        $category = Category::find($id);
        $category->update([
            'name' =>
            [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'description' =>
            [
                'en' => $request->description_en,
                'ar' => $request->description_ar
            ]
        ]);
        // setTranslation('name', 'en', $request->name_en);
        /*  $category->setTranslation('name', 'ar', $request->name_ar);
        $category->setTranslation('description', 'en', $request->description_en);
        $category->setTranslation('description', 'ar', $request->description_ar);
        $category->save();
      */
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
