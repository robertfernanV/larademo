<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mesa;
use Illuminate\Support\Facades\Validator;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \response()->json(Mesa::all());
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
            'restaurant_id' =>'required|max:1|exists:restaurants,id',
            'name' =>'required|max:255',
            'capacity' =>'required|digits_between:1,11',
        ]);
        
        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->all()], 422);
        }

        return \response()->json(
            Mesa::create($request->all())
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
        $mesa = Mesa::find($id);
        if($mesa ==null){
            return \response(['errors'=>"Mesa no encontrada"], 422);
        }
        return \response()->json(
            $mesa
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
            'restaurant_id' =>'required|max:1|exists:restaurants,id',
            'name' =>'required|max:255',
            'capacity' =>'required|digits_between:1,11',
        ]);
        
        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->all()], 422);
        }

        $mesa = Mesa::find($id);
        if($mesa ==null){
            return \response(['errors'=>"Mesa no encontrada"], 422);
        }

        $mesa->restaurant_id = $request->restaurant_id;
        $mesa->name = $request->name;
        $mesa->capacity = $request->capacity;
        $mesa->active = isset($request->active)?$request->active:$mesa->active;
        $mesa->busy = isset($request->busy)?$request->busy:$mesa->busy;
        $mesa->save();

        return \response()->json($mesa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa = Mesa::find($id);
        if($mesa ==null){
            return \response(['errors'=>"Mesa no encontrada"], 422);
        }
        $mesa->delete();
        return \response()->json(['Exito'=>'Mesa eliminado exitosamente']);
    }
}
