<x-layout style-link='css/contact.css'>
    <section>
        <div class="">
            <h1 class="text-center">Email Verification</h1>
            @if (session()->has('status') && session('status') === 'error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>The verification link is invalid.</strong> Please, check and try again later.
                </div>
            @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Verification successful!</strong> Your email has been verified. You can now continue with the Contact form submission.
                </div>
            @endif
        </div>
    </section>
</x-layout>