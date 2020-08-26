<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255',
            'description' =>'required|max:255'
        ]);

        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }
        
        $image= null;
        $ex = null;
        if(isset($request->image)){
            $image = $request->file('image');
            $extencion = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extencion,File::get($image));
            $ex = $image->getFilename().'.'.$extencion;
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description  = $request->description;
        $category->image = $ex;
        $category->save();

        $restaurants = $request->restaurants;
        foreach($restaurants as $r){
            $category->restaurants()->attach($r,[
                'active'=>1
            ]);
        }
        $category = $category->with('restaurants')->find($category->id);
        return response()->json(
            $category
        );

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
        $category = Category::with('restaurants')->find($id);
        if($category==null){
            return \response(['errors'=>"Categoria no encontrada"], 422);
        }

        return response()->json(
            $category
        );
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
        return false;
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
        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255',
            'description' =>'required|max:255'
        ]);

        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        //dd($request);
        $category = Category::with('restaurants')->find($id);
        if($category==null){
            return \response(['errors'=>"Categoria no encontrada"], 422);
        }

        $image= null;
        if(isset($request->image)){
            $image = $request->file('image');
            $extencion = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extencion,File::get($image));
            $ex = $image->getFilename().'.'.$extencion;
        }

        //borramos la imagen anterior registramos la nueva
        if($image){
            Storage::disk('public')->delete($category->image);
            //y se crea la nueva
            $category->image = $image->getFilename().'.'.$extencion;
        }

        $category->name = $request->name;
        $category->description  = $request->description;
        $category->save();

        $restaurants = $request->restaurants;
        $category->restaurants()->sync($restaurants);
        
        return response()->json(
            $category
        );

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
        $category= Category::find($id);
        if($category ==null){
            return \response(['errors'=>"Categoria no encontrada"], 422);
        }
        $category->restaurants()->detach();
        $category->delete();
        return \response()->json(['Exito'=>'Categoria eliminada exitosamente']);
    }
}
