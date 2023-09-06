<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
class CandidateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function candidate(Request $request){

        $request->validate([
            'first_name' => 'required|max:40',
            'last_name' => 'nullable|max:255',
            'email' => 'required|string|email|max:100',
            'contact_number' => 'required|max:100',
            'gender' => 'required|in:1,2',
            'qualification_specialization' => 'nullable|max:200',
            'total_experience' => 'nullable|integer|max:30',
            'birthdate_unix' => 'nullable',
            'full_address' => 'nullable|max:500',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Adjust the allowed file types and maximum file size as needed
        ]);
        
        
        $candidate = new Candidate();

        // Set the candidate properties from the request
        $candidate->first_name = $request->first_name;
        $candidate->last_name = $request->last_name;
        $candidate->email = $request->email;
        $candidate->contact_number = $request->contact_number;
        $candidate->gender = $request->gender;
        $candidate->qualification_specialization = $request->qualification_specialization;
        $candidate->total_experience = $request->total_experience;
        // $birthDate = strtotime($request->input('birthdate_unix'));
        // $candidate->birthdate_unix = $birthDate;
        $candidate->birthdate_unix = $request->input('birthdate_unix');
        $candidate->full_address = $request->full_address;
        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $path = $file->store('resumes'); // This will store the file in the 'storage/app/resumes' directory
            $candidate->resume_file_path = $path;
        }
        // Save the candidate to the database
        $candidate->save();
    
        // Return a success response
        return response()->json(['success' => 'Candidate data saved successfully'], 201);

    }

    public function findCandidateById($id)
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return response()->json(['error' => 'Candidate not found'], 404);
        }

        return response()->json(['candidate' => $candidate], 200);
    }

    public function listCandidates(Request $request)
    {
        // Define the number of candidates to show per page
        $perPage = $request->input('limit', 25);

        // Retrieve candidates using pagination
        $candidates = Candidate::paginate($perPage);

        // Structure the response
        $response = [
            'page' => $candidates->currentPage(),
            'limit' => $candidates->perPage(),
            'current_page' => $candidates->currentPage(),
            'first_page_url' => $candidates->url(1),
            'from' => $candidates->firstItem(),
            'next_page_url' => $candidates->nextPageUrl(),
            'path' => $candidates->url($candidates->currentPage()),
            'per_page' => $candidates->perPage(),
            'prev_page_url' => $candidates->previousPageUrl(),
            'to' => $candidates->lastItem(),
            'data' => $candidates->items(),
        ];

        return response()->json($response, 200);
    }


    public function searchCandidatesByName($name)
{

    // Query candidates whose names match the provided name
    $candidates = Candidate::where('first_name', 'like', "%$name%")->get();

    // Return the list of matching candidates
    return response()->json(['data' => $candidates], 200);
}




}
