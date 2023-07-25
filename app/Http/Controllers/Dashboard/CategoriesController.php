<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;

use Exception;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories= Category::all();  //Return collection object
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parents= Category::all();
        $category=new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
           //
          /*$request->input('name');
          $request->query('name');
          $request->get('name');// general
          $request->name;
          $request['name'];
          $request->post('name');

          $requrest->all();//return array of input data
          $request->only(['name','parent_id']);
          $request->except(['image','status']);*/

          /*$category = new Category([
            'name'=>$request->post('name'),
            'parent_id'=>$request->post('parent_id')
          ]);

          $category = new Category('');
            $category->name=$request->post('name');
            $category->parent_id=$request->post('parent_id');
          //...
        

          $category= new Category($request->all());
          $category->save();*/
        $clean_data=  $request->validate(Category::rules(),[
            'required'=>'This field(:attribute) is required',
            'name.unique'=>'This name is already exists!'
          ]);
          
          //Request merge
          $request->merge([
            'slug'=> Str::slug($request->post('name'))
          ]);
          $data = $request->except('image');
          $data['image']= $this->uploadImage($request);
          
  
          //mass assigment
          $category =Category::create($data);

          //PRG
          return redirect()->route('categories.index')
          ->with('success','Category created!');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
    $category = Category::findorfail($id);
    }catch(Exception $e){
     return redirect()->route('categories.index')
    ->with('info','Record not found!');
  }
    $parents= Category::where('id','<>',$id)
    ->where(function($query) use($id){
      $query->whereNull('parent_id')
            ->orwhere('parent_id','<>',$id);
    })
      ->get();
    return view('dashboard.categories.edit', compact('category', 'parents'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //  //  $category->fill($request->all())->save();
        $category=Category::findOrFail($id);
        $old_image =$category->image;
        $data = $request->except('image');
        $new_image= $this->uploadImage($request);     
        if($new_image){
          $data['image']=$new_image;
        }     
        $category->update($data);
        if($old_image && $new_image){
          Storage::disk('public')->delete($old_image);
        }
      return redirect()->route('categories.index')
          ->with('success','Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $category=Category::findOrFail($id);      
        $category->delete();
        if($category->image){
          Storage::disk('public')->delete($category->image);
        }
        //Category::destroy($id);
        return redirect()->route('categories.index')
          ->with('success','Category deleted!');
    }

    protected function uploadImage(Request $request){
      if(!$request->hasFile('image')){
        return;
      }
        $file = $request->file('image');
       // $file->getClientOriginalName();
       // $file->getSize();
       // $file->getClientOriginalExtension();
       // $file->getMimeType();
        $path= $file->store('uploads',[
         'disk'=>'public'
        ]);        
        return $path;
       }  
    }
    
