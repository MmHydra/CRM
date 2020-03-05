<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAccountForm extends FormRequest
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
    {   //$id = $this->request->get('accountID');
        return [
           'accountName' => 'Required|unique:Accounts,account_name,'.$this->request->get('accountID').',id',
            'ownerName' => 'Required',
            //'keitaroID' => 'Required|integer',
            'tokenFB' => 'Required',
            'statusID' => 'Required|integer',
            // 'proxyIP' => 'Required|ip',
            // 'proxyPort' => 'Required|integer|digits_between:1,4',
            // 'proxyLogin' => 'Required',
            // 'proxyPassword' => 'Required',
            // 'proxyType' => 'Required',
        ];
    }
    public function messages(){
    return [
        
        'accountName.unique' => 'Имя Аккаунта не уникально',
        'ownerName.required' => 'Владелец должен быть заполнен',
        // 'keitaroID.required' => 'Keitaro ID должен быть заполнен',
        // 'keitaroID.integer' => 'Keitaro ID должен состоять из цифр',
        'tokenFB.required' => 'Токен FB должен быть заполнен',
        'statusID.integer' => 'Status id должен состоять из цифр',
        // 'proxyIP.required' => 'Proxy IP должен быть заполнен',
        // 'proxyIP.ip' => 'Прокси IP должен соответствовать формату IP адреса',
        // 'proxyPort.required' => 'Proxy порт должен быть заполнен',
        // 'proxyPort.integer' => 'Proxy порт должен состоять из цифр',
        // 'proxyPort.digits_between' => 'Proxy порт должен содержать не больше 4 знаков',
        // 'proxyLogin.required' => 'Proxy логин должен быть заполнен',
        // 'proxyPassword.required' => 'Proxy пароль должен быть заполнен',
        // 'proxyType.required' => 'Proxy тип должен быть заполнен'
    ];
    }
  
  
   
}