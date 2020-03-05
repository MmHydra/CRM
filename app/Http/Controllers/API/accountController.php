<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storeAccountForm;
use App\Http\Requests\updateAccountForm;
use App\Owners;
use App\Accounts;
use App\Proxy;
use Carbon\Carbon;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {   
        $owners = Owners::all();
        $proxy = Proxy::select('ip')->get();
        return response()->json(array('owners' => $owners, 'proxy' => $proxy));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeAccountForm $request)
    {   
        // $getProxyID;

        // if($request->proxyIP !== null){
        //     $storeProxy = new Proxy;
        //     $storeProxy->ip = $request->proxyIP;
        //     $storeProxy->login = $request->proxyLogin;
        //     $storeProxy->port = $request->proxyPort;
        //     $storeProxy->password = $request->proxyPassword;
        //     $storeProxy->proxy_type = $request->proxyType;
        //     $storeProxy->save();
        //     $getProxyID = $storeProxy->latest()->first()->id;
        // }


        $account_Owner = Owners::where('name', $request->ownerName)->get();
        $getOwnerID = $account_Owner[0]->id;
        if($request->proxyIP)
        {
            $current_Proxy_ID = Proxy::select('id')->where('ip', $request->proxyIP)->get();
        }

        

        $storeAccounts = new Accounts;
        $storeAccounts->account_name = $request->accountName;
        $storeAccounts->acc_owner = $getOwnerID;
        $storeAccounts->keitaro_comp_id = $request->keitaroID;
        $storeAccounts->token_fb = $request->tokenFB;

        // if($request->proxyIP !== null){
        // $storeAccounts->acc_proxy_id = $getProxyID;
        // }

        $storeAccounts->status_id = 1;
        $storeAccounts->BillingInUse = $request->BillingInUse;
        $storeAccounts->status_id = $request->statusID;
        $storeAccounts->updated_at = '2020-01-01';
        $storeAccounts->user_agent = $request->accountsUserAgent;
        if($request->proxyIP)
        {
            $storeAccounts->acc_proxy_id = $current_Proxy_ID[0]->id;
        }
        $storeAccounts->save();

        return response()->json(['success' => 'yay']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        
        
        $accountData = new Accounts;
        
        // $accountResponse = $accountData->where('account_name', $name)->with(['proxyes'=> function($q)
        //     {$q->select('id','ip', 'port','login','password','proxy_type');}])->with(
        //     ['owners' => function($q)
        //      {$q->select(['id','name']);}])->get();

        $proxy = Proxy::select('ip')->get();
        $accountResponse = $accountData->where('id', $id)->with(
            ['owners' => function($q){$q->select(['id','name']);}])
        ->with(
            ['proxyes' => function($q){$q->select(['id','ip']);}])
        ->get();
        $ownersResponse = Owners::all();
        
        return response()->json(array(
            'accountResponse' => $accountResponse,
            'ownersResponse' => $ownersResponse,
            'proxyResponse' => $proxy));

        //$v = json($owners + $response);
        
        
            
        //хватаем с веб морды имя аккаунта
        //получаем его id
        //по этому id получаем все данные связанных таблиц
        //отправляем нужные нам данные на морду
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateAccountForm $request,  $id)
    {   

        
        if($request->proxyIP)
        {
            $current_Proxy_ID = Proxy::select('id')->where('ip', $request->proxyIP)->get();
            $current_Proxy_ID = $current_Proxy_ID[0]->id;
          
        }
        else
        {
            $current_Proxy_ID = null;
        }


        $account_Owner = Owners::where('name', $request->ownerName)->get();
        $getOwnerID = $account_Owner[0]->id;
        
        $storeAccounts = Accounts::where('id', $request->accountID)->update([
        'account_name' => $request->accountName,
        'acc_owner' => $getOwnerID,
        'keitaro_comp_id' => $request->keitaroID,
        'token_fb' => $request->tokenFB,
        'status_id' => 1,
        'BillingInUse' => $request->BillingInUse,
        'status_id' => $request->statusID,
        'acc_proxy_id' => $current_Proxy_ID,
        'user_agent' => $request->accountsUserAgent,
		//'updated_at' => false,
        ]);

        // if($request->proxyIP !== null){     
        //     $getIdAccount = Accounts::where('account_name', $request->accountName)->get(); 
                    
        //     $storeProxy = Proxy::where('id',$getIdAccount[0]->acc_proxy_id)->update([
        //     'ip' => $request->proxyIP,
        //     'login' => $request->proxyLogin,
        //     'port' => $request->proxyPort,
        //     'password' => $request->proxyPassword,
        //     'proxy_type' => $request->proxyType,
        //     ]);
        // }

        return response()->json(['success' => 'yay']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {   
        //$getIdProxy = Accounts::where('account_name', $name)->get();
        
        $destroyAccount = Accounts::where('account_name', $name);

       //$destroyProxy = Proxy::where('id', $getIdProxy[0]->acc_proxy_id);
        
       // $destroyProxy->delete();
        $destroyAccount->delete();

        return response()->json(['success' => 'yay']);
    }

}
