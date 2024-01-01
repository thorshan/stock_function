<x-layout>
    <div class="container py-3">
        <h1 class="my-5">Edit order</h1>
        <form action="{{ route('orders.update', $order->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="stock_id">Select Stock</label>
                <select name="stock_id" id="stock_id" class="custom-select">
                    <option>-- select --</option>
                    @foreach ($stocks as $stock)
                        <option value="{{ $stock->id }}" {{ $stock->id == $order->stock_id ? 'selected' : '' }}
                            data-leveltype="{{ $stock->level_type }}">{{ $stock->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="level_type">Level Type</label>
                <select name="level_type" id="level_type" class="custom-select" disable>
                    @foreach ($stocks as $stock)
                        <option value="{{ $stock->level_type }}" data-stockid="{{ $stock->id }}"
                            style="display: none">
                            {{ $stock->level_type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="order_quantity">Order Quantity</label>
                <input type="number" name="order_quantity" id="order_quantity" class="form-control"
                    value="{{ $order->order_quantity }}">
            </div>
            <div class="form-group">
                <label for="price_option">Price Option</label>
                @if ($order)
                    <input type="checkbox" name="price_option" id="price_option" class="form-check" value="1"
                        @if ($order->price_option == 1) checked @endif>
                @endif
            </div>
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" id="order_date" class="form-control"
                    value="{{ $order->order_date }}">
            </div>

            <button class="btn btn-primary my-3">Add Order</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#stock_id').change(function() {
                var selectedStockId = $(this).val();
                var levelTypeSelect = $('#level_type');

                // Hide all level_type options
                levelTypeSelect.find('option').hide();

                // Show the corresponding level_type based on the selected stock_id
                levelTypeSelect.find('option[data-stockid="' + selectedStockId + '"]').show();

                // Enable the level_type select and select the appropriate option
                levelTypeSelect.prop('disabled', false);
                levelTypeSelect.val(levelTypeSelect.find('option[data-stockid="' + selectedStockId +
                    '"]:visible').val());
            });
        });
    </script>
</x-layout>
