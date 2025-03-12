<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a profile</title>
</head>
<body>
    <h1>Enter your details</h1>
    <form action="/result" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age"><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
