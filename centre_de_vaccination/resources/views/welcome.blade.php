<x-layout>
    <div class="container mx-auto mt-10 flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 text-center">Bienvenue sur le système de gestion des vaccination</h1>
        <i class="fa-solid fa-syringe mb-6 text-8xl"></i>
        <div class="flex justify-center mb-4 space-x-4">
            <a href="{{ route('patients.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center">Voir la liste des
                patients</a>
            <a href="{{ route('patients.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-center">Ajouter un patient</a>
        </div>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('vaccins.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center">Voir
                la liste des vaccins</a>
            <a href="{{ route('vaccins.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-center">Ajouter un vaccin</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-layout>
