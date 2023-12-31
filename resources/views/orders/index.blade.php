<x-layout>
    <div class="container py-3">
        <h3>In Stock</h3>
        <div class="row">
            @foreach ($stocks as $stock)
                <div class="col-5">
                    <h6>{{ $stock->name }} | {{ $stock->level_type }} | <span
                            class="text-primary">{{ $stock->quantity }}</span> Pax.</h6>
                </div>
            @endforeach
        </div>
        <a href="{{ route('orders.create') }}" class="btn btn-primary my-3">Add Order</a>
        <table id="example" class="stripe" style="width:100%">
            <thead>
                <th>N0.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Campus</th>
                <th>Level / Type</th>
                <th>Quanntity</th>
                <th>Price</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($orders as $row)
                    @php
                        $stock = \App\Models\Stock::find($row->stock_id);
                        $campuses = \App\Models\Campuses::all();
                        foreach ($campuses as $campus) {
                            $campus = \App\Models\Campuses::find($stock->campus_id);
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->order_date)->format('j M Y') }}</td>
                        <td>{{ $stock ? $stock->name : '' }}</td>
                        <td>{{ $campus ? $campus->name : '' }}</td>
                        <td>{{ $stock ? $stock->level_type : '' }}</td>
                        <td>{{ $row->order_quantity }}</td>
                        <td>{{ $stock ? $stock->price : '' }}</td>
                        <td>
                            @if ($row->price_option == 1)
                                {{ $stock ? $stock->price * $row->order_quantity : '' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <a href="{{route('orders.edit', $row->id)}}" class="btn btn-primary mx-2">Edit</a>
                                <form action="{{route('orders.destroy', $row->id)}}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to submit?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
