<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Received</title>
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
            color: yellow;
            background-color: black;
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
        <h1>Thanks for contacting us</h1>
        <p>We will get back to you soonest within your specified time.</p>
        <h2>Your contact details are as follow:</h2>
        <div class="">
            @if(!$data->is_pdf)
            <div style="width: min(20rem, 96%); margin: auto">
                <figure><img src="{{ $message->embed(public_path($data->passport_link)) }}" style="max-width: 100%;" alt="guest passport image">
                    <figcaption style="color: #FFFF00; background-color:black; padding:.25rem">Your passport</figcaption>
                </figure>
            </div>
            @endif
            <p>
                Are you representing a government: <span>{{$data->gov_rep?? ""}}</span>
            </p>
            @if($data->gov_rep == 'Yes')
            <p>
                Name of country: <span>{{$data->country?? ""}}</span>
            </p>
            @else
            <p>
                Name of organization: <span>{{$data->organization?? ""}}</span>
            </p>
            @endif
            <p>Your designation: <span>{{$data->designation?? ""}}</span></p>
            <p>
                Contact number: <span>{{$data->contact_no?? ""}}</span>
            </p>
            <p>
                You are expecting us to contact you: <span>{{$data->response_time?? ""}}</span>
            </p>
            <p>Best time to contact you: <span>{{$data->best_time?? ""}}</span></p>
            <p>
                Your remark: <span>{{$data->remark?? ""}}</span>
            </p>
            <p>
                Your email: <span>{{$data->email?? ""}}</span>
            </p>
        </div>
    </main>
    <section>
        <p>Best regards</p>
        <h3>AMR Projects</h3>
    </section>
</body>

</html>