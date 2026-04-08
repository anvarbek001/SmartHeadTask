<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #111;
            padding: 40px;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .label {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .value {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 6px;
            font-size: 12px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Ticket #{{ $ticket->id }}</h2>
        <p class="label">{{ $ticket->created_at->format('d.m.Y H:i') }}</p>
    </div>

    <p class="label">Customer</p>
    <p class="value">{{ $ticket->customer->name }}</p>

    <p class="label">Topic</p>
    <p class="value">{{ $ticket->topic }}</p>

    <p class="label">Text</p>
    <p class="value">{{ $ticket->text }}</p>

    <p class="label">Status</p>
    <p class="value"><span class="badge">{{ $ticket->status }}</span></p>

    <div class="footer">
        Ticket created • {{ now()->format('d.m.Y') }}
    </div>

</body>

</html>
