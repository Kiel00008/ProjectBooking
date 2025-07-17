<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #eef1f5;
        }

        .sidebar {
            background-color: #1f2937;
            width: 240px;
            padding-top: 20px;
            position: fixed;
            height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 6px;
            transition: background-color 0.3s, transform 0.2s;
            text-align: center;
            width: 80%;
        }

        .sidebar a:hover {
            background-color: #374151;
            transform: scale(1.05);
        }

        .content {
            margin-left: 240px;
            padding: 40px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .top-bar {
            background-color: #1f2937;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .top-bar .actions {
            display: flex;
            gap: 15px;
        }

        .top-bar a,
        .top-bar button {
            background-color: #4B5563;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .top-bar a:hover,
        .top-bar button:hover {
            background-color: #374151;
            transform: scale(1.05);
        }

        h1 {
            font-size: 32px;
            color: #1f2937;
            margin-bottom: 30px;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .stat-box {
            flex: 1;
            background-color: #f3f4f6;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin: 0 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: default;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-box h2 {
            font-size: 24px;
            margin: 0;
            color: #111827;
        }

        .stat-box p {
            font-size: 16px;
            color: #6b7280;
            margin-top: 8px;
        }

        #calendar-container {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        #calendar {
            background-color: #000;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 1000px;
            color: white;
        }

        .fc .fc-toolbar-title,
        .fc .fc-button,
        .fc .fc-col-header-cell-cushion,
        .fc .fc-daygrid-day-number {
            color: white !important;
        }

        .fc .fc-button {
            background-color: #374151;
            border: none;
        }

        .fc .fc-button:hover {
            background-color: #4B5563;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: #1f2937 !important;
        }

        .fc .fc-daygrid-day.booked-date {
            background-color: red !important;
            color: white !important;
        }

        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
                gap: 20px;
            }

            .stat-box {
                margin: 0;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="title">📊 Dashboard</div>
    <nav>
        <a href="{{ route('bookings.index') }}">📖 View Bookings</a>
        <a href="{{ route('bookings.create') }}">➕ Create Booking</a>
    </nav>
</div>

<!-- Main Content -->
<div class="content">
    <div class="top-bar">
        <div class="title">Welcome, {{ auth()->user()->name }}</div>
        <div class="actions">
            <a href="{{ route('profile.edit') }}">👤 Edit Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <h1>TANGINAMO GUMAWA KA NG SARILI MO</h1>

    <div class="stats">
        <div class="stat-box">
            <h2>{{ $totalBookings }}</h2>
            <p>Total Bookings</p>
        </div>
        <div class="stat-box">
            <h2>{{ $totalUsers }}</h2>
            <p>Total Users</p>
        </div>
    </div>

    

</body>
</html>
