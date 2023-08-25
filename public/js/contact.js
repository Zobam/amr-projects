const codeContainer = document.getElementById('code-container');
const codeInput = document.getElementById('country_code');
const passportInput = document.getElementById('passport');
let verifyingPassport = false;
let verifyingElem = document.getElementById('verifying');
let passportLink;
let verificationAttempts = 0;
// update verification attempts from local storage if it exist
if (localStorage.getItem("verificationAttempts") !== null) {
    verificationAttempts = Number(localStorage.getItem("verificationAttempts"));
}
// respond to focusing on country code field and typing on it
codeInput.addEventListener('focus', filterCodes);
codeInput.addEventListener('keyup', filterCodes);
// respond to file change
passportInput.addEventListener('change', verifyPassport);

let allCountryCodes;
let loading = true;
axios.get('https://api.beezlinq.com/api/v1/get/countries').then(response => {
    // console.log(response.data);
    allCountryCodes = response.data.data;
    loading = false;
}).catch(e => {
    console.log('an error occurred: ', e);
});
// hide a provided element
function hideElement(elem, hide = true) {
    if (hide) {
        elem.style.display = 'none';
    } else {
        elem.style.display = 'block';
    }
}

function filterCodes() {
    const val = codeInput.value;
    let filteredAllCountryCodes = allCountryCodes.filter(country => country.name.toLowerCase().indexOf(val.toLowerCase()) != -1 || country.phonecode.toString().indexOf(val) != -1);
    // console.log(filteredAllCountryCodes);
    appendList(filteredAllCountryCodes);
}

function appendList(countries) {
    if (countries.length) {
        let codeHtml = '<ul>';
        for (let country of countries) {
            codeHtml += `<li onClick="setCode(${country.phonecode})">
                    <img src="${country.flag}" alt="${country.name} flag">
                    (${country.phonecode}) ${country.name}
                    </li>`;
        }
        codeHtml += '</ul>';
        codeContainer.innerHTML = codeHtml;
        codeContainer.style.display = 'block';
    }
}

function setCode(countryCode) {
    codeInput.value = `+(${countryCode})`;
    hideElement(codeContainer);
    hideElement(document.getElementById('country_code_error'));
    contactForm.country_code = true;
}

function updateResponseText(text) {
    verifyingElem.innerHTML = text;
}

// redirect if attempts reached limit
if (verificationAttempts > 2) {
    location = '/_';
}

// verifyPassport
function verifyPassport() {

    let passedVerification = false;

    let guestPassport = passportInput.files[0];

    const verificationParams = ['birth_date', 'birth_place', 'country', 'expiry_date', 'gender', 'given_names', 'id_number', 'issuance_date', 'mrz1', 'surname'];

    if (guestPassport) {
        addClass(verifyingElem, 'loading');
        // show loading element
        hideElement(verifyingElem, false);

        verifyingPassport = true;
        updateResponseText('verifying passport ...');
        // remove the success and error class in case the user is retrying verification
        addClass(verifyingElem, 'success', false);
        addClass(verifyingElem, 'error', false);
        // check if file type is allowed
        const allowedImageTypes = ['png', 'jpg', 'jpeg', 'pdf'];
        const imageNameArr = guestPassport.name.split('.');
        if (!allowedImageTypes.includes(imageNameArr[imageNameArr.length - 1])) {
            addClass(verifyingElem, 'error');
            updateResponseText("Please choose an image or document of type jpg, jpeg, png or pdf.");
            return;
        }
        console.log(guestPassport);
        let data = new FormData();
        data.append("passport", guestPassport, guestPassport.name);
        data.append('verification_attempts', verificationAttempts);
        axios.post('http://127.0.0.1:8000/api/verify_passport', data).then(response => {
            // console.log('back from mindee api');
            console.log(response.data);
            if (response.data.status == 'success') {
                passedVerification = true;
                passportLink = response.data.passport_link;
                updateResponseText("Passport verified.");
                addClass(verifyingElem, 'success');
                // disableForm(false);
                contactForm.passport = true;
                checkFormValidity('email', 'email');
            } else {
                if (response.data?.error_code == '002') {
                    location = '/_';
                } else {
                    if (response.data?.error_code == '001') {
                        let remainingAttempts = 3 - verificationAttempts - 1;
                        if (remainingAttempts < 0) remainingAttempts = 0;
                        updateResponseText(`The uploaded document is not a passport.<p>You have ${remainingAttempts} attempts left. After <strong>three(3)</strong> failed attempts, you will be blocked from this site.</p>`);
                        disableForm();
                        addClass(verifyingElem, 'error');
                        // increment verification attempts and save in local storage
                        verificationAttempts++;
                        localStorage.setItem("verificationAttempts", verificationAttempts);
                    } else {
                        updateResponseText("An error occurred. Please try again.");
                        addClass(verifyingElem, 'error');
                    }
                    passportInput.value = null;
                }
            }
        }).catch(err => {
            console.log('error from mindee api: ', err);
            updateResponseText("An error occurred. Please try again.");
            addClass(verifyingElem, 'error');
        }).finally(() => {
            verifyingPassport = false;
            // hideElement(verifyingElem);
            addClass(verifyingElem, 'loading', false);
        });
    }

    function checkValidityScore(prediction) {
        console.log('the prediction I got', prediction);
        let confidenceScore = 0;
        for (const param of verificationParams) {
            if (param == 'given_names') {
                if (prediction[param]?.length)
                    confidenceScore += 10 * prediction[param][0]?.confidence;
            } else {
                confidenceScore += 10 * prediction[param]?.confidence;
            }
        }
        return confidenceScore;
    }
}
// handle form disabling
function disableForm(disable = true) {
    const btn = document.getElementById('submit-btn');
    if (disable) {
        btn.setAttribute('disabled', true);
    } else {
        btn.removeAttribute('disabled');
    }
}
// handle adding class to element
function addClass(element, className, add = true) {
    if (add) {
        element.classList.add(className);
    } else {
        element.classList.remove(className);
    }
}