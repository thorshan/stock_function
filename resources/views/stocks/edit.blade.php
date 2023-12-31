<x-layout>
    <div class="container py-3">
        <h1 class="my-5">Update Stock</h1>
        <form action="{{ route('stocks.update', $stock->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Stock Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$stock->name}}">
            </div>
            <div class="form-group">
                <label for="level_type">Level / Type</label>
                <input type="text" class="form-control" id="level_type" name="level_type" value="{{$stock->level_type}}">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{$stock->quantity}}" disabled>
            </div>
            <div class="form-group">
                <label for="total_quantity">Total Quantity</label>
                <input type="number" class="form-control" id="total_quantity" name="total_quantity" value="{{$stock->total_quantity}}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{$stock->price}}">
            </div>
            <div class="form-group">
                <label for="campus_id">Campus</label>
                <select name="campus_id" id="campus_id" class="custom-select">
                    @foreach($campus as $row)
                    <option value="{{$row->id}}" {{$row->id == $stock->campus_id ? 'selected' : ''}}>{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$stock->date}}">
            </div>
            <button class="btn btn-primary my-3">Update Stock</button>
        </form>
    </div>
</x-layout>
