<x-layout>
    <div class="container py-3">
        <h1 class="my-5">Create new stock</h1>
        <form action="{{ route('stocks.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Stock Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="level_type">Level / Type</label>
                <input type="text" class="form-control" id="level_type" name="level_type">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="campus_id">Campus</label>
                <select name="campus_id" id="campus_id" class="custom-select">
                    <option>-- Select --</option>
                    @foreach($campus as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <button class="btn btn-primary my-3">Add Stock</button>
        </form>
    </div>
</x-layout>
