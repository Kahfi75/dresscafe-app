<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <style>
        /* Styling for the order form */
        .order-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .menu_item select,
        .menu_item input {
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: auto;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .order-form {
                padding: 15px;
            }

            .form-group label {
                font-size: 14px;
            }

            .form-control {
                font-size: 12px;
                padding: 8px;
            }

            .btn {
                font-size: 14px;
            }
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Create New Order</h2>

        <!-- Success Alert (Optional) -->
        <div class="alert" id="successAlert" style="display: none;">
            Order has been successfully submitted!
        </div>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Order Form -->
        <form action="{{ route('orders.store') }}" method="POST" class="order-form" id="orderForm">
            @csrf

            <!-- Customer Name -->
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ old('customer_name') }}" required>
                @error('customer_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Menu Items -->
            <div class="form-group">
                <label for="menu_items">Menu Items</label>
                <div id="menu_items">
                    <div class="menu_item mb-3">
                        <select name="menu[0][menu_id]" class="form-control" required>
                            <option value="">Select Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{ old('menu.0.menu_id') == $menu->id ? 'selected' : '' }}>{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="menu[0][quantity]" class="form-control mt-2" min="1" value="{{ old('menu.0.quantity') }}" placeholder="Quantity" required>
                        @error('menu.0.menu_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        @error('menu.0.quantity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="button" id="add-menu" class="btn btn-secondary mt-3">Add Another Menu Item</button>
            </div>

            <!-- Hidden Status (Pending) -->
            <input type="hidden" name="status" value="Pending">

            <button type="submit" class="btn btn-primary mt-4">Submit Order</button>
        </form>
    </div>

    <script>
        // Add new menu item field
        document.getElementById('add-menu').addEventListener('click', function () {
            let menuItem = document.createElement('div');
            menuItem.classList.add('menu_item', 'mb-3');
            menuItem.innerHTML = `
                <select name="menu[][menu_id]" class="form-control" required>
                    <option value="">Select Menu</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ old('menu[].menu_id') == $menu->id ? 'selected' : '' }}>{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="menu[][quantity]" class="form-control mt-2" min="1" placeholder="Quantity" required>
            `;
            document.getElementById('menu_items').appendChild(menuItem);
        });
    </script>
</body>
</html>
