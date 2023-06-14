<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentsControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        // Retrieve appointments for the logged-in user
        $appointments = Appointments::where('user_id', $userId)->get();
    
        // Retrieve related doctor information for the appointments
        $doctorIds = $appointments->pluck('doc_id')->toArray();
        $doctors = User::whereIn('id', $doctorIds)->where('type', 'doctor')->get();
    
        // Merge doctor information into the appointment data
        foreach ($appointments as $appointment) {
            $doctor = $doctors->firstWhere('id', $appointment->doc_id);
    
            if ($doctor) {
                $details = $doctor->doctor;
                $appointment->doctor_name = $doctor->name;
                $appointment->doctor_profile = $doctor->profile_photo_url;
                $appointment->category = $details->category;
            }
        }
    
        return $appointments;
    
    }
    
    public function IncomingPatients(){
        $userId = Auth::user()->id;
$incomAppointments = Appointments::where('user_id', $userId)->where('status','incoming')->get();
$completeAppointments = Appointments::where('user_id', $userId)->where('status','complete')->get();
$doctorName=Auth::user()->name;

return view('patients',compact('incomAppointments','completeAppointments','doctorName'));

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
        //this controller is to store booking details post from mobile app
        $appointment = new Appointments();
        $appointment->user_id = Auth::user()->id;
        $appointment->doc_id = $request->get('doctor_id');
        $appointment->date = $request->get('date');
        $appointment->day = $request->get('day');
        $appointment->time = $request->get('time');
        $appointment->status = 'upcoming'; //new appointment will be saved as 'upcoming' by default
        $appointment->save();
       


        //if successfully, return status code 200
        return response()->json([
            'success'=>'New Appointment has been made successfully!',
        ], 200);

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
    }
}
