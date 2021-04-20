<?php

namespace App\Http\Controllers;

use App\Oil;
use Illuminate\Http\Request;

class OilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oils = Oil::with('user')->where('status', 0)->paginate();
        return view('dashboard.oils.index', compact('oils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'type'      => ['required' , 'string'], 
            'quantity'  => ['required'], 
            'address'   => ['required' , 'string'], 
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $oil = Oil::create($data);

        return response()->json($oil);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Oil  $oil
     * @return \Illuminate\Http\Response
     */
    public function show($oil)
    {
        $oil = Oil::find($oil);
        return response()->json($oil->load('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Oil  $oil
     * @return \Illuminate\Http\Response
     */
    public function edit(Oil $oil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oil  $oil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oil $oil)
    {
        if($request->type == 'cansel') {
            $oil->update([
                'status' => 2
            ]);
            return back();
        }

        if($request->type == 'accepted') {
            $oil->update([
                'status' => 1
            ]);
            return back();
        }

        $request->validate([
            'type'      => ['required' , 'string'], 
            'quantity'  => ['required'], 
            'address'   => ['required' , 'string'], 
        ]);
        
        $data = $request->validate();
        $data['user_id'] = auth()->user()->id;
        $oil->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oil  $oil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oil $oil)
    {
        $oil->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
