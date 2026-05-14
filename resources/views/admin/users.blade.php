<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>

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

        .note {
            background: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        th {
            background: #2f3e2f;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        tr:hover {
            background: #f1f8e9;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .btn-active {
            background: #4CAF50;
            color: white;
        }

        .btn-restrict {
            background: #FF9800;
            color: white;
        }

        .btn-ban {
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

        .badge {
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-active {
            background: #d4edda;
            color: #155724;
        }

        .badge-restricted {
            background: #fff3cd;
            color: #856404;
        }

        .badge-banned {
            background: #f8d7da;
            color: #721c24;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            color: #777;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .small-text {
            color: #777;
            font-size: 13px;
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
            <h1>User Management</h1>
            <p>Monitor registered student accounts and control user access based on marketplace rules.</p>
        </div>

        <div class="note">
            Since only users with <b>@s.unikl.edu.my</b> email can register, admin does not need to manually verify users. 
            Admin can set user status to <b>Active</b>, <b>Restricted</b>, or <b>Banned</b> if users violate marketplace rules.
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($users->isEmpty())

            <div class="empty">
                <div style="font-size:50px;">👤</div>
                <h3>No Users Found</h3>
                <p>Registered users will appear here.</p>
            </div>

        @else

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Restriction Info</th>
                <th>Action</th>
            </tr>

            @foreach($users as $id => $user)
            <tr>

                <td>{{ $user['name'] ?? '-' }}</td>

                <td>{{ $user['email'] ?? '-' }}</td>

                <td>
                    @if(($user['status'] ?? 'Active') == 'Active')
                        <span class="badge badge-active">Active</span>

                    @elseif(($user['status'] ?? '') == 'Restricted')
                        <span class="badge badge-restricted">Restricted</span>

                    @elseif(($user['status'] ?? '') == 'Banned')
                        <span class="badge badge-banned">Banned</span>

                    @else
                        <span class="badge badge-active">Active</span>
                    @endif
                </td>

                <td>
                    @if(($user['status'] ?? 'Active') == 'Restricted')
                        <div><b>Reason:</b> {{ $user['restriction_reason'] ?? '-' }}</div>
                        <div class="small-text">Until: {{ $user['restricted_until'] ?? '-' }}</div>

                    @elseif(($user['status'] ?? '') == 'Banned')
                        <div><b>Reason:</b> {{ $user['restriction_reason'] ?? '-' }}</div>
                        <div class="small-text">Duration: Permanent</div>

                    @else
                        <span class="small-text">No restriction</span>
                    @endif
                </td>

                <td>
                    @if(($user['status'] ?? 'Active') != 'Active')
                    <form action="/admin/users/{{ $id }}/active" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-active" type="submit">
                            Set Active
                        </button>
                    </form>
                    @endif

                    @if(($user['status'] ?? 'Active') != 'Restricted')
                    <form action="/admin/users/{{ $id }}/restrict" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-restrict" type="submit"
                                onclick="return confirm('Restrict this user for 2 months?')">
                            Restrict
                        </button>
                    </form>
                    @endif

                    @if(($user['status'] ?? 'Active') != 'Banned')
                    <form action="/admin/users/{{ $id }}/ban" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-ban" type="submit"
                                onclick="return confirm('Ban this user permanently?')">
                            Ban
                        </button>
                    </form>
                    @endif
                </td>

            </tr>
            @endforeach

        </table>

        @endif

    </div>

</div>

</body>
</html>