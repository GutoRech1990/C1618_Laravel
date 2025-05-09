<x-layout>
    <x-slot name="title">Edit Job - {{ $job->title }}</x-slot>
    <x-slot name="header">
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-2">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Job
                        Listing</h1>
                    <p class="mt-2 text-sm text-gray-600">Update the job listing
                        information below</p>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="/jobs/{{ $job->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}"
                        class="mt-1 block w-full rounded-md border shadow-sm">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Job Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border shadow-sm">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $job->company) }}"
                        class="mt-1 block w-full rounded-md border shadow-sm">
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}"
                        class="mt-1 block w-full rounded-md border shadow-sm">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Submit Button -->
                <div class="pt-6 flex justify-between">
                    <a href="/jobs/{{ $job->id }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
                        Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
