@extends('API.Capsule')


@section('body')
<ul class="nav nav-pills nav-justified"  style="font-size: 16px;">
  <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#panel1">Аккаунты</a></li>
  <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#panel2">Бизнес-Менеджеры</a></li>
  <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#panel3">Рекламные аккаунты</a></li>
  <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#panel4">Прокси</a></li>
</ul>
<div class="tab-content container col-md-12">

<div id="panel1" class="tab-pane fade in active" style="margin-top:50px;">
  	
    <h2>Аккаунты</h2>
<div style=" margin: 0 auto;">
	<div class="p-3 mb-2 bg-light text-dark">
		
		<menu>
			<h3 style="padding-bottom: 15px;">Фильтрация</h3>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Фильтр
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				Сортировка
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
  			<li style="list-style-type: none; float:left;padding-left:20px;padding-top:5px;">
  			<div class="custom-control custom-checkbox">
    				<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    				<label class="custom-control-label" for="defaultUnchecked">Применить для всех таблиц</label>
			</div>
			</li>
  			
			<li style="list-style-type: none; text-align: right; padding-right:20px;">
  				<button type="button" class="btn btn-primary btn-md">Получить данные</button>
    		</li>
    		
		</menu>	
    </div>
	<div class="table-acc">
	    	<table class="table table-sm">
  				<thead class="thead-dark">
    				<tr>
				      <th scope="col">#</th>
				      <th scope="col">Название аккаунта</th>
				      <th scope="col">Владелец</th>
				      <th scope="col">БМ1</th>
				      <th scope="col">БМ2</th>
				      <th scope="col">Создан</th>
				      <th scope="col">Изменен</th>
				    </tr>				  
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				  </tbody>
				</table>
	</div>
	<div class="create-update buttons" style="padding-left:40px;padding-top: 20px; padding-bottom:20px; background-color: #CCFFFF;">
		<button type="button" class="btn btn-primary btn-sm">Small button</button>
		<button type="button" class="btn btn-secondary btn-sm">Small button</button>
	</div>
</div>
</div>
 <div id="panel2" class="tab-pane fade" style="margin-top:50px;">
  	
    <h3>Бмы</h3>
    <div style="margin: 0 auto;">
	<div class="p-3 mb-2 bg-light text-dark">
		
		<menu>
			<h3 style="padding-bottom: 15px;">Фильтрация</h3>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Фильтр
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				Сортировка
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
  			<li style="list-style-type: none; float:left;padding-left:20px;padding-top:5px;">
  			<div class="custom-control custom-checkbox">
    				<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    				<label class="custom-control-label" for="defaultUnchecked">Применить для всех таблиц</label>
			</div>
			</li>
  			
			<li style="list-style-type: none; text-align: right; padding-right:20px;">
  				<button type="button" class="btn btn-primary btn-md">Получить данные</button>
    		</li>
    		
		</menu>	
    </div>
	<div class="table-acc">
	    	<table class="table table-sm">
  				<thead class="thead-dark">
    				<tr>
				      <th scope="col">#</th>
				      <th scope="col">Название аккаунта</th>
				      <th scope="col">Владелец</th>
				      <th scope="col">БМ1</th>
				      <th scope="col">БМ2</th>
				      <th scope="col">Создан</th>
				      <th scope="col">Изменен</th>
				    </tr>				  
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				  </tbody>
				</table>
	</div>
	<div class="create-update buttons" style="padding-left:40px;padding-top: 20px; padding-bottom:20px; background-color: #CCFFFF;">
		<button type="button" class="btn btn-primary btn-sm">Small button</button>
		<button type="button" class="btn btn-secondary btn-sm">Small button</button>
	</div>
</div>
  </div>
  <div id="panel3" class="tab-pane fade in active" style="margin-top:50px;">
  	
    <h3>РА</h3>
<div style="margin: 0 auto;">
	<div class="p-3 mb-2 bg-light text-dark">
		
		<menu>
			<h3 style="padding-bottom: 15px;">Фильтрация</h3>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Фильтр
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				Сортировка
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
  			<li style="list-style-type: none; float:left;padding-left:20px;padding-top:5px;">
  			<div class="custom-control custom-checkbox">
    				<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    				<label class="custom-control-label" for="defaultUnchecked">Применить для всех таблиц</label>
			</div>
			</li>
  			
			<li style="list-style-type: none; text-align: right; padding-right:20px;">
  				<button type="button" class="btn btn-primary btn-md">Получить данные</button>
    		</li>
    		
		</menu>	
    </div>
	<div class="table-acc">
	    	<table class="table table-sm">
  				<thead class="thead-dark">
    				<tr>
				      <th scope="col">#</th>
				      <th scope="col">Название аккаунта</th>
				      <th scope="col">Владелец</th>
				      <th scope="col">БМ1</th>
				      <th scope="col">БМ2</th>
				      <th scope="col">Создан</th>
				      <th scope="col">Изменен</th>
				    </tr>				  
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				  </tbody>
				</table>
	</div>
	<div class="create-update buttons" style="padding-left:40px;padding-top: 20px; padding-bottom:20px; background-color: #CCFFFF;">
		<button type="button" class="btn btn-primary btn-sm">Small button</button>
		<button type="button" class="btn btn-secondary btn-sm">Small button</button>
	</div>
</div>
</div>
	<div id="panel4" class="tab-pane fade in active" style="margin-top:50px;">
  	
    <h3>Прокси</h3>
<div style=" margin: 0 auto;">
	<div class="p-3 mb-2 bg-light text-dark">
		
		<menu>
			<h3 style="padding-bottom: 15px;">Фильтрация</h3>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    				Фильтр
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
			<li style="list-style-type: none; float: left; margin-right:10px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				Сортировка
  					</button>
						  <div class="dropdown-menu dropdown-menu-right">
						    <button class="dropdown-item" type="button">Action</button>
						    <button class="dropdown-item" type="button">Another action</button>
						    <button class="dropdown-item" type="button">Something else here</button>
						  </div>
				</div>
  			</li>
  			<li style="list-style-type: none; float:left;padding-left:20px;padding-top:5px;">
  			<div class="custom-control custom-checkbox">
    				<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    				<label class="custom-control-label" for="defaultUnchecked">Применить для всех таблиц</label>
			</div>
			</li>
  			
			<li style="list-style-type: none; text-align: right; padding-right:20px;">
  				<button type="button" class="btn btn-primary btn-md">Получить данные</button>
    		</li>
    		
		</menu>	
    </div>
	<div class="table-acc">
	    	<table class="table table-sm">
  				<thead class="thead-dark">
    				<tr>
				      <th scope="col">#</th>
				      <th scope="col">Название аккаунта</th>
				      <th scope="col">Владелец</th>
				      <th scope="col">БМ1</th>
				      <th scope="col">БМ2</th>
				      <th scope="col">Создан</th>
				      <th scope="col">Изменен</th>
				    </tr>				  
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				    </tr>
				  </tbody>
				</table>
	</div>
	<div class="create-update buttons" style="padding-left:40px;padding-top: 20px; padding-bottom:20px; background-color: #CCFFFF;">
		<button type="button" class="btn btn-primary btn-sm">Small button</button>
		<button type="button" class="btn btn-secondary btn-sm">Small button</button>
	</div>
</div>
</div>
</div>
@stop