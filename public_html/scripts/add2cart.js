var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
    var xmlHttp;
    if(window.ActiveXObject){
        try{
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlHttp = false;
        }
    }
    else{
        try{
            xmlHttp =new XMLHttpRequest();
        }catch(e){
            xmlHttp = false;
        }
    }  
        
    if(!xmlHttp)
        alert("can't create that Object Hoss!");
   else
        return xmlHttp;
}



function add2cart(p_id){
   
    if(xmlHttp.readyState==0||xmlHttp.readyState==4){
    
       
        if(document.getElementById("itemqty") != null){//this is for "add to cart" button in detail.php
            quantity=document.getElementById("itemqty").value;
        }
        else{
            quantity=1;
        }
        xmlHttp.open("GET","add2cart.php?quantity="+quantity+"&p_id="+p_id,true);
        xmlHttp.onreadystatechange = a2cHandleServerResponse;
        xmlHttp.send(null);
    }
   
    
}

function a2cHandleServerResponse(){
    if(xmlHttp.readyState==4){
        if(xmlHttp.status==200){
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            document.getElementById("itemNum").innerHTML =message;
            
        }
    }
}

function cart(p_id){
    if(xmlHttp.readyState==0||xmlHttp.readyState==4){
        
        quantity =document.getElementById("product"+p_id).value;
        xmlHttp.open("GET","changeqt.php?quantity="+quantity+"&p_id="+p_id,true);
        xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4){
        if(xmlHttp.status==200){
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            cost = xmlDocumentElement.firstChild.nextSibling.firstChild.data;
            total = xmlDocumentElement.lastChild.previousSibling.firstChild.data;
            itemNum = xmlDocumentElement.lastChild.firstChild.data;
            document.getElementById("cost"+p_id).innerHTML = '$'+ cost+'<br /><a href="delete.php?p_id='+p_id+'"><span style="font-size:13px;margin-top:15px;">Delete</a>';
           document.getElementById("total").innerHTML='Total:$'+total;
           document.getElementById("itemNum").innerHTML=itemNum;
           // setTimeout('cart()',3000);
        }
    }
            
        };
        xmlHttp.send(null);
    }
   /* else{
        setTimeout('cart()',3000);
    }*/
}
/*function changeHandleServerResponse(){
     
    }*/
