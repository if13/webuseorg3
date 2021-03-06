/* 
 * (с) 2011-2015 Грибов Павел
 * http://грибовы.рф * 
 * Если исходный код найден в сети - значит лицензия GPL v.3 * 
 * В противном случае - код собственность ГК Яртелесервис, Мультистрим, Телесервис, Телесервис плюс * 
 */


addOptions={
    top: 100, left: 100, width: 500
};   

function ViewMufts(){    
    jQuery("#list2").jqGrid({
            url:'controller/server/cables/mufts.php?orgid='+defaultorgid,
            datatype: "json",
            colNames:['Id','Имя','Комментарий','Действия'],
            colModel:[   		
                    {name:'id',index:'id', width:55},
                    {name:'name',index:'name', width:200,editable:true},
                    {name:'comment',index:'comment', width:200,editable:true},
                    {name:'myac', width:80, fixed:true, sortable:false, resize:false, formatter:'actions',formatoptions:{keys:true}}
            ],
            autowidth: true,			
            rowNum:10,	   	
            pager: '#pager2',
            sortname: 'id',
            scroll:1,
            height: 140,
        viewrecords: true,
        sortorder: "asc",
        editurl:'controller/server/cables/mufts.php?orgid='+defaultorgid,
        caption:"Муфты"  
    });   
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:true,add:true,del:true,search:false},{},addOptions,{},{multipleSearch:false},{closeOnEscape:true} );
};
$( document ).ready(function() {
    ViewMufts();
});