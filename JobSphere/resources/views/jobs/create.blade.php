<x-layout>
    <x-slot name="title">Create job</x-slot>
    
    <x-slot name="header">
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-2">
                    <h1 class="text-3xl font-bold text-gray-900">Create a new job</h1>
                    <p class="mt-2 text-sm text-gray-600">Fill out the form below to post a new job listing</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="/jobs" method="POST" class="space-y-6">
<!--  CSRF (Cross-Site Request Forgery) token. Il permet de protéger vos formulaires contre la falsification /attaques des requêtes intersites -->
                @csrf
                
                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title"
                        value="{{ old('title') }}"
                        class="mt-1 block w-full rounded-md border shadow-sm"
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">The title field is required.</p>
                    @enderror
                </div>

                <!-- Job Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
                    <textarea 
                        name="description" 
                        id="description"
                        rows="4"
                        class="mt-1 block w-full rounded-md border shadow-sm"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">The description field is required.</p>
                    @enderror
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                    <input 
                        type="text" 
                        name="company" 
                        id="company"
                        value="{{ old('company') }}"
                        class="mt-1 block w-full rounded-md border shadow-sm"
                    >
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">The company field is required.</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input 
                        type="text" 
                        name="location" 
                        id="location"
                        value="{{ old('location') }}"
                        class="mt-1 block w-full rounded-md border shadow-sm"
                    >
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">The location field is required.</p>
                    @enderror
                </div>

                <!-- Employer -->
                <div>
                    <label for="employer_id" class="block text-sm font-medium text-gray-700">Employer</label>
                    <select 
                        name="employer_id" 
                        id="employer_id"
                        class="mt-1 block w-full rounded-md border shadow-sm"
                    >
                        <option value="">Select an employer</option>
                        @foreach($employers as $employer)
                            <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                                {{ $employer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employer_id')
                        <p class="mt-1 text-sm text-red-600">The employer field is required.</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button 
                        type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300"
                    >
                        Create Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>

