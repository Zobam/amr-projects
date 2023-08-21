<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyPassportController extends Controller
{
    // verify passport
    public function verify_passport(Request $request)
    {
        /* // set cURL options
        $FILE_PATH = 'images/email/passport_image09034343434.jpg';
        $MIME_TYPE = 'image/png'; // change according to the file type

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
        $result = json_decode($json, true);
        Log::info('Result from curl to mindee: \n' . json_encode($result, JSON_PRETTY_PRINT)); */
        $result = [
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
        ];

        $prediction = $result['document']['inference']['prediction'];
        $response = ['status' => 'success', 'message' => 'Passport passed verification check.'];
        if (!$this->checkPassportValidity($prediction)) {
            $response['status'] = 'error';
            $response['message'] = 'Passport failed verification check.';
        }
        return $response;

        $ip_address = $request->ip_address ?? '';
        // send response to front end
        if ($this->blacklist($ip_address)) {
            return response()->json([
                'status' => 'success',
                'message' => 'IP address successfully blacklisted',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'IP address was not successfully blacklisted',
            ]);
        }
    }
    public function blacklist($ip_address)
    {
        if (!$this->checkIfBlacklisted($ip_address)) {
            try {
                $blacklist = fopen(public_path('blacklist.txt'), 'a');
                $lineText = "$ip_address\n";
                fwrite($blacklist, $lineText);
                fclose($blacklist);
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
    public function checkIfBlacklisted($ip_address)
    {
        try {
            $blacklist = fopen(public_path('blacklist.txt'), 'r');
            $already_blacklisted = false;
            while (!feof($blacklist)) {
                $currentLine = fgets($blacklist);
                Log::info($currentLine);
                if (strpos($currentLine, $ip_address) !== false) {
                    $already_blacklisted = true;
                    break;
                }
            }
            return $already_blacklisted;
        } catch (Exception $e) {
            return false;
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
                    $confidence_score += $score_per_prediction * $prediction[$value][0]['confidence'];
                } else {
                    $confidence_score += $score_per_prediction * $prediction[$value]['confidence'];
                }
            }
        } else {
            return false;
        }
        return $confidence_score > 50 ? true : false;
    }
}
