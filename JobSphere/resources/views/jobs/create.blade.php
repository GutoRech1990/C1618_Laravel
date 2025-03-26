<x-layout>
    <h1>Create a new job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Job title" />
        <input type="text" name="description" placeholder="Job description" />
        <button type="submit">Create</button>
    </form>
</x-layout>
