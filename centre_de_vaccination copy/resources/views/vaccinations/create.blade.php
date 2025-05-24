<x-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter une Vaccination</h1>
            <p class="mt-2 text-sm text-gray-700">Enregistrez une nouvelle vaccination pour le patient</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('vaccinations.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Patient ID (Hidden) -->
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                <!-- Patient Name (Read-only) -->
                <div>
                    <label for="patient_name" class="block text-sm font-medium text-gray-700">Nom du Patient</label>
                    <div class="mt-1">
                        <input type="text" id="patient_name" value="{{ $patient->name }}"
                            class="block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm" disabled>
                    </div>
                </div>

                <!-- Vaccine Selection -->
                <div>
                    <label for="vaccin_id" class="block text-sm font-medium text-gray-700">Vaccin</label>
                    <div class="mt-1">
                        <select name="vaccin_id" id="vaccin_id"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('vaccin_id') ? 'border-red-300' : 'border-gray-300' }}">
                            <option value="" disabled selected>Choisissez un vaccin</option>
                            @foreach ($vaccins as $vaccin)
                                <option value="{{ $vaccin->id }}"
                                    {{ old('vaccin_id') == $vaccin->id ? 'selected' : '' }}>
                                    {{ $vaccin->name }} - {{ $vaccin->fabricant }} ({{ $vaccin->price }}€)
                                </option>
                            @endforeach
                        </select>
                        @error('vaccin_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Vaccination Date -->
                <div>
                    <label for="vaccination_date" class="block text-sm font-medium text-gray-700">Date de
                        Vaccination</label>
                    <div class="mt-1">
                        <input type="date" name="vaccination_date" id="vaccination_date"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('vaccination_date') ? 'border-red-300' : 'border-gray-300' }}"
                            value="{{ old('vaccination_date', date('Y-m-d')) }}" required>
                        @error('vaccination_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('vaccinations.show', $patient->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
