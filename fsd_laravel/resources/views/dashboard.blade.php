<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <p>{{ $welcome }}</p>

    <ol>
        @forelse ($news as $new_item) 
            <li>{{ $new_item }}</li>
        @empty
            <p>No news available</p>
        @endforelse
    </ol>
</body>

</html>