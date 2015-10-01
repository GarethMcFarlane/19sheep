function getData(json){
    var l= json.body.series;
    return l;
}
function getActivityData(json){
	var l = json.body.activities;
	return l;
}

function calculateSleepsDuration(status,data){
    var duration = 0;
        for(i=0;i<data.length;++i){
        	if(data[i].state==status){
                duration+= data[i].enddate-data[i].startdate;
            }
        }
    return duration; 
}
function calculateSleepInstances(status, data){
	var instances = 0;
		for(i=0;i<night.length;++i){
			if(data[i].state == status){
				instances++;
			}
		}
	return instances;
}
function getAverageSleep(status,data){
	var result = 'average';
	var average = transferSecond(status,night);
	if(status == 0){
		result += ' Awake time is: ';
	}else if(status == 1){
		result += ' LightSleep time is: ';
	}else{
		result += ' DeepSleep time is: ';
	}
	result += average;
	return result;
}
function getDuration(time, status, data){
	var total = 0;
	for(var i=0;i<data.length;++i){
		var utcSecondsStart = data[i].startdate;
		var utcSecondsEnd = data[i].enddate;
		var dS = new Date(0);
		var dE = new Date(0);
		dS.setUTCSeconds(utcSecondsStart);
		dE.setUTCSeconds(utcSecondsEnd);
		if(time == "evening" && data[i].state == status && 21<=dS.getHours()&&dS.getHours()<=23 && 21<=dE.getHours()&&dE.getHours()<=23){
			total+=data[i].enddate - data[i].startdate;
		}
		if(time == "morning" && data[i].state == status && 0<=dS.getHours()&&dS.getHours()<=9 && 0<=dE.getHours()&&dE.getHours()<=9){
			total+=data[i].enddate - data[i].startdate;
		}
	}
	return total/3600;
}
function getInstance(time,status,data){
	var total = 0;
	for(var i=0;i<data.length;++i){
		var utcSecondsStart = data[i].startdate;
		var utcSecondsEnd = data[i].enddate;
		var dS = new Date(0);
		var dE = new Date(0);
		dS.setUTCSeconds(utcSecondsStart);
		dE.setUTCSeconds(utcSecondsEnd);
		if(time == "evening" && data[i].state == status && 21<=dS.getHours()&&dS.getHours()<=23 && 21<=dE.getHours()&&dE.getHours()<=23){
			total++;
		}

		if(time == "morning" && data[i].state == status && 0<=dS.getHours()&&dS.getHours()<=9 && 0<=dE.getHours()&&dE.getHours()<=9){
			total++;
		}
	}
	return total;
}
function getAverageDuration(time, status, data){
	if(getInstance(time,status,data)==0){
		return 0;
	}else{
		return getDuration(time,status,data)/getInstance(time,status,data);
	}
}
function getSleepScore(time,status,data){
	if(getInstance(time,status,data)==0){
		return 0;
	}
	return getDuration(time,status,data)/(getInstance(time,status,data)+(getInstance(time,0,data)*getAverageDuration(time,0,data)));
}
function getFinalSleepScore(am,pm){
	var result = am*0.25 + pm*0.75;
	result = result * 100;
	result = Math.round(result * 1000) / 1000;
	return result;
}

function totalActivityScore(data){
	var softMinutes = Math.floor(data.soft/60);
	var moderateMinutes = Math.floor(data.moderate/60);
	var intenseMinutes = Math.floor(data.intense/60);
	return softMinutes+moderateMinutes*3+intenseMinutes*10;
}
function getActivityDuration(type, json){
	var days = getActivityData(json);
	var value = 0;
	if(type == "intense"){
		value = days[6].intense/3600;
	}
	if(type == "soft"){
		value = days[6].soft/3600;
	}
	if(type == "moderate"){
		value = days[6].moderate/3600;
		}

	return value;
}
function getAllActivityDuration(type, json){
	var days = getActivityData(json);
	var total = 0;
	for(var i = 0; i < days.length;++i){
		if(type == "intense"){
			total += days[i].intense/3600;
		}
		if(type == "soft"){
			total += days[i].soft/3600;
		}
		if(type == "moderate"){
			total += days[i].moderate/3600;
		}	
	}
	return total;
}
function generateColors(threedays){
	//todo: get 6 colors to display in sleep bank. The colors would be based on 
	//sleep score for last three days. different score would generate different colors.
	//return these 6 colors in an array.
	var sixColours = [];
	var arraySize = 2;
	var red= '#E00000';
	var green='#82CA9D';
	var yellow='#FF8400';
	for(var i = 0; i < threedays.length;++i){
		var day = getData(threedays[i]);
		//for testing, printing out each value in the formula, all the printing is just for testing.
		// console.log("day"+i);
		// console.log("evening duration:"+getDuration("evening",2,day));
		// console.log("morning duration:"+getDuration("morning",2,day));
		// console.log("evening deep instances:"+getInstance("evening",2,day)+" morning deep instances:"+getInstance("morning",2,day));
		// console.log("evening awake instances:"+getInstance("evening",0,day)+" morning awake instances"+getInstance("morning",0,day));
		// console.log("evening awake avg:"+getAverageDuration("evening",0,day)+" morning awake avg"+getAverageDuration("morning",0,day));
		var pm = getSleepScore("evening",2,day);
		var am = getSleepScore("morning",2,day);
		//console.log("am score, pm score: "+am+" "+pm);
		var finalScore = getFinalSleepScore(am,pm);
		// console.log("final score:"+finalScore);
		if(finalScore <= 19.99){
			sixColours.push(red);
			sixColours.push(red);
		}else if(finalScore<=29.99 && finalScore>=20){
			sixColours.push(red);
		}else if(finalScore<=39.99 && finalScore >= 30){
			sixColours.push(yellow);
		}else if(finalScore<=49.99 && finalScore >=40){
			sixColours.push(green);
		}else{
			sixColours.push(green);
			sixColours.push(green);
		}
		if(sixColours.length<arraySize){
			sixColours.push('#d8d8d8');
		}
		arraySize+=2;
	}
	return sixColours;
}
function generateActivityColors(json, daynum){
	var colors = [];
	var arraySize = 2;
	var days = getActivityData(json);
	var red= '#F2635F';
	var green='#9CFF00';
	var yellow='#F4D00C';
	var orange='#E0A025';
	var blue='#0093D1';
	for(var i = days.length-1; i> days.length-1-daynum;--i){
		var score = totalActivityScore(days[i]);
		// for testing
		// console.log(score);
		// console.log(days[i].date);
		if(score<=19.99){
			colors.push(red);
			colors.push(red);
		}else if(score<=49.99){
			colors.push(red);
		}else if(score<=99.99){
			colors.push(orange);
		}else if(score<=149.99){
			colors.push(green);
		}else if(score<=199.99){
			colors.push(green);
			colors.push(green);
		}else if(score<=249.99){
			colors.push(blue);
		}else if(score<=299.99){
			colors.push(blue);
			colors.push(blue);
		}else if(score<=349.99){
			colors.push(yellow);
		}else{
			colors.push(yellow);
		}
		if(colors.length<arraySize){
			colors.push('#d8d8d8');
		}
		arraySize+=2;
	}
	return colors;
}
//not using anymore just for evidence, you know.
/*
function getPrevious3Days(){
	var temp = [];
	var days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
	var result = [];
	var current = new Date();
	var day = current.getDay()-1;
	if(day == 2){
		temp.push(1);
		temp.push(0);
		temp.push(6);
	}
	else if(day == 1){
		temp.push(0);
		temp.push(6);
		temp.push(5);
		
	}
	else if(day == 0){
		temp.push(6);
		temp.push(5);
		temp.push(4);
	}
	else{
		for(var i=day-1; i>day-4;--i){
			temp.push(i);	
		}
	}
	for(var i=0;i<temp.length;++i){
		result.push(days[temp[i]]);
		// console.log(result[i]);
	}

	return result;
}
*/
function getPreviousDaysName(daynum){
	var mond = {
		data: "Monday",
		pre: null
	};
	var tued = {
		data: "Tuesday",
		pre: mond
	};
	var wedd = {
		data: "Wedsday",
		pre: tued
	};
	var thud = {
		data: "Thursday",
		pre: wedd
	};
	var frid = {
		data: "Friday",
		pre: thud
	};
	var satd = {
		data: "Saturday",
		pre: frid
	};
	var sund = {
		data: "Sunday",
		pre: satd
	};
	mond.pre = sund;
	var week = [sund,mond,tued,wedd,thud,frid,satd];
	var current = new Date();
	var day = current.getDay();
	var node = week[day];
	var result =[];
	for(var i=0;i<daynum;i++){
		if( i==0 ){
			result.push("Today");
		}else{
			result.push(getDayName(node));	
		}
		node = node.pre;
	}
	return result;
}
function getDayName(node){
	return node.data;
}
function getTodayReal(days){
	var today = [];
	today.push(getActivityDuration('intense',days));
	today.push(getActivityDuration('moderate',days));
	today.push(getActivityDuration('soft',days));
	return today;
}
function getWeekReal(days){
	var week = [];
	week.push(getAllActivityDuration('intense',days));	
	week.push(getAllActivityDuration('moderate',days));	
	week.push(getAllActivityDuration('soft',days));
	return week;
}
function covertBasedOnTen(array){
	var converted = [];
	var total = 0;
	for(var i=0;i<array.length;++i){
		total+=array[i];
	}
	for(var i=0;i<array.length;++i){
		converted.push(array[i]/total*10);
	}
	return converted;
}
function getSleepGaugeMessage(score){
	if(score<=19.99&&score>=0){
		return 'Your score suggests that you are not getting enough quality sleep. If your score is consistently at this level you should make a time to see you doctor and discuss what you believe is causing your lack of sleep.';
	}else if(score<=39.99){
		return 'Your score suggests that you are in the lower to middle rangeof sleep efficiency. If you wish to further improve your score and wellness then try gaining more sleep in the hours  between 9pm-12 midnight.';
	}else{
		return 'Congratulations. You are sleeping well and getting some quality deep sleep.';
	}
}
function getActivityGaugeMessage(score,age){
	if(age>=16&&age<=60){
		if(score<=49.99&&score>=20){
			return "Your daily activity score is low. This is likely to impact on your wellness and vitality. Seek medical advice to determine what is preventing you getting more exercise."
		}else if(score<=99.99){
			return "Your activity score is within the average range. Safely and gradually increasing your level of activity is likely to add to your wellness and health. "
		}else if(score<=199.99){
			return "Keep up the good work. You have a solid level of activity that will increase your wellness and personal resilience."
		}else if(score<=299.99){
			return "Super! You have a high level of activity that will increase your wellness and reduce the chances of you experiencing disease. "
		}else{
			return "Wow! Everyone is looking up to you. Your setting a great example for your family and your peers. Please monitor your recovery carefully to make sure you are getting enough rest."
		}
	}else if(age<=60){
		if(score<=49.99&&score>=20){
			return "Your daily activity score is low. This is likely to impact on your wellness and vitality. Please review your daily routine to see if you can squeeze in more regular exercise. "
		}else if(score<=99.99){
			return "Your activity score is within the average range. Safely and gradually increasing your level of activity is likely to add to your wellness and health. "
		}else if(score<=199.99){
			return "Keep up the good work. You have a solid level of activity that will increase your wellness and personal resilience."
		}else if(score<=299.99){
			return "Super! You have a high level of activity that will increase your wellness and reduce the chances of you experiencing disease. "
		}else{
			return "Wow! Everyone is looking up to you. Your setting a great example for your family and your peers. Please monitor your recovery carefully to make sure you are getting enough rest."
		}
	}else if(age<=80){
		if(score<=49.99&&score>=20){
			return "Good. You have a base activity that will increase your wellness and personal resilience."
		}else if(score<=99.99){
			return "Super! You have a solid level of activity that will increase your wellness and reduce the chances of you experiencing disease. "
		}else if(score<=199.99){
			return "Wow! Everyone is looking up to you. Your setting a great example for your family and your peers. Please monitor your recovery carefully to make sure you are getting enough rest. "
		}else if(score<=299.99){
			return "Check with your doctor to ensure that your level of exercise is sustainable for your health. "
		}else{
			return "Check with your doctor to ensure that your level of exercise is sustainable for your health. "
		}
	}else{
		if(score<=49.99&&score>=20){
			return "Super! You have a solid level of activity that will increase your wellness and reduce the chances of you experiencing disease."
		}else if(score<=99.99){
			return "Wow! Everyone is looking up to you. Your setting a great example for your family and your peers. Please monitor your recovery carefully to make sure you are getting enough rest. "
		}else if(score<=199.99){
			return "Check with your doctor to ensure that your level of exercise is sustainable for your health."
		}else if(score<=299.99){
			return "Check with your doctor to ensure that your level of exercise is sustainable for your health. "
		}else{
			return "Check with your doctor to ensure that your level of exercise is sustainable for your health. "
		}
	}
}
function getSleepBankMessage(sixColors, daysName){
	var red=0;
	var orange=0;
	var green=0;
	var greenDay = 0;
	for(var i=0;i<sixColors.length;){
		if(sixColors[i]=='#E00000'){
			red++;
		}
		if(sixColors[i]=='#FF8400'){
			orange++;
		}
		if(sixColors[i]=='#82CA9D'){
			green++;
			greenDay = i;
		}
		i+=2;
	}
	console.log(red+' '+orange+' '+green);
	if(red==3){
		return "Over the last three days, you had very low levels of deep sleep.  Please seek medical advice as soon as possible to determine what is preventing you from getting reasonable sleep. "
	}
	if(red == 2 && orange==1){
		return "Over the last three days, you have had low levels of deep sleep. Did you know that  having caffeine and or other drugs before sleep can reduce your sleep efficiency.";
	}
	if(red == 2 && green == 1){
		var day = null;
		if(greenDay==0){
			day = daysName[0];
		}
		if(greenDay==2){
			day = daysName[1];
		}
		if(greenDay==4){
			day = daysName[2];
		}
		return "Over the last three days, you have had mainly low levels of deep sleep but with one good sleep. Please consider the good things you did to get the sleep result on "+day+" and try to repeat them."
	}
	if(red == 1 && orange == 2){
		return "Over the last three days, you have had low to average levels of deep sleep. If you can find a way to talk about stressful events with people you trust,  then it's more likely you will sleep efficiently.";
	}
	if(orange == 3){
		return "Over the last three days, you have had no sleeps that have added to your sleep bank. Please review your before bed routine to see if some of your choices are preventing you from getting quality sleep.";
	}
	if(red == 1 && orange == 1 && green == 1){
		return "Over the last three days, your sleep is a little erratic. Often we are pulled in all directions with the business of life. Remember to take some regualr time out for yourself to smell the roses and relax.";
	}
	if(orange == 2 && green == 1){
		return "Over the last three days, you have had one sleep that has added to your sleep bank. Good work! This will increase your personal resevoir of wellness.";
	}
	if(green == 2 && orange == 1){
		return "Congratulations! You have had two sleeps in the last three days that have added to your sleep bank. You should be feeling good and have a growing sense of wellness. ";		
	}
	if(green == 3){
		return "Champion! You have achieved 3 consecutive days of quality sleep. You have added significantly to your sleep bank and achieved some high performace sleep! You're the boss! ";
	}
}
function getActivityBankMessage(sixColors, daysName){
	var red=0;
	var orange=0;
	var green=0;
	var blue = 0;
	var yellow = 0;
	
	var greenDays = [];
	var redDays = [];
	var orangeDays = [];
	var blueDays = [];
	var yellowDays = [];

	for(var i=0;i<sixColors.length;){
		if(sixColors[i]=='#F2635F'){
			red++;
			redDays.push(i);
		}
		if(sixColors[i]=='#E0A025'){
			orange++;
			orangeDays.push(i);
		}
		if(sixColors[i]=='#F4D00C'){
			yellow++;
			yellowDays.push(i);
		}
		if(sixColors[i]=='#9CFF00'){
			green++;
			greenDays.push(i);
		}
		if(sixColors[i]=='#0093D1'){
			blue++;
			blueDays.push(i);
		}
		i+=2;
	}
	if(red==3){
		return "Over the last three days, you have recorded a very low level of activity. If you have have the capacity, please consider increasing your level of exercise.";
	}
	if(red==2){
		if(orange==1){
			return "Over the last three days, you have recorded a low level of activity. "+daysName[convertToDayNumber(orangeDays[0])]+" was your best day can you try to build on that?";
		}
		if(green==1){
			return "Over the last three days, you had one good day on "+daysName[convertToDayNumber(greenDays[0])]+". Now the challenge is to try to have more exercise days like that one to increase your wellness. ";
		}
		if(blue==1){
			return "Over the last three days, what happened? You had a great day on "+daysName[convertToDayNumber(blueDays[0])]+" and then? Focus on the good things and try to make the next 3 days of activity even better. ";
		}
		if(yellow==1){
			return "Over the last three days, OMG you had an epic activity day on "+daysName[convertToDayNumber(yellowDays[0])]+". You deserve congratulations for that. ";
		}
	}
	if(orange==3){
		return "Over the last three days, you've been very consistent with a nice little routine of activity. Good stuff!";
	}
	if(orange==2){
		if(red==1){
			return "Over the last three days, you've been pretty good with your activity. A little setback on "+daysName[convertToDayNumber(redDays[0])]+" but the other days were fine. ";
		}
		if(green==1){
			return "Over the last three days, you've been pretty solid with your activity. "+daysName[convertToDayNumber(greenDays[0])]+" was a ripper! ";
		}
		if(blue==1){
			return "Over the last three days, you've been pretty good with your activity. On "+daysName[convertToDayNumber(blueDays[0])]+" you were a legend!  ";
		}
		if(yellow==1){
			return "Over the last three days, you've been ticking over nicely. On "+daysName[convertToDayNumber(yellowDays[9])]+" you were on fire with activity. Congratulations. ";
		}
	}
	if(green==3){
		return "Well done! You've had three consecutive days of good  activity. If you keep this up -  look out world. ";
	}
	if(green==2){
		if(red==1){
			return "Good effort. Don't worry too much about "+daysName[convertToDayNumber(redDays[0])]+" .Your other two days worth of activity more than make up for it. ";
		}
		if(orange==1){
			return "Over the last three days, you have posted 2 great days of activity on "+daysName[convertToDayNumber(greenDays[0])]+" and "+daysName[convertToDayNumber(greenDays[1])]+". Keep building it up! ";
		}
		if(blue==1){
			return "Wow, now you're really progressing. You're into blue territory, we should call you '(Insert user name) the conqueror.' ";
		}
		if(yellow==1){
			return "What happened on "+daysName[convertToDayNumber(yellowDays[0])]+" You just shot your activity stats to the moon. Great work. ";
		}
	}
	if(blue==3){
		return "You're just too good arent you? Three days in a row of blue level activity? We the common people salute you. ";
	}
	if(blue==2){
		if(red==1){
			return "Did you injure yourself? We can see that you had two days of blue level activity and then? Hope you get better soon. ";
		}
		if(orange==1){
			return "Over the last three days you've been doing a great job with your activity. Keep smiling. ";
		}
		if(green==1){
			return "Wow! We should take a photo of your for our next fitness magazine issue. Top job! ";
		}
		if(yellow==1){
			return "OMG! On "+daysName[convertToDayNumber(yellowDays[0])]+" you entered the EPIC yellow level of activity and had two blue activity days for the other two? C'mon tell us how you do it? You god you. ";
		}
	}
	if(yellow==3){
		return "Words like 'Machine' and 'Freak' have been used to describe your physical prowess. But for you, your activity level is just a normal type of thing. Right? ";
	}
	if(yellow==2){
		if(red==1){
			return "Even superheros need to rest. It looks like on "+daysName[convertToDayNumber(redDays[0])]+" you got some recovery happening! ";
		}
		if(orange==1){
			return "Two days of super-human activity and one day of taking it easy. Sounds like a sustainable routine to us. Keep up the great work. ";
		}
		if(green==1){
			return "Your "+daysName[convertToDayNumber(yellowDays[0])]+" and "+daysName[convertToDayNumber(yellowDays[1])]+" were huge activity days. You should be congratulated. You have a mind of steel. ";
		}
		if(blue==1){
			return "Wow, we wish our body looked like yours. You're an inspiration to all the rest of us mortals. ";
		}
	}
	if(yellow==1){
		return "Looks like you been mixing up your activity over the last three days. Whatever works for you - as long as it makes you happy. ";
	}
	if(blue==1){
		return "You did have a high level of activity on "+daysName[convertToDayNumber(blueDays[0])]+" Great work! ";
	}
	if(green==1){
		return "You had a solid level of activity on "+daysName[convertToDayNumber(greenDays[0])]+" Onward and upward! ";
	}
}
function convertToDayNumber(num){
	if(num==0){
		return 0;
	}else{
		return num/2;
	}
}
function getDrillDownAmMessage(value){
	if(value>=0 && value<=9.99){
		return "Ouch! Your head must be really hurting. You are suffering without enough deep sleep. Perhaps you are getting all your deep sleep before 12 midnight? If not we suggest you seek medical advice as soon as possible. ";
	}else if(value<=19.99){
		return "You are not getting enough deep sleep. Every now and then we can deal with one night of slightly less deep sleep so long as we have built up some hours in the bank with good sleeps preceding it and a nights good sleep straight afterwards";
	}else if(value<=29.99){
		return "You are getting some deep sleep, but we are guessing that you really want more? It's worth thinking about what's keeping you up? If you are thinking too much then try to visualise your worried thoughts as being separate from you and make a firm decision not to engage with them. ";
	}else if(value<=39.99){
		return "Solid! You are banking some reasonable deep sleep. Enough for you to feel normal and function. The question is - how super would you feel if you could have even more deep sleep every night? ";
	}else if(value<=70){
		return "Good! You are having some excellent deep sleep in the morning. This is going to help your body get around to doing some of the finer repairs that it may not have time for, if you slept less. "
	}else{
		return "Fantastic. You are a high performance sleeper. Don't forget to keep a record of your dreams and log them on our site when you have a chance. Keep up the great sleeping. ";
	}
}
function getDrillDownPmMessage(value){
	if(value>=0 && value<=9.99){
		return "Wow! Something is really going wrong with your sleep period between 9pm and 12pm. You are hardly getting any deep sleep at all. This puts your body under pressure to try and recover the missing deep sleep from the morning period from 12-9am. To break the cycle, get yourself out of bed at 6am one day and then stay awake for the whole day. This should make it easier for you to retire earlier. If this problem persists please seek medical advice. ";
	}else if(value<=19.99){
		return "OK, it looks like you are in the habit if staying up a little later than most people? You might feel like you manage well with this and get good things done during the quieter hours before 12 midnight. Just bear in mind that you will need to make up the deep sleep in the next sleep period or else you'll move into deficit with all of the negative effects like faster ageing, stress and impaired cognitive function.";
	}else if(value<=29.99){
		return "You're trying to get to bed earlier but somehow things just seem to keep getting in the way. Right? You might be watching you favourite show, using social media reading, gaming or doing something that gives you satisfaction. Maybe you've got it all covered and there is nothing to worry about? Why not try  going to bed early one night and compare the difference with how you feel the next day. ";
	}else if(value<=39.99){
		return "You're getting a reasonable amount of deep sleep before 12 midnight. Good job! You have a solid base to build on. Show us how great you can be! ";
	}else if(value<=70){
		return "Congratulations! You are getting some excellent deep sleep before 12 midnight. Your body is going to be so happy with you! You are helping it to get all the major jobs done at the beginning of the night, leaving the rest of the night for relaxation and repair. ";
	}else{
		return "Outstanding! People are going to be commenting that you look fantastic. Getting this much deep sleep before 12 midnight Is going to slow the ageing process and keep you looking fresher for longer.";
	}
}