<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryGroup;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $groups = GalleryGroup::with('photos')->get();
        return Inertia::render('gallery/index', [
            'groups' => $groups
        ]);
    }

    public function storeGroup(Request $request)
    {
        $count = GalleryGroup::count();
        if ($count >= 12) {
            return redirect()->back()->withErrors(['message' => 'Maksimal 12 grup foto.']);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        GalleryGroup::create($request->all());

        return redirect()->back();
    }

    public function updateGroup(Request $request, $id)
    {
        $group = GalleryGroup::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $group->update($request->all());

        return redirect()->back();
    }

    public function destroyGroup($id)
    {
        $group = GalleryGroup::findOrFail($id);
        foreach ($group->photos as $photo) {
            if (Storage::disk('public')->exists($photo->image_path)) {
                Storage::disk('public')->delete($photo->image_path);
            }
        }
        $group->delete();

        return redirect()->back();
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'gallery_group_id' => 'required|exists:gallery_groups,id',
            'image' => 'required|image|max:2048', // 2MB max
            'caption' => 'nullable|string|max:255',
        ]);

        $group = GalleryGroup::findOrFail($request->gallery_group_id);

        if ($group->photos()->count() >= 5) {
            return redirect()->back()->withErrors(['message' => 'Maksimal 5 foto per grup.']);
        }

        $path = $request->file('image')->store('gallery', 'public');

        GalleryPhoto::create([
            'gallery_group_id' => $request->gallery_group_id,
            'image_path' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->back();
    }

    public function destroyPhoto($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        if (Storage::disk('public')->exists($photo->image_path)) {
            Storage::disk('public')->delete($photo->image_path);
        }
        $photo->delete();

        return redirect()->back();
    }
}
