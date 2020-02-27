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
   status : {}, // статус код, возвращается функцией вызова сервера
   message : {}, // запрашиваемые данные, возвращается функцией вызова сервера
     /* Функция получает status и message от сервера -> вызывает функцию обработки результата
       @param {url} string.
       @param {method} string.
       @param {data} array.
       @param {returnData} function. 
       @return Вызов функции returnDataFunc с object параметром.
    */
    fetchData :  function(url, method, data = null, handleRequestData, elem){
        fetch(url, {
           headers: {
           'Accept': 'application/json',
           'Content-Type': 'application/json',
           "X-CSRF-Token": token
           },
           method: method,
           body: data,
           credentials: "same-origin",
        })
        .then(function(response){
          //status = response.status;
          status = response.status;
          return response.json();
        })
        .then(function(response){
          message = response;
          handleRequestData({status : status, message : message}, elem);
        })     
    },
   /* Функция инициализирует заполнение поле владелец формы создания аккаунта
      @return Ничего.
   */
   showCreateAccounts : function(url, method){
       // let status = {};
       // let message = {};
       var url =  url;
       var method = method;
       var data;
       $('#modalCreateAccounts').modal('show');
              if($('#selectOwners option').length == 0){
                sendFormAccountsProxy.fetchData(url, method, data, handleRequestData);

                /* Функция парсит option-ы в поле владелец формы создания аккаунта
                   @param {object} данные для парсинга (status, message).
                   @return Ничего.
                */
                function handleRequestData(data){
                  console.log(data.message);
                  $('#selectOwners').append(
                  data.message.map(n =>`<option name="ownerName" class="_accountFormInputOwner">${n.name}</option>`));
                }   
      }

    },

  

    submitFormAccountProxy : function(elem, url, method){ 
      $("#modalUpdateAccounts")
       
       var urlRequest = url;
       var method = method;    
       var data = {};
       data.ownerName = $('#'+elem+'').find("select option:selected").text();
       data.BillingInUse = $('#'+elem+'').find(".checkbox").is(':checked');
      $('#'+elem+'').find('._accountFormInputs').each(function() {
        data[this.name] = $(this).val();
      });
      data = JSON.stringify(data);
      $('#'+elem+'').find(".outputSpan").remove();
      console.log(data);
      //$("#errorsOutput").css('display', 'none');
      sendFormAccountsProxy.fetchData(url, method, data, handleRequestData, elem);
      function handleRequestData(data, elem){
          if(data.status == 422){
            $('#'+elem+'').find(".errorsOutput").css('display', '');
            for(key in data.message.errors){
                $('#'+elem+'').find(".errorsOutput").append(`<span class="outputSpan" style="color:red;display: flex;flex-direction: column">${key} - ${data.message.errors[key]}</span`);
            }
          }
          if(data.status == 200){ 
            $('#'+elem+'').find(".errorsOutput").css('display', '').append(`<span class="outputSpan" style="color:green;">Успешно</span>`);
             

          }
      }
    },
    EditAccountProxy : function(elem, url, method){
      $("#modalUpdateAccounts input").val('');
      var url = url;
      var method = method;
      var data;
      $(".errorsOutput").css('display', 'none');
      $("._accountFormInputOwner").remove();   
      var formNameValue;
      sendFormAccountsProxy.fetchData(url, method, data, handleRequestData, elem);
      function handleRequestData(data, elem){
        var arrOwners = [];
        for(key in data.message.ownersResponse){
        arrOwners.push(data.message.ownersResponse[key].name);      
        }
        $('#selectOwnersEdit').append(arrOwners.map(n=>`<option name="ownerName" class="_accountFormInputOwner">${n}</option>`));
       
        formNameValue = {
          'accountID' : data.message.accountResponse[0].id,
          'accountName' : data.message.accountResponse[0].account_name,
          'keitaroID' : data.message.accountResponse[0].keitaro_comp_id,
          'tokenFB' : data.message.accountResponse[0].token_fb,
          'ownerName' : data.message.accountResponse[0].owners.name,
          'BillingInUse' : data.message.accountResponse[0].BillingInUse,
          'statusID' : data.message.accountResponse[0].status_id,
         
        };
        if(data.message.accountResponse[0].proxyes !== null){
          
          formNameValue.proxyIP = data.message.accountResponse[0].proxyes.ip;
          formNameValue.proxyPort = data.message.accountResponse[0].proxyes.port;
          formNameValue.proxyLogin = data.message.accountResponse[0].proxyes.login;
          formNameValue.proxyPassword = data.message.accountResponse[0].proxyes.password;
          formNameValue.proxyType = data.message.accountResponse[0].proxyes.proxy_type;
        }
        console.log(formNameValue);
          for(key in formNameValue){
          if(key == 'ownerName'){
            console.log(formNameValue[key]);
            $('#selectOwnersEdit :contains('+formNameValue[key]+')').attr("selected", "selected");
          }
          else if(key == 'BillingInUse'){
            if(formNameValue[key] == 1){
              console.log( $('#modalUpdateAccounts').find('.checkbox'));
              $('#modalUpdateAccounts').find('.checkbox').prop('checked', true);
            }
            else{
              $('#modalUpdateAccounts').find('.checkbox').prop('checked', false);
            }

          }
          else{
              $("#modalUpdateAccounts").find("[name="+key+"]").val(formNameValue[key]);
          }

        }
        $('#modalUpdateAccounts').modal('show');   
      }
    },

    // EditAccountProxy : function(elem, url, method){
    //   var url = url;
    //   var method = method;
    //   var data;
    //   $(".errorsOutput").css('display', 'none');
    //   $("._accountFormInputOwner").remove();  
    //     //.siblings().find('.account_names'));
    //   var formNameValue;
    //   sendFormAccountsProxy.fetchData(url, method, data, handleRequestData, elem);

    //   function handleRequestData(data, elem){
    //     var arrOwners = [];
    //     for(key in data.message.ownersResponse){
    //       arrOwners.push(data.message.ownersResponse[key].name);
    //     }
    //     $('#selectOwnersEdit').append(arrOwners.map(n=>`<option name="ownerName" class="_accountFormInputOwner">${n}</option>`));
    //     console.log(data);
    //     formNameValue = {
    //      'accountID' : data.message.accountResponse[0].id,
    //      'accountName' : data.message.accountResponse[0].account_name,
    //       'keitaroID' : data.message.accountResponse[0].keitaro_comp_id,
    //       'tokenFB' : data.message.accountResponse[0].token_fb,
    //       'ownerName' : data.message.accountResponse[0].owners.name,
    //       'proxyIP' : data.message.accountResponse[0].proxyes.ip,
    //       'proxyPort' : data.message.accountResponse[0].proxyes.port,
    //       'proxyLogin' : data.message.accountResponse[0].proxyes.login,
    //       'proxyPassword' : data.message.accountResponse[0].proxyes.password,
    //       'proxyType' : data.message.accountResponse[0].proxyes.proxy_type,
    //     };  
    //     for(key in formNameValue){
    //       if(key == 'ownerName'){
    //         console.log(formNameValue[key]);
    //         $('#selectOwnersEdit :contains('+formNameValue[key]+')').attr("selected", "selected");
    //       }
    //       else{
    //         $("#modalUpdateAccounts").find("[name="+key+"]").val(formNameValue[key]);
    //       }
    //     } 
      
    //     $('#modalUpdateAccounts').modal('show');
    //   }
    // }
  

     deleteGroupObject : {   url : '',
                            method : '',
                            elem : '',
                            data : null,
                            showModalDelete : function(){ 
                              $('#modalDelete').modal('show');
                              $('.outputSpan').remove();
                              console.log(this.url, this.method);
                            },

                            submitDeleteAccount : function(){
                              $('#infoResponse').find('.outputSpan').remove();
                              sendFormAccountsProxy.fetchData(this.url, this.method, this.data, handleRequestData, this.elem);
                              function handleRequestData(data, elem){
                                console.log(data.status);
                                if(data.status == 200){
                                  $('#infoResponse').append(`<span class="outputSpan" style="color:green;">Аккаунт успешно удален</span`);
                                }
                                else{
                                   $('#infoResponse').append(`<span class="outputSpan" style="color:red;">Произошла внутренняя ошибка</span`);
                                }
                              }
                            },
    

      }
}

    


    //   fetch("/accounts/"+ url, {
    //             headers: {
    //             'Content-Type': 'application/json',
    //             "X-CSRF-Token": token
    //             },
    //             method: method,
    //             credentials: "same-origin",
    //             })
    //             .then(function(response){
    //               if (response.ok){
    //                 console.log("ok");
    //                 $('#infoResponse').append(`<span class="outputSpan" style="color:green;">Аккаунт успешно удален</span`);
    //               }
    //               if (!response.ok){
    //                 console.log("not ok");
    //                 $('#infoResponse').append(`<span class="outputSpan" style="color:red;">Произошла ошибка</span`);
    //               }
                  
    //               })
    // },
    // }
      
         
                                                                                                      

////////////////////////////////////////////////////

  function openFormAccountProxy(){
    var url = 'accounts/create';
    var method = 'GET';
    sendFormAccountsProxy.showCreateAccounts(url, method);
  } 

   function openFormAccountProxyUpdate(){
      var elem = event.target;
      var url = '';
      var method = 'GET';
      elem = $(elem).parents("td").siblings(".account_names").text();
      url = "accounts/"+ elem +"/edit";
      sendFormAccountsProxy.EditAccountProxy(elem, url, method);
  }   

  function submitFormStore(){
      var elem = event.target;
      var url = '';
      var method = 'POST';
      elem = $(elem).parent("div").siblings("form").attr("id");
      url = 'accounts' 
    sendFormAccountsProxy.submitFormAccountProxy(elem, url, method);
  }

  function submitFormUpdate(){
      var elem = event.target;
      console.log(elem);
      var url = '';
      var method = 'PATCH';
      elem = $(elem).parent("div").siblings("form").attr("id");
      url ='accounts/' + elem;
      console.log(url);
    sendFormAccountsProxy.submitFormAccountProxy(elem, url, method);
  }

  function openModalAccountProxyDelete(){
    var elem = event.target;
    var url = '';
    var method = 'DELETE';
    elem = $(elem).parents("td").siblings(".account_names").text();
    sendFormAccountsProxy.deleteGroupObject.url = 'accounts/' + elem;
    sendFormAccountsProxy.deleteGroupObject.method = method;
    sendFormAccountsProxy.deleteGroupObject.elem = elem;
    sendFormAccountsProxy.deleteGroupObject.showModalDelete();
  }

  function recieveAccountsFromFBToll(){
        fetch('/getAccountsFBtool', {
           headers: {
           'Accept': 'application/json',
           'Content-Type': 'application/json',
           "X-CSRF-Token": token
           },
           method: 'GET',
           credentials: "same-origin",
        })
        .then(function(response){
          //status = response.status;
          status = response.status;
          return response.json();
        })
        .then(function(response){
          message = response;
          console.log(message);
          alert('Аккаунтов добавлено ' + message.newAccounts + '\r\n'+ 'Аккаунтов обновлено ' + message.updatedAccounts +  '\r\n' + 'Страница будет перезагружена');
          window.location = 'API';
        })     
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
