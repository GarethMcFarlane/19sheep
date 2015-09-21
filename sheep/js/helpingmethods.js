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
	return Math.round(100*(am*0.25+pm*0.75) * 1000) / 1000;
}

function totalActivityScore(data){
	var softMinutes = Math.floor(data[0].soft/60);
	var moderateMinutes = Math.floor(data[0].moderate/60);
	var intenseMinutes = Math.floor(data[0].intense/60);
	return softMinutes*4+moderateMinutes+15+intenseMinutes*50;
}
function generateColors(threedays){
	//todo: get 6 colors to display in sleep bank. The colors would be based on 
	//sleep score for last three days. different score would generate different colors.
	//return these 6 colors in an array.
	var sixColours = [];
	var arraySize = 2;

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
			sixColours.push('#ff0000');
			sixColours.push('#ff0000');
		}else if(finalScore<=29.99 && finalScore>=20){
			sixColours.push('#ff0000');
		}else if(finalScore<=39.99 && finalScore >= 30){
			sixColours.push('#ffa500');
		}else if(finalScore<=49.99 && finalScore >=40){
			sixColours.push('#198C19');
		}else{
			sixColours.push('#198C19');
			sixColours.push('#198C19');
		}
		if(sixColours.length<arraySize){
			sixColours.push('#d8d8d8');
		}
		arraySize+=2;
	}
	return sixColours;
}
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