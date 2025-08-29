<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status_id' => 'required|numeric|between:1,7',
        'remarks' => 'string|max:100',
    ]);

    $user = Auth::user();
    $application = Application::findOrFail($id);

    $app_type = $application->application_type_id;

    if ($user->role != 1) {
        if (($request->status_id == 4 && $user->role != 2) || ($request->status_id == 2 && $user->role != 2)) {
            return response()->json(['message' => 'You are not authorized'], 401);
        }
    }

    $application->application_status_id = $request->status_id;
    $application->save();

    Conversation::create([
        'application_id' => $id,
        'sender_id' => $user->id,
        'receiver_id' => $application->user_id,
        'chat' => $request->remarks,
    ]);

    // Example of writing a file (you can modify this)
    $content = $request->status_id;
    $this->create_text_file($content);

    if ($request->status_id == 4 && $app_type == 2) {
        $application = Application::with(['applicants' => function ($query) {
            $query->select('id', 'cnic', 'name', 'fathername', 'domicile_number', 'issuance_date');
        }])->with(['users' => function ($query) {
            $query->select('id', 'user_type_id', 'name', 'fathername');
        }])->where('id', $id)->get();

        $this->gen_pdf($id, $application);
    } elseif ($request->status_id == 2 && $app_type == 1) {
        $application = Application::with(['applicants' => function ($query) {
            $query->select('id', 'cnic', 'name', 'fathername', 'date_of_birth', 'date_of_arrival', 'temporaryAddress', 'permanentAddress', 'marital_status_id', 'occupation_id', 'contact')
                ->with('childerns', 'marital_status', 'occupations');
        }])->where('id', $id)->get();

        $this->gen_form_p($id, $application);
    }

    if ($request->status_id == 6) {
        DB::table('applications')
            ->where('id', $id)
            ->update(['multiple_docs' => '1']);
    }

    return response()->json([
        'message' => 'Application status updated successfully',
        'application_id' => $id,
        'status_id' => $request->status_id
    ], 200);
}
}
