<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
                'status' => 'available'
            ]);

            if ($response->successful()) {
                $pets = json_decode($response->body());
                return view('pet.index', compact('pets'));
            } else {
                Log::error('Error fetching pets: ' . $response->body());
                return back()->withErrors(['msg' => 'Unable to fetch the list of pets']);
            }
        } catch (\Exception $e) {
            Log::error('Connection error with Petstore API: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'API connection error']);
        }
    }

    public function show($petId)
    {
        try {
            $response = Http::get('https://petstore.swagger.io/v2/pet/'.$petId);

            if ($response->successful()) {
                $pet = json_decode($response->body());
                return view('pet.show', compact('pet'));
            } else {
                return back()->withErrors(['msg' => 'Pet not found']);
            }
        } catch (\Exception $e) {
            Log::error('Connection error with Petstore API: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'API connection error']);
        }
    }

    public function create()
    {
        return view('pet.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

        try {
            $response = Http::post('https://petstore.swagger.io/v2/pet', $validatedData);

            if ($response->successful()) {
                return redirect('/pets');
            } else {
                return back()->withErrors(['msg' => 'Error adding the pet']);
            }
        } catch (\Exception $e) {
            Log::error('Connection error with Petstore API: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'API connection error']);
        }
    }

    public function update(Request $request, $petId)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
        ]);
        $validatedData['id'] = $petId;

        try {
            $response = Http::put('https://petstore.swagger.io/v2/pet/', $validatedData);

            if ($response->successful()) {
                return redirect('/pets')->with('success', 'Pet updated successfully.');
            } else {
                return back()->withErrors(['msg' => 'Error updating the pet']);
            }
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'API connection error']);
        }
    }

    public function edit($petId)
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$petId);

        if ($response->successful()) {
            $pet = json_decode($response->body());
            return view('pet.edit', compact('pet'));
        } else {
            return back()->withErrors(['msg' => 'Unable to load pet data for editing']);
        }
    }

    public function destroy($petId)
    {
        try {
            $response = Http::delete('https://petstore.swagger.io/v2/pet/'.$petId);

            if ($response->successful()) {
                return redirect('/pets')->with('success', 'Pet successfully deleted.');
            } else {
                return back()->withErrors(['msg' => 'Error deleting the pet']);
            }
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'API connection error']);
        }
    }
}
