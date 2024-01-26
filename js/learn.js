const max_errors = 2;
let error = 0;

let lang = l;
let grade = g;
let unit = u;
let active_word;
let active_type;

let check = document.getElementById("check")
let cont = document.getElementById("continue")
let errors = document.getElementById("errors")
let transl = document.getElementById("translate")

window.onload = function() {
    NewWord();
}

function NewWord() {
    let word = document.getElementById("word")
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/newWord.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            if (data === "err") {
                console.log("err")
                console.log(data)
            } else {
                active_word = data.slice(1);
                word.value = active_word;
                active_type = data[0];
            }
        } else {
            console.log("err")
        }
    };
    let formData = new FormData();
    formData.append('lang', lang);
    formData.append('grade', parseInt(grade));
    formData.append('unit', parseInt(unit));
    xhr.send(formData);
}

function Check(translate) {
    if(translate !== "") {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/checkWord.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let data = xhr.response;
                if (data === "err") {
                    console.log("err")
                    console.log(data)
                } else {    
                    let jsonData = JSON.parse(data)
                    if(jsonData.stat === "success") {
                        transl.style.border = "4px solid rgb(8, 138, 8)"
                        check.classList.add("hide")
                        cont.classList.remove("hide")
                    } else if(jsonData.stat === "fail") {
                        transl.style.border = "4px solid rgb(156, 10, 10)"
                        if(++error == max_errors) {
                            errors.innerHTML = `${error}/${max_errors} - Good Answer: ${jsonData.good}`;
                            check.classList.add("hide")
                            cont.classList.remove("hide")
                        } else {
                            errors.innerHTML = `${error}/${max_errors}`;
                        }
                        errors.style.display = "block";
                    } else {
                        console.log("err")
                    }
                }
            } else {
                console.log("err")
            }
        };
        let formData = new FormData();
        formData.append('lang', lang);
        formData.append('grade', parseInt(grade));
        formData.append('unit', parseInt(unit));
        formData.append('ans', translate);
        formData.append('def_word', active_word);
        formData.append('type', parseInt(active_type));
        xhr.send(formData);
    }
}

function Continue() {
    NewWord()
    transl.style.border = "4px solid #ccc"
    transl.value = "";
    errors.style.display = "none";
    check.classList.remove("hide");
    cont.classList.add("hide");
}