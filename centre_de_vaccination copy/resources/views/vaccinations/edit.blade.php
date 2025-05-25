<x-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Modifier la Vaccination</h1>
        {{-- Formulaire de modification avec méthode PUT --}}
        <form action="{{ route('vaccinations.update', $vaccination->id) }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            {{-- Champ caché pour l'ID du patient --}}
            {{-- Ce champ est nécessaire pour maintenir l'association avec le patient lors de la mise à jour --}}
            <input type="hidden" name="patient_id" value="{{ $vaccination->patient_id }}">

            {{-- Affichage du nom du patient en lecture seule --}}
            {{-- Ce champ est désactivé pour éviter la modification du patient associé --}}
            <div class="mb-4">
                <label for="patient_name" class="block text-gray-700 font-bold mb-2">Nom du Patient:</label>
                <input type="text" id="patient_name" value="{{ $vaccination->patient->name }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    disabled>
            </div>

            {{-- Liste déroulante pour la sélection du vaccin --}}
            <div class="mb-4">
                <label for="vaccin_id" class="block text-gray-700 font-bold mb-2">Vaccin:</label>
                <select name="vaccin_id" id="vaccin_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    {{-- Option par défaut désactivée --}}
                    <option value="" disabled>Choisissez un vaccin</option>
                    {{-- Boucle sur tous les vaccins disponibles --}}
                    @foreach ($vaccins as $vaccin)
                        {{-- L'option est présélectionnée si elle correspond au vaccin actuel --}}
                        <option value="{{ $vaccin->id }}"
                            {{ $vaccination->vaccin_id == $vaccin->id ? 'selected' : '' }}>
                            {{ $vaccin->name }}</option>
                    @endforeach
                </select>
                {{-- Affichage des erreurs de validation pour le vaccin --}}
                @error('vaccin_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Champ pour la date de vaccination --}}
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date de Vaccination:</label>
                <input type="date" name="vaccination_date" id="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ old('vaccination_date', $vaccination->vaccination_date) }}" required>
                {{-- Affichage des erreurs de validation pour la date --}}
                @error('vaccination_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Boutons d'action du formulaire --}}
            <div class="flex items-center justify-between">
                {{-- Bouton de soumission pour enregistrer les modifications --}}
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Modifier
                </button>
                {{-- Lien d'annulation qui redirige vers la page de détails du patient --}}
                <a href="{{ route('vaccinations.show', $vaccination->patient_id) }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-layout>
