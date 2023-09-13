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
        @if($data->to_guest)
        <h1>Thanks for contacting us</h1>
        <p>Someone from AMR will contact you soon.</p>
        <section>
            <p>Best regards</p>
            <h3>AMR Projects</h3>
        </section>
        @else
        <h1>You Have a New Contact From AMR</h1>
        <h2>The contact details are as follow:</h2>
        <div class="">
            @if(!$data->is_pdf)
            <div style="width: min(20rem, 96%); margin: auto">
                <figure><img src="{{ $message->embed(public_path($data->passport_link)) }}" style="max-width: 100%;" alt="guest passport image">
                    <figcaption style="color: #FFFF00; background-color:black; padding:.25rem">Passport</figcaption>
                </figure>
            </div>
            @endif
            <p>
                Representing a government: <span>{{$data->gov_rep?? ""}}</span>
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
            <p>Designation: <span>{{$data->designation?? ""}}</span></p>
            <p>
                Contact number: <span>{{$data->contact_no?? ""}}</span>
            </p>
            <p>
                Expecting to be contacted: <span>{{$data->response_time?? ""}}</span>
            </p>
            <p>Best time to contact: <span>{{$data->best_time?? ""}}</span></p>
            <p>
                Remark: <span>{{$data->remark?? ""}}</span>
            </p>
            <p>
                Email: <span>{{$data->email?? ""}}</span>
            </p>
        </div>
        @endif

    </main>
</body>

</html>