<?php

namespace App\Http\Controllers;

use App\Models\Strength;
use Illuminate\Http\Request;

class StrengthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $strengths =  Strength::latest()->get();
            return view('admin.strength.strength', compact('strengths'));
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
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
        try {

            $request->validate([
                'name' => 'required',
            ]);

            Strength::create($request->post());

            return redirect()->route('strength.index')->with('success', 'Successfully Data Stored !!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Strength  $strength
     * @return \Illuminate\Http\Response
     */
    public function show(Strength $strength)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Strength  $strength
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $strength = Strength::findOrFail($id);
            return response()->json($strength);
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Strength  $strength
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $strength = Strength::findOrFail($id);
            $strength->update($request->all());

            return redirect()->route('strength.index')->with('success', 'Successfully Data Updated !!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strength  $strength
     * @return \Illuminate\Http\Response
     */
    public function destroy(Strength $strength)
    {
        //
    }
}
