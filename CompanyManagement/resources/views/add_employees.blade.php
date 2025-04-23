<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($first_name && $last_name && $matricule)
        <h1>Employee Details</h1>
        <p>First Name: {{ $first_name }}</p>
        <p>Last Name: {{ $last_name }}</p>
        <p>Email: {{ $matricule }}</p>
        <a href="/">Go back to form</a> <br>
        <a href="/show_employees">Show all employees</a>
    @else
        <h1>Something went wrong</h1>
        <p>Please check the input data.</p>
        <a href="/add_employees">Go back to form</a>        
    @endif
</body>
</html>