D<!DOCTYPE HTML>
<html>
<head>
 <!-- CSS dependencies -->
<link type="text/css" rel="stylesheet" href="css/bootstrap.css">

</head>
<body>

<!------------------------------------------------------------------>
<div id="header">
    <img src="img/AKSW_Logo.png" >
    <img src="img/latc-logo.gif" >
</div>
<div class="well well-large">
<p align="justify">
<b>
	
This page presents a linksets inventory as an addition to Quality Assurrance Dashboard. The data of the linkset inventory are derived from the Linkset API 
(http://linker.sindice.com/runtime-results/). <br>
The provided information include:  link-set,source dataset,target dataset,interlinnking	type,number of triples, and downloads.In downloads the specifications and links files
for the link-set are accessed.

</b>
</p>
</div>

<br>
<form id="linksTablesfrm2" class="well span20" >
	<div id= "linksTablesdiv" class="span3">
		<table id="tbll" class="table table-bordered table-hover">
			<thead>
				<col width="50">
				<col width="50">
				<col width="50">
				<col width="50">
				<col width="50">
				<col width="50">
				<tr>
					<th>Task name</th>
					<th>Source</th>
					<th>Target</th>
					<th>Type</th>
					<th>Triples No</th>
					<th>Date</th>
					<th>Downloads</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</form> 
<br>

 <!-- JS dependencies -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.fileDownload.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">

</script>

 <script type="text/javascript">
     var totallinks =0;
	function init() 
	{
		var numberOfAttributes= 11;
		$.get("http://localhost/linkqa/summary", function(json) 
		{// the get function connects to the service running on the specied url and the retrieved information will passed to it as "json" 
			var myJSONObject = JSON.parse(json);  // assign json to an object
			//alert(myJSONObject.data.length);
			//alert(myJSONObject.data[5000].FileName);
			//create two dimensional array for storing the list of retrieved information in 'json'
		/*	var info = new Array(myJSONObject.data.length);  //number of rows equals number of interlinking tasks
			for (var i = 0; i < myJSONObject.data.length; i++) 
				info[i] = new Array(numberOfAttributes);  // for each interlinking task there is X attributes
				
			for(var i=0; i<myJSONObject.data.length;i++)
			{				
				info[i][0]=myJSONObject.data[i].taskSetName;// the spec file that contains most the information
				info[i][1]=myJSONObject.data[i].Source;// the source dataset
				info[i][2]=myJSONObject.data[i].Target;//the target dataset
				info[i][3]=myJSONObject.data[i].LinkingType;//the linking type whether sameAs,relatedTo,...
				info[i][4]=myJSONObject.data[i].TriplesNo;// number of linking triples (extracted from void file)
				info[i][5]=myJSONObject.data[i].revisionDate;// the date the linking task created (which is the parent folder name of it)
				info[i][6]=myJSONObject.data[i].SourceEndpoint;// the endpoint of the source dataset
				info[i][7]=myJSONObject.data[i].TargetEndpoint;//the endpoint of the target dataset
				info[i][8]=myJSONObject.data[i].FileName;// the name of the task set (extracted from the folder name)
				info[i][9]=myJSONObject.data[i].linksFile;// the file that contains the created links (links.nt)
				info[i][10]=myJSONObject.data[i].taskSetPath;// the path of the taskset over latc website
			}*/
			
			var infoArray=[];
			for(var i=0; i<myJSONObject.data.length;i++)
			{
			//	infoArray.push({FileName:myJSONObject.data[i].FileName,Source:myJSONObject.data[i].Source,Target:myJSONObject.data[i].Target,
			//	LinkingType:myJSONObject.data[i].LinkingType,TriplesNo:myJSONObject.data[i].TriplesNo,revisionDate:myJSONObject.data[i].revisionDate});
			infoArray[i]={FileName:myJSONObject.data[i].FileName,Source:myJSONObject.data[i].Source,Target:myJSONObject.data[i].Target,
				LinkingType:myJSONObject.data[i].LinkingType,TriplesNo:myJSONObject.data[i].TriplesNo,revisionDate:myJSONObject.data[i].revisionDate,
				taskSetName:myJSONObject.data[i].taskSetName,linksFile:myJSONObject.data[i].linksFile};
			} 
			createDynamicTable2($("#tbll"),infoArray);
	//		createDynamicTable($("#tbll"),info);

		});        
	}

        
	 $(document).ready(function() 
	 {
				init();
				
	 });// The end of document load function
		
 // This function creates dynamically a table with the specified number of rows and columns
  	function createDynamicTable(tbody, info) 
  	{
					
			if (tbody == null || tbody.length < 1) return; //check number of rows and columns
			alert(info.length);
			for (var r = 0; r < info.length; r++) 
			{ //for each row
               var trow = $("<tr class=\"info\">");	//create row open tag
               var lblele=$("<label id="+cellText+">1</label>");	//create inside it a label with id equals the specified text
               for (var c = 0; c < info[r].length-5; c++) // the -value part is to stop getting moreattributes to be displayed , the important attributes are added to the two dimension array in the beginning
               {
                   var cellText = info[r][c];		//contents + r + "." + c  ;
                   $("<td  title=\"A text feild\">").addClass("tableCell").text(cellText).data("col", c).appendTo(trow); //put a text inside the cell
               }
				// here the two buttons download two files where the data exist online and their url are stored in attributes number 9 and 8
               var btnele=$("<input type=\"button\" value =\"links \"  class=\"btn btn-primary\"  onClick=\"window.location.href='"+info[r][9]+"'\"/>"+
               "  <input type=\"button\" value =\"Specs \"  class=\"btn btn-primary\"  onClick=\"window.location.href='"+info[r][8]+"'\"/>");
               btnele.appendTo($("<td>").appendTo(trow));
              trow.appendTo(tbody);
            }
            ocument.getElementById("total").value = totallinks;
      } 
      
      
    function createDynamicTable2(tbody,infoArray) 
  	{
					
			if (tbody == null || tbody.length < 1) return; //check number of rows and columns
			for (var r = 0; r < infoArray.length; r++) 
			{ 
				//prepare data
				var row=infoArray[r];
				var taskname= row.taskSetName ?  row.taskSetName : ""; // this gets the text value instead of JSON.stringify(infoArray[r].taskSetName, null, 4) that returns string with double qoutes
				var source= row.Source ?  row.Source : "";
				var target= row.Target ?  row.Target : "";
				var linkingtype= row.LinkingType ?  row.LinkingType : "";
				var triplesno= row.TriplesNo ?  row.TriplesNo : "";								
				var revisiondat= row.revisionDate ?  row.revisionDate : "";
				totallinks+=triplesno;
				//for each row 
               var trow = $("<tr class=\"info\">");	//create row open tag
               $("<td width= \"5%\" title=\"Task Name\">").addClass("tableCell").text(taskname).data("col", 0).appendTo(trow);
               $("<td width= \"5%\" title=\"Source\">").addClass("tableCell").text(source).data("col", 1).appendTo(trow);
               $("<td width= \"5%\" title=\"Target\">").addClass("tableCell").text(target).data("col", 2).appendTo(trow);
               $("<td width= \"5%\" title=\"Linking Type\">").addClass("tableCell").text(linkingtype).data("col", 3).appendTo(trow);
               $("<td width= \"5%\" title=\"TriplesNo\">").addClass("tableCell").text(triplesno).data("col", 4).appendTo(trow);
               $("<td width= \"5%\" title=\"Revision Date\">").addClass("tableCell").text(revisiondat).data("col", 5).appendTo(trow);
					
				var links= infoArray[r].linksFile;
				var specs = infoArray[r].FileName;
			
			
			
			
               var btnele=$(" <input type=\"button\" value =\"Links   \"  class=\"btn btn-primary\"  onClick=\"window.location.href='"+links+"'\"/>"+
               " <br> <input type=\"button\" value =\"Specs \"  class=\"btn btn-primary\"  onClick=\"window.location.href='"+specs+"'\"/>");
               btnele.appendTo($("<td>").appendTo(trow));
              trow.appendTo(tbody);
            }
           // alert("finish loading all link tasks");
            document.getElementById("tot").value = totallinks;
      } 
   

</script>
<br>
<center>
<table border="1">
  
  <tr>
    <td><label id="totallbl"> <b> The total number of links: </b></label></td>
    <td><input type="" id="tot" name="first_name" value="" maxlength="200" readonly /></td>

    <a href="download.php?file=http://linker.sindice.com/runtime-results/2011-02-10/dbpedia-lgd_airport.xml/links.nt">Download the cool PDF.</a>
    <a href="http://www.hyperlinkcode.com">Hyperlink Code</a>

    
  </tr>
</table>
 </center>
</body>
</html>
