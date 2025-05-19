<div>
    <header class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Centre de Vaccination</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('patients.index') }}" class="hover:text-gray-400">Patients</a></li>
                    <li><a href="{{ route('vaccins.index') }}" class="hover:text-gray-400">Vaccins</a></li>
                </ul>
            </nav>
        </div>
    </header>
</div>
