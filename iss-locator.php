<section class="isslocator">

    <div id="infoi" class="container" style="width: 90%;">
    	<form action="toTimestamp.php" method="post">
    		<h2>Find ISS here !</h2>
	    	<input  type="datetime-local" name="issDatetime" value="<?php echo $getTime ?>">
	    	<p id="help-box">Select Date</p>
	    	<button  class="btn" type="submit">Check</button>

    	</form>
    </div>

</section>