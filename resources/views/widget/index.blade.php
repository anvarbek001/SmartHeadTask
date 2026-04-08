<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form UI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            padding: 40px 24px;
            min-height: 100vh;
            font-family: sans-serif;
        }

        .card-custom {
            width: 100%;
            padding: 36px 40px 28px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.97);
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.18);
            border: 0.5px solid rgba(255, 255, 255, 0.6);
            margin-bottom: 28px;
        }

        .card-custom h3 {
            text-align: left;
            font-size: 20px;
            font-weight: 600;
            color: #1e1b4b;
            margin-bottom: 4px;
        }

        .card-item {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 16px;
            align-items: flex-end;
        }

        .box-input {
            width: 100%;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #4b5563;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .form-control {
            height: 44px;
            padding: 0 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px !important;
            font-size: 14px;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
            outline: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .btn-custom {
            height: 44px;
            padding: 0 28px;
            border-radius: 10px;
            width: auto;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            transition: opacity 0.2s, transform 0.1s;
            cursor: pointer;
        }

        .btn-custom:hover {
            opacity: 0.9;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .btn-custom:active {
            transform: scale(0.97);
        }

        .ticket-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .ticket-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 18px 22px;
            border: 0.5px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.10);
        }

        .ticket-card h5 {
            font-size: 15px;
            font-weight: 600;
            color: #1e1b4b;
            margin-bottom: 4px;
        }

        .ticket-card p {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .ticket-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ticket-date {
            font-size: 12px;
            color: #9ca3af;
            margin-left: auto;
        }

        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }

        .badge-done {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-processing {
            background: #e0e7ff;
            color: #3730a3;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #4338ca;
            background: #eef2ff;
            border-radius: 8px;
            text-decoration: none;
            border: 0.5px solid #c7d2fe;
            margin-left: 0;
            transition: background 0.15s;
        }

        .btn-download:hover {
            background: #e0e7ff;
            color: #4338ca;
        }

        @media (max-width: 640px) {
            .card-item {
                grid-template-columns: 1fr;
            }

            .card-custom {
                padding: 24px 20px;
            }

            .btn-custom {
                width: 100%;
                height: 44px;
            }
        }
    </style>
</head>

<body>

    <div class="card-custom">
        <h3>Send application</h3>
        <div class="card-item">
            <div class="mb-3 box-input">
                <label class="form-label">Subject</label>
                <input type="text" id="topic" name="topic" class="form-control" placeholder="Enter subject..."
                    required>
            </div>

            <div class="mb-3 box-input">
                <label class="form-label">Text</label>
                <input type="text" id="text" name="text" class="form-control" placeholder="Enter text..."
                    required>
            </div>

            <button class="btn-custom">Submit</button>
        </div>
    </div>


    <div class="ticket-list">
        <h2>Tickets</h2>
        @foreach ($tickets as $ticket)
            <div class="ticket-card">
                <h5>{{ $ticket->topic }}</h5>
                <p>{{ $ticket->text }}</p>
                <div class="ticket-meta">
                    <div><span class="badge bg-primary">{{ $ticket->status }}</span></div>
                    <span class="ticket-date">{{ $ticket->response_date }}</span>
                    <span>{{ $ticket->created_at }}</span>
                    @if ($ticket->getFirstMediaUrl('ticket_pdf'))
                        <a href="{{ $ticket->getFirstMediaUrl('ticket_pdf') }}" download class="btn-download">
                            PDF download
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div id="myToast" class="toast position-fixed top-0 end-0 m-3" role="alert">
        <div class="toast-header">
            <strong class="me-auto">Message</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body" id="toastBody">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const topic = document.getElementById('topic');
        const text = document.getElementById('text');
        const btn = document.querySelector('.btn-custom');
        const custom_id = "{{ $custom_id }}";
        console.log(custom_id)

        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('myToast');
            const toastBody = document.getElementById('toastBody');

            toastBody.textContent = message;

            toastEl.classList.remove('bg-success', 'bg-danger');
            if (type === 'success') {
                toastEl.classList.add('bg-success', 'text-white');
            } else {
                toastEl.classList.add('bg-danger', 'text-white');
            }
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        btn.addEventListener('click', function() {
            if (topic.value == '' || text.value == '') {
                showToast("The information is incomplete.", 'error');
                return;
            }
            axios({
                method: 'post',
                url: '/api/tickets',
                data: JSON.stringify({
                    custom_id: custom_id,
                    topic: topic.value,
                    text: text.value
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => {
                const data = res.data;
                showToast(data.message, 'success');
            }).catch(err => {
                showToast(JSON.stringify(err.response.data.message), 'error');
            }).finally(() => {
                topic.value = '';
                text.value = '';
            })
        })
    </script>
</body>

</html>
