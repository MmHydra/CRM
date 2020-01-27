<!DOCTYPE html>
<head>
 
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navigation Bar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Bar2<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Bar3</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Bar4</a>
      </li>
     </ul>
  </div>
</nav>
@yield('body')

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
var obj;
const token = '{{ csrf_token() }}';

var sendFormAccountsProxy = {
   url : '',
   method : '', 
   showCreateAccounts : function(){
       url =  '';
       method = 'POST';
       $('#modalCreateAccounts').modal('show');
              if($('.ownerOptions').length == 0){
                fetch("accounts/create", {
                headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token
                },
                method: "GET",
                credentials: "same-origin",
                })
                .then(function(response){
                      return response.json();
                })
                .then(function(data){
                                                 // data => obj = data;
                      return dataOwnersProxyes = data;
                })
                .then(function(){
                     
                      $('#selectOwners').append(
                          dataOwnersProxyes.map(n =>`<option name="ownerName" class="_accountFormInputOwner">${n.name}</option>`)
                      );
                })
                }

    },
    submitFormAccountProxy : function(elem){      
       var data = {};
       data.ownerName = $('#'+elem+'').find("select option:selected").text();
       console.log("data.ownerName = " + data.ownerName);
     // data.ownerName = $('#selectOwners option:selected').text();
      $('#'+elem+'').find('._accountFormInputs').each(function() {
      data[this.name] = $(this).val();
      });
      data = JSON.stringify(data);
     


      console.log(data);
      $('#'+elem+'').find(".outputSpan").remove();
      //$("#errorsOutput").css('display', 'none');
      fetch('/accounts/' + url, {
                headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                "X-CSRF-Token": token,
                },
                body: data,
                method: method,
                credentials: "same-origin",
                })
                  .then((response) => {
                    console.log($('#'+elem+'').html()); 
                     
                      if (response.ok) {
                        
                      $('#'+elem+'').find(".errorsOutput").css('display', '');
                      
                      $('#'+elem+'').find(".errorsOutput").append(
                        `<span class="outputSpan" style="color:green;">Аккаунт создан успешно</span>`);  
                      }
                      else{
                        data = response.json();
                        return data;
                      } 
                  })
                  .then((data) => {
                       return Promise.reject(data);
                  })  
                  .catch((data)=>{
                        console.log(data);
                        console.log(typeof data);
                        $('#'+elem+'').find(".errorsOutput").css('display', '');
                        for(key in data.errors){
                        $('#'+elem+'').find(".errorsOutput").append(`<span class="outputSpan" style="color:red;display: flex;flex-direction: column">${key} - ${data.errors[key]}</span`);
                        }
                })
                            
    },
    updateAccountProxy : function(elem){
      url = elem,
      method = 'PATCH',
      $("._accountFormInputOwner").remove();  
        //.siblings().find('.account_names'));
      var formNameValue;
      fetch("/accounts/"+ url +"/edit", {
                headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token
                },
                method: "GET",
                credentials: "same-origin",
                })
                .then(function(response){
                  return response.json();
                  
                })
                .then(function(response){
                  var arrOwners = [];
                  for(key in response.ownersResponse){
                    arrOwners.push(response.ownersResponse[key].name);
                  }

                  $('#selectOwnersEdit').append(
                    arrOwners.map(n=>`<option name="ownerName" class="_accountFormInputOwner">${n}</option>`)
                  );
                    //response.ownersResponse[key].name;
                  
                  console.log(response);
                  formNameValue = {
                    'accountName' : response.accountResponse[0].account_name,
                    'keitaroID' : response.accountResponse[0].keitaro_comp_id,
                    'tokenFB' : response.accountResponse[0].token_fb,
                    'ownerName' : response.accountResponse[0].owners.name,
                    'proxyIP' : response.accountResponse[0].proxyes.ip,
                    'proxyPort' : response.accountResponse[0].proxyes.port,
                    'proxyLogin' : response.accountResponse[0].proxyes.login,
                    'proxyPassword' : response.accountResponse[0].proxyes.password,
                    'proxyType' : response.accountResponse[0].proxyes.proxy_type,
                  }  
                for(key in formNameValue){
                  if(key == 'ownerName'){
                    console.log(formNameValue[key]);
                    $('#selectOwnersEdit :contains('+formNameValue[key]+')').attr("selected", "selected");
                  }
                  else{
                  $("#modalUpdateAccounts").find("[name="+key+"]").val(formNameValue[key]);
                  }
                   } 
                  
                })
           
        

       $('#modalUpdateAccounts').modal('show');
    },
    showModalDelete : function(elem){
      
      url = elem;
      method = 'DELETE';
      $('#modalDelete').modal('show');
    },
    deleteAccount : function(){
      $('#infoResponse').find('.outputSpan').remove();
      fetch("/accounts/"+ url, {
                headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token
                },
                method: method,
                credentials: "same-origin",
                })
                .then(function(response){
                  if (response.ok){
                    console.log("ok");
                    $('#infoResponse').append(`<span class="outputSpan" style="color:green;">Аккаунт успешно удален</span`);
                  }
                  if (!response.ok){
                    console.log("not ok");
                    $('#infoResponse').append(`<span class="outputSpan" style="color:red;">Произошла ошибка</span`);
                  }
                  
                  })
    },
    }
      
          
                                                                                                      

////////////////////////////////////////////////////

  function openFormAccountProxy(){
      sendFormAccountsProxy.showCreateAccounts();
  } 
   function openFormAccountProxyUpdate(){
      var elem = event.target;
      elem = $(elem).parents("td").siblings(".account_names").text();
      sendFormAccountsProxy.updateAccountProxy(elem);
  }   

  function submitForm(){
      var elem = event.target;
      elem = $(elem).parent("div").siblings("form").attr("id");
      console.log("elem = " + elem); 
    sendFormAccountsProxy.submitFormAccountProxy(elem);
  }

  function openModalAccountProxyDelete(){
    var elem = event.target;
    elem = $(elem).parents("td").siblings(".account_names").text();
    sendFormAccountsProxy.showModalDelete(elem);
  }




var filterObject = { filterOwnersArr : [],
                 filterCheckboxArr : [],

                 createFilterOwnersList : function(){
                          var filter = $("#select_owner option:selected").val();

                          if(filterObject['filterOwnersArr'].includes(filter) != 1){
                          $('#_filter_owner ul').append(`<li style="float: left; width:100px; border: 2px solid Yellow;"><span>${filter}</span><button style="float:right;" onclick="destroyElemOwner()">X</button></li>`);
                          filterObject['filterOwnersArr'].push(filter);
                          console.log(filterObject['filterOwnersArr']);
                          }
                          else{
                            alert('такой уже есть');
                          }
                  },
                  createFilterCheckboxList : function(){

                          var filter = $("#select_checkbox_status option:selected").val();
                          console.log(filter);
                          
                          if(filterObject['filterCheckboxArr'].includes(filter) != 1){
                          $('#_filter_checkbox ul').append(`<li style="float: left; width:100px; border: 2px solid Yellow;"><span>${filter}</span><button style="float:right;"onclick="destroyElemCheckbox()">X</button></li>`);
                          filter = (filter == "false") ? "false" : "true";
                          filterObject['filterCheckboxArr'].push(filter);
                          console.log(filterObject['filterCheckboxArr']);
                          }
                          else{
                            alert('такой уже есть');
                          }
                  },
                  destroyElemFilterListOwners : function(elem){
                    filterObject['filterOwnersArr'].splice(function(){
                    filterObjxect['filterOwnersArr'].indexOf(elem.innerHTML);
                    },1);
                    elem.remove();
                    console.log(filterObject['filterOwnersArr']);
                  },
                  destroyElemFilterListCheckbox: function(elem){
                    filterObject['filterCheckboxArr'].splice(function(){
                    filterObject['filterCheckboxArr'].indexOf(elem.innerHTML);
                    },1);
                    elem.remove();
                    console.log(filterObject['filterCheckboxArr']);
                  },
                  applyFilter : function(){
                    
                    
                    $(this).find(".owners").text()
                    //   $("#Accounts .rows").css('display', '')
                    //   $("#Accounts .rows").each(function(){
                    //     if(filterObject['filterOwnersArr'].includes($(this).find(".owners").text()) 
                    //       && 
                    //       $(this).find(".account_names").text() == "Masha1"){
                    //       $(this).css('display', '');
                    //     }
                    //     else{
                    //       $(this).css('display', 'none');
                    //     }
                      
                    // });
                 
                  }

               }
  function chooseOptionOwner(){
    filterObject.createFilterOwnersList();
 
    // var filter = $("#select_owner option:selected").val();
    //   if(filter == "Без фильтра"){
    //       $("#Accounts").find(".owners").each(function(){
    //       $(this).parent().css('display', '');
    //       });
    //   }
    //   else{
    //       $("#Accounts").find(".owners").each(function(){
    //           if($(this).text() == filter){
    //             $(this).parent().css('display', '');
    //             }
    //             else{
    //              $(this).parent().css('display', 'none');
    //             }
    //       });
    //       } 


    // var filter = $("#select_owner option:selected").val();
    // var filterArr = [];
    // $("#_filter_owner ul li span").each(function(){
      
    //   filterArr.push($(this).text());
      
    // });
    
    // if(filterArr.includes(filter) != 1){
    // $('#_filter_owner ul').append(`<li style="float: left; width:100px; border: 2px solid Yellow;"><span>${filter}</span><button style="float:right;">X</button></li>`);
    
    // }
    // else{
    //   alert('такой уже есть');
    // }
  }
  function chooseOptionCheckbox(){
    filterObject.createFilterCheckboxList();
  }
  function destroyElemOwner(){
    var elem = event.target.parentElement;
    filterObject.destroyElemFilterListOwners(elem);
  }
  function destroyElemCheckbox(){
    var elem = event.target.parentElement;
    filterObject.destroyElemFilterListCheckbox(elem);
  }
  function applyFilter(){
    filterObject.applyFilter();
  }
  
  // function makeObject(){
  //   var objectFilter = {owners:'',
  //                       checkboxes:''};
  //   console.log(objectFilter);
  //}
  function showTableADS(){
   
   var idAccountsSelected =[];
    if($("table_accounts").css('display','')){
        var checkedRows = $("#Accounts tr").find(".chooseAcc:checked");
        if(checkedRows.length < 1){
          alert("Аккаунты не выбраны");
        }
        else{
           //var BusinessManagers = checkedRows.parents("tr");
           checkedRows.parents("tr").each(function(){
             idAccountsSelected.push($(this).find(".account_names").text());
             
           });
      
    
           console.log(JSON.stringify({acc_name : idAccountsSelected}));

           makeTableACT(idAccountsSelected);

           $("#table_accounts").css('display','none');
           $("#table_ADS").css('display','');
           
           
         }
    }
  }
  function showTableAccounts(){
    if($("#table_accounts").css('display','none'))
      $("#table_accounts").css('display','');
      $("#table_ADS").css('display','none');
  }
  function makeTableACT(idAccountsSelected){
          fetch("/getADSs", {
          headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token
          },
          method: "POST",
          credentials: "same-origin",
          
          body: JSON.stringify({acc_name : idAccountsSelected}),
          })
         // .then(res => res.json())
          .then(function(response){
           return response.json();
          })
          .then(function(data){
           // data => obj = data;
            return obj = data;
          })
          .then(function(){
         
            $('#ACT').append(
              `<tbody>${obj.map(n =>
                `<tr style="text-align: center"> 
                 <td></td> 
                 <td>${n.account_name}</td> 
                 <td>${Object.values(n.business_manager).map(n => n.a_c_t.map(n => `<p>${n.act_id}</p>`))}</td>
                 </tr>`)}  
              </tbody>`
            );
          })      
      }
  
  

      
</script>
</html>
  <!--                     $('#ACT').append(
  `<tbody>${data.map(n =>
    `<tr>
      <td>${n.title}</td>
      <td>${n.director}</td>
      <td>${n.year}</td>
      <td>${Object.values(n.photo).map(n => `<img src="${n}">`).join('')}</td>
    </tr>`).join('')}
  </tbody>`
);  -->
//передаем в контроллер имена аккаунтов

//по аккаунтам забираем имена БМов

//по бмам забираем имена рекламмных аккаунтов

//отдаем записи в таблицу на морде

Перем АссоциативныйМассив = ['0'=> Андрей1()=>бм1([имя])=>РА1([имя],[спенд])
                                                          РА2([имя],[спенд])
                                                           РА3([имя],[спенд])

                                              бм2()=>РА1([имя],[спенд])
                                                     РА2([имя],[спенд])
                                                     РА3([имя],[спенд])

                                              бм3()=>РА1([имя],[спенд])
                                                     РА2([имя],[спенд])
                                                     РА3([имя],[спенд])



                             '1'=>Андрей1()=>бм1()=> РА1([имя],[спенд])
                                                     РА2([имя],[спенд])
                                                     РА3([имя],[спенд])

                                            бм2()=>РА1([имя],[спенд])
                                                     РА2([имя],[спенд])
                                                     РА3([имя],[спенд])

                                            бм3()=>РА1([имя],[спенд])
                                                     РА2([имя],[спенд])
                                                     РА3([имя],[спенд])
                                  
                           
                                  
foreach(массивСИменнамиАккаунтов as имяАккаунта){
  
}