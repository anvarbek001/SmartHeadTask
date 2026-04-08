<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin — Arizalar</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f5f4ff;
            min-height: 100vh;
            font-family: sans-serif;
            color: #374151;
        }

        .adm-wrap {
            padding: 32px 28px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .adm-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .adm-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e1b4b;
        }

        .adm-count {
            font-size: 13px;
            font-weight: 500;
            color: #7c3aed;
            background: #ede9fe;
            padding: 4px 14px;
            border-radius: 20px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 16px 18px;
            border: 0.5px solid #e5e7eb;
        }

        .stat-label {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 500;
        }

        .stat-val {
            font-size: 26px;
            font-weight: 700;
            color: #1e1b4b;
        }

        .stat-val.green {
            color: #15803d;
        }

        .stat-val.blue {
            color: #1d4ed8;
        }

        .stat-val.amber {
            color: #92400e;
        }

        .tbl-wrap {
            background: #fff;
            border-radius: 16px;
            border: 0.5px solid #e5e7eb;
            overflow: hidden;
        }

        .tbl-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 0.5px solid #e5e7eb;
        }

        .tbl-toolbar-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e1b4b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead tr {
            background: #f9fafb;
        }

        th {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 11px 18px;
            text-align: left;
            border-bottom: 0.5px solid #e5e7eb;
        }

        td {
            font-size: 13px;
            color: #374151;
            padding: 13px 18px;
            border-bottom: 0.5px solid #f3f4f6;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background: #fafafa;
        }

        .row-num {
            color: #9ca3af;
            font-size: 12px;
            width: 48px;
        }

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .av-purple {
            background: #ede9fe;
            color: #6d28d9;
        }

        .av-blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .av-green {
            background: #dcfce7;
            color: #15803d;
        }

        .av-amber {
            background: #fef3c7;
            color: #92400e;
        }

        .cust-name {
            font-weight: 500;
            color: #1e1b4b;
            font-size: 13px;
        }

        .cust-email {
            font-size: 11px;
            color: #9ca3af;
        }

        .topic-text {
            font-weight: 500;
            color: #1e1b4b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .msg-text {
            color: #9ca3af;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .date-text {
            color: #9ca3af;
            font-size: 12px;
            white-space: nowrap;
        }

        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.02em;
            white-space: nowrap;
        }

        .badge-new {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-done {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-inprocess {
            background: #e0e7ff;
            color: #3730a3;
        }

        .btn-pdf {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #4338ca;
            background: #eef2ff;
            border-radius: 7px;
            border: 0.5px solid #c7d2fe;
            text-decoration: none;
            transition: background 0.15s;
            cursor: pointer;
        }

        .btn-pdf:hover {
            background: #e0e7ff;
            color: #4338ca;
        }

        .no-pdf {
            color: #d1d5db;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .adm-wrap {
                padding: 20px 14px;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .adm-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            th,
            td {
                padding: 10px 12px;
            }
        }

        .status-select {
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 6px;
            appearance: none;
            -webkit-appearance: none;
        }

        .badge-new {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-inprocess {
            background: #fef9c3;
            color: #a16207;
        }

        .badge-done {
            background: #f3f4f6;
            color: #374151;
        }
    </style>
</head>

<body>

    <div class="adm-wrap">

        <div class="adm-header">
            <h1 class="adm-title">Applications</h1>
            <span class="adm-count">Total: {{ $tickets->count() }} </span>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total</div>
                <div class="stat-val">{{ $tickets->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">New</div>
                <div class="stat-val green">{{ $tickets->where('status', 'new')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Processing</div>
                <div class="stat-val blue">{{ $tickets->where('status', 'inprocess')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Done</div>
                <div class="stat-val amber">{{ $tickets->where('status', 'done')->count() }}</div>
            </div>
        </div>

        <div class="tbl-wrap">
            <div class="tbl-toolbar">
                <span class="tbl-toolbar-title">All applications</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Topic</th>
                        <th>Text</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="row-num">{{ str_pad($ticket->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="customer-cell">
                                    <div
                                        class="avatar av-{{ $loop->index % 4 === 0 ? 'purple' : ($loop->index % 4 === 1 ? 'blue' : ($loop->index % 4 === 2 ? 'green' : 'amber')) }}">
                                        {{ strtoupper(substr($ticket->customer->name ?? 'N', 0, 1)) }}{{ strtoupper(substr(strrchr($ticket->customer->name ?? ' A', ' '), 1, 1)) }}
                                    </div>
                                    <div>
                                        <div class="cust-name">{{ $ticket->customer->name ?? '—' }}</div>
                                        <div class="cust-email">{{ $ticket->customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="topic-text">{{ $ticket->topic }}</div>
                            </td>
                            <td>
                                <div class="msg-text">{{ $ticket->text }}</div>
                            </td>
                            <td>
                                <select class="status-select badge badge-{{ $ticket->status }}"
                                    data-id="{{ $ticket->id }}" onchange="updateStatus(this)">
                                    <option value="new" {{ $ticket->status === 'new' ? 'selected' : '' }}>new
                                    </option>
                                    <option value="inprocess" {{ $ticket->status === 'inprocess' ? 'selected' : '' }}>
                                        inprocess</option>
                                    <option value="done" {{ $ticket->status === 'done' ? 'selected' : '' }}>
                                        done</option>
                                </select>
                            </td>
                            <td>
                                <div class="date-text">
                                    {{ $ticket->response_date ?? $ticket->created_at->format('Y-m-d') }}</div>
                            </td>
                            <td>
                                @if ($ticket->getFirstMediaUrl('ticket_pdf'))
                                    <a href="{{ $ticket->getFirstMediaUrl('ticket_pdf') }}" download class="btn-pdf">
                                        <svg width="11" height="11" viewBox="0 0 16 16" fill="none">
                                            <path d="M8 1v9m0 0L5 7m3 3 3-3M2 13h12" stroke="#4338ca" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Download
                                    </a>
                                @else
                                    <span class="no-pdf">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="display:flex; justify-content:center;">
        {{ $tickets->links() }}
    </div>


    <script>
        function updateStatus(sel) {
            const id = sel.dataset.id;
            const status = sel.value;

            sel.className = `status-select badge badge-${status}`;

            fetch(`/tickets/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status
                    })
                }).then(res => {
                    console.log('Status:', res.status);
                    return res.json();
                })
                .then(data => {
                    console.log('Response:', data);
                })
                .catch(err => {
                    console.log('Fetch error:', err);
                });
        }
    </script>

</body>

</html>
