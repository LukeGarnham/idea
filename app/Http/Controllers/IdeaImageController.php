<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Throwable;

class IdeaImageController extends Controller
{
    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
        try {
            Storage::disk('public')->delete($idea->image_path);
            $idea->update(['image_path' => null]);
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Idea image could not be deleted. Check the application logs for details.');
        }

        return back()->with('success', 'Idea image deleted.');
    }
}
