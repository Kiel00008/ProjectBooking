<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef1f5;
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
            font-size: 20px;
            font-weight: 600;
        }

        .top-bar .actions a {
            background-color: #4B5563;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .top-bar .actions a:hover {
            background-color: #374151;
            transform: scale(1.05);
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        h2 {
            text-align: center;
            color: #1f2937;
            font-size: 28px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: 600;
            color: #374151;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background-color: #f9fafb;
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 30px;
            width: 100%;
            background-color: #1f2937;
        
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .error {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 12px;
            border-radius: 6px;
            margin-top: 15px;
        }

        #calendar-container {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        #selected-date {
            margin-top: 15px;
            font-weight: 600;
            color: #1f2937;
            text-align: center;
        }

        /* Calendar Styling */
        .flatpickr-calendar {
            font-size: 14px !important;
            width: 100% !important;
            max-width: 500px;
            border-radius: 12px;
            background-color: #000 !important;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .flatpickr-months {
            background-color: #111 !important;
            color: white !important;
            border-bottom: 1px solid #333;
        }

        .flatpickr-current-month {
            color: white !important;
            font-size: 16px !important;
        }

        .flatpickr-weekdays {
            background-color: #111 !important;
        }

        .flatpickr-weekday {
            color: white !important;
            font-weight: 600;
        }

        .flatpickr-day {
            color: white !important;
            border: 1px solid #333;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 2px;
        }

        .flatpickr-day:hover {
            background-color: #4b5563 !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background-color: #ef4444 !important;
            color: white !important;
            border-color: #ef4444 !important;
        }

        .flatpickr-monthDropdown-months,
        .flatpickr-current-month input.cur-year {
            background: black !important;
            color: white !important;
        }

    </style>
</head>
<body>

<div class="top-bar">
    <div class="title">✏️ Edit Booking</div>
    <div class="actions">
        <a href="{{ route('bookings.index') }}">← Back to Bookings</a>
    </div>
</div>

<div class="container">
    <h2>Update Your Booking</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $booking->title) }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4">{{ old('description', $booking->description) }}</textarea>

        <label for="booking_date">Booking Date:</label>
        <input type="text" id="calendar" name="booking_date" value="{{ old('booking_date', $booking->booking_date) }}" required readonly>
        <div id="calendar-container"></div>
        <p id="selected-date">📅 Selected Date: {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</p>

        <button type="submit">✅ Update Booking</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const bookedDates = @json($bookedDates ?? []);
    const currentDate = "{{ $booking->booking_date }}";

    // Normalize date format to YYYY-MM-DD
    function normalize(date) {
        const d = new Date(date);
        const yyyy = d.getFullYear();
        const mm = ('0' + (d.getMonth() + 1)).slice(-2);
        const dd = ('0' + d.getDate()).slice(-2);
        return `${yyyy}-${mm}-${dd}`;
    }

    const normalizedCurrent = normalize(currentDate);
    const disabledDates = bookedDates
        .map(normalize)
        .filter(date => date !== normalizedCurrent);

    flatpickr("#calendar", {
        inline: true,
        appendTo: document.getElementById('calendar-container'),
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: normalizedCurrent,
        disable: disabledDates,
        onChange: function(selectedDates, dateStr) {
            document.getElementById('selected-date').innerText = "📅 Selected Date: " + dateStr;
        }
    });
</script>

</body>
</html>
