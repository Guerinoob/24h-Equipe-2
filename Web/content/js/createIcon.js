new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {

        datasets: [{
            backgroundColor: ["#3e95cd", "#8e5ea2"],
            data: [$("#production_arabica").text() , $("#production_robusta").text()]
        }]
    }
});
function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}
sleep(1000);
html2canvas(document.querySelector("#pie-chart")).then(canvas => {
    go();

});


function go(){
    var cv = document.getElementById("pie-chart");
    var image = cv.toDataURL();
    $.post(
        "createImage.php",
        {'img': image,
          'pays' : $("#pays").text()},
        function(response){
            console.log("Putain");
        }
    );


}




