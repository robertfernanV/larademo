<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Schedule::all());
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
            'dayFrom' =>'required|max:255',
            'dayUntil' =>'required|max:255',
            'timeFrom' =>'required|date_format:H:i',
            'timeUntil' =>'required|date_format:H:i',
        ]);
        
        if($validate->fails()){
            return response(['errors'=>$validate->errors()->all()], 422);
        }
        return \response()->json(
            Schedule::create($request->all())
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
        $schedule = Schedule::find($id);
        if($schedule == null){
            return response(['errors'=>"Horario no encontrado"], 422);
        }
        return \response()->json(
            $schedule
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
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
    public function update(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'restaurant_id' =>'required|max:1|exists:restaurants,id',
            'dayFrom' =>'required|max:255',
            'dayUntil' =>'required|max:255',
            'timeFrom' =>'required|date_format:H:i',
            'timeUntil' =>'required|date_format:H:i',
        ]);
        
        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->all()], 422);
        }

        $schedule = Schedule::find($id);
        if($schedule == null){
            return response(['errors'=>"Horario no encontrado"], 422);
        }

        $schedule->restaurant_id = $request->restaurant_id;
        $schedule->dayFrom = $request->dayFrom;
        $schedule->dayUntil = $request->dayUntil;
        $schedule->timeFrom = $request->timeFrom;
        $schedule->timeUntil = $request->timeUntil;

        $schedule->save();
        return \response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $schedule = Schedule::find($id);
        if($schedule == null){
            return response(['errors'=>"Horario no encontrado"], 422);
        }
        $schedule->delete();
        return \response()->json(['Exito'=>'Horario eliminado exitosamente']);
    }
}
