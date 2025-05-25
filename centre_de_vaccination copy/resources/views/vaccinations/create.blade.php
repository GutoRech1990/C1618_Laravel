<x-layout>
    <div class="max-w-2xl mx-auto">
        {{-- Section d'en-tête avec titre et description --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter une Vaccination</h1>
            <p class="mt-2 text-sm text-gray-700">Enregistrez une nouvelle vaccination pour le patient</p>
        </div>

        {{-- Section du formulaire d'ajout de vaccination --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            {{-- Formulaire avec token CSRF pour la sécurité --}}
            <form action="{{ route('vaccinations.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Champ caché pour l'ID du patient --}}
                {{-- Ce champ est nécessaire pour associer la vaccination au bon patient --}}
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                {{-- Affichage en lecture seule du nom du patient --}}
                <div>
                    <label for="patient_name" class="block text-sm font-medium text-gray-700">Nom du Patient</label>
                    <div class="mt-1">
                        {{-- Champ désactivé pour éviter toute modification du patient --}}
                        <input type="text" id="patient_name" value="{{ $patient->name }}"
                            class="block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm" disabled>
                    </div>
                </div>

                {{-- Sélection du vaccin avec liste déroulante --}}
                <div>
                    <label for="vaccin_id" class="block text-sm font-medium text-gray-700">Vaccin</label>
                    <div class="mt-1">
                        {{-- Select avec gestion des erreurs de validation et conservation de la valeur précédente --}}
                        <select name="vaccin_id" id="vaccin_id"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('vaccin_id') ? 'border-red-300' : 'border-gray-300' }}">
                            {{-- Option par défaut avec message d'instruction --}}
                            <option value="" disabled selected>Choisissez un vaccin</option>
                            {{-- Boucle sur tous les vaccins disponibles --}}
                            @foreach ($vaccins as $vaccin)
                                {{-- Option avec conservation de la sélection précédente en cas d'erreur --}}
                                <option value="{{ $vaccin->id }}"
                                    {{ old('vaccin_id') == $vaccin->id ? 'selected' : '' }}>
                                    {{ $vaccin->name }} - {{ $vaccin->fabricant }} ({{ $vaccin->price }}€)
                                </option>
                            @endforeach
                        </select>
                        {{-- Affichage des erreurs de validation pour le vaccin --}}
                        @error('vaccin_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Sélection de la date de vaccination --}}
                <div>
                    <label for="vaccination_date" class="block text-sm font-medium text-gray-700">Date de
                        Vaccination</label>
                    <div class="mt-1">
                        {{-- Champ de type date avec date du jour par défaut et gestion des erreurs --}}
                        <input type="date" name="vaccination_date" id="vaccination_date"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('vaccination_date') ? 'border-red-300' : 'border-gray-300' }}"
                            value="{{ old('vaccination_date', date('Y-m-d')) }}" required>
                        {{-- Affichage des erreurs de validation pour la date --}}
                        @error('vaccination_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Boutons d'action du formulaire --}}
                <div class="flex items-center justify-end space-x-3 pt-4">
                    {{-- Bouton d'annulation qui redirige vers la page de détails du patient --}}
                    <a href="{{ route('vaccinations.show', $patient->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </a>
                    {{-- Bouton de soumission avec icône --}}
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
