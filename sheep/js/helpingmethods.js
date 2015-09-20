function getData(json){
    var l= json.0.body.series;
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
	return getDuration(time,status,data)/getInstance(time,status,data);
}
function getSleepScore(time,status,data){
	if(getInstance(time,0,data)==0){
		return getDuration(time,status,data)/getInstance(time,status,data);
	}
	return getDuration(time,status,data)/(getInstance(time,status,data)+(getInstance(time,0,data)*getAverageDuration(time,0,data)));
}
function printDeepSleepTime(data){
	for(var i=0;i<data.length;++i){
		if(data[i].state==2){
			console.log("No."+i);
			console.log("start:"+data[i].startdate+" end:"+data[i].enddate);
		}
	}
}

function totalActivityScore(data){
	var softMinutes = Math.floor(data[0].soft/60);
	var moderateMinutes = Math.floor(data[0].moderate/60);
	var intenseMinutes = Math.floor(data[0].intense/60);
	return softMinutes*4+moderateMinutes+15+intenseMinutes*50;
}