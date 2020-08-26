<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \response()->json(
            Ingredient::all()
        );
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
            'name' =>'required|max:255'
        ]);
        
        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        return \response()->json(
            Ingredient::create($request->all())
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
        $ingredient = Ingredient::find($id);
        if($ingredient ==null){
            return \response(['errors'=>"Ingrediente no encontrado"], 422);
        }
        return \response()->json(
            $ingredient
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
        $ingredient = Ingredient::find($id);
        if($ingredient ==null){
            return \response(['errors'=>"Ingrediente no encontrado"], 422);
        }

        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255'
        ]);
        
        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        $ingredient->name= $request->name;
        $ingredient->save();
        return \response()->json(
            $ingredient
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
        $ingredient = Ingredient::find($id);
        if($ingredient ==null){
            return \response(['errors'=>"Ingrediente no encontrado"], 422);
        }
        
        $ingredient->delete();

        return \response()->json(['Exito'=>'Ingrediente eliminado exitosamente']);
    }
}
