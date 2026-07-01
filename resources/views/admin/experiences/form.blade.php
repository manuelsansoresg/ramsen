@php
    $statuses = ['draft' => 'Borrador', 'published' => 'Publicado', 'finished' => 'Finalizado'];
@endphp

@if ($errors->any())
    <div class="mb-8 rounded-lg border border-red-300/20 bg-red-500/10 px-5 py-4 text-sm text-red-100">
        Revisa los campos marcados antes de continuar.
    </div>
@endif

<div class="rounded-lg border border-white/10 bg-white/[0.035] p-5 shadow-2xl shadow-black/20 lg:p-8">
    <div class="grid gap-6 md:grid-cols-2">
        <label class="block md:col-span-2">
            <span class="admin-label">Título</span>
            <input type="text" name="title" value="{{ old('title', $experience->title) }}" required class="admin-input mt-2">
            @error('title') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block md:col-span-2">
            <span class="admin-label">Subtítulo</span>
            <input type="text" name="subtitle" value="{{ old('subtitle', $experience->subtitle) }}" class="admin-input mt-2">
            @error('subtitle') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block md:col-span-2">
            <span class="admin-label">Descripción</span>
            <textarea name="description" rows="5" class="admin-textarea mt-2">{{ old('description', $experience->description) }}</textarea>
            @error('description') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Fecha</span>
            <input type="date" name="event_date" value="{{ old('event_date', $experience->event_date?->format('Y-m-d')) }}" class="admin-input mt-2">
            @error('event_date') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Ubicación</span>
            <input type="text" name="location" value="{{ old('location', $experience->location) }}" class="admin-input mt-2">
            @error('location') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Hora inicio</span>
            <input type="time" name="start_time" value="{{ old('start_time', $experience->start_time ? substr($experience->start_time, 0, 5) : '') }}" class="admin-input mt-2">
            @error('start_time') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Hora fin</span>
            <input type="time" name="end_time" value="{{ old('end_time', $experience->end_time ? substr($experience->end_time, 0, 5) : '') }}" class="admin-input mt-2">
            @error('end_time') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Precio</span>
            <input type="text" name="price" value="{{ old('price', $experience->price) }}" class="admin-input mt-2">
            @error('price') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Estado</span>
            <select name="status" required class="admin-input mt-2">
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $experience->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="admin-label">Orden</span>
            <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order ?? 0) }}" class="admin-input mt-2">
            @error('sort_order') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block md:col-span-2">
            <span class="admin-label">Elementos incluidos</span>
            <textarea name="includes_text" rows="5" class="admin-textarea mt-2" placeholder="Vapor&#10;Piscina&#10;Ceremonia&#10;Campamento">{{ old('includes_text', $includesText) }}</textarea>
            <span class="mt-2 block text-xs text-warm/45">Un elemento por línea.</span>
            @error('includes_text') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <label class="block md:col-span-2">
            <span class="admin-label">Mensaje WhatsApp</span>
            <textarea name="whatsapp_message" rows="4" class="admin-textarea mt-2">{{ old('whatsapp_message', $experience->whatsapp_message) }}</textarea>
            @error('whatsapp_message') <span class="admin-error">{{ $message }}</span> @enderror
        </label>

        <div class="md:col-span-2">
            <span class="admin-label">Imagen</span>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="admin-file mt-2">
            <span class="mt-2 block text-xs text-warm/45">JPG, JPEG, PNG o WEBP. Máximo 5 MB.</span>
            @error('image') <span class="admin-error">{{ $message }}</span> @enderror

            @if ($experience->image)
                <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">
                    <img src="{{ asset($experience->image) }}" alt="{{ $experience->title }}" class="h-28 w-40 rounded-md object-cover">
                    <label class="flex items-center gap-3 text-sm text-warm/68">
                        <input type="checkbox" name="remove_image" value="1" class="h-4 w-4 rounded border-gold/40 bg-ink text-gold focus:ring-gold">
                        Eliminar imagen actual
                    </label>
                </div>
            @endif
        </div>

        <label class="flex items-center gap-3 text-sm text-warm/75 md:col-span-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $experience->is_featured)) class="h-4 w-4 rounded border-gold/40 bg-ink text-gold focus:ring-gold">
            Marcar como destacada
        </label>
    </div>

    <div class="mt-10 flex flex-col gap-4 sm:flex-row">
        <button type="submit" class="premium-button">{{ $experience->exists ? 'Guardar cambios' : 'Crear experiencia' }}</button>
        <a href="{{ route('admin.experiences.index') }}" class="secondary-button">Cancelar</a>
    </div>
</div>
