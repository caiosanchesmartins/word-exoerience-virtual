var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");
var body = document.querySelector("body");
var isAnimating = false;

function changeClass(className) {
    if (isAnimating) return; // Impede que a função seja chamada novamente durante a animação
    isAnimating = true;
    body.className = className;

    setTimeout(() => {
        isAnimating = false; // Libera o bloqueio após a duração da animação
    }, 500); // Duração da animação em ms
}    

btnSignin.addEventListener("click", function () {
    changeClass("sign-in-js");
});

btnSignup.addEventListener("click", function () {
    changeClass("sign-up-js");
});
