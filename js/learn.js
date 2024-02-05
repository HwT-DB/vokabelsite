const max_errors = 2;
let error = 0;

let point = 0;

let streak = 0;
let highest_streak = localStorage.getItem("streak") > 0 ? localStorage.getItem("streak") : 0;

let first_try = true;

let lang = l;
let grade = g;
let unit = u;
let active_word;
let active_type;

let check = document.getElementById("check")
let cont = document.getElementById("continue")
let errors = document.getElementById("errors")
let transl = document.getElementById("translate")
let streak_c = document.getElementById("streak_c")
streak_c.innerHTML = `Streak: 0<br>Highest Streak: ${highest_streak}`

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
                console.log(data)
                let jsonData = JSON.parse(data)
                active_word = jsonData.word;
                word.value = active_word;
                active_type = jsonData.type;
                first_try = true;
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
                console.log(data)
                if (data === "err") {
                    console.log("err")
                    console.log(data)
                } else {    
                    let jsonData = JSON.parse(data);
                    if(jsonData.stat === "success") {
                        transl.style.border = "4px solid rgb(8, 138, 8)"
                        End();
                        if (first_try == true) {
                            streak++;
                            if(streak > highest_streak) {
                                localStorage.setItem("streak", streak);
                                highest_streak = streak;
                            }
                            point++;
                        }
                    } else if(jsonData.stat === "fail") {
                        transl.style.border = "4px solid rgb(156, 10, 10)"
                        if(++error == max_errors) {
                            errors.innerHTML = `${error}/${max_errors} - Richtige Lösung: ${jsonData.good}`;
                            End();
                        } else {
                            errors.innerHTML = `${error}/${max_errors}`;
                            first_try = false;
                        }
                        errors.style.display = "block";
                        streak = 0;
                    } else {
                        console.log("err")
                    }
                    streak_c.innerHTML = `Streak: ${streak}<br>Highest Streak: ${highest_streak}`;
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

function End() {
    check.classList.add("hide")
    cont.classList.remove("hide")
    error = 0;
}

function Continue() {
    NewWord()
    transl.style.border = "4px solid #ccc"
    transl.value = "";
    errors.style.display = "none";
    check.classList.remove("hide");
    cont.classList.add("hide");
}

function insertTextAtCursor(text) {
    var inputElement = transl;
    var cursorPos = inputElement.selectionStart;
    var textBefore = inputElement.value.substring(0, cursorPos);
    var textAfter = inputElement.value.substring(cursorPos);
    inputElement.value = textBefore + text + textAfter;
    inputElement.setSelectionRange(cursorPos + text.length, cursorPos + text.length);
    inputElement.focus();
}

document.getElementById('showCharacters').addEventListener('click', function () {
    var specialCharacters = document.getElementById('specialCharacters');
    specialCharacters.style.display = (specialCharacters.style.display === 'none' || specialCharacters.style.display === '') ? 'block' : 'none';
});

var specialCharacterList = document.getElementById('specialCharacters');
specialCharacterList.addEventListener('click', function (event) {
    if (event.target.tagName === 'LI') {
        insertTextAtCursor(event.target.innerText);
    }
});