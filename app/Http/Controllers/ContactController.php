<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use Exception;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;

class ContactController extends Controller
{
    public function send_mail(Request $request)
    {
        $validated = $request->validate([
            // 'passport' => ['required', File::types(['jpg', 'jpeg', 'png'])->min(10)],
            'gov_rep' => ['required', 'max:1'],
            'organization' => ['required', 'string', 'max:40'],
            'designation' => ['required', 'string', 'max:40'],
            'country_code' => ['required', 'string', 'max:8'],
            'contact_no' => ['required', 'string', 'min:8', 'max:14'],
            'response_time' => ['required', 'string', 'max:140'],
            'best_time' => ['required', 'string', 'max:140'],
            'remark' => ['sometimes', 'nullable ', 'string', 'max:600'],
            'email' => ['required', 'email'],
            'passport_link' => ['required', 'max:50'],
        ]);
        Log::warning($request->all());

        try {
            // $recipients = ['amrprojects@proton.me', $request->email];
            $recipients = ['chizoba@bexit.com.ng', $request->email];

            // put 'yes' or 'no' for 1 or 0
            $request['gov_rep'] = $request->gov_rep == 1 ? 'Yes' : 'No';
            // set is_pdf 
            $str_arr = explode('.', $request->passport_link);
            $request['is_pdf'] = $str_arr[count($str_arr) - 1] == 'pdf';

            Log::info($request->all());
            // send mail to guest
            foreach ($recipients as $recipient) {
                Mail::to($recipient)->send(new ContactReceived($request));
            }
            $request->session()->flash('status', 'success');
            return redirect('/');
        } catch (Exception $e) {
            Log::info('an error occurred');
            Log::warning($e);
            return back()->withInput();
        } finally {
            // delete the passport image
            $this->delete_passport($request->passport_link);
        }
    }
    // handle the deletion of the passport image
    public function delete_passport($link)
    {
        if (file_exists($link)) {
            unlink($link);
        }
    }
}
