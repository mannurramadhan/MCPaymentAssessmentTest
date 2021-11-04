function numsIndex(action) {
    var divElement = document.getElementById("indexNumber");
    var inputElement = document.getElementsByClassName("input-index");
    var length = inputElement.length;
    indexElement = "";

    switch (action) {
        case 'add':
            for (let i = 0; i < (length + 1); i++) {
                indexElement += "<input type='number' class='input-index' placeholder='Value-" + (i + 1) + "' name='numsIndex" + (i + 1) + "' />"   
            }
            break;
        case 'reduce':
            for (let i = 0; i < (length - 1); i++) {
                indexElement += "<input type='number' class='input-index' placeholder='Value-" + (i + 1) + "' name='numsIndex" + (i + 1) + "' />"
            }
            break;
        default:
            break;
    }
    
    divElement.innerHTML = indexElement;
}