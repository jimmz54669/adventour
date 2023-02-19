//navbar js
var settingsmenu = document.querySelector(".settings-menu");
var darkBtn = document.getElementById("dark-btn");

function settingsMenuToggle() {
    settingsmenu.classList.toggle("settings-menu-height");
}

darkBtn.onclick = function(){
    darkBtn.classList.toggle("dark-btn-on");
    document.body.classList.toggle("dark-theme");
}
//search bar
let inputBox = document.querySelector(".input-box"),
    search = document.querySelector(".search"),
    closeIcon = document.querySelector(".close-icon");

search.addEventListener("click", () => inputBox.classList.add("open"));
closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));

//start side js


//sidebar//
const menuItems = document.querySelectorAll('.menu-item');


//------------ SIDE NAV JS ------------//

const side_menu_toggle = document.querySelector('.side-menu-toggle');
const sidenav = document.querySelector('.sidenav');

side_menu_toggle.addEventListener('click', () => {
    side_menu_toggle.classList.toggle('is-active');
    sidenav.classList.toggle('is-active');
})

//theme//
const theme = document.querySelector('#theme');
const themeModal = document.querySelector('.customize-theme');

//theme-font-size//
const fontSizes = document.querySelectorAll('.choose-size span');
var root = document.querySelector(':root');

//theme-primary-colors//
const colorPallete = document.querySelectorAll('.choose-color span');

//remove active class from all menu items
const changeActiveItem = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    })
}

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItem();
        item.classList.add('active');
        if(item.id !='notifications') {
            document.querySelector('.notification-popup').
            style.display = 'none';
        } else {
            document.querySelector('.notification-popup').
            style.display = 'block';
            document.querySelector('#notifications .notification-count').style.display ='none';
        }
    })
})

//THEME CUSTOMIZATION DISPLAY//


//theme modal open
const openThemeModal = () => {
    themeModal.style.display = 'grid';
}

//Theme modal close
const closeThemeModal = (e) => {
    if(e.target.classList.contains('customize-theme')) {
        themeModal.style.display = 'none';
    }
}

// modal close
themeModal.addEventListener('click', closeThemeModal);

// modal open
theme.addEventListener('click', openThemeModal);



//----Font Size-------//

// remove active class font size//
const removeSizeSelector = () => {
    fontSizes.forEach(size => {
        size.classList.remove('active');
    })
}


fontSizes.forEach(size => {
    

    size.addEventListener('click', () => {
        removeSizeSelector();
        let fontSize;
        size.classList.toggle('active');

        if(size.classList.contains('font-size-1')){
            fontSize = '12px';
            root.style.setProperty('--sticky-top-left', '1rem');
        } else if(size.classList.contains('font-size-2')){
            fontSize = '15px';
            root.style.setProperty('--sticky-top-left', '1rem');
        } else if(size.classList.contains('font-size-3')){
            fontSize = '17px';
            root.style.setProperty('--sticky-top-left', '-2rem');
        } else if(size.classList.contains('font-size-4')){
            fontSize = '19px';
            root.style.setProperty('--sticky-top-left', '-5rem');
        } else if(size.classList.contains('font-size-5')){
            fontSize = '20px';
            root.style.setProperty('--sticky-top-left', '-12rem');
        }

        //change font size from the root html
        document.querySelector('html').style.fontSize = fontSize;
    })

    
})

// remove active class from colors
const changeActiveColorClass = () => {
    colorPallete.forEach(colorPicker => {
        colorPicker.classList.remove('active');
    })
}

//change primary theme color//
colorPallete.forEach(color => {
    color.addEventListener('click', () => {
        let primaryHue;
        // remove active class from colors
        changeActiveColorClass();

        if(color.classList.contains('color-1')) {
            primaryHue = 152;
        } else if(color.classList.contains('color-2')) {
            primaryHue = 220;
        } else if(color.classList.contains('color-3')) {
            primaryHue = 2;
        } else if(color.classList.contains('color-4')) {
            primaryHue = 264;
        } else if(color.classList.contains('color-5')) {
            primaryHue = 79;
        } else if(color.classList.contains('color-6')) {
            primaryHue = 166;
        }
        color.classList.add('active');

        root.style.setProperty('--primary-color-hue', primaryHue);
    })
})


//end side js

//weather
const wrapper = document.querySelector(".wrapper"),
inputPart = wrapper.querySelector(".input-part"),
infoTxt = inputPart.querySelector(".info-txt"),
inputField = inputPart.querySelector(".city"),
locationBtn = inputPart.querySelector(".city-btn"),
wIcon = document.querySelector(".weather-part img"),
arrowBack = wrapper.querySelector("header i");

let api;

inputField.addEventListener("keyup", e =>{
    //if user pressed enter btn and input value is not empty 
    if(e.key == "Enter" && inputField.value != ""){
        requestApi(inputField.value);
    }
});

locationBtn.addEventListener("click", ()=>{
    if(navigator.geolocation){//if browser support geolocation api
        navigator.geolocation.getCurrentPosition(onSuccess, onError)
    }else{
        alert("Your browser not support geolocation api");
    }
});

function onSuccess(position){
    const {latitude, longitude} = position.coords; //getting lat and lon of the user device from coords obj
    api = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=837d3ca206591f2e35eddbf09280b462`
    fetchData();
}

function onError(error){
    infoTxt.innerHTML = error.message;
    infoTxt.classList.add("error");
}

function requestApi(city){
    api = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=837d3ca206591f2e35eddbf09280b462`;
    fetchData();
}

function fetchData(){
    infoTxt.innerHTML = "Getting weather details...";
    infoTxt.classList.add("pending");
    //getting api response and returning it with parsing into js obj and in another
    //then function calling weatherDetails function with passing api result as an argument
    fetch(api).then(response => response.json()).then(result => weatherDetails(result));
}

function weatherDetails(info){
    infoTxt.classList.replace("pending", "error");
    if(info.cod == "404"){
        infoTxt.innerHTML = `${inputField.value} isn't a valid city name`;  
    }else {
        //let's get required properties value from the info object
        const city = info.name;
        const country = info.sys.country;
        const {description, id} = info.weather[0];
        const {feels_like, humidity, temp} = info.main;

        //using custom icon according to the id which api return us
        if(id == 800){
            wIcon.src = "images/clear weather.png";
        }else if(id >= 200 && id <= 232){
            wIcon.src = "images/storm.png";
        }else if(id >= 801 && id <= 804){
            wIcon.src = "images/cloudwsun.png";
        }else if(id >= 500 && id <= 531){
            wIcon.src = "images/rain.png";
        }else if(id >= 701 && id <= 781){
            wIcon.src = "images/haze.png";
        }else if(id >= 600 && id <= 622){
            wIcon.src = "images/snow.png";
        }else if(id >= 300 && id <= 321){
            wIcon.src = "images/weather.png";
        }

        //let's pass these values to a particular html element
        wrapper.querySelector(".temp .numb").innerText = Math.floor(temp);
        wrapper.querySelector(".weather").innerText = description;
        wrapper.querySelector(".location span").innerText = `${city}, ${country}`;
        wrapper.querySelector(".temp .numb-2").innerText = Math.floor(feels_like);
        wrapper.querySelector(".humidity span").innerText = `${humidity}%`;

        infoTxt.classList.remove("pending", "error");
        wrapper.classList.add("active");
        console.log(info);
    }

}

arrowBack.addEventListener("click", ()=> {
    wrapper.classList.remove("active");
})

/*realtime clock*/
function showTime(){
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();
    var session = "AM"; 

    if(h == 0){
        h =12;
    }

    if(h > 12) {
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerHTML = time;
    document.getElementById("MyClockDisplay").textContent = time;

    setTimeout(showTime, 1000);
}

showTime();

/*Calendar*/
