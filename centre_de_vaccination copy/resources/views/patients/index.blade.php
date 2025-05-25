<x-layout>
    <div class="max-w-7xl mx-auto">
        {{-- Section d'en-tête avec titre et barre de recherche --}}
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">
            {{-- Titre et sous-titre de la page --}}
            <div class="mb-6 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Liste des Patients</h1>
                <p class="mt-2 text-sm text-gray-700">Gérez et consultez tous les patients enregistrés</p>
            </div>
            {{-- Zone de recherche et bouton d'ajout --}}
            <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
                {{-- Barre de recherche avec icône --}}
                <div class="relative">
                    <input type="text" id="searchPatient"
                        class="block w-full rounded-md border-gray-300 pl-10 pr-4 py-2 text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Rechercher un patient...">
                    {{-- Icône de recherche positionnée à gauche --}}
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                {{-- Bouton pour ajouter un nouveau patient --}}
                <a href="{{ route('patients.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Ajouter un Patient
                </a>
            </div>
        </div>

        {{-- Section du tableau des patients --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto min-w-full">
                {{-- Tableau responsive avec bordures de séparation --}}
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- En-tête du tableau --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Informations</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    {{-- Corps du tableau avec la liste des patients --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($patients as $patient)
                            {{-- Ligne de patient avec effet de survol --}}
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                {{-- Cellule d'informations du patient --}}
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex flex-col">
                                        {{-- Nom du patient --}}
                                        <div class="text-sm font-medium text-gray-900">{{ $patient->name }}</div>
                                        {{-- Âge et date de naissance (responsive) --}}
                                        <div class="text-sm text-gray-500">
                                            <span class="inline-block mr-3">Age: {{ $patient->age }}</span>
                                            <span class="hidden sm:inline-block">Date: {{ $patient->birth_date }}</span>
                                        </div>
                                        {{-- Adresse (visible uniquement sur desktop) --}}
                                        <div class="text-sm text-gray-500 hidden sm:block">{{ $patient->adress }}</div>
                                    </div>
                                </td>
                                {{-- Cellule des actions --}}
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center justify-end gap-4">
                                        {{-- Bouton de modification --}}
                                        <a href="{{ route('patients.edit', $patient) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            <i class="fa-solid fa-pen text-lg"></i>
                                        </a>
                                        {{-- Bouton pour accéder aux vaccinations --}}
                                        <a href="{{ route('vaccinations.show', $patient->id) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200">
                                            <i class="fa-solid fa-syringe text-lg"></i>
                                        </a>
                                        {{-- Formulaire de suppression avec confirmation --}}
                                        <form action="{{ route('patients.destroy', $patient) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200 delete-button"
                                                data-id="{{ $patient->id }}">
                                                <i class="fa-solid fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Message affiché lorsqu'aucun patient n'est trouvé --}}
                            <tr>
                                <td colspan="2" class="px-4 sm:px-6 py-4 text-center">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <i class="fa-solid fa-users text-gray-400 text-4xl mb-4"></i>
                                        <p class="text-gray-500 text-lg">Aucun patient trouvé</p>
                                        <p class="text-gray-400 text-sm mt-1">Commencez par ajouter un nouveau patient
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Notification de succès avec SweetAlert2 --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        // Script de gestion des interactions utilisateur
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration de la confirmation de suppression avec SweetAlert2
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const patientId = this.dataset.id;
                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: "Cette action ne peut pas être annulée!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#EF4444',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Oui, supprimer',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
            });

            // Fonctionnalité de recherche en temps réel
            const searchInput = document.getElementById('searchPatient');
            const rows = document.querySelectorAll('tbody tr');

            // Filtrage des patients lors de la saisie
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();

                rows.forEach(row => {
                    if (row.querySelector('td')) { // Ignore la ligne d'état vide
                        const name = row.querySelector('td:first-child').textContent.toLowerCase();
                        if (name.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
</x-layout>
