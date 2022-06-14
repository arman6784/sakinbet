var interval1 = setInterval(tetrisTimer, 700);
 
function tetrisTimer() {
    var second = document.getElementById("clock-second").innerText;
 
    if(parseInt(second)===33)
    {
        
        // document.getElementById("clock-second").innerHTML = "00";
        //alert('Finish');
           $("div.timer").hide(33);
           
    } else {
        newSec = (parseInt(second) + 1).toString();
        if(newSec<10)
            newSec="0" + newSec;
        document.getElementById("clock-second").innerHTML = newSec;
    }
    
            if (someCondition()) timer.stop();
}

