<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <style>
        .order-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-primary { background-color: #007bff; color: #fff; border: none; }
        .btn-danger { background-color: #dc3545; color: #fff; border: none; }
        .btn-secondary { background-color: #6c757d; color: #fff; border: none; }
        .error { color: red; font-size: 14px; }
        .menu_item { display: flex; gap: 10px; align-items: center; margin-bottom: 10px; }
        .price { font-weight: bold; }
        .alert { padding: 10px; background-color: #28a745; color: white; text-align: center; display: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create New Order</h2>
        <div class="alert" id="successAlert">Order has been successfully submitted!</div>
        <form action="{{ route('orders.store') }}" method="POST" class="order-form" id="orderForm">
            @csrf
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name" required>
            </div>
            
            {{-- Dropdown Customer dari Database --}}
            <div class="form-group">
                <label for="customer_select">Pilih Customer yang Terdaftar</label>
                <select id="customer_select" class="form-control">
                    <option value="">-- Pilih Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Jika dipilih, nama customer akan otomatis diisi di atas.</small>
            </div>

            <div class="form-group">
                <label>Menu Items</label>
                <div id="menu_items">
                    <div class="menu_item">
                        <select name="menu[0][menu_id]" class="form-control menu-select" required>
                            <option value="">Select Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="menu[0][quantity]" class="form-control quantity" min="1" required>
                        <span class="price">Rp 0</span>
                        <button type="button" class="btn btn-danger remove-item">Hapus</button>
                    </div>
                </div>
                <button type="button" id="add-menu" class="btn btn-secondary">Add Another Menu Item</button>
            </div>
            <div><strong>Total Harga: Rp <span id="total-price">0</span></strong></div>
            <input type="hidden" name="status" value="Pending">
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let index = 1;
            const menuItems = document.getElementById("menu_items");
            const totalPriceEl = document.getElementById("total-price");

            // Autofill customer_name dari dropdown
            const customerSelect = document.getElementById("customer_select");
            const customerInput = document.getElementById("customer_name");

            customerSelect.addEventListener("change", function () {
                if (this.value) {
                    customerInput.value = this.value;
                }
            });

            function updateTotalPrice() {
                let total = 0;
                document.querySelectorAll(".price").forEach(el => {
                    total += parseInt(el.innerText.replace("Rp ", "").replace(/\./g, "")) || 0;
                });
                totalPriceEl.innerText = new Intl.NumberFormat('id-ID').format(total);
            }

            document.getElementById("add-menu").addEventListener("click", function () {
                const newRow = `
                    <div class="menu_item">
                        <select name="menu[${index}][menu_id]" class="form-control menu-select" required>
                            <option value="">Select Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="menu[${index}][quantity]" class="form-control quantity" min="1" required>
                        <span class="price">Rp 0</span>
                        <button type="button" class="btn btn-danger remove-item">Hapus</button>
                    </div>
                `;
                menuItems.insertAdjacentHTML("beforeend", newRow);
                index++;
            });

            document.addEventListener("change", function (event) {
                if (event.target.classList.contains("menu-select") || event.target.classList.contains("quantity")) {
                    const menuSelect = event.target.closest(".menu_item").querySelector(".menu-select");
                    const quantityInput = event.target.closest(".menu_item").querySelector(".quantity");
                    const priceEl = event.target.closest(".menu_item").querySelector(".price");

                    const price = menuSelect.selectedOptions[0].dataset.price || 0;
                    const quantity = quantityInput.value || 1;

                    priceEl.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(price * quantity);
                    updateTotalPrice();
                }
            });

            document.addEventListener("click", function (event) {
                if (event.target.classList.contains("remove-item")) {
                    event.target.closest(".menu_item").remove();
                    updateTotalPrice();
                }
            });
        });
    </script>
</body>
</html>
