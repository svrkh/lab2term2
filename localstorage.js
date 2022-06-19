function _1() {
    let publisher = document.getElementById("publisher").value;
    let result = localStorage.getItem(publisher);;
    document.getElementById("res").innerHTML = result;
}
function _2() {
    let year_min = document.getElementById("year_min").value;
    let year_max = document.getElementById("year_max").value;
    let year = year_min + "&" + year_max; 
    let result = localStorage.getItem(year);
    document.getElementById("res").innerHTML = result;
}
function _3(){
    let author = document.getElementById("author").value;
    let result = localStorage.getItem(author);
    document.getElementById("res").innerHTML = result;
}