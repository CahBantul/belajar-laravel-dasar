<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <form action="/form" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">
        <input type="submit">
    </form>
</body>

</html>