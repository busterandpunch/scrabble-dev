let word = ""
function addToBoard(val){
    const text = val.innerText;
    document.getElementById('word').value += text;
    word += text;
    val.style.visibility = 'hidden'
}