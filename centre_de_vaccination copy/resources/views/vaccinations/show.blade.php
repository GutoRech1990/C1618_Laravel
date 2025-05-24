<x-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Détails du Patient</h1>
            <p class="mt-2 text-sm text-gray-700">Consultez et gérez les vaccinations du patient</p>
        </div>

        <!-- Patient Info Card -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Informations du Patient</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Âge</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->age }} ans</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Adresse</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->adress }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de Naissance</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->birth_date }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vaccinations Section -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900">Vaccinations</h2>
                <a href="{{ route('vaccinations.create', $patient->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Ajouter une Vaccination
                </a>
            </div>

            @if ($vaccinations->isEmpty())
                <div class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-syringe text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Aucune vaccination trouvée</p>
                        <p class="text-gray-400 text-sm mt-1">Ajoutez une nouvelle vaccination pour ce patient</p>
                    </div>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom du Vaccin</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de Vaccination</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($vaccinations as $vaccination)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $vaccination->vaccin->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vaccination->vaccination_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('vaccinations.edit', $vaccination->id) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('vaccinations.destroy', $vaccination->id) }}"
                                                method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 delete-button">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
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
        });
    </script>
</x-layout>
