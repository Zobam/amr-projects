<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use App\Mail\TestEmail;
use Exception;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;

class ContactController extends Controller
{
    public function send_mail(Request $request)
    {
        // return $request->all();
        $request->validate([
            // 'passport' => ['required', File::types(['jpg', 'jpeg', 'png'])->min(10)],
            'gov_rep' => ['required', 'max:1'],
            'organization' => ['sometimes', 'nullable ', 'string', 'max:140'],
            'country' => ['sometimes', 'nullable ', 'string', 'max:140'],
            'designation' => ['required', 'string', 'max:140'],
            'country_code' => ['required', 'string', 'max:8'],
            'contact_no' => ['required', 'string', 'min:8', 'max:14'],
            'response_time' => ['required', 'string', 'max:140'],
            'best_time' => ['required', 'string', 'max:140'],
            'remark' => ['sometimes', 'nullable ', 'string', 'max:600'],
            'email' => ['required', 'email'],
            'passport_link' => ['required', 'max:50'],
        ]);
        // Log::warning($request->all());

        try {
            // $recipients = ['wr@amrprojects.com', $request->email];
            $recipients = ['chizoba@bexit.com.ng', $request->email];

            // put 'yes' or 'no' for 1 or 0
            $request['gov_rep'] = $request->gov_rep == 1 ? 'Yes' : 'No';
            // set is_pdf 
            $str_arr = explode('.', $request->passport_link);
            $request['is_pdf'] = $str_arr[count($str_arr) - 1] == 'pdf';

            // Log::info($request->all());
            // send mail to guest
            foreach ($recipients as $recipient) {
                // set to_guest for the purpose of customizing the email body
                $request['to_guest'] = $request->email == $recipient;
                Mail::to($recipient)->send(new ContactReceived($request));
            }
            $request->session()->flash('status', 'success');
            return redirect('/case-study');
        } catch (Exception $e) {
            Log::info('an error occurred');
            Log::warning($e);
            $request->session()->flash('status', 'error');
            return back()->withInput();
        } finally {
            // delete the passport image
            $this->delete_passport($request->passport_link);
            // delete uploaded images that has stayed more than a day
            $this->delete_files();
        }
    }
    // handle the deletion of the passport image
    public function delete_passport($link)
    {
        if (file_exists($link)) {
            unlink($link);
        }
    }
    public function test_mail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);
        if ($request->has('email')) {
            Mail::to($request->email)->send(new TestEmail());
            return response()->json([
                'status' => 'success',
                'message' => 'Email sent to ' . $request->email
            ]);
        } else {
            return "email not found";
        }
    }
    public function delete_files()
    {
        $dir = 'images/email';
        if ($handle = opendir($dir)) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '..' && $entry != '.') {
                    $file = $dir . '/' . $entry;
                    if (file_exists($file)) {
                        $time = filemtime($file);
                        $now = time();
                        $days_past = round(($now - $time) / (60 * 60 * 24), 2);
                        // delete the file if it was uploaded more than a day ago
                        if ($days_past >= 1) {
                            unlink($file);
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
}
