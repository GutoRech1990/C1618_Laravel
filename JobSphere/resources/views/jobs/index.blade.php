<x-layout>
    <h1>{{ $title }}</h1>
    <ul>
        @forelse($availableJobs as $job)
            <li>{{ $job }}</li>
        @empty
            <p>No jobs available</p>
        @endforelse
    </ul>
</x-layout>