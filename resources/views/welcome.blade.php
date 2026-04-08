<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:400,600,700,800|dm-sans:400,500" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #0b0c10;
            --surface: #13151a;
            --border: #252830;
            --accent: #e8ff47;
            --accent-dim: #b8cc2a;
            --text: #f0f2f5;
            --muted: #6b7280;
            --input-bg: #1a1d24;
            --error: #ff5c5c;
            --radius: 14px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(232, 255, 71, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(232, 255, 71, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(232, 255, 71, 0.08);
            border: 1px solid rgba(232, 255, 71, 0.2);
            color: var(--accent);
            font-family: 'Syne', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 99px;
            margin-bottom: 1.4rem;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: blink 2s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            overflow: hidden;
            position: relative;
        }

        .card::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(232, 255, 71, 0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 0.4rem;
        }

        .card-title span {
            color: var(--accent);
        }

        .card-sub {
            color: var(--muted);
            font-size: 0.88rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field label {
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--muted);
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap:focus-within svg {
            color: var(--accent);
        }

        .input {
            width: 100%;
            background: var(--input-bg);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            padding: 13px 14px 13px 42px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }

        .input::placeholder {
            color: #2e3240;
        }

        .input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(232, 255, 71, 0.08);
        }

        .field-error {
            color: var(--error);
            font-size: 0.78rem;
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 0.2rem 0;
        }

        .btn {
            width: 100%;
            background: var(--accent);
            color: #0b0c10;
            border: none;
            border-radius: var(--radius);
            font-family: 'Syne', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        .btn:hover {
            background: var(--accent-dim);
            box-shadow: 0 8px 28px rgba(232, 255, 71, 0.18);
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .note {
            text-align: center;
            color: var(--muted);
            font-size: 0.78rem;
            margin-top: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="badge">Ticket</div>

        <div class="card">
            <h1 class="card-title">Send a<br><span>Request</span></h1>
            <p class="card-sub">Fill in your details — we’ll get in touch with you.</p>

            <div class="field">
                <label for="name">Name</label>
                <div class="input-wrap">
                    <input id="name" type="text" class="input" name="name" placeholder="Abdullayev Jasur"
                        required autocomplete="name">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <div class="field">
                <label for="phone">Phone</label>
                <div class="input-wrap">
                    <input id="phone" type="tel" class="input" name="phone" placeholder="+998 90 123 45 67"
                        required>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <input id="email" type="email" class="input" name="email" placeholder="jasur@example.com"
                        required autocomplete="email">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div class="divider"></div>

            <button id="submit_btn" class="btn">
                Submit a ticket
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </div>

        <p class="note">Need help? — support@example.com</p>
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
        const submitBtn = document.getElementById('submit_btn');
        const name = document.getElementById('name');
        const phone = document.getElementById('phone');
        const email = document.getElementById('email');
        const result = document.getElementById('result');

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

        submitBtn.addEventListener('click', function() {
            submitBtn.textContent = 'Loading...';
            axios({
                method: 'post',
                url: 'api/customer/store',
                data: JSON.stringify({
                    name: name.value,
                    phone: phone.value,
                    email: email.value,
                }),
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(res => {
                const data = res.data;
                if (data.success) {
                    window.location.href = '/widget/' + data.id;
                    showToast(data.message, 'success')
                } else {
                    showToast(data.message, 'error')
                }
            }).catch(err => {
                showToast(JSON.stringify(err.response.data), 'error');
            }).finally(() => {
                submitBtn.innerHTML = `Submit a ticket
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>`
            })
        })
    </script>
</body>

</html>
