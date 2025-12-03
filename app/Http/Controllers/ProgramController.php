<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::latest()->get();
        return Inertia::render('programs/index', [
            'programs' => $programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('programs/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'emoji' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'schedule_type' => 'required|in:one_time,weekly,custom',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'day_of_week' => 'nullable|array',
            'custom_text' => 'nullable|string',
        ]);

        Program::create($validated);

        return redirect()->route('programs.index')->with('success', 'Program berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return Inertia::render('programs/edit', [
            'program' => $program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'emoji' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'schedule_type' => 'required|in:one_time,weekly,custom',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'day_of_week' => 'nullable|array',
            'custom_text' => 'nullable|string',
        ]);

        $program->update($validated);

        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->back()->with('success', 'Program berhasil dihapus.');
    }
}
