<!DOCTYPE html>
<html>

<head>
    <title>Product Management</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f3df;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #2f3e2f;
            color: white;
            padding: 25px 20px;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 35px;
            color: #f4d35e;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #6b8e23;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header h1 {
            margin: 0;
            color: #2f3e2f;
        }

        .form-box {
            background: white;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 650px;
        }

        .form-box h2 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #2f3e2f;
            font-size: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-grid input,
        .form-grid textarea {
            width: 100%;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .form-grid textarea {
            height: 70px;
            grid-column: span 2;
        }

        .form-box .btn {
            margin-top: 12px;
        }

        .filter {
            margin: 20px 0;
        }

        .filter a {
            display: inline-block;
            text-decoration: none;
            background: white;
            color: #2f3e2f;
            padding: 8px 14px;
            border-radius: 20px;
            margin-right: 8px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .filter a:hover {
            background: #6b8e23;
            color: white;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-top: 6px solid #6b8e23;
        }

        .product-card h3 {
            margin-top: 0;
            color: #2f3e2f;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #6b8e23;
        }

        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 12px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .status-sold {
            background: #e2e3e5;
            color: #383d41;
        }

        .btn {
            width: 100%;
            padding: 9px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 7px;
            font-weight: bold;
        }

        .btn-approve {
            background: #4CAF50;
            color: white;
        }

        .btn-reject {
            background: #E53935;
            color: white;
        }

        .btn-delete {
            background: #B71C1C;
            color: white;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            color: #777;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .note {
            background: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="layout">

        <div class="sidebar">
            <h2>Campus Thrift</h2>

            <a href="/">🏠 Dashboard</a>
            <a href="/admin/products">📦 Product Management</a>
            <a href="/admin/users">👤 User Management</a>
            <a href="/admin/transactions">💳 Transaction Monitoring</a>
            <a href="/admin/reports">⚠ Reports & Complaints</a>
        </div>

        <div class="main">

            <div class="header">
                <h1>Product Management</h1>
                <p>Review, approve, reject, remove, and monitor product listings.</p>
            </div>

            <div class="note">
                Admin approves or rejects product listings based on suitability and safety.
                Sold status is managed by the seller because the seller knows when the item has actually been sold.
            </div>

            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif


            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            <div class="form-box">
                <h2>Add Product</h2>

                <form action="/admin/products" method="POST">
                    @csrf

                    <div class="form-grid">
                        <input type="text" name="name" placeholder="Product Name" required>
                        <input type="text" name="category" placeholder="Category" required>
                        <input type="number" name="price" placeholder="Price" required>
                        <input type="text" name="condition" placeholder="Condition" required>
                        <textarea name="description" placeholder="Description"></textarea>
                    </div>

                    <button class="btn btn-approve" type="submit">
                        Add Product
                    </button>
                </form>
            </div>

            <div class="filter">
                
            </div>

            <div class="filter">
                <a href="/admin/products">All</a>
                <a href="/admin/products?status=Pending">Pending</a>
                <a href="/admin/products?status=Approved">Approved</a>
                <a href="/admin/products?status=Rejected">Rejected</a>
                <a href="/admin/products?status=Sold">Sold</a>
            </div>

            @if($products->isEmpty())
                <div class="empty">
                    <div style="font-size:50px;">📦</div>
                    <h3>No Products Yet</h3>
                    <p>Products added by admin or sellers will appear here.</p>
                </div>
            @else
                <div class="products-grid">

                    @foreach($products as $id => $product)
                        <div class="product-card">
                            <h3>{{ $product['name'] ?? '-' }}</h3>

                            <p>{{ $product['category'] ?? '-' }}</p>

                            <p class="price">RM {{ $product['price'] ?? 0 }}</p>

                            <p><b>Condition:</b> {{ $product['condition'] ?? '-' }}</p>

                            <p>{{ $product['description'] ?? '' }}</p>

                            @if(($product['status'] ?? '') == 'Approved')
                                <span class="status status-approved">Approved</span>
                            @elseif(($product['status'] ?? '') == 'Rejected')
                                <span class="status status-rejected">Rejected</span>
                            @elseif(($product['status'] ?? '') == 'Sold')
                                <span class="status status-sold">Sold</span>
                            @else
                                <span class="status status-pending">Pending</span>
                            @endif

                            @if(($product['status'] ?? '') != 'Approved' && ($product['status'] ?? '') != 'Sold')
                                <form action="/admin/products/{{ $id }}/approve" method="POST">
                                    @csrf
                                    <button class="btn btn-approve" type="submit"> Approve </button>
                                </form>
                            @endif

                            <form action="/admin/products/{{ $id }}/reject" method="POST">
                                @csrf
                                <button class="btn btn-reject" type="submit">Reject</button>
                            </form>

                            <form action="/admin/products/{{ $id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete" type="submit" onclick="return confirm('Remove this product?')">
                                    Remove Inappropriate Item
                                </button>
                            </form>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>

    </div>

</body>

</html>