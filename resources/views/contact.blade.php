<x-layout style-link='css/contact.css'>
    <section>
        <div class="">
            <h1>Contact Form</h1>
            @if (session()->has('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>An error occurred.</strong> Please, try again later.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="margin: 1rem 0rem; border: 2px solid red; border-radius: 1rem">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p style="color: #1413139E;">
                After sending the completed contact form you will receive a confirmation mail.
            </p>
            <form name="contactForm" class="form" action="/contact" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="passport">Scan the Data page of your International Passport and upload it here:
                        <span>*</span></label>
                    <input type="file" name="passport" id="passport">
                    <!-- loading animation -->
                    <div id="verifying" class="">verifying passport ...</div>
                </div>
                <div class="form-group">
                    <label for="gov-rep">Are you representing a Government:<span>*</span></label>
                    <label><input type="radio" name="gov_rep" value=1 class="gov-rep"
                            {{ old('gov_rep') == 1 ? 'checked' : '' }}> Yes</label>
                    <label style="display: inline-block; margin-left: .5rem"><input type="radio" name="gov_rep"
                            value=0 class="gov-rep" {{ old('gov_rep') == 0 ? 'checked' : '' }}> No</label>
                    <span class="error" id="gov_rep_error">Choose one.</span>
                </div>
                <div class="row">
                    <div id="country-form-group" class="col-12 col-md-6 form-group">
                        <label for="organization">Country <span>*</span></label>
                        <select name="country" id="country" value="{{ old('organization') }}"
                            onchange="checkFormValidity('country', 'country')">
                            <option value="">Select a Country</option>
                        </select>
                        <!-- <input type="text" name="organization" id="organization"> -->
                        <span class="error" id="country_error">Name of country is required.</span>
                    </div>
                    <div id="organization-form-group" class="col-12 col-md-6 form-group">
                        <label for="organization">Name of Organisation <span>*</span></label>
                        <input type="text" name="organization" id="organization" value="{{ old('organization') }}">
                        <span class="error" id="organization_error">Name of organization is required.</span>
                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <label for="designation">Designation <span>*</span></label>
                        <input type="text" name="designation" id="designation" value="{{ old('designation') }}">
                        <span class="error" id="designation_error">Designation is required.</span>
                    </div>
                </div>
                <div class="d-flex">
                    <div class=" form-group" style="margin-right: 1rem; position: relative">
                        <label for="country_code">Country Code <span>*</span></label>
                        <input type="text" name="country_code" id="country_code" value="{{ old('country_code') }}"
                            onchange="checkFormValidity('contact_no', 'code')">
                        <span class="error" id="country_code_error">Country code is required.</span>
                        <div id="code-container"></div>
                    </div>
                    <div class="flex-grow-1 form-group">
                        <label for="contact_no">Contact Number <span>*</span></label>
                        <input type="tel" name="contact_no" id="contact_no" value="{{ old('contact_no') }}"
                            onchange="checkFormValidity('contact_no', 'tel')">
                        <span class="error" id="contact_no_error">Number should be 8-11 digits.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="response_time">Are you expecting us to contact you: <span>*</span></label>
                    <select name="response_time" id="response_time" value="{{ old('response_time') }}">
                        <option value="within 24 hours">Within 24 hours <img src="/images/AMR-PC-yellow-1-min.png"
                                width="40" alt=""> </option>
                        <option value="within 5 days">Within 5 days</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="best_time">Best time to contact you: <span>*</span></label>
                    <select name="best_time" id="best_time" value="{{ old('best_time') }}">
                        <option value="Early Morning&ensp;&emsp;06:00 – 08:00">Early Morning&ensp;&emsp;06:00 – 08:00
                        </option>
                        <option value="Morning&nbsp;&ensp;&emsp;&ensp;&emsp; &ensp;06:00 – 08:00">
                            Morning&nbsp;&ensp;&emsp;&ensp;&emsp; &ensp;06:00 – 08:00</option>
                        <option value="Lunch Time&ensp;&emsp;&ensp;&ensp;12:00 – 15:00">Lunch
                            Time&ensp;&emsp;&ensp;&ensp;12:00 – 15:00</option>
                        <option value="Afternoon&ensp;&nbsp;&emsp;&ensp;&emsp;15:00 – 17:00">
                            Afternoon&ensp;&nbsp;&emsp;&ensp;&emsp;15:00 – 17:00</option>
                        <option value="Evening&nbsp; &ensp;&nbsp;&emsp;&ensp;&ensp;&emsp;17:00 – 20:00">Evening&nbsp;
                            &ensp;&nbsp;&emsp;&ensp;&ensp;&emsp;17:00 – 20:00</option>
                        <option value="Night&emsp;&ensp;&nbsp; &ensp;&emsp;&nbsp;&ensp;&emsp;20:00 – 24:00">
                            Night&emsp;&ensp;&nbsp; &ensp;&emsp;&nbsp;&ensp;&emsp;20:00 – 24:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remark">Remarks</label>
                    <textarea name="remark" id="" cols="30" rows="2">{{ old('remark') }}</textarea>
                    <span><em>*600 characters length</em></span>
                </div>
                <div class="form-group email">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        onchange="checkFormValidity('email', 'email')" placeholder="Enter reply email">
                    <span class="error" id="email_error">Enter valid email address.</span>
                    <input type="hidden" name="passport_link" id="passport_link">
                </div>
                <!-- recaptcha -->
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Lel4Z4UAAAAAOa8LO1Q9mqKRUiMYl_00o5mXJrR"></div>
                    <span class="error" id="recaptcha_error">Please, verify that you are human.</span>
                </div>
                <p class="text-center mt-4" style="color: green">Once submitted, you will have access to watch the
                    Case
                    Study video</p>
                <div class="d-flex justify-content-center">
                    <button id="submit-btn" disabled>Send</button>
                </div>
            </form>
        </div>
    </section>
    {{-- <section id="side-video">
        <button id="close-btn">X Close</button>
        <video id="verified-video" width="320" height="240" controls>
            <source
                src="https://firebasestorage.googleapis.com/v0/b/rutride-fb-d85a7.appspot.com/o/InnoMux-2.mp4?alt=media&token=591c8a94-88ef-46f7-abfc-5e32ed4aa1f4"
                type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>
    </section>
    <section id="custom-video">
        <video width="320" height="240" autoplay muted>
            <source
                src="https://firebasestorage.googleapis.com/v0/b/rutride-fb-d85a7.appspot.com/o/Laravel%20Multi-Step%20Validation%20with%20DB%20Transactions.mp4?alt=media&token=6aed94a1-4a44-4816-9b6b-4bf01f1947a1"
                type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>
    </section> --}}
    <script src="{{ asset('/js/contact1.js') }}"></script>
    <script src="{{ asset('/js/validation.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.querySelector(".form").addEventListener("submit", (event) => {
            const recaptchaErrorElem = document.getElementById('recaptcha_error');
            const response = grecaptcha.getResponse();
            if (response.length === 0) {
                event.preventDefault();
                hideElement(recaptchaErrorElem, false);
            } else {
                document.getElementById('passport_link').value = passportLink;
                hideElement(recaptchaErrorElem);
            }
        })

        const videoElement = document.querySelector("#verified-video");

        const sideVideoContainer = document.querySelector('#side-video');
        // showVideo
        function showVideo() {
            sideVideoContainer.style.display = 'block';
            videoElement.play();
            videoElement.muted = false;
            closeSideBtn.scrollIntoView();
        }
        // test
        // localStorage.setItem('verifiedPassport', true);
    </script>
</x-layout>
