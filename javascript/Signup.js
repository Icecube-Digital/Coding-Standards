
//
//	-------------------------- To get country , state , city combobox -------------------------------
//

if (window.XMLHttpRequest) 			
	http = new XMLHttpRequest();
else if (window.ActiveXObject) 
	http = new ActiveXObject("Microsoft.XMLHTTP");
			
function GetStateCombo(CountryId) 
{    
	$('#spinner').css('display','block');
	//document.getElementById('cmbcity').value = 'Enter City';
	if(CountryId!=0) {
		var url = 'ComboAjax.php?do=getstatecombo&cmbcountry=' + CountryId;
		http.open("GET", url, true);
		http.send(null);
		http.onreadystatechange = GetStateResult;
	}else if(CountryId == '' || CountryId == null){
		document.getElementById('cmbstate').innerHTML = '<option value="">-- Select --</option>';
		$('#spinner').css('display','none');
	}else{
		document.getElementById('cmbstate').innerHTML = '<option value="">-- Select --</option>';
		$('#spinner').css('display','none');
	}
	$('#spinner2').css('display','none');
	$('#suggestions').hide();
}

function GetStateResult() 
{
	if (http.readyState == 4) 
	{
		document.getElementById('StateList').innerHTML = http.responseText;
		$('#spinner').css('display','none');
	}
}

function GetCityCombo(StateId,CountryId) 
{			
	//document.getElementById('cmbcity').value = 'Enter City';
	$('#spinner2').css('display','none');
	$('#suggestions').hide();
}

function FitToContent(id, maxHeight)
{
   var text = id && id.style ? id : document.getElementById(id);
   if ( !text )
      return;

   var adjustedHeight = text.clientHeight;
   if ( !maxHeight || maxHeight > adjustedHeight )
   {
      adjustedHeight = Math.max(text.scrollHeight, adjustedHeight);
      if ( maxHeight )
         adjustedHeight = Math.min(maxHeight, adjustedHeight);
      if ( adjustedHeight > text.clientHeight )
         text.style.height = adjustedHeight + "px";
   }
}

//-------------------- for email validation

function checkEmailavailable(email)
{
	
	var httpxml;
	 if (window.XMLHttpRequest) 
	{
        httpxml = new XMLHttpRequest();
    }
	else if (window.ActiveXObject) 
	{
        httpxml = new ActiveXObject("Microsoft.XMLHTTP");
    }
	function stateck()
	{
		if(httpxml.readyState==4)
		{
			document.getElementById("emailMsg").innerHTML=httpxml.responseText;
			document.getElementById("emailMsg").style.display = "block";
		}
	}
	var url="email_ajax.php";
	url=url+"?email="+email;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateck;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}
