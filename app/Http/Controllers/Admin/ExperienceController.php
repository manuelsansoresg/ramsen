<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::query()
            ->orderByDesc('is_featured')
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create', [
            'experience' => new Experience(['status' => 'draft']),
            'includesText' => '',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['includes'] = $this->includesFromText($request->string('includes_text')->toString());
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request);
        }

        Experience::create($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experiencia creada correctamente.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', [
            'experience' => $experience,
            'includesText' => collect($experience->includes)->filter()->implode("\n"),
        ]);
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $experience->id);
        $data['includes'] = $this->includesFromText($request->string('includes_text')->toString());
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->boolean('remove_image') && $experience->image) {
            $this->deleteImage($experience->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($experience->image) {
                $this->deleteImage($experience->image);
            }

            $data['image'] = $this->storeImage($request);
        }

        $experience->update($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experiencia actualizada correctamente.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        if ($experience->image) {
            $this->deleteImage($experience->image);
        }

        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experiencia eliminada correctamente.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'includes_text' => ['nullable', 'string'],
            'price' => ['nullable', 'string', 'max:255'],
            'whatsapp_message' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'published', 'finished'])],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function includesFromText(string $includes): ?array
    {
        $items = collect(preg_split('/\r\n|\r|\n/', $includes))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();

        return $items === [] ? null : $items;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: Str::random(8);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Experience::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $relativePath = 'uploads/experiences/'.$filename;
        $destination = public_path('uploads/experiences');

        File::ensureDirectoryExists($destination);
        $file->move($destination, $filename);

        return $relativePath;
    }

    private function deleteImage(string $image): void
    {
        $path = public_path($image);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
