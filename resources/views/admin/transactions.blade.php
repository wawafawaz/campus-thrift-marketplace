<!DOCTYPE html>
<html>
<head>
    <title>Transaction Monitoring</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f7f3df; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: #2f3e2f; color: white; padding: 25px 20px; }
        .sidebar h2 { font-size: 22px; margin-bottom: 35px; color: #f4d35e; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 12px; margin-bottom: 10px; border-radius: 8px; }
        .sidebar a:hover { background: #6b8e23; }
        .main { flex: 1; padding: 30px; }
        .header { background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .header h1 { margin: 0; color: #2f3e2f; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        th { background: #2f3e2f; color: white; padding: 14px; text-align: left; }
        td { padding: 14px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f1f8e9; }
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .badge-pending { background: #FFC107; color: black; }
        .badge-completed { background: #4CAF50; color: white; }
        .badge-cancelled { background: #E53935; color: white; }
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
            <h1>Transaction Monitoring</h1>
            <p>Monitor buyer, seller, product, payment, and transaction status.</p>
        </div>

    <div style="display:flex; gap:20px; margin-bottom:20px;">
    <div style="background:white; padding:15px; border-radius:10px; width:200px;">
        <h4>Total Transactions</h4>
        <h2>{{ $transactions->count() }}</h2>
    </div>

    <div style="background:white; padding:15px; border-radius:10px; width:200px;">
        <h4>Completed</h4>
        <h2>{{ $transactions->where('transaction_status','Completed')->count() }}</h2>
    </div>

    <div style="background:white; padding:15px; border-radius:10px; width:200px;">
        <h4>Pending</h4>
        <h2>{{ $transactions->where('transaction_status','Pending')->count() }}</h2>
    </div>
</div>

        <table>
            <tr>
                <th>Buyer ID</th>
                <th>Seller ID</th>
                <th>Product ID</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Transaction Status</th>
            </tr>

                @if($transactions->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px;">
                            <div style="font-size:50px;">📭</div>
                            <h3 style="margin:10px 0;">No Transactions Yet</h3>
                            <p style="color:#777;">All completed transactions will appear here</p>
                        </td>
                    </tr>
                @else
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction['buyer_id'] ?? '-' }}</td>
                            <td>{{ $transaction['seller_id'] ?? '-' }}</td>
                            <td>{{ $transaction['product_id'] ?? '-' }}</td>
                            <td>RM {{ $transaction['amount'] ?? 0 }}</td>
                            <td>
                                <span class="badge badge-pending">
                                    {{ $transaction['payment_status'] ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if(($transaction['transaction_status'] ?? '') == 'Completed') badge-completed
                                    @elseif(($transaction['transaction_status'] ?? '') == 'Cancelled') badge-cancelled
                                    @else badge-pending
                                    @endif
                                ">
                                    {{ $transaction['transaction_status'] ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
            @endif
        </table>
    </div>
</div>
</body>
</html>