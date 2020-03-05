@extends('API.Capsule')
@section('body')
<h1>Аккаунты</h1>
<div class="col-md-12">
<ul class="nav nav-pills nav-justified _tab"  style="font-size: 16px; margin-bottom: 20px; background-color: #AFEEEE;">
  <li class=" nav-item"><a class="nav-link active" data-toggle="tab" onclick="showTableAccounts()">Профили</a></li>
  <li class=" nav-item"><a class="nav-link " onclick="showTableProxy()">Proxy</a></li>
  <li class=" nav-item"><a class="nav-link " onclick="showTableADS()">Рекламные Аккаунты</a></li>
 

</ul>
	<div id="table_accounts">
		<div id="_filter_group"style="display: flex;">
			<div id="_filter_owner" style=" border: 2px solid Yellow;margin-left:15px;">
				<h3>Владелец</h3>
				<ul class="_filter_list" style="list-style: none;padding-left: 0px;">
					

					
				</ul>
			</div>
			<div id="_filter_checkbox" class="_filter_checkbox" style=" border: 2px solid Yellow;">
				<h3>Checkbox</h3>
				<ul class="_filter_list" style="list-style: none; padding-left: 0px; margin-left:15px;">
					
				</ul>
			</div>
				
			</div>

			<div class="_control">

			<div class="btn-group" style="padding-bottom: 0.625em;">
 			

				<select id="select_owner" class="browser-default custom-select" style="margin-right: 20px;" onchange="chooseOptionOwner()">
					 
					  	@foreach($Data_Owners as $owners)
					  	<option>{{$owners->name}}</option>
					  	@endforeach
				</select>

				<select id="select_checkbox_status" class="browser-default custom-select" onchange="chooseOptionCheckbox()">
					  
					  	
					  	<option>true</option>
					  	<option>false</option>
					  	
				</select>
				<button onclick="applyFilter()">Применить фильтр</button>

				
			</div>


		  		
			</div>

			<button type="button" id = "modalCreateAccountsShow" onclick = "openFormAccount()" class="btn btn-primary btn-lg" style="float: right; margin-top:  -0.625em">Создать аккаунт</button>
			<button type="button" id = "recieveAccountsFromFBToll" onclick = "recieveAccountsFromFBToll()" class="btn btn-primary btn-lg" style="float: right; margin-right: 10px;background-color:brown;border-color: brown; margin-top:  -0.625em">Получить аккаунты из fbtool</button>
	

<div class="_table-acc">
	    	<table class="table table-striped" id="Accounts">
  				<thead class="thead-dark">
    				<tr style="text-align: center;">
				      <th scope="col">checkbox</th>
				      <th scope="col">ID</th>
				      <th scope="col">Аккаунт</th>
				      <th scope="col">Владелец</th>
				      <th scope="col">Бизнес-менеджеры   Акт/Бан</th>
				      <th scope="col">Статус аккаунта</th>
				      <th scope="col">Использовать биллинг</th>
				      <th scope="col">Действия</th>
				      </tr>				  
				  </thead>
				  <tbody style="text-align: center;">
				    
				      @foreach($array_Data_Accounts as $Data_Accounts)
				      <tr class="rows">
				      <td><input class="_checkbox" type="checkbox"unchecked style=" transform:scale(1.5);"></td>
				      <td class="account_IDs" id="accountIDTable">{{$Data_Accounts->id}}</td>
				      <td class="account_names" id="accountNameTable">{{$Data_Accounts->account_name}}</td>
				      <td class="owners">{{$Data_Accounts->owners->name}}</td>

				      

				  	  <td class="businessManager">  
				  	  		    @if($Data_Accounts->BusinessManager->count()) 
				  	  			@foreach($Data_Accounts->BusinessManager as $BM)							  	 
				  	  			<p>{{$BM->acc_name}}</p>  	  							  	  	 		
				  	  			@endforeach

				  	  			@else
				  	  			<p>Данных нет</p>
				  	  			@endif
					  </td>

						<td class="status_IDs">{{$Data_Accounts->status_id}}</td>
					  
					 	<td>
				  	  									  
				  	  			@if($Data_Accounts->BillingInUse == 1)
				  	  			<input disabled class="_billingInUse" type="checkbox"checked style=" transform:scale(1.5);"></td>	 
				  	  			@else
				  	  			<input disabled class="_billingInUse" type="checkbox"unchecked style=" transform:scale(1.5);"></td>
				  	  			@endif 	  							  	  	 		
				  	  			
				  	  	</td>

				  	  			
				  	  			
				  	 	
				      
				      <td>
				            <div class="_bottom-group" style="padding-right:15px; text-align: center;  height: 7em;">
				      			<button type="button" class="btn btn-primary btn-sm" onclick = "openFormAccountUpdate()">Редактировать</button>
						  		<button type="button"  class="btn btn-secondary btn-sm" onclick = "openModalAccountDelete()">Удалить</button>
						    </div>
					   </td> 
					   </tr>
				      @endforeach
				      
				      
				     
				      
				     
				      		

				 <!--     <tr>
				      
				      <td>checkbox</td>
				      <td>Andre1</td>
				      <td>Andrei</td>
				      <td><p>1111111111111111111  5/1</p><p>1111111111111111111  8/1</p><p>1111111111111111111  9/1</p></td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr> -->
				   
				  </tbody>
				</table>
	</div>
	</div>
	


	<div id="table_ADS" style="display:none;">
	
		<div class="_filter_group">
			<ul class="_filter_list" style="display:inline-block; list-style: none; padding-left: 0px;">
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>Andrei</span><button style="float:right;">X</button></li>
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>Andrei</span><button style="float:right;">X</button></li>
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>Andrei</span><button style="float:right;">X</button></li>
			</ul>
		</div>


			<div class="_table-acc">
				    	<table class="table table-striped" id="ACT">
			  				<thead class="thead-dark">
			    				<tr style="text-align: center;">
							      <th scope="col">checkbox</th>
							      <th scope="col">Имя РА</th>
							      <th scope="col">Имя аккаунта/th>
							      <th scope="col">Владелец</th>
							      <th scope="col">Спенд???</th>
							      <th scope="col">Биллинг</th>
							      <th scope="col">Статус</th>
							      </tr>				  
							  </thead>
							<!--   <tbody style="text-align: center;">
							    
							 
							  </tbody> -->
							</table>
			</div>				
	</div>
		<div id="div_table_proxy" style="display:none;">
	
		<div class="_filter_group">
			<ul class="_filter_list" style="display:inline-block; list-style: none; padding-left: 0px;">
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>No use</span><button style="float:right;">X</button></li>
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>No use</span><button style="float:right;">X</button></li>
				<li style="float: left; width:100px; border: 2px solid Yellow; margin-left: 15px;"><span>No use</span><button style="float:right;">X</button></li>
			</ul>
		</div>

		<button type="button" id = "modalCreateAccountsShow" onclick = "openFormCreateProxy()" class="btn btn-primary btn-lg" style="float: right; margin-top:  -0.625em">Создать proxy</button>


			<div class="_table_proxy" >
				    	<table class="table table-striped" id="table_proxy">
			  				<thead class="thead-dark">
			    				<tr style="text-align: center;">
							      <th scope="col">ID</th>
							      <th scope="col">IP</th>
							      <th scope="col">Порт</th>
							      <th scope="col">Логин</th>
							      <th scope="col">Пароль</th>
							      <th scope="col">Действия</th>
							    </tr>				  
							</thead>
							<!--   <tbody style="text-align: center;">
							    
							 
							  </tbody> -->
							</table>
			</div>				
	</div>
	</div>
	
<div id="modalCreateAccounts" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
    <div class="modal-header">
		 <h4 class="modal-title" style="display: flex; flex-direction: row">Создание аккаунта</h4>
     </div>
		<form style="margin-left: 10px; margin-right: 10px; margin-top: 10px;" id="formAccountCreate">
		
		  <div class="form-group row">
		  	 
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Имя аккаунта</label>
		    <div class="col-sm-6">
		      <input maxlength="50" name="accountName" value="1" type="text" class="form-control form-control _accountFormInputs" id="colFormLabelSm" placeholder="">
		    </div>
		  </div>
		 
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Владелец</label>
		    <div class="col-sm-6">
		      <select class="custom-select mr" id="selectOwners">
		        
		        
		      </select>
		    </div>
		  </div>
		  <div class="form-group row">

		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Keitaro id</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" value="1" id="colFormLabelLg" placeholder="" name="keitaroID">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Token FB</label>
		    <div class="col-sm-6">
		      <input type="text"  class="form-control _accountFormInputs" id="colFormLabelLg" placeholder="" name="tokenFB">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Status ID</label>
		    <div class="col-sm-6">
		      <input type="text" value="1" class="form-control _accountFormInputs" value="1" id="colFormLabelLg" placeholder="" name="statusID">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Proxy IP</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" id="accountsProxyIPInputCreate" placeholder="" name="proxyIP">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">User Agent</label>
		    <div class="col-sm-6">
		      <textarea type="text" class="form-control _accountFormInputs" placeholder="" name="accountsUserAgent"></textarea>
		    </div>
		  </div>
		   <div class="form-group row">
		  	 
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Использовать биллинг</label>
		    <div class="col-sm-6">
		      <input type="hidden" name="status" value="0">
		      <input  name="BillingInUse" type="checkbox" style="height: 100%; width: 1.5em;" class=" checkbox _accountFormInputs" id="colFormLabelSm" placeholder="" value="1">
		    </div>
		  </div> 
		
		
		  <div class="errorsOutput" style="width:70%;display: none; margin-left:5px;"></div>
		</form>
		
		<div class="modal-footer _footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	        <button type="button" class="btn btn-primary" onclick="submitFormStore()">Применить</button>
      </div>
	</div>
	</div>	
</div>

<div id="modalUpdateAccounts" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
    <div class="modal-header">
		 <h4 class="modal-title" style="display: flex; flex-direction: row">Редактирование аккаунта</h4>
     </div>
		<form style="margin-left: 10px; margin-right: 10px; margin-top: 10px;" id="formAccountProxyEdit">
			<div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">ID аккаунта</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" id="accountID" placeholder="" name="accountID" disabled>
		    </div>
		    </div>
		  <div class="form-group row">
		  	<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Имя аккаунта</label>
		    <div class="col-sm-6">
		      <input maxlength="50" name="accountName" type="text" class="form-control form-control _accountFormInputs" id="colFormLabelSm" placeholder="">
		    </div>
		  </div>
		 
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Владелец</label>
		    <div class="col-sm-6">
		      <select class="custom-select mr" id="selectOwnersEdit">
		        <option>Выберите владельца</option>
		        
		      </select>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Keitaro id</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" id="colFormLabelLg" placeholder="" name="keitaroID">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Token FB</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" id="colFormLabelLg" placeholder="" name="tokenFB">
		    </div>
		  </div>
		   <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Status ID</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" id="colFormLabelLg" placeholder="" name="statusID">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Proxy IP</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _accountFormInputs" placeholder="" name="proxyIP" id="accountsProxyIPInputEdit">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">User Agent</label>
		    <div class="col-sm-6">
		      <textarea type="text" class="form-control _accountFormInputs" placeholder="" name="accountsUserAgent"></textarea>
		    </div>
		  </div>
		    <div class="form-group row">
		  	 
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Использовать биллинг</label>
		    <div class="col-sm-6">
		      
		      <input  name="BillingInUse" type="checkbox" style="height: 100%; width: 1.5em;" class=" checkbox " id="colFormLabelSm" placeholder="" value="1">
		    </div>
		  </div> 
		
		
		  <div class="errorsOutput" style="width:70%;display: none; margin-left:5px;"></div>
		</form>
		
		<div class="modal-footer _footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	        <button type="button" class="btn btn-primary" onclick="submitFormUpdate()">Применить</button>
      </div>
	</div>
	</div>	
</div>

<div id="modalCreateProxy" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
    <div class="modal-header">
		 <h4 class="modal-title" style="display: flex; flex-direction: row">Создание Proxy</h4>
     </div>
		<form style="margin-left: 10px; margin-right: 10px; margin-top: 10px;" id="formProxyCreate">
		  <div class="form-group row">
		  	<label for="colFormLabelSm" type="text"  class="col-sm-2 col-form-label col-form-label">Proxy IP</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" id="proxyIP" name="proxyIP" placeholder="">
		    </div>
		  </div>
		 
		  <div class="form-group row">
		    <label for="colFormLabelSm" type="text"  class="col-sm-2 col-form-label col-form-label">Proxy port</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" name="proxyPort" placeholder="">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label ">Proxy Логин</label>
		    <div class="col-sm-6">
		      <input class="form-control _proxyFormInputs" id="colFormLabelLg" name="proxyLogin" placeholder="" type="text">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Proxy Пароль</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" name="proxyPassword" placeholder="" type="text">
		    </div>
		  </div>
		   <div class="errorsOutput" style="width:70%;display: none; margin-left:5px;"></div>
		</form>
		
		<div class="modal-footer _footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	        <button type="button" class="btn btn-primary" onclick="submitFormUpdateProxy()">Применить</button>
      </div>
	</div>
	</div>

</div>

<div class="modal" id="modalDeleteAccount" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Вы действительно хотите удалить Аккаунт и связанные с ним Бмы и РА</p>
      </div>
      <div class="modal-footer">
      	<div id="infoResponse"></div>
        <button type="button" class="btn btn-primary" onclick="sendFormAccountsProxy.deleteGroupObjectAccount.submitDeleteAccount()">Да</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

												<!--PROXY-->
<div id="modalUpdateProxy" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
    <div class="modal-header">
		 <h4 class="modal-title" style="display: flex; flex-direction: row">Редактирование Proxy</h4>
     </div>
		<form style="margin-left: 10px; margin-right: 10px; margin-top: 10px;" id="formProxyEdit">
			<div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">ID</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control _proxyFormInputs" id="proxyID" placeholder="" name="proxyID" disabled>
		    </div>
		    </div>
		  <div class="form-group row">
		  	<label for="colFormLabelSm" type="text"  class="col-sm-2 col-form-label col-form-label">Proxy IP</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" id="proxyIP" name="proxyIP" placeholder="">
		    </div>
		  </div>
		 
		  <div class="form-group row">
		    <label for="colFormLabelSm" type="text"  class="col-sm-2 col-form-label col-form-label">Proxy port</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" name="proxyPort" placeholder="">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label ">Proxy Логин</label>
		    <div class="col-sm-6">
		      <input class="form-control _proxyFormInputs" id="colFormLabelLg" name="proxyLogin" placeholder="" type="text">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Proxy Пароль</label>
		    <div class="col-sm-6">
		      <input  class="form-control _proxyFormInputs" name="proxyPassword" placeholder="" type="text">
		    </div>
		  </div>
		   <div class="errorsOutput" style="width:70%;display: none; margin-left:5px;"></div>
		</form>
		
		<div class="modal-footer _footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	        <button type="button" class="btn btn-primary" onclick="submitFormUpdateProxy()">Применить</button>
      </div>
	</div>
	</div>

</div>

<div class="modal" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Вы действительно хотите удалить Proxy?</p>
      </div>
      <div class="modal-footer">
      	<div id="infoResponseProxy"></div>
        <button type="button" class="btn btn-primary" onclick="sendFormAccountsProxy.deleteGroupObjectProxy.submitDeleteProxy()">Да</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>




@stop
