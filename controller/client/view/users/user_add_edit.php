<?php

// Данный код создан и распространяется по лицензии GPL v3
// Изначальный автор данного кода - Грибов Павел
// http://грибовы.рф

include_once ("../../../../config.php");                    // загружаем первоначальные настройки

// загружаем классы

include_once("../../../../class/sql.php");               // загружаем классы работы с БД
include_once("../../../../class/config.php");		// загружаем классы настроек
include_once("../../../../class/users.php");		// загружаем классы работы с пользователями
include_once("../../../../class/employees.php");		// загружаем классы работы с профилем пользователя


// загружаем все что нужно для работы движка

include_once("../../../../inc/connect.php");		// соеденяемся с БД, получаем $mysql_base_id
include_once("../../../../inc/config.php");              // подгружаем настройки из БД, получаем заполненый класс $cfg
include_once("../../../../inc/functions.php");		// загружаем функции
include_once("../../../../inc/login.php");		// логинимся

$step = _GET("step");
$id   = _GET("id");
$login   = _POST("login");
$email   = _POST("email");
$pass   = _POST("pass");
$mode=0;
if ($user->mode=="1") {
    
if ($step=="edit"){    
                $tmpuser=new Tusers;
                $tmpuser->GetById($id);                
                $orgid=$tmpuser->orgid;
                $login=$tmpuser->login;
                $pass=$tmpuser->pass;
                $email=$tmpuser->email;
                $mode=$tmpuser->mode;
                unset($tmpuser);
  };    
?>
 
 <script>
 $(function(){
        var field = new Array("login", "pass", "email");//поля обязательные                 
        $("form").submit(function() {// обрабатываем отправку формы    
            var error=0; // индекс ошибки
            $("form").find(":input").each(function() {// проверяем каждое поле в форме
                for(var i=0;i<field.length;i++){ // если поле присутствует в списке обязательных
                    if($(this).attr("name")==field[i]){ //проверяем поле формы на пустоту                        
                        if(!$(this).val()){// если в поле пустое
                            $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                            error=1;// определяем индекс ошибки                                                               
                        }
                        else{
                            $(this).css('border', 'gray 1px solid');// устанавливаем рамку обычного цвета
                        }
                        
                    }               
                }
           })           
            if(error==0){ // если ошибок нет то отправляем данные
                return true;
            }
            else {
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $("#messenger").addClass("alert alert-error");
            $("#messenger").html(err_text);
            $("#messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
            }                                       
        })
    });
    
$(document).ready(function() { 
            // навесим на форму 'myForm' обработчик отлавливающий сабмит формы и передадим функцию callback.
            $('#myForm').ajaxForm(function(msg) {                 
                if (msg!="ok"){
                    $('#messenger').html(msg); 
                } else {
                    $('#add_edit').html(""); 
                    $("#add_edit" ).dialog( "destroy" );
                    jQuery("#list2").jqGrid().trigger('reloadGrid');
                };
                
            }); 
        }); 
        
</script>
<div id="messenger"></div>    
<form id="myForm" class="well" ENCTYPE="multipart/form-data" action="controller/server/users/libre_users_form.php?step=<?php echo "$step&id=$id"; ?>" method="post" name="form1" target="_self">
 <span class="help-block">Организация:</span>
 <select name=orgid>
<?php
  $morgs=GetArrayOrgs();
  for ($i = 0; $i < count($morgs); $i++) { 
   $idorg=$morgs[$i]["id"];
   $nameorg=$morgs[$i]["name"];
 ?>  
   <option <?php if ($idorg==$cfg->defaultorgid){echo "selected";}; ?> value=<?php echo "$idorg";?>><?php echo "$nameorg"; ?></option>
 <?php };?>     
 </select>
         <select name=mode>
            <option value=0 <?php if ($mode==0) {echo "selected";};?>>Пользователь</option>
            <option value=1 <?php if ($mode==1) {echo "selected";};?>>Администратор</option>
        </select>
 
 <div class="well form-inline">
    <input placeholder="Логин" name="login" id="login" value="<?php echo "$login";?>">
    <input placeholder="Пароль" name="pass" id="pass"  TYPE=PASSWORD value="<?php echo "$pass";?>">
    <input placeholder="Email" name="email" id="email" size=16 value="<?php echo "$email";?>"> 
 </div>
 <div align=center><input type="submit"  name="Submit" value="Сохранить"></div> 
</form> 
<?php    
} else echo "Нужны права администратора!";
?>