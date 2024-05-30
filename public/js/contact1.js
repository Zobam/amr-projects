const codeContainer = document.getElementById("code-container");
const codeInput = document.getElementById("country_code");
const passportInput = document.getElementById("passport");
const isGovRepRadioInput = document.contactForm.gov_rep;
const countryFormGroup = document.getElementById("country-form-group");
const organizationFormGroup = document.getElementById(
    "organization-form-group"
);
let verifyingPassport = false;
let verifyingElem = document.getElementById("verifying");
let passportLink;
let verificationAttempts = 0;
let isGovRep = false;
// respond to focusing on country code field and typing on it
codeInput.addEventListener("focus", filterCodes);
codeInput.addEventListener("keyup", filterCodes);
// respond to file change
passportInput.addEventListener("change", verifyPassport);
// respond to is gov rep change
let prev = null;
for (var i = 0; i < isGovRepRadioInput.length; i++) {
    isGovRepRadioInput[i].addEventListener("change", function () {
        prev ? console.log(prev.value) : null;
        if (this !== prev) {
            prev = this;
        }
        if (this.value == 1) {
            // console.log("is gov rep");
            isGovRep = true;
            hideElement(organizationFormGroup);
            hideElement(countryFormGroup, false);
            populateCountriesOptions();
        } else {
            // console.log("is not gov rep");
            isGovRep = false;
            hideElement(countryFormGroup);
            hideElement(organizationFormGroup, false);
        }
    });
}
function populateCountriesOptions() {
    for (const country of allCountryCodes) {
        var option = document.createElement("option");
        option.text = country.name;
        option.value = country.name;
        var select = document.getElementById("country");
        select.appendChild(option);
    }
}

let allCountryCodes;
let loading = true;
axios
    .get("https://api.beezlinq.com/api/v1/get/countries")
    .then((response) => {
        // console.log(response.data);
        allCountryCodes = response.data.data;
        loading = false;
    })
    .catch((e) => {
        console.log("an error occurred: ", e);
    });
// hide a provided element
function hideElement(elem, hide = true) {
    if (hide) {
        elem.style.display = "none";
    } else {
        elem.style.display = "block";
    }
}

function filterCodes() {
    const val = codeInput.value;
    let filteredAllCountryCodes = allCountryCodes.filter(
        (country) =>
            country.name.toLowerCase().indexOf(val.toLowerCase()) != -1 ||
            country.phonecode.toString().indexOf(val) != -1
    );
    // console.log(filteredAllCountryCodes);
    appendList(filteredAllCountryCodes);
}

function appendList(countries) {
    if (countries.length) {
        let codeHtml = "<ul>";
        for (let country of countries) {
            codeHtml += `<li onClick="setCode(${country.phonecode})">
                    <img src="${country.flag}" alt="${country.name} flag">
                    (${country.phonecode}) ${country.name}
                    </li>`;
        }
        codeHtml += "</ul>";
        codeContainer.innerHTML = codeHtml;
        codeContainer.style.display = "block";
    }
}

function setCode(countryCode) {
    codeInput.value = `+(${countryCode})`;
    hideElement(codeContainer);
    hideElement(document.getElementById("country_code_error"));
    contactForm.country_code = true;
}

function updateResponseText(text) {
    verifyingElem.innerHTML = text;
}

// verifyPassport
function verifyPassport() {
    let passedVerification = false;

    let guestPassport = passportInput.files[0];

    if (guestPassport) {
        addClass(verifyingElem, "loading");
        // show loading element
        hideElement(verifyingElem, false);

        verifyingPassport = true;
        updateResponseText("verifying passport ...");
        // remove the success and error class in case the user is retrying verification
        addClass(verifyingElem, "success", false);
        addClass(verifyingElem, "error", false);
        // check if file type is allowed
        const allowedImageTypes = ["png", "jpg", "jpeg", "pdf"];
        const imageNameArr = guestPassport.name.split(".");
        if (
            !allowedImageTypes.includes(imageNameArr[imageNameArr.length - 1])
        ) {
            addClass(verifyingElem, "error");
            updateResponseText(
                "Please choose an image or document of type jpg, jpeg, png or pdf."
            );
            return;
        }
        console.log(guestPassport);
        let data = new FormData();
        data.append("passport", guestPassport, guestPassport.name);
        data.append("verification_attempts", verificationAttempts);
        axios
            .post(location.origin + "/api/verify_passport", data)
            .then((response) => {
                // console.log('back from mindee api');
                // console.log(response.data);
                if (response.data.status == "success") {
                    passedVerification = true;
                    passportLink = response.data.passport_link;
                    updateResponseText("Passport verified.");
                    addClass(verifyingElem, "success");
                    // save passport verified status to state
                    localStorage.setItem("verifiedPassport", true);
                    // disableForm(false);
                    contactForm.passport = true;
                    // disable passport input element
                    passportInput.setAttribute("disabled", true);

                    checkFormValidity("email", "email");
                } else {
                    if (
                        response.data?.error_code == "002" ||
                        response.data?.error_code == "001"
                    ) {
                        //ip blacklisted
                        // location = '/_';
                        if (response.data?.error_code == "002") {
                            verificationAttempts = 0;
                        } else {
                            verificationAttempts++;
                        }
                        updateResponseText(
                            `The uploaded document is not a passport.`
                        );
                        disableForm();
                        addClass(verifyingElem, "error");
                    } else {
                        updateResponseText(
                            "An error occurred. Please try again."
                        );
                        addClass(verifyingElem, "error");
                        passportInput.value = null;
                    }
                }
            })
            .catch((err) => {
                // console.log("error from mindee api: ", err);
                updateResponseText("An error occurred. Please try again.");
                addClass(verifyingElem, "error");
            })
            .finally(() => {
                verifyingPassport = false;
                // hideElement(verifyingElem);
                addClass(verifyingElem, "loading", false);
            });
    }
}
// handle form disabling
function disableForm(disable = true) {
    const btn = document.getElementById("submit-btn");
    if (disable) {
        btn.setAttribute("disabled", true);
    } else {
        btn.removeAttribute("disabled");
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
