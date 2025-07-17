<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
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
      max-width: 900px;
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

    #calendar {
      margin-top: 20px;
      max-width: 100%;
      background: white;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 10px;
    }

    .fc .booked-date {
      background-color: red !important;
      color: white !important;
      pointer-events: none;
      opacity: 0.8;
      border-radius: 5px;
    }

    .fc .fc-button {
      background-color: #1f2937;
      border: none;
      color: white;
    }

    .fc .fc-button:hover {
      background-color: #374151;
    }

    .fc .fc-daygrid-day-number,
    .fc .fc-col-header-cell-cushion {
      color: #1f2937;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div class="title">📅 Create Booking</div>
  <div class="actions">
    <a href="{{ route('dashboard') }}">🔙 Back to Dashboard</a>
  </div>
</div>

<div class="container">
  <h2>➕ Create New Booking</h2>

  @if ($errors->any())
    <div class="error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" required>

    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>

    <input type="hidden" id="booking_date" name="booking_date" required>

    <div id="calendar"></div>

    <button type="submit">✅ Book Now</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bookedDates = @json($bookedDates ?? []);
    const calendarEl = document.getElementById('calendar');
    const today = new Date().toISOString().split('T')[0];

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      selectable: true,
      validRange: {
        start: today
      },
      selectAllow: function (info) {
        const date = info.startStr;
        return !bookedDates.includes(date);
      },
      dateClick: function (info) {
        if (bookedDates.includes(info.dateStr)) {
          alert("❌ The date has been already booked.");
        } else {
          document.getElementById('booking_date').value = info.dateStr;
          // alert("✅ You selected: " + info.dateStr);
        }
      },
      dayCellDidMount: function (arg) {
        const year = arg.date.getFullYear();
        const month = String(arg.date.getMonth() + 1).padStart(2, '0');
        const day = String(arg.date.getDate()).padStart(2, '0');
        const dateStr = `${year}-${month}-${day}`;

        if (bookedDates.includes(dateStr)) {
          arg.el.classList.add('booked-date');
        }
      }
    });

    calendar.render();
  });
</script>

</body>
</html>
