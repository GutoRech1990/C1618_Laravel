<x-layout>
    <div>
        <h1 class="text-2xl font-bold mb-4 text-center"> Liste de Patients</h1>
        <div class="mb-4 text-center">
            <a href="{{ route('patients.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Add
                Patient</a>
        </div>

        <table class="table-auto border-collapse border border-gray-300 w-full mx-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-300">Nom</th>
                    <th class="px-4 py-2 border border-gray-300">Age</th>
                    <th class="px-4 py-2 border border-gray-300 hidden md:table-cell">Adresse</th>
                    <th class="px-4 py-2 border border-gray-300">Date de Naissance</th>
                    <th class="px-4 py-2 border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4">{{ $patient->name }}</td>
                        <td class="border px-4">{{ $patient->age }}</td>
                        <td class="border px-4 hidden md:table-cell">{{ $patient->adress }}</td>
                        <td class="border px-4">{{ $patient->birth_date }}</td>
                        <td class="border px-4">
                            <a href="{{ route('patients.edit', $patient) }}" class="text-green-600 px-3 py-1"><i
                                    class="fa-solid fa-pen"></i></a>

                            {{-- button pour verifier les vaccins du patient --}}
                            <a href="{{ route('vaccinations.show', $patient->id) }}" class="text-blue-600 px-3 py-1"><i
                                    class="fa-solid fa-syringe"></i></a>
                            {{-- button pour suprimer un patient --}}
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST"
                                class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 px-3 py-1 delete-button"
                                    data-id="{{ $patient->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p class="text-gray-500">Aucun patient trouvé.</p>
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
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.delete-form');
                const patientId = this.getAttribute('data-id');

                // Verificar se o paciente possui vacinações
                fetch(`/patients/${patientId}/has-vaccinations`)
                    .then(response => response.json())
                    .then(data => {
                        let alertText = "Êtes-vous sûr de vouloir supprimer ce patient?";
                        if (data.hasVaccinations) {
                            alertText =
                                "Ce patient a des vaccinations associées. Êtes-vous sûr de vouloir le supprimer? Cette action supprimera également les vaccinations associées.";
                        }

                        Swal.fire({
                            title: 'Êtes-vous sûr?',
                            text: alertText,
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
        });
    </script>


</x-layout>
