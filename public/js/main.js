document.querySelector("#iden").addEventListener("submit", function(e){
        e.preventDefault();    //stop form from submitting
        document.getElementById("iden").style.display = 'none';
        document.getElementById("calendar").style.display = 'block';
        document.getElementById("nextCalen").style.display = 'block';
        document.getElementById("help").innerHTML = 'Please select a date that suits you.'

        /*var x = window.matchMedia("(max-width: 600px)")
        if(x.matches){
        document.getElementById("box").style.height = '800px';
        } else {
        document.getElementById("box").style.height = '750px';
        }*/
});