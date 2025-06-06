<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\FailedAttempts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;

// define enums for various error situation. This will help to count verification attempts if and only if the error is due to uploading non passport image ie error code 001
enum ErrorCodes: string
{
    case FailedVerification = '001';
    case IPBlackListed = '002';
    case ServerError = '003';
}

class VerifyPassportController extends Controller
{
    public $uploaded_image_extension;
    // verify passport
    public function verify_passport(Request $request)
    {
        return $request->all();
        /* $result = [
            "api_request" => [
                "error" => [],
                "resources" => ["document"],
                "status" => "success",
                "status_code" => 201,
                "url" =>
                "https://api.mindee.net/v1/products/mindee/passport/v1/predict",
            ],
            "document" => [
                "id" => "2fa7365d-b384-4e80-a5bf-a1c3895743ab",
                "inference" => [
                    "extras" => [],
                    "finished_at" => "2023-08-21T15:15:43.142177",
                    "is_rotation_applied" => true,
                    "pages" => [
                        [
                            "extras" => [],
                            "id" => 0,
                            "orientation" => ["value" => 0],
                            "prediction" => [
                                "birth_date" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.307, 0.712],
                                        [0.493, 0.712],
                                        [0.493, 0.733],
                                        [0.307, 0.733],
                                    ],
                                    "value" => "1996-07-01",
                                ],
                                "birth_place" => [
                                    "confidence" => 0.93,
                                    "polygon" => [
                                        [0.394, 0.752],
                                        [0.481, 0.752],
                                        [0.481, 0.772],
                                        [0.394, 0.772],
                                    ],
                                    "value" => "MINNA",
                                ],
                                "country" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.497, 0.567],
                                        [0.557, 0.567],
                                        [0.557, 0.588],
                                        [0.497, 0.588],
                                    ],
                                    "value" => "NGA",
                                ],
                                "expiry_date" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.308, 0.829],
                                        [0.512, 0.829],
                                        [0.512, 0.849],
                                        [0.308, 0.849],
                                    ],
                                    "value" => "2023-10-25",
                                ],
                                "gender" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.039, 0.923],
                                        [0.928, 0.923],
                                        [0.928, 0.948],
                                        [0.039, 0.948],
                                    ],
                                    "value" => "F",
                                ],
                                "given_names" => [
                                    [
                                        "confidence" => 0.99,
                                        "polygon" => [
                                            [0.039, 0.888],
                                            [0.929, 0.888],
                                            [0.929, 0.914],
                                            [0.039, 0.914],
                                        ],
                                        "value" => "FRANCIS",
                                    ],
                                    [
                                        "confidence" => 0.99,
                                        "polygon" => [
                                            [0.039, 0.888],
                                            [0.929, 0.888],
                                            [0.929, 0.914],
                                            [0.039, 0.914],
                                        ],
                                        "value" => "LILIAN",
                                    ],
                                ],
                                "id_number" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.711, 0.565],
                                        [0.847, 0.565],
                                        [0.847, 0.587],
                                        [0.711, 0.587],
                                    ],
                                    "value" => "A09845543",
                                ],
                                "issuance_date" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.308, 0.793],
                                        [0.512, 0.793],
                                        [0.512, 0.813],
                                        [0.308, 0.813],
                                    ],
                                    "value" => "2018-10-26",
                                ],
                                "mrz1" => [
                                    "confidence" => 0.99,
                                    "polygon" => [
                                        [0.039, 0.888],
                                        [0.929, 0.888],
                                        [0.929, 0.914],
                                        [0.039, 0.914],
                                    ],
                                    "value" =>
                                    "P<NGAABURIEKI<<FRANCIS<LILIAN<<<<<<<<<<<<<<<",
                                ],
                                "mrz2" => [
                                    "confidence" => 1,
                                    "polygon" => [
                                        [0.039, 0.923],
                                        [0.928, 0.923],
                                        [0.928, 0.948],
                                        [0.039, 0.948],
                                    ],
                                    "value" =>
                                    "A098455432NGA9607011F2310255<<<<<<<<<<<<<<00",
                                ],
                                "orientation" => ["confidence" => 0.99, "degrees" => 0],
                                "surname" => [
                                    "confidence" => 0.99,
                                    "polygon" => [
                                        [0.307, 0.6],
                                        [0.429, 0.6],
                                        [0.429, 0.621],
                                        [0.307, 0.621],
                                    ],
                                    "value" => "ABURIEKI",
                                ],
                            ],
                        ],
                    ],
                    "prediction" => [
                        "birth_date" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.307, 0.712],
                                [0.493, 0.712],
                                [0.493, 0.733],
                                [0.307, 0.733],
                            ],
                            "value" => "1996-07-01",
                        ],
                        "birth_place" => [
                            "confidence" => 0.93,
                            "page_id" => 0,
                            "polygon" => [
                                [0.394, 0.752],
                                [0.481, 0.752],
                                [0.481, 0.772],
                                [0.394, 0.772],
                            ],
                            "value" => "MINNA",
                        ],
                        "country" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.497, 0.567],
                                [0.557, 0.567],
                                [0.557, 0.588],
                                [0.497, 0.588],
                            ],
                            "value" => "NGA",
                        ],
                        "expiry_date" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.308, 0.829],
                                [0.512, 0.829],
                                [
                                    0.512, 0.849
                                ],
                                [0.308, 0.849],
                            ],
                            "value" => "2023-10-25",
                        ],
                        "gender" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.039, 0.923],
                                [0.928, 0.923],
                                [0.928, 0.948],
                                [0.039, 0.948],
                            ],
                            "value" => "F",
                        ],
                        "given_names" => [
                            [
                                "confidence" => 0.99,
                                "page_id" => 0,
                                "polygon" => [
                                    [0.039, 0.888],
                                    [0.929, 0.888],
                                    [0.929, 0.914],
                                    [0.039, 0.914],
                                ],
                                "value" => "FRANCIS",
                            ],
                            [
                                "confidence" => 0.99,
                                "page_id" => 0,
                                "polygon" => [
                                    [0.039, 0.888],
                                    [0.929, 0.888],
                                    [0.929, 0.914],
                                    [0.039, 0.914],
                                ],
                                "value" => "LILIAN",
                            ],
                        ],
                        "id_number" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.711, 0.565],
                                [0.847, 0.565],
                                [
                                    0.847, 0.587
                                ],
                                [0.711, 0.587],
                            ],
                            "value" => "A09845543",
                        ],
                        "issuance_date" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.308, 0.793],
                                [0.512, 0.793],
                                [0.512, 0.813],
                                [0.308, 0.813],
                            ],
                            "value" => "2018-10-26",
                        ],
                        "mrz1" => [
                            "confidence" => 0.99,
                            "page_id" => 0,
                            "polygon" => [
                                [0.039, 0.888],
                                [0.929, 0.888],
                                [0.929, 0.914],
                                [0.039, 0.914],
                            ],
                            "value" => "P<NGAABURIEKI<<FRANCIS<LILIAN<<<<<<<<<<<<<<<",
                        ],
                        "mrz2" => [
                            "confidence" => 1,
                            "page_id" => 0,
                            "polygon" => [
                                [0.039, 0.923],
                                [0.928, 0.923],
                                [0.928, 0.948],
                                [0.039, 0.948],
                            ],
                            "value" => "A098455432NGA9607011F2310255<<<<<<<<<<<<<<00",
                        ],
                        "surname" => [
                            "confidence" => 0.99,
                            "page_id" => 0,
                            "polygon" => [
                                [0.307, 0.6],
                                [0.429, 0.6],
                                [0.429, 0.621],
                                [0.307, 0.621],
                            ],
                            "value" => "ABURIEKI",
                        ],
                    ],
                    "processing_time" => 1.122,
                    "product" => [
                        "features" => [
                            "country",
                            "id_number",
                            "given_names",
                            "surname",
                            "birth_date",
                            "birth_place",
                            "gender",
                            "issuance_date",
                            "expiry_date",
                            "orientation",
                            "mrz1",
                            "mrz2",
                        ],
                        "name" => "mindee/passport",
                        "type" => "standard",
                        "version" => "1.0",
                    ],
                    "started_at" => "2023-08-21T15:15:42.020001",
                ],
                "n_pages" => 1,
                "name" => "passport_image09034343434.jpg",
            ],
        ]; */
        $attempt_limit = 3;

        // ensure verification attempts has not exceeded limit

        $validated = $request->validate([
            'passport' => ['required', File::types(['jpg', 'jpeg', 'png', 'pdf'])->min(10)],
            'verification_attempts' => ['required', 'max:4'],
        ]);
        // // MAKE SURE THE NEXT LINE IS COMMENTED OUT FOR LIVE // //
        // return $validated;
        try {
            // save the uploaded passport
            $image_file = $request->passport;
            $this->uploaded_image_extension = $image_file->getClientOriginalExtension();
            $image_name = 'passport_image' . $request->ip() . '.' . $this->uploaded_image_extension;
            $save_dir = 'images/email/';
            // move passport image
            $image_file->move($save_dir, $image_name);
            // add the passport link to the request collection
            $passport_link =  $save_dir . $image_name;
            // submit passport to mindee api
            $result = $this->submitPassportToApi($passport_link);
            $response = [];
            if (is_array($result)) {
                // $prediction = $result['document']['inference']['prediction'];
                if (!array_key_exists('document', $result) || !$this->checkPassportValidity($result['document']['inference']['prediction'])) {
                    $response['status'] = 'error';
                    $response['error_code'] = ErrorCodes::FailedVerification->value;
                    $response['message'] = 'Passport failed verification check.';
                    // notify AMR if this is the 3rd failed attempt
                    if ($request->verification_attempts >= 2) {
                        $this->notifyAMR($request->ip());
                        $response['error_code'] = ErrorCodes::IPBlackListed->value;
                    }
                    // delete passport if it failed validity check
                    $this->delete_passport($passport_link);
                }
                if ($this->checkPassportValidity($result['document']['inference']['prediction'])) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Passport passed verification check.',
                        'passport_link' => $passport_link,
                    ];
                }
            } else {
                $response['status'] = 'error';
                $response['error_code'] = ErrorCodes::ServerError->value;
                $response['message'] = 'Error from passport validation server.';
            }
        } catch (Exception $e) {
            // Log::info('an error occurred saving uploaded image');
            Log::info($e);
        }
        return $response;
    }
    public function notifyAMR($ip_address)
    {
        try {
            // send failed attempts email to amr
            Mail::to("wr@amrprojects.com")->send(new FailedAttempts($ip_address));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    // submit guest passport to mindee api for processing
    public function submitPassportToApi($passport_link)
    {
        try {
            // set cURL options
            $FILE_PATH = $passport_link;
            $mime = $this->uploaded_image_extension == 'pdf' ? 'application/' : 'image/';
            $MIME_TYPE =  $mime . $this->uploaded_image_extension; // change according to the file type

            // Open a cURL session to send the document
            $ch = curl_init();
            // Setup headers
            $headers = array(
                "Authorization: Token " . config('mindee.mindee_api_key')
            );
            // Add our file to the request
            $data = array(
                "document" => new \CURLFile(
                    $FILE_PATH,
                    $MIME_TYPE,
                    substr($FILE_PATH, strrpos($FILE_PATH, "/") + 1)
                )
            );

            $options = array(
                CURLOPT_URL => config('mindee.mindee_api_url'),
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_RETURNTRANSFER => true
            );
            // Set all options for the cURL request
            curl_setopt_array(
                $ch,
                $options
            );
            // Execute the request & extract the query content into a variable
            $json = curl_exec($ch);

            // Close the cURL session
            curl_close($ch);

            // Store the response as an array to allow for easier manipulations
            return json_decode($json, true);
        } catch (Exception $e) {
            Log::info($e);
            // delete passport
            $this->delete_passport($passport_link);
            return false;
        } finally {
            Log::info('completed trip to mindee api: ' . json_encode($json));
        }
    }
    public function checkPassportValidity($prediction)
    {
        $score_per_prediction = 10;
        $confidence_score = 0;
        if (count($prediction)) {
            $verificationParams = ['birth_date', 'birth_place', 'country', 'expiry_date', 'gender', 'given_names', 'id_number', 'issuance_date', 'mrz1', 'surname'];
            foreach ($verificationParams as $value) {
                if ($value == 'given_names') {
                    if (count($prediction[$value])) {
                        $confidence_score += $score_per_prediction * $prediction[$value][0]['confidence'];
                    }
                } else {
                    $confidence_score += $score_per_prediction * $prediction[$value]['confidence'];
                }
            }
        } else {
            return false;
        }
        return $confidence_score > 50 ? true : false;
    }
    // handle the deletion of the passport image
    public function delete_passport($link)
    {
        if (file_exists($link)) {
            unlink($link);
        }
    }
    public function send_verification_link(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);
        // check if email already verified
        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
        if ($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already verified'
            ]);
        }
        // check if email already exists
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->email);
            $user->save();
            return response()->json([
                'status' => 'error',
                'message' => 'Verification link already sent. Please check your email.'
            ]);
        }
        $user = new User();
        $user->name = "user" . (User::count() + 1);
        $user->email = $request->email;
        $user->password = Hash::make($request->email);
        $user->save();
        $request->merge([
            'email_type' => 'email_verification_link',
            'token' => base64_encode($user->password),
        ]);

        Mail::to($request->email)->send(new \App\Mail\ContactReceived($request));
        return response()->json([
            'status' => 'success',
            'message' => "Email sent to {$request->email}"
        ]);
    }
    public function check_email(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);
        // check if email already verified
        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not verified'
            ])->setStatusCode(400);
        }
        return response()->json([
            'status' => 'success',
            'message' => "Email is valid"
        ]);
    }
}
