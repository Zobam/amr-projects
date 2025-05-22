<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use App\Mail\TestEmail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'email' => ['required', 'email', 'exists:users,email'],
            // 'passport_link' => ['required', 'max:50'],
        ]);
        // Log::warning($request->all());

        try {
            $user = User::where('email', $request->email)->first();
            if ($user->email_verified_at == null) {
                return redirect('/contact')->with('status', 'error');
            }
            auth()->login($user, true);
            if ($user->contacted) {
                return redirect('/case-study')->with('status', 'We have already contacted you');
            }


            // $recipients = ['chizoba@bexit.com.ng', $request->email];
            $recipients = ['wr@amrprojects.com', $request->email];

            // put 'yes' or 'no' for 1 or 0
            $request['gov_rep'] = $request->gov_rep == 1 ? 'Yes' : 'No';
            // set is_pdf 
            // $str_arr = explode('.', $request->passport_link);
            $request['is_pdf'] = false; // $str_arr[count($str_arr) - 1] == 'pdf';
            $request['token'] = base64_encode($user->password);

            Log::info($request->all());
            // send mail to guest
            foreach ($recipients as $recipient) {
                // set to_guest for the purpose of customizing the email body
                $request['to_guest'] = $request->email == $recipient;
                Mail::to($recipient)->send(new ContactReceived($request));
            }
            $user->name = $request->name ?? $request->designation;
            $user->contacted = true;
            $user->save();

            $request->session()->flash('status', 'success');
            // auth()->login($user, true);
            return redirect()->intended('/case-study');
        } catch (Exception $e) {
            Log::info('an error occurred');
            Log::warning($e);
            $request->session()->flash('status', 'error');
            return back()->withInput();
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
    public function verify_email(Request $request, $token)
    {
        $token = base64_decode($token);
        /* return response()->json([
            'status' => 'success',
            'message' => 'Email verified successfully'
        ]); */
        $user = User::where('password', $token)->first();
        if ($user) {
            if ($user->email_verified_at === null) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
            // auth()->login($user, true);
            $request->session()->flash('status', 'success');
            return view('email_verification');
        } else {
            $request->session()->flash('status', 'error');
            return view('email_verification');
        }
    }
    public function authorize_email(Request $request)
    {
        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
        if ($user) {
            auth()->login($user, true);
            return redirect('/case-study');
        } else {
            return redirect('/contact');
        }
    }
}
