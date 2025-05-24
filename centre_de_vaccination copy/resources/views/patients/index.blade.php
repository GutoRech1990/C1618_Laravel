<x-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">
            <div class="mb-6 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Liste des Patients</h1>
                <p class="mt-2 text-sm text-gray-700">Gérez et consultez tous les patients enregistrés</p>
            </div>
            <div>
                <a href="{{ route('patients.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Ajouter un Patient
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Age</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Adresse</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date de Naissance</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($patients as $patient)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $patient->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->age }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                                    {{ $patient->adress }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->birth_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('patients.edit', $patient) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="{{ route('vaccinations.show', $patient->id) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200">
                                            <i class="fa-solid fa-syringe"></i>
                                        </a>
                                        <form action="{{ route('patients.destroy', $patient) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200 delete-button"
                                                data-id="{{ $patient->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
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
        // Script for delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</x-layout>
