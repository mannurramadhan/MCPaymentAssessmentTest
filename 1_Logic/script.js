function numsIndex(action) {
    var divElement = document.getElementById("indexNumber");
    var inputElement = document.getElementsByClassName("input-index");
    var length = inputElement.length;
    indexElement = "";

    switch (action) {
        case 'add':
            for (let i = 0; i < (length + 1); i++) {
                indexElement += "<input type='number' class='input-index' placeholder='Value-" + (i + 1) + "' id='numsIndex" + (i + 1) + "' />"
            }
            break;
        case 'reduce':
            for (let i = 0; i < (length - 1); i++) {
                indexElement += "<input type='number' class='input-index' placeholder='Value-" + (i + 1) + "' id='numsIndex" + (i + 1) + "' />"
            }
            break;
        default:
            break;
    }
    
    // Set input element on div#indexNumber element
    divElement.innerHTML = indexElement;
}

function generate() {
    var inputElement = document.getElementsByClassName("input-index");
    var length = inputElement.length;
    var numsTarget = document.getElementById("numsTarget").value;
    var arrayVal = document.getElementById("arrayValue");
    var targetVal = document.getElementById("targetValue");
    var resultVal = document.getElementById("resultValue");
    const nums = [];

    // Convert to array for input index
    for (let i = 0; i < length; i++) {
        nums[i] = document.getElementById("numsIndex" + (i + 1) +"").value;
    }

    for (let x = 0; x < nums.length; x++) {
        for (let y = 0; y < nums.length; y++) {
            let twoSums = parseInt(nums[x]) + parseInt(nums[y]);

            if (twoSums == numsTarget) {
                const result = new Array(x,y);

                // Set value for result section
                arrayVal.value = "[ " + nums.join(", ") + " ]";
                targetVal.value = numsTarget;
                resultVal.value = "[ " + result.join(", ") + " ]";

                return result;
            } else {
                // Set null value for invalid condition
                arrayVal.value = targetVal.value = resultVal.value = 'null';
            }
        }
    }

}