<x-layout>
    <div class="container py-3">
        <h1 class="my-5">Create new order</h1>
        <form action="{{ route('orders.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="stock_id">Select Stock</label>
                <select name="stock_id" id="stock_id" class="custom-select">
                    <option>-- select --</option>
                    @foreach ($stocks as $stock)
                        <option value="{{ $stock->id }}" data-leveltype="{{ $stock->level_type }}">{{ $stock->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="level_type">Level Type</label>
                <select name="level_type" id="level_type" class="custom-select" disabled>
                </select>
            </div>
            <div class="form-group">
                <label for="order_quantity">Order Quantity</label>
                <input type="number" name="order_quantity" id="order_quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="price_option">Price Option</label>
                <input type="checkbox" name="price_option" id="price_option" value="1" class="form-check">
            </div>
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" id="order_date" class="form-control">
            </div>

            <button class="btn btn-primary my-3">Add Order</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#stock_id').change(function() {
                var selectedStock = $(this).find(':selected');
                var levelType = selectedStock.data('leveltype');
                var levelTypeSelect = $('#level_type');

                // Enable and clear the level type select
                levelTypeSelect.prop('disabled', false);
                levelTypeSelect.empty();

                // Populate the level type select based on the selected stock
                levelTypeSelect.append($('<option>', {
                    value: levelType,
                    text: levelType,
                    selected: true
                }));
            });
        });
    </script>
</x-layout>
