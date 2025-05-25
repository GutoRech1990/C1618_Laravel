<x-layout>
    <div class="max-w-2xl mx-auto">
        {{-- Section d'en-tête avec titre et description --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter un Vaccin</h1>
            <p class="mt-2 text-sm text-gray-700">Remplissez les informations pour ajouter un nouveau vaccin</p>
        </div>

        {{-- Section du formulaire d'ajout --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            {{-- Formulaire avec token CSRF pour la sécurité --}}
            <form action="{{ route('vaccins.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Champ pour le nom du vaccin --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <div class="mt-1">
                        {{-- Input avec validation et gestion des erreurs --}}
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Nom du vaccin" value="{{ old('name') }}" required>
                        {{-- Affichage des erreurs de validation pour le nom --}}
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Champ pour le fabricant du vaccin --}}
                <div>
                    <label for="fabricant" class="block text-sm font-medium text-gray-700">Fabricant</label>
                    <div class="mt-1">
                        {{-- Input avec validation et gestion des erreurs --}}
                        <input type="text" name="fabricant" id="fabricant"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('fabricant') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Fabricant du vaccin" value="{{ old('fabricant') }}" required>
                        {{-- Affichage des erreurs de validation pour le fabricant --}}
                        @error('fabricant')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Champ pour le prix du vaccin avec symbole € --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        {{-- Input numérique avec validation et gestion des erreurs --}}
                        <input type="number" name="price" id="price" step="0.01"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('price') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="0.00" value="{{ old('price') }}" required>
                        {{-- Affichage du symbole € à droite du champ --}}
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                        {{-- Affichage des erreurs de validation pour le prix --}}
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Boutons d'action du formulaire --}}
                <div class="flex items-center justify-end space-x-3 pt-4">
                    {{-- Bouton d'annulation avec retour à la liste --}}
                    <a href="{{ route('vaccins.index') }}"
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
