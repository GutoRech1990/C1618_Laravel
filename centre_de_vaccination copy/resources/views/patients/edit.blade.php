<x-layout>
    <div class="max-w-2xl mx-auto">
        {{-- Section d'en-tête avec titre et description --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Modifier un Patient</h1>
            <p class="mt-2 text-sm text-gray-700">Modifiez les informations du patient</p>
        </div>

        {{-- Section du formulaire de modification --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            {{-- Formulaire avec méthode PUT pour la mise à jour --}}
            <form action="{{ route('patients.update', $patient) }}" method="POST" class="p-6 space-y-6">
                {{-- Protection CSRF et méthode HTTP --}}
                @csrf
                @method('PUT')

                {{-- Champ pour le nom du patient --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <div class="mt-1">
                        {{-- Input avec gestion des erreurs de validation et conservation des anciennes valeurs --}}
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Nom du patient" value="{{ old('name', $patient->name) }}" required>
                        {{-- Affichage des messages d'erreur --}}
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Champ pour l'âge du patient (calculé automatiquement) --}}
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <div class="mt-1">
                        {{-- Input numérique avec validation --}}
                        <input type="number" name="age" id="age"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('age') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Âge du patient" value="{{ old('age', $patient->age) }}" required>
                        {{-- Messages d'erreur pour l'âge --}}
                        @error('age')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Champ pour l'adresse du patient --}}
                <div>
                    <label for="adress" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <div class="mt-1">
                        {{-- Input texte avec validation et conservation des données --}}
                        <input type="text" name="adress" id="adress"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('adress') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Adresse du patient" value="{{ old('adress', $patient->adress) }}" required>
                        {{-- Affichage des erreurs d'adresse --}}
                        @error('adress')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Champ pour la date de naissance --}}
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                    <div class="mt-1">
                        {{-- Input de type date avec validation --}}
                        <input type="date" name="birth_date" id="birth_date"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('birth_date') ? 'border-red-300' : 'border-gray-300' }}"
                            value="{{ old('birth_date', $patient->birth_date) }}" required>
                        {{-- Messages d'erreur pour la date de naissance --}}
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Boutons d'action du formulaire --}}
                <div class="flex items-center justify-end space-x-3 pt-4">
                    {{-- Bouton d'annulation avec retour à la liste --}}
                    <a href="{{ route('patients.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </a>
                    {{-- Bouton de soumission avec icône --}}
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fa-solid fa-save mr-2"></i>
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script pour le calcul automatique de l'âge --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupération des éléments du formulaire
            const birthDateInput = document.getElementById('birth_date');
            const ageInput = document.getElementById('age');

            // Fonction de calcul de l'âge à partir de la date de naissance
            function calculateAge(birthDate) {
                const today = new Date();
                const birth = new Date(birthDate);
                let age = today.getFullYear() - birth.getFullYear();
                const monthDiff = today.getMonth() - birth.getMonth();

                // Ajustement de l'âge si l'anniversaire n'est pas encore passé cette année
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                    age--;
                }
                return age;
            }

            // Écouteur d'événement pour mettre à jour l'âge automatiquement
            birthDateInput.addEventListener('change', function() {
                if (this.value) {
                    ageInput.value = calculateAge(this.value);
                }
            });
        });
    </script>
</x-layout>
