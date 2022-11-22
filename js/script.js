let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');
let body = document.querySelector("body");

document.querySelector('#close-btn').onclick = () => {
   navbar.classList.remove('active');
   body.classList.remove("blur");
   
}

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
   body.classList.add("blur");
}


// document.querySelector('#user-navbar').onclick = () =>{
//    profile.classList.toggle('active');
//    navbar.classList.remove('active');
// }

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
   body.classList.remove("blur");
}