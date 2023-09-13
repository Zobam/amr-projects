<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Received</title>
    <style>
        body,
        section {
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
            margin: .2rem 0rem;
            padding: .2rem 0rem;
        }
    </style>
</head>

<body>
    <main>
        <h1>Failed Attempts</h1>
        <p>Three failed verification attempts from <strong>{{$ip_address?? ""}}</strong></p>
    </main>
</body>

</html>