<html>
<head>
<script>
function showHotels(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","HotelName.php?q="+str,true);
xmlhttp.send();
}
function showHospitals(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","HospitalName.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<form  id="AQForm" action="AdminQueryPhp.php" method="post">
<br/>Number of Past Visits <br/>
<input type="checkbox" name="PastVisit[]" value="past_visit='0'" />0<br />
<input type="checkbox" name="PastVisit[]" value="past_visit>'1' and past_visit<'3'" />1-3<br />
<input type="checkbox" name="PastVisit[]" value="past_visit>'3'" />>3<br /> 
Age<br/>
<input type="checkbox" name="Age[]" value="age<'18'" /><18<br />
<input type="checkbox" name="Age[]" value="age>'18' and age<'60'" />18-60<br />
<input type="checkbox" name="Age[]" value="age>'60'" />>60<br />
Gender<br/>
<input type="checkbox" name="Gender[]" value="gender='male'" />Male<br />
<input type="checkbox" name="Gender[]" value="gender='female'" />Female<br /> 

No. of Dependents<br/>
<input type="checkbox" name="NoDependent[]" value="'0'=(select count(*) from dependent as d where d.pmar=a.pmar)" />0<br />
<input type="checkbox" name="NoDependent[]" value="'1'<=(select count(*) from dependent as d where d.pmar=a.pmar)<'5'" />1-5<br />
<input type="checkbox" name="NoDependent[]" value="'5'<=(select count(*) from dependent as d where d.pmar=a.pmar)<'10'" />5-10<br />
<input type="checkbox" name="NoDependent[]" value="(select count(*) from dependent as d where d.pmar=a.pmar)>='10'" />>10<br />
<input type="submit" name="formSubmit" value="Submit" />
</form>
Hotels<br/>
<form action=""> 
<select name="customers" onchange="showHotels(this.value)">
<option value="">Place:</option>
<option value="1">Bangalore</option>
<option value="2 ">Mysore</option>
<option value="3">Mangalore</option>
</select>
</form>
Hospitals<br/>
<form action=""> 
<select name="customers" onchange="showHospitals(this.value)">
<option value="">Select a Place:</option>
<option value="1">Bangalore</option>
<option value="2 ">Mysore</option>
<option value="3">Mangalore</option>
</select>
</form>
<div id="txtHint">Customer info will be listed here...</div>
</body>
</html>