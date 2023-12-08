<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => 'required|date_format:H:i'
        ];
    }

    public function withValidator($validator)
    {

        $validator->after(function ($validator) {

            if ($validator->errors()->hasAny(['movie_id', 'start_time_time', 'end_time_date', 'end_time_time'])) {
                return false;
            }

            $startTime = new Carbon($this->start_time_time);
            $endTime = new Carbon($this->end_time_time);
            

            if(isset($startTime) && isset($endTime)) {

                if($startTime->gte($endTime)) {
                    $validator->errors()->add('start_time_time', '開始時間が終了時間よりも長いです。');
                    $validator->errors()->add('end_time_time', '開始時間が終了時間よりも長いです。');
                }
            
                $diffInMinutes = $endTime->diffInMinutes($startTime);
            
                if($diffInMinutes < 6) {
                    $validator->errors()->add('start_time_time', '開始時間が終了時間よりも長いです。');
                    $validator->errors()->add('end_time_time', '開始時間と終了時間が5分未満です。');
                }
            }
        });
    }
}
