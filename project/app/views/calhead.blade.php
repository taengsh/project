<!DOCTYPE html>
<html>


<body>
<div id="panel">
<label>Destination
          <input type="text" name="destination" id="destination" class="form-control input-sm" value="">
      </label>
      <input type="button" value="Create"  onclick="calcRoute()">
  </div>
<script type="text/javascript">

function bearling(lat,lng,nlat,nlng){
          //  alert("bearingWork");
             var y = Math.sin(nlng-lng) * Math.cos(nlat);
          var x = Math.cos(lat)*Math.sin(nlat) - Math.sin(lat)*Math.cos(nlat)*Math.cos(nlng-lng);
          var bear = 360+((Math.atan2(y, x)*180)/Math.PI);
          bear=bear%360;

              return bear;
        }

</script> 

</body>
  </html>