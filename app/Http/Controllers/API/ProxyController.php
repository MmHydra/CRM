<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Proxy;
use App\Accounts;

use App\Http\Requests\UpdateProxyForm;
use App\Http\Requests\StoreProxyForm;

class ProxyController extends Controller
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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProxyForm $request)
    {
        $storeProxy = new Proxy;
        $storeProxy->ip = $request->proxyIP;
        $storeProxy->login = $request->proxyLogin;
        $storeProxy->port = $request->proxyPort;
        $storeProxy->password = $request->proxyPassword;
        $storeProxy->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProxyForm $request, $id)
    {
        $storeProxy = Proxy::where('id', $id)->update([
            'ip' => $request->proxyIP,
            'login' => $request->proxyLogin,
            'port' => $request->proxyPort,
            'password' => $request->proxyPassword,

            ]);
       
        return response()->json(['success' => 'yay']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

        $destroyProxy = Proxy::where('id', $id);
        
        $destroyProxy->delete();       

        return response()->json(['success' => 'yay']);
    }
}
