function revealMessage(){
    document.getElementById("hiddenMessage").style.display = 'block';
}
function countDown(){
    var currentVal = document.getElementById("countDownButton").innerHTML;
    var newVal = currentVal - 1;
    if(newVal == 0)
        newVal = "TIMEtoGO";
    if(currentVal == "TIMEtoGO")
        newVal = "TIMEtoGO";
    document.getElementById("countDownButton").innerHTML = newVal;
}