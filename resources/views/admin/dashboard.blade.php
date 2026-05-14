<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

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
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .header h1 {
            margin: 0;
            color: #2f3e2f;
        }

        .header p {
            color: #666;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 6px solid #6b8e23;
        }

        .card h3 {
            margin: 0;
            color: #555;
            font-size: 16px;
        }

        .card p {
            font-size: 34px;
            font-weight: bold;
            color: #2f3e2f;
            margin: 12px 0 0;
        }

        .badge {
            background: #f4d35e;
            color: #2f3e2f;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="layout">

    <div class="sidebar">
        <h2>Campus Thrift</h2>

        <a href="/">Dashboard</a>
        <a href="/admin/products">Product Management</a>
        <a href="/admin/users">User Management</a>
        <a href="/admin/transactions">Transaction Monitoring</a>
        <a href="/admin/reports">Reports & Complaints</a>
    </div>

    <div class="main">

        <div class="header">
            <h1>Admin Dashboard</h1>
            <p>Manage users, listings, transactions, and reports for Campus Thrift Marketplace.</p>
            <span class="badge">Sustainable Campus Marketplace ♻️</span>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>{{ $totalUsers }}</p>
            </div>

            <div class="card">
                <h3>Total Products</h3>
                <p>{{ $totalProducts }}</p>
            </div>

            <div class="card">
                <h3>Pending Products</h3>
                <p>{{ $pendingProducts }}</p>
            </div>

            <div class="card">
                <h3>Approved Products</h3>
                <p>{{ $approvedProducts }}</p>
            </div>

            <div class="card">
                <h3>Sold Products</h3>
                <p>{{ $soldProducts }}</p>
            </div>

            <div class="card">
                <h3>Total Transactions</h3>
                <p>{{ $totalTransactions }}</p>
            </div>

            <div class="card">
                <h3>Pending Reports</h3>
                <p>{{ $totalReports }}</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>