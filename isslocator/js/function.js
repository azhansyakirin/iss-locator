function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

function myFunction() 
{  
  document.getElementById("demo").innerHTML = String(document.getElementById("isstime").value);
  var myDate = String(document.getElementById("isstime").value);
  let d = document.getElementById("isstime").value;
  document.getElementById("demo").innerHTML = (d * 1);

      }  

      function toTimestamp(){
       
        strDate = String(document.getElementById("isstime").value);
        var datum = Date.parse(strDate);
        var d = datum/1000;

        //document.getElementById("demo").innerHTML = d;

        const time = [];
        time[6] = d ;
        
        for (let j = 5; j >= 0 ; j--) {
          time[j] = time[j+1]-600;
        }
        for (let t = 7; t <= 12; t++) {
          time[t] = time[t-1]+600;
        }
        console.log(time);
        
        for(let i = 0; i<time.length;i++){
          var mainContainer = document.getElementById("demo");
          var div = document.createElement("div");
          div.innerHTML =i+'. '+time[i]
         mainContainer.appendChild(div);
        }
        for(var h = 0; h<time.length;h++){
          console.log(h+'atas');

        fetch('https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps='+time[1]+'&units=miles')
        .then(function (response) {
        console.log();
        return response.json();
        })
        .then(function (data) {
        appendData(data);
        })
        .catch(function (err) {
        console.log(err);
        div.innerHTML ='Sorry the time is not recorded';
        });
        console.log(h);
        }
     }

     

      function appendData(data,h) {
       
      var mainContainer = document.getElementById("myData");

      var tableHead = document.createElement("thead");
      tableHead.innerHTML = "<table><tr><thead><th><center>Name</center></th><th><center>Latitude</center></th><th><center>Longitude</center></th></thead></tr>"
       
      
      for (var i = 0; i < data.length; i++) {

       
        var tableBody = document.createElement("tbody");
        tableBody.innerHTML = "<tr><td>" + data[i].name + ' ' + data[i].id +"</td><td>" + data[i].latitude + "</td><td>" + data[i].longitude+ "</td></tr></table>";
        // 'Name: ' + data[i].name + ' ' + data[i].id + 
        // '<br>Latitude:' + data[i].latitude + 
        // '<br>Longtitude:' + data[i].longitude ;
        mainContainer.appendChild(tableBody);

        // async function loadTable(url, table) {
        //   const tableHead = table.querySelector("thead");
        //   const tableBody = table.querySelector("tbody");
        //   const response = await fetch('https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps='+time[1]+'&units=miles');
        //   const { headers, rows } = await response.json();

        //   console.log(data);
        // }

        // loadTable("./data.json", document.querySelector("table"));
        
       
      }
    }
    
  
