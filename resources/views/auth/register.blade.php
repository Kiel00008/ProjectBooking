<x-guest-layout>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .register-header {
            background-color: #1f2937;
            color: white;
            padding: 30px 40px;
            text-align: center;
            font-size: 26px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .register-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        label {
            display: block;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 5px;
            color: #374151;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 15px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 4px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .actions a {
            font-size: 14px;
            color: #6b7280;
            text-decoration: none;
        }

        .actions a:hover {
            color: #1f2937;
            text-decoration: underline;
        }

        .primary-button {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            background-color: #2563EB;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
        }

        .primary-button:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }
    </style>

    <div class="register-header">
        📝 Create Your Business Account
    </div>

    <div class="register-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Email -->
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <a href="{{ route('login') }}">Already registered?</a>
                <button type="submit" class="primary-button">Register</button>
            </div>
        </form>
    </div>
</x-guest-layout>
