<x-layout>
    <div>
        <h1 class="text-2xl font-bold mb-4 text-center">Liste de Vaccins</h1>
        <div class="mb-4 text-center">
            <a href="{{ route('vaccins.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Add Vaccin</a>
        </div>

        <table class="table-auto border-collapse border border-gray-300 w-full mx-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-300">Nom</th>
                    <th class="px-4 py-2 border border-gray-300">Fabricant</th>
                    <th class="px-4 py-2 border border-gray-300">Prix</th>
                    <th class="px-4 py-2 border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody id="vaccinTable">
                @forelse ($vaccins as $vaccin)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4">{{ $vaccin->name }}</td>
                        <td class="border px-4">{{ $vaccin->fabricant }}</td>
                        <td class="border px-4">{{ $vaccin->price }} €</td>
                        <td class="border px-4">
                            <a href="{{ route('vaccins.edit', $vaccin) }}"
                                class="text-green-600 px-3 py-1 hover:bg-green-200 rounded">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('vaccins.destroy', $vaccin) }}" method="POST"
                                class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="text-red-600 px-3 py-1 hover:bg-red-200 rounded delete-button">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Aucun vaccin trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
                const vaccinId = form.action.split('/').pop(); // Obter o ID da vacina a partir da URL

                // Verificar os pacientes associados à vacina
                fetch(`/vaccins/${vaccinId}/patients`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.patients.length > 0) {
                            // Construir a lista de pacientes
                            let patientList = data.patients.map(patient => `- ${patient.name}`).join(
                                '<br>');

                            // Mostrar alerta com a lista de pacientes
                            Swal.fire({
                                title: 'Impossible de supprimer!',
                                html: `Cette vaccin est associé aux patients suivants:<br><br>${patientList}<br><br>Veuillez d'abord supprimer la vaccination de ces patients.`,
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Mostrar confirmação de exclusão
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
                        }
                    });
            });
        });
    </script>
</x-layout>
