<x-layout>
    {{-- Conteneur principal avec marges responsives --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- En-tête de la page d'accueil --}}
        <div class="text-center">
            {{-- Titre principal avec animation de taille selon l'écran --}}
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Centre de Vaccination</span>
                {{-- Sous-titre en bleu pour le contraste --}}
                <span class="block text-blue-600">Système de Gestion</span>
            </h1>
            {{-- Description du système avec taille de texte responsive --}}
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Gérez efficacement les vaccinations et les patients dans un seul endroit.
            </p>
        </div>

        {{-- Section des cartes de navigation --}}
        <div class="mt-16">
            {{-- Grille responsive : 1 colonne sur mobile, 2 colonnes sur tablette et desktop --}}
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-12">
                {{-- Carte de gestion des patients --}}
                <div class="relative group">
                    {{-- Conteneur avec effet d'élévation au survol --}}
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 group-hover:scale-105">
                        <div class="p-6">
                            {{-- Icône décorative pour la section patients --}}
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-md mb-4">
                                <i class="fa-solid fa-users text-2xl text-blue-600"></i>
                            </div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Gestion des Patients</h2>
                            <p class="text-gray-600 mb-6">Accédez à la liste complète des patients ou ajoutez de
                                nouveaux patients au système.</p>
                            {{-- Boutons d'action pour la gestion des patients --}}
                            <div class="flex flex-col space-y-3">
                                {{-- Bouton pour accéder à la liste des patients --}}
                                <a href="{{ route('patients.index') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                                    <i class="fa-solid fa-list-ul mr-2"></i>
                                    Liste des patients
                                </a>
                                {{-- Bouton pour ajouter un nouveau patient --}}
                                <a href="{{ route('patients.create') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-blue-600 text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition duration-150">
                                    <i class="fa-solid fa-plus mr-2"></i>
                                    Ajouter un patient
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carte de gestion des vaccins --}}
                <div class="relative group">
                    {{-- Conteneur avec effet d'élévation au survol --}}
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 group-hover:scale-105">
                        <div class="p-6">
                            {{-- Icône décorative pour la section vaccins --}}
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-md mb-4">
                                <i class="fa-solid fa-shield-virus text-2xl text-green-600"></i>
                            </div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Gestion des Vaccins</h2>
                            <p class="text-gray-600 mb-6">Consultez l'inventaire des vaccins disponibles ou ajoutez de
                                nouveaux vaccins au système.</p>
                            {{-- Boutons d'action pour la gestion des vaccins --}}
                            <div class="flex flex-col space-y-3">
                                {{-- Bouton pour accéder à la liste des vaccins --}}
                                <a href="{{ route('vaccins.index') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                    <i class="fa-solid fa-list-ul mr-2"></i>
                                    Liste des vaccins
                                </a>
                                {{-- Bouton pour ajouter un nouveau vaccin --}}
                                <a href="{{ route('vaccins.create') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-green-600 text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50 transition duration-150">
                                    <i class="fa-solid fa-plus mr-2"></i>
                                    Ajouter un vaccin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
