<x-layout>
    <h1>{{ $title }}</h1>
    <ul>
        @forelse($availableJobs as $job)
            <li>{{ $job }}</li>
        @empty
            <p>No jobs available</p>
        @endforelse
    </ul>

    <hr>

    {{-- <table>
        <tr>
            <th>Job Title</th>
        </tr>
        @foreach($availableJobs as $job)
            <tr>
                <td>{{$job}}</td>
            </tr>
        @endforeach
    </table> --}}
</x-layout>