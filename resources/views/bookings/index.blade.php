<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📅 View Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            background-color: #1f2937;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .title {
            font-size: 22px;
            font-weight: 600;
        }

        .top-bar .nav-links a {
            background-color: #4B5563;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 10px;
            font-size: 14px;
            transition: background 0.3s, transform 0.2s;
        }

        .top-bar .nav-links a:hover {
            background-color: #374151;
            transform: scale(1.05);
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 28px;
            color: #1f2937;
            text-align: center;
            margin-bottom: 30px;
        }

        .notification {
            background-color: #d1fae5;
            color: #065f46;
            padding: 15px;
            border: 1px solid #a7f3d0;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.04);
        }

        th, td {
            padding: 14px 18px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
        }

        td {
            color: #4b5563;
        }

        .no-bookings {
            text-align: center;
            background: #fff3cd;
            padding: 20px;
            border: 1px solid #ffeeba;
            border-radius: 6px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-btn, .delete-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .edit-btn {
            background-color: #1f2937;
            
        }

        .edit-btn:hover {
            background-color: #2563eb;
            transform: scale(1.05);
        }

        .delete-btn {
            background-color: #ef4444;
        }

        .delete-btn:hover {
            background-color: #dc2626;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="title">📅 View Bookings</div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('bookings.create') }}">➕ New Booking</a>
    </div>
</div>

<div class="container">

    <h1>Your Bookings</h1>

    {{-- ✅ Success Message --}}
    @if (session('success'))
        <div class="notification">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <div class="no-bookings">You don't have any bookings yet.</div>
    @else
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Booking Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</td>
                    <td>{{ $booking->description }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="edit-btn" title="Edit Booking">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" title="Delete Booking">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

</div>

</body>
</html>
