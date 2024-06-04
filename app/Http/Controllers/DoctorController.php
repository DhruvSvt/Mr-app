<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctor.doctor', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::whereStatus(true)->get();
        $areas = Area::whereStatus(true)->get();
        return view('admin.doctor.create', compact('specialities', 'areas'));
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
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phn_no' => 'required|string|max:15',
                'speciality_id' => 'required|integer',
                'area_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'longitude.*' => 'required|numeric',
                'latitude.*' => 'required|numeric',
                'title.*' => 'required|string|max:255',
                'addresses.*' => 'required|string|max:255',
            ]);

            $doctor = new Doctor();

            // Handle the image upload if there is one
            if ($request->hasFile('image')) {
                $destinationPath = 'public/images/doctors';
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs($destinationPath, $imageName);
                $doctor->image = $imageName;
            }

            // Store the doctor information
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->phn_no = $request->phn_no;
            $doctor->speciality_id = $request->speciality_id;
            $doctor->area_id = $request->area_id;

            // Save JSON-encoded arrays
            $doctor->longitude =  json_encode($request->longitude);
            $doctor->latitude = json_encode($request->latitude);
            $doctor->title = json_encode($request->title);
            $doctor->addresses = json_encode($request->addresses);

            $doctor->save();

            return redirect()->route('doctor.create')->with('success', 'Doctor added successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
