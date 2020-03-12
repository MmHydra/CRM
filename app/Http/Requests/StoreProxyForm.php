<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProxyForm extends FormRequest
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
            'proxyIP' => 'Required|ip',
            'proxyPort' => 'Required|integer|digits_between:1,8',
            'proxyLogin' => 'Required',
            'proxyPassword' => 'Required',
           
        ];
    }
    public function messages(){

    return [
      'proxyIP.required' => 'Proxy IP должен быть заполнен',
      'proxyIP.ip' => 'Прокси IP должен соответствовать формату IP адреса',
      'proxyPort.required' => 'Proxy порт должен быть заполнен',
      'proxyPort.integer' => 'Proxy порт должен состоять из цифр',
      'proxyPort.digits_between' => 'Proxy порт должен содержать не больше 8 знаков',
      'proxyLogin.required' => 'Proxy логин должен быть заполнен',
      'proxyPassword.required' => 'Proxy пароль должен быть заполнен',

    ];
    }
}
