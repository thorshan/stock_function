<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('stock.create')}}">Add Stock</a>
    <a href="{{route('order.index')}}">All Orders</a>
    <table style="border: 1px solid #3e3e3e">
        <thead style="background:#deafcf">
            <th>No.</th>
            <th>Name</th>
            <th>Level / Type</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Date</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$stock->name}}</td>
                <td>{{$stock->level_type}}</td>
                <td>{{$stock->quantity}}</td>
                <td>{{$stock->price}}</td>
                <td>{{$stock->date}}</td>
                <td><a href="">Sell</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
