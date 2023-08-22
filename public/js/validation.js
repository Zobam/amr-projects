

const contactForm = {
    // passport: false,
    gov_rep: false,
    organization: false,
    designation: false,
    country_code: false,
    contact_no: false,
    email: false,
};
// disallow letters in contact no field
const telElem = document.getElementById('contact_no');
let initialTel = telElem.value;
telElem.addEventListener('keyup', () => {
    let newValue = telElem.value;
    if (newValue) {
        const lastCharacter = newValue[newValue.length - 1];
        if (isNaN(parseInt(lastCharacter)) || newValue.length > 11) {
            telElem.value = initialTel;
        } else {
            initialTel = telElem.value;
        }
    }
});
// validation some form fields

function checkFormValidity(elemID, type) {
    const formElem = document.getElementById(elemID);
    const errorElem = document.getElementById(elemID + '_error');
    const inputValue = formElem.value;
    if (type == 'email') {
        const re = /\S+@\S+\.\S+/;
        if (!re.test(inputValue)) {
            if (inputValue.length)
                hideElement(errorElem, false);
            contactForm.email = false;
        } else {
            hideElement(errorElem);
            contactForm.email = true;
        }
    } else if (type == 'tel') {
        if (inputValue.length < 8) {
            if (inputValue.length)
                hideElement(errorElem, false);
            contactForm.contact_no = false;
        } else {
            hideElement(errorElem);
            contactForm.contact_no = true;
        }
        checkFormValidity('country_code', 'code');

    } else if (type == 'code') {
        if (!inputValue) {
            if (inputValue.length)
                hideElement(errorElem, false);
            contactForm.country_code = false;
        } else {
            hideElement(errorElem);
            contactForm.country_code = true;
        }
    }
    // check for gov rep
    if (document.querySelector('input[name="gov_rep"]:checked')) {
        contactForm.gov_rep = true;
    }
    if (document.getElementById('organization').value) {
        contactForm.organization = true;
    }
    if (document.getElementById('designation').value) {
        contactForm.designation = true;
    }
    // enable form if required fields are provided and valid
    let formHasError = false;
    for (const field in contactForm) {
        if (!contactForm[field]) {
            console.log(field, contactForm[field]);
            formHasError = true;
            break;
        }
    }
    if (!formHasError) {
        disableForm(false);
    } else {
        disableForm();
    }
}
// check validity on load for page returning from server after validation fail
checkFormValidity('contact_no', 'tel');
checkFormValidity('email', 'email');
checkFormValidity('country_code', 'code');

