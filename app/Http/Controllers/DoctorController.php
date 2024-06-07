<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Speciality;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $doctors = Doctor::all();
            return view('admin.doctor.doctor', compact('doctors'));
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
        try {
            $specialities = Speciality::whereStatus(true)->get();
            $areas = Area::whereStatus(true)->get();
            return view('admin.doctor.create', compact('specialities', 'areas'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'speciality_id' => 'required|integer',
                'area_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'longitude.*' => 'required',
                'latitude.*' => 'required',
                'title.*' => 'required|string|max:255',
                'addresses.*' => 'required|string|max:255',
                'phn_no.*' => 'required|string|max:15',
            ]);

            // Handle the image upload if there is one
            if ($request->hasFile('image')) {
                $destinationPath = 'public/images/doctors';
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs($destinationPath, $imageName);
                $validatedData['image'] = $imageName;
            }

            // Save the doctor information
            Doctor::create($validatedData);

            return redirect()->route('doctor.index')->with('success', 'Doctor added successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Validation error occurred. Please try again!')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request. Please try again later.');
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
        try {
            $doctor = Doctor::findOrFail($doctor->id);
            return view('admin.doctor.detail', compact('doctor'));
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        try {
            $doctor = Doctor::findOrFail($doctor->id);
            $specialities = Speciality::whereStatus(true)->get();
            $areas = Area::whereStatus(true)->get();
            return view('admin.doctor.edit', compact('doctor', 'specialities', 'areas'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
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
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'speciality_id' => 'required',
                'area_id' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'longitude.*' => 'required',
                'latitude.*' => 'required',
                'title.*' => 'required|string|max:255',
                'addresses.*' => 'required|string|max:255',
                'phn_no.*' => 'required|string|max:15',
            ]);

            // Handle the image updation
            if ($request->hasFile('image')) {
                $destinationPath = 'public/images/doctors/';
                $existingImagePath = $destinationPath . $doctor->image;

                if (Storage::exists($existingImagePath)) {
                    Storage::delete($existingImagePath);
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs($destinationPath, $imageName);
                $doctor->image = $imageName;
            }

            // Update the doctor information
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->phn_no = $request->phn_no;
            $doctor->speciality_id = $request->speciality_id;
            $doctor->area_id = $request->area_id;

            // Assuming longitude, latitude, title, and addresses are JSON columns
            $doctor->longitude = $request->longitude;
            $doctor->latitude = $request->latitude;
            $doctor->title = $request->title;
            $doctor->addresses = $request->addresses;

            $doctor->save();

            return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Validation Error occurred. Please try again!')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
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
