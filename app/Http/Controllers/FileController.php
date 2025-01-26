<?php

namespace App\Http\Controllers;

use App\Events\FileChangeEvent;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        return Inertia::render('Files/Index', [
            'files' => $user->files,
            'sharedFiles' => $user->sharedFiles,
        ]);
    }

    public function show(File $file)
    {
        $this->authorize('view', $file);

        return Inertia::render('Files/Show', [
            'file' => $file->load('owner', 'users'),
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', File::class);

        return Inertia::render('Files/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $file = File::create([
            'title' => $request->title,
            'content' => $request->content,
            'owner_id' => auth()->user()->id,
        ]);

        return redirect()->route('files.show', $file);
    }

    public function edit(File $file)
    {
        $this->authorize('update', $file);

        return Inertia::render('Files/Edit', [
            'file' => $file->load('owner', 'users'),
        ]);
    }

    public function update(Request $request, File $file)
    {
        $this->authorize('update', $file);

        $file->update($request->all());
        broadcast(new FileChangeEvent($file));

        return redirect()->route('files.show', $file);
    }

    public function destroy(File $file)
    {
        $this->authorize('delete', $file);

        $file->delete();

        return redirect()->route('files.index');
    }

    public function attach(File $file, User $user)
    {
        $file->users()->syncWithoutDetaching($user->id);
        broadcast(new FileChangeEvent($file));

        // return redirect()->route('files.show', $file);
    }

    public function detach(File $file, User $user)
    {
        $file->users()->detach($user->id);
        broadcast(new FileChangeEvent($file));

        // return redirect()->route('files.show', $file);
    }
}
