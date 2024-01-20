<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Order</title>
</head>

<body>

    <a href="{{ route('order.create') }}">Add Order</a>

    @php
        $totalAmount = 0; // Initialize total amount variable
    @endphp

    <table style="border: 1px solid #3e3e3e">
        <thead style="background:#deafcf">
            <th>No.</th>
            <th>Date</th>
            <th>Name</th>
            <th>Level / Type</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total Amount</th>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                @php
                    $stock = \App\Models\Stock::find($order->stock_id);
                    $amount = $order->price_option == 1 && $stock ? $stock->price * $order->order_quantity : 0;
                    $totalAmount += $amount;
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $stock ? $stock->name : '' }}</td>
                    <td>{{ $stock ? $stock->level_type : '' }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>
                        @if ($order->price_option == 1)
                            {{ $stock ? $stock->price : '' }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($order->price_option == 1)
                            {{ $stock ? $stock->price * $order->order_quantity : '' }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{{$totalAmount}}</p>

</body>

</html>
