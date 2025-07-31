<x-filament::page>
    <div class="flex flex-col items-center space-y-4">
        <img
            src="{{ $record->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($record->name) }}"
            alt="Profile Photo"
            class="w-32 h-32 rounded-full shadow-lg"
        />

        <div class="text-center">
            <h2 class="text-xl font-bold">{{ $record->name }}</h2>
            <p class="text-gray-600">{{ $record->email }}</p>
        </div>
    </div>
</x-filament::page>
