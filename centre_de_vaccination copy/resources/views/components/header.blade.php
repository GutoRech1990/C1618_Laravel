<div>
    {{-- En-tête avec dégradé de bleu et ombre --}}
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-5">
            {{-- Conteneur flexible pour le logo et la navigation --}}
            <div class="flex justify-between items-center">
                {{-- Logo et titre avec animation au survol --}}
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <h1
                        class="text-2xl font-bold tracking-tight group-hover:text-blue-200 transition-colors duration-200">
                        Centre de Vaccination</h1>
                    {{-- Icône de seringue avec animation de rotation au survol (visible uniquement sur desktop) --}}
                    <i
                        class="fa-solid fa-syringe text-2xl group-hover:text-blue-200 hidden sm:inline transform group-hover:rotate-12 transition-all duration-200"></i>
                </a>
                {{-- Navigation principale (visible uniquement sur desktop) --}}
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        {{-- Lien vers la liste des patients --}}
                        <li>
                            <a href="{{ route('patients.index') }}"
                                class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                                <i class="fa-solid fa-users"></i>
                                <span>Patients</span>
                            </a>
                        </li>
                        {{-- Lien vers la liste des vaccins --}}
                        <li>
                            <a href="{{ route('vaccins.index') }}"
                                class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                                <i class="fa-solid fa-shield-virus"></i>
                                <span>Vaccins</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                {{-- Bouton du menu mobile (visible uniquement sur mobile) --}}
                <button class="md:hidden text-white hover:text-blue-200 transition-colors duration-200">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        {{-- Menu mobile (caché par défaut) --}}
        {{-- S'affiche lorsque le bouton du menu mobile est cliqué --}}
        <div class="md:hidden hidden bg-blue-700">
            <div class="container mx-auto px-4 py-3">
                {{-- Liste des liens de navigation pour mobile --}}
                <ul class="space-y-3">
                    {{-- Lien mobile vers la liste des patients --}}
                    <li>
                        <a href="{{ route('patients.index') }}"
                            class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                            <i class="fa-solid fa-users"></i>
                            <span>Patients</span>
                        </a>
                    </li>
                    {{-- Lien mobile vers la liste des vaccins --}}
                    <li>
                        <a href="{{ route('vaccins.index') }}"
                            class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                            <i class="fa-solid fa-shield-virus"></i>
                            <span>Vaccins</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</div>
