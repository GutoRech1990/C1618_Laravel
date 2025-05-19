<x-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <!-- Dados do Paciente -->
        <h1 class="text-2xl font-bold mb-6 text-center">Détails du Patient</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p><strong>Nom:</strong> {{ $patient->name }}</p>
            <p><strong>Âge:</strong> {{ $patient->age }}</p>
            <p><strong>Adresse:</strong> {{ $patient->adress }}</p>
            <p><strong>Date de Naissance:</strong> {{ $patient->birth_date }}</p>
        </div>

        <!-- Botão para adicionar nova vacinação -->
        <div class="mb-6 text-center">
            <a href="{{ route('vaccinations.create', $patient->id) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">
                Ajouter une Vaccination
            </a>
        </div>

        <!-- Lista de Vacinas -->
        <h2 class="text-xl font-bold mb-4">Vaccinations</h2>
        @if ($vaccinations->isEmpty())
            <p class="text-gray-500">Aucune vaccination trouvée pour ce patient.</p>
        @else
            <table class="table-auto border-collapse border border-gray-300 w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Nom du Vaccin</th>
                        <th class="px-4 py-2 border border-gray-300">Date de Vaccination</th>
                        <th class="px-4 py-2 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vaccinations as $vaccination)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4">{{ $vaccination->vaccin->name }}</td>
                            <td class="border px-4">{{ $vaccination->vaccination_date }}</td>
                            <td class="border px-4">
                                <a href="{{ route('vaccinations.edit', $vaccination->id) }}"
                                    class="text-green-600 px-3 py-1"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('vaccinations.destroy', $vaccination->id) }}" method="POST"
                                    class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 px-3 py-1 delete-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Script pour alert personalise -->
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
        // Confirmation avant la suppression
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: "Cette action est irréversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-layout>
