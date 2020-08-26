<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Dish::all());
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
            'description' =>'required|max:255',
            'restaurants.*'=>'exists:restaurants,id'
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

        $dish = new Dish();
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->image =$ex;
        $dish->portions = isset($request->portions)?$request->portions:1;
        $dish->save();

        if($request->restaurants){
            $dish->restaurants()->attach($request->restaurants);
        }
        return \response()->json(
            $dish->where('id',$dish->id)
            ->with('restaurants')
            ->get()
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
        $dish = Dish::find($id);
        if($dish==null){
            return \response(['errors'=>"Plato no encontrada"], 422);
        }

        return response()->json(
            $dish
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
        $dish = Dish::find($id);
        if($dish==null){
            return \response(['errors'=>"Plato no encontrada"], 422);
        }

        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255',
            'description' =>'required|max:255',
            'restaurants.*'=>'exists:restaurants,id'
        ]);

        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        $image= null;
        if(isset($request->image)){
            $image = $request->file('image');
            $extencion = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extencion,File::get($image));
        }
        //borramos la imagen anterior registramos la nueva
        if($image){
            Storage::disk('public')->delete($dish->image);
            //y se crea la nueva
            $dish->image = $image->getFilename().'.'.$extencion;
        }

        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->portions = isset($request->portions)?$request->portions:$dish->portions;
        $dish->save();

        if($request->restaurants){
            $dish->restaurants()->sync($request->restaurants);
        }

        return \response()->json(
            $dish->where('id',$dish->id)
            ->with('restaurants')
            ->get()
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
        $dish = Dish::find($id);
        if($dish==null){
            return \response(['errors'=>"Plato no encontrada"], 422);
        }
        //detach
        $dish->restaurants()->detach();
        $dish->delete();
        return \response()->json(['Exito'=>'Plato eliminado exitosamente']);
        
    }
}
