<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Create</title>
</head>
<body>

    <form action="{{route('stock.store')}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="name ...">
        <input type="text" name="level_type" placeholder="level / type ...">
        <input type="number" name="quantity" placeholder="quantity ...">
        <input type="number" name="price" placeholder="price ...">
        <input type="date" name="date">
        <button>Add Stock</button>
    </form>
</body>
</html>
