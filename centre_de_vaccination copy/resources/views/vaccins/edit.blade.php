<x-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Modifier un Vaccin</h1>
            <p class="mt-2 text-sm text-gray-700">Modifiez les informations du vaccin</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('vaccins.update', $vaccin) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Nom du vaccin" value="{{ old('name', $vaccin->name) }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Manufacturer Field -->
                <div>
                    <label for="fabricant" class="block text-sm font-medium text-gray-700">Fabricant</label>
                    <div class="mt-1">
                        <input type="text" name="fabricant" id="fabricant"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('fabricant') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="Fabricant du vaccin" value="{{ old('fabricant', $vaccin->fabricant) }}"
                            required>
                        @error('fabricant')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Price Field -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" name="price" id="price" step="0.01"
                            class="block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ $errors->has('price') ? 'border-red-300' : 'border-gray-300' }}"
                            placeholder="0.00" value="{{ old('price', $vaccin->price) }}" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('vaccins.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fa-solid fa-save mr-2"></i>
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
