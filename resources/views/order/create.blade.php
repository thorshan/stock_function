<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Create</title>
</head>
<body>

    <form action="{{route('order.place')}}" method="post">
        @csrf
        <select name="stock_id">
            <option>-- select --</option>
            @foreach($stocks as $stock)
            <option value="{{$stock->id}}">{{$stock->name}}</option>
            @endforeach
        </select>
        <input type="number" name="order_quantity" placeholder="quantity ..">
        <input type="checkbox" name="price_option" value="1">
        <input type="date" name="order_date">
        <button>Place Stock</button>
    </form>
</body>
</html>
