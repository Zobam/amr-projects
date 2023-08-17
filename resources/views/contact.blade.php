<x-layout style-link='css/contact.css'>
    <section>
        <div class="">
            <h1>Contact Form</h1>
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
            <form action="/contact" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="passport">Scan the Data page of your International Passport and upload it here: <span>*</span></label>
                    <input type="file" name="passport" id="passport">
                    <!-- loading animation -->
                    <div id="verifying" class="">verifying passport ...</div>
                </div>
                <div class="form-group">
                    <label for="gov-rep">Are you representing a Government:<span>*</span></label>
                    <input type="radio" name="gov_rep" value=1 class="gov-rep"> Yes
                    <input type="radio" name="gov_rep" value=0 class="gov-rep"> No
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 form-group">
                        <label for="organization">Name of Organisation <span>*</span></label>
                        <input type="text" name="organization" id="organization">
                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <label for="designation">Designation <span>*</span></label>
                        <input type="text" name="designation" id="designation">
                    </div>
                </div>
                <div class="d-flex">
                    <div class=" form-group" style="margin-right: 1rem; position: relative">
                        <label for="country_code">Country Code <span>*</span></label>
                        <input type="text" name="country_code" id="country_code">
                        <div id="code-container">234</div>
                    </div>
                    <div class="flex-grow-1 form-group">
                        <label for="contact_no">Contact Number <span>*</span></label>
                        <input type="tel" name="contact_no" id="contact_no">
                    </div>
                </div>
                <div class="form-group">
                    <label for="response_time">Are you expecting us to contact you: <span>*</span></label>
                    <select name="response_time" id="response_time">
                        <option value="within 24 hours">Within 24 hours <img src="/images/AMR-PC-yellow-1-min.png" width="40" alt=""> </option>
                        <option value="within 5 days">Within 5 days</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="best_time">Best time to contact you: <span>*</span></label>
                    <select name="best_time" id="best_time">
                        <option value="Early Morning&ensp;&emsp;06:00 – 08:00">Early Morning&ensp;&emsp;06:00 – 08:00</option>
                        <option value="Morning&nbsp;&ensp;&emsp;&ensp;&emsp; &ensp;06:00 – 08:00">Morning&nbsp;&ensp;&emsp;&ensp;&emsp; &ensp;06:00 – 08:00</option>
                        <option value="Lunch Time&ensp;&emsp;&ensp;&ensp;12:00 – 15:00">Lunch Time&ensp;&emsp;&ensp;&ensp;12:00 – 15:00</option>
                        <option value="Afternoon&ensp;&nbsp;&emsp;&ensp;&emsp;15:00 – 17:00">Afternoon&ensp;&nbsp;&emsp;&ensp;&emsp;15:00 – 17:00</option>
                        <option value="Evening&nbsp; &ensp;&nbsp;&emsp;&ensp;&ensp;&emsp;17:00 – 20:00">Evening&nbsp; &ensp;&nbsp;&emsp;&ensp;&ensp;&emsp;17:00 – 20:00</option>
                        <option value="Night&emsp;&ensp;&nbsp; &ensp;&emsp;&nbsp;&ensp;&emsp;20:00 – 24:00">Night&emsp;&ensp;&nbsp; &ensp;&emsp;&nbsp;&ensp;&emsp;20:00 – 24:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remark">Remarks</label>
                    <textarea name="remark" id="" cols="30" rows="2"></textarea>
                    <span><em>*600 characters length</em></span>
                </div>
                <div class="form-group email">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="" placeholder="Enter reply email">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button id="submit-btn" disabled>Send</button>
                </div>
            </form>
        </div>
    </section>
    <script src="{{asset('/js/contact.js')}}"></script>
</x-layout>