let grade = document.getElementById("grade");
let unit = document.getElementById("unit");
let unit_elements = document.getElementById("unit_elements");

grade.oninput = function() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/units.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            if (data === "err") {
                console.log("err")
                console.log(data)
            } else {
                unit.disabled = false;
                unit.innerHTML = data;
            }
        } else {
            console.log("err")
        }
    };
    let formData = new FormData();
    formData.append('lang', "eng");
    formData.append('grade', parseInt(grade.value));
    xhr.send(formData);
}

function Run(gradee, unitt) {
    if(!isNaN(gradee) && unitt != "def") {
        grade.style.border = "4px solid rgb(8, 138, 8)"
        unit.style.border = "4px solid rgb(8, 138, 8)"
        window.location.href = `../learn.php?lang=eng,grade=${gradee},unit=${unitt}`;
    } else {
        if(isNaN(gradee)) {
            grade.style.border = "4px solid rgb(156, 10, 10)"
        } else {
            grade.style.border = "4px solid rgb(8, 138, 8)"
        }
        if(unitt == "def") {
            unit.style.border = "4px solid rgb(156, 10, 10)"
        } else {
            unit.style.border = "4px solid rgb(8, 138, 8)"
        }
    }
}