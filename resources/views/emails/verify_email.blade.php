<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email : AMR Projects</title>
    <style>
        body,
        section,
        div {
            box-sizing: border-box;
        }

        body {
            background-color: #ededed;
            font-size: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
        }

        main {
            width: min(54rem, 96%);
            margin: auto;
            background-color: #fff;
            border-radius: 1rem;
            padding: .75rem;
        }

        p {
            font-size: 1.2rem;
        }

        div {
            padding: 0rem .75rem;
        }

        div span {
            font-weight: bold;
        }

        section {
            padding: .75rem;
            width: 100%;
        }

        div p {
            margin: .2rem 0rem;
            padding: .2rem 0rem;
        }
    </style>
</head>

<body>
    <main>
            <h1>Verify Your Email</h1>
            <p>Click this link to verify your email, complete contact form submission and watch our Case Study video. <a
                    href="{{ url('/') }}/email/verify/{{ $data->token }}">Verify Email</a></p>
            <section>
                <p>Best regards</p>
                <h3>AMR Projects</h3>
            </section>

    </main>
</body>

</html>