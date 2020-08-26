<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
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
            Unit::all()
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
            Unit::create($request->all())
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
        $unit = Unit::find($id);
        if($unit ==null){
            return \response(['errors'=>"Unidad no encontrado"], 422);
        }
        return \response()->json(
            $unit
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
        $unit = Unit::find($id);
        if($unit ==null){
            return \response(['errors'=>"Unidad no encontrado"], 422);
        }
        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255'
        ]);
        
        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        $unit->name= $request->name;
        $unit->save();
        return \response()->json(
            $unit
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
        $unit = Unit::find($id);
        if($unit ==null){
            return \response(['errors'=>"Unidad no encontrado"], 422);
        }
        $unit->delete();
        return \response()->json(['Exito'=>'Unidad eliminada exitosamente']);
    }
}
