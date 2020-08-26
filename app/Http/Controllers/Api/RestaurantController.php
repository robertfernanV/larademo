<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \response()->json(Restaurant::first());
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
            'direction' =>'required|max:255'
        ]);

        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        if(Restaurant::get()->count()>0){
            return response(['errors'=>"No se puede registrar mas restaurants"], 422);
        }

        $image= null;
        if(isset($request->image)){
            $image = $request->file('image');
            $extencion = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extencion,File::get($image));
        }

        $rest = new Restaurant();
        $rest->name = $request->name;
        $rest->direction = $request->direction;
        if(isset($request->number))
            $rest->number = $request->number;
        if(isset($request->whatsappNumber))
            $rest->whatsappNumber = $request->whatsappNumber;
        if(isset($request->image))
            $rest->image = $image->getFilename().'.'.$extencion;
        if(isset($request->facebook))
            $rest->facebook = $request->facebook;
        if(isset($request->instagram))
            $rest->instagram = $request->instagram;
        if(isset($request->twitter))
            $rest->twitter = $request->twitter;
        if(isset($request->youtube))
            $rest->youtube = $request->youtube;
        if(isset($request->tiktok))
            $rest->tiktok = $request->tiktok;
        
        $rest->save();
        return \response($rest,200);
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
        $rest = Restaurant::find($id);
        if($rest->schedules){
            return \response($rest,200);
        }else{
            return \response([
                'errors' =>"Restaurant no Existe"
            ],422);
        }
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
        
        $validate = Validator::make($request->all(),[
            'name' =>'required|max:255',
            'direction' =>'required|max:255'
        ]);

        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }

        $rest = Restaurant::find($id);
        if($rest){
            $rest->name = $request->name;
            $rest->direction = $request->direction;

            $image= null;
            if(isset($request->image)){
                $image = $request->file('image');
                $extencion = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename().'.'.$extencion,File::get($image));
            }
            //borramos la imagen anterior registramos la nueva
            if($image){
                Storage::disk('public')->delete($rest->image);
                //y se crea la nueva
                $rest->image = $image->getFilename().'.'.$extencion;
            }

            if(isset($request->number))
                $rest->number = $request->number;
            if(isset($request->whatsappNumber))
                $rest->whatsappNumber = $request->whatsappNumber;
            if(isset($request->facebook))
                $rest->facebook = $request->facebook;
            if(isset($request->instagram))
                $rest->instagram = $request->instagram;
            if(isset($request->twitter))
                $rest->twitter = $request->twitter;
            if(isset($request->youtube))
                $rest->youtube = $request->youtube;
            if(isset($request->tiktok))
                $rest->tiktok = $request->tiktok;
            $rest->save();
            return \response($rest,200);
        }else{
            return \response([
                'errors' =>"Restaurant no Existe"
            ],422);
        }
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
        return false;
    }
}
