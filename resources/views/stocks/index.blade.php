<x-layout>
    <div class="container py-3">
        <h1 class="my-3">All Stocks</h1>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary my-3">Add Stock</a>
        <table id="example" class="stripe" style="width:100%">
            <thead>
                <th>N0.</th>
                <th>Name</th>
                <th>Level / Type</th>
                <th>In Stock</th>
                <th>Price</th>
                <th>Campus</th>
                <th>Total Quantity</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($stocks as $row)
                    @php
                        $campus = \App\Models\Campuses::find($row->campus_id);
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->level_type }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $campus ? $campus->name : '' }}</td>
                        <td>{{ $row->total_quantity }}</td>
                        <td>{{ $row->updated_at }}</td>
                        <td>
                            <div class="row">
                                <a href="{{ route('stocks.edit', $row->id) }}" class="btn btn-primary mx-2">Edit</a>
                                <form action="{{ route('stocks.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to submit?');">
                                    @csrf
                                    @method("DELETE")
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
