<x-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Ajouter une Vaccination</h1>
        <form action="{{ route('vaccinations.store') }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <!-- Champ nom visible pour l'ID du patient -->
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <!-- Nom du patient ( non editable ) -->
            <div class="mb-4">
                <label for="patient_name" class="block text-gray-700 font-bold mb-2">Nom du Patient:</label>
                <input type="text" id="patient_name" value="{{ $patient->name }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    disabled>
            </div>

            <!-- Select pour choisir un vaccin -->
            <div class="mb-4">
                <label for="vaccin_id" class="block text-gray-700 font-bold mb-2">Vaccin:</label>
                <select name="vaccin_id" id="vaccin_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="" disabled selected>Choisissez un vaccin</option>
                    @foreach ($vaccins as $vaccin)
                        <option value="{{ $vaccin->id }}" {{ old('vaccin_id') == $vaccin->id ? 'selected' : '' }}>
                            {{ $vaccin->name }}</option>
                    @endforeach
                </select>
                @error('vaccin_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date de la vaccination -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date de Vaccination:</label>
                <input type="date" name="vaccination_date" id="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ date('Y-m-d') }}" readonly>
                @error('vaccination_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Ajouter
                </button>
                <a href="{{ route('vaccinations.show', $patient->id) }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-layout>
