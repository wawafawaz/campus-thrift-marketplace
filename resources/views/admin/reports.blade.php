<!DOCTYPE html>
<html>
<head>
    <title>Reports & Complaints</title>
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
        .btn { padding: 8px 14px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .btn-resolve { background: #4CAF50; color: white; }
        .success { background: #d4edda; color: #155724; padding: 12px; border-radius: 10px; margin-bottom: 20px; }
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .badge-pending { background: #FFC107; color: black; }
        .badge-resolved { background: #4CAF50; color: white; }
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
            <h1>Reports & Complaints</h1>
            <p>Review and resolve product or user reports submitted by users.</p>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <table>
            <tr>
                <th>Reporter ID</th>
                <th>Reported User ID</th>
                <th>Product ID</th>
                <th>Reason</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @if($reports->isEmpty())
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">
                        <div style="font-size:50px;">🛑</div>
                        <h3 style="margin:10px 0;">No Reports Submitted</h3>
                        <p style="color:#777;">User complaints and reports will appear here</p>
                    </td>
                </tr>
                @else
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->reporter_id }}</td>
                        <td>{{ $report->reported_user_id }}</td>
                        <td>{{ $report->product_id }}</td>
                        <td>{{ $report->reason }}</td>
                        <td>{{ $report->description }}</td>
                        <td>
                            <span class="badge 
                                @if($report->status == 'Resolved') badge-resolved
                                @else badge-pending
                                @endif
                            ">
                                {{ $report->status }}
                            </span>
                        </td>
                        <td>
                            <form action="/admin/reports/{{ $report->id }}/resolve" method="POST">
                                @csrf
                                <button class="btn btn-resolve">Resolve</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
</body>
</html>