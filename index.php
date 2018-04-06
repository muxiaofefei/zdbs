<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" href="compiled/flipclock.css">

<script src="jquery.min.js"></script>
<script src="compiled/flipclock.js"></script>

<!-- 时钟 -->
<div class="htmleaf-content">
    <div class="clock" style="margin:2em;"></div>
</div>

<!-- 音乐播放器 -->
<audio id="myaudio" src= controls="controls" hidden="true" >
</audio>

<?php 
	error_reporting(0);
	$hour = $_POST['hour'] ? $_POST['hour'] : "-1";
	$minute = $_POST['minute'] ? $_POST['minute'] : "-1";
	if($hour != -1 && $minute != -1){
		echo "<div id='xs'>您设置了".$hour."时".$minute."分的闹钟";
 		echo "倒计时<span id='countdown'></span>秒</div>";
 	}	
 ?>

<form method="post" action="index.php">
	设置闹钟：
	<select name="hour" id="hour">
		<?php for ($i=0;$i<25;$i++): 
				if($i<10):
					$i = '0'.$i;
				endif;
		?>
			<option value="<?= $i?>"><?= $i ?></option>
		<?php endfor; ?>
	</select>

	<select name="minute" id="minute">
		<?php for ($i=0;$i<61;$i++): 
					if($i<10):
						$i = '0'.$i;
					endif;
		?>
			<option value="<?= $i?>"><?= $i ?></option>
		<?php endfor; ?>
	</select>
	
	<button type="submit">提交</button>
</form>


<script type="text/javascript">
	if(<?=$hour ?> != -1 && <?=$minute ?> != -1){
		document.getElementById('hour').value = '<?=$hour ?>';
		document.getElementById('minute').value = '<?=$minute ?>';
	}
</script>

<!-- 整点报时 -->
<script type="text/javascript">
	
    <!--
    //整点报时器方法
    function hourReport() {
        //当前时间
        var time = new Date();
        // alert(time);
        //小时
        var hours = time.getHours();
        if(hours<10){
            hours = '0'+hours;
        }
        //分钟
        var mins = time.getMinutes();
        //秒钟
        var secs = time.getSeconds();
        //下一次报时间隔
        var next = ((60 - mins) * 60 - secs) * 1000;
        //设置下次启动时间
        setTimeout(hourReport, next);

        //播放闹钟音乐
        function nclock(){
        	var myAuto = document.getElementById('myaudio');
            myAuto.src = "./yyzdbssc/513.wav";
            myAuto.play();
        }
        var nhour = <?=$hour?>-hours; //时
        var nminute = <?=$minute?>-mins; //分
        if(nhour<0){nhour = nhour + 24}; //闹钟时间小于当前时间
        if(nhour==0 && nminute<0){nminute = nminute + 60;nhour=23};//闹钟时间小于当前时间
        if(nhour==0 && nminute==0){nhour=24};//闹钟时间等于当前时间
        var countdown =(nhour * 3600 + nminute * 60 - secs) * 1000;
        // console.log(countdown);
        if(countdown>0){
        	setTimeout(nclock, countdown);
        	countdown=countdown/1000;
			setInterval(function(){
				countdown--;
				if(countdown>=0){
					document.getElementById('countdown').innerHTML = countdown;
				}else{
					document.getElementById('xs').innerHTML = "闹铃结束";
				}
			},1000);
		}

        //整点报时，因为第一次进来mins可能不为0所以要判断
        if (mins == 0 && secs == 0) {
            var myAuto = document.getElementById('myaudio');
            myAuto.src = "./yyzdbssc/0"+hours+".wav";
            myAuto.play();
        }
        
    }

    //启动报时器
    hourReport();
    //-->
</script>

<!-- 时钟 -->
<script type="text/javascript">
    var clock;

    $(document).ready(function() {
        clock = $('.clock').FlipClock({
            clockFace: 'TwentyFourHourClock'
        });
    });
</script>
