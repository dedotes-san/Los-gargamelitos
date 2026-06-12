const categoryFilter = document.getElementById("categoryFilter");

categoryFilter.addEventListener("change", function () {

    const category = this.value;

    fetch("get_games.php?category=" + category)
    .then(res => res.json())
    .then(data => {

        const gamesList = document.getElementById("gamesList");
        gamesList.innerHTML = "";

        data.forEach(game => {

            const div = document.createElement("div");

            div.innerHTML = `
                <h3>${game.title}</h3>
                <p>${game.description}</p>
                <button onclick="playGame('${game.file_path}')">Jugar</button>
            `;

            gamesList.appendChild(div);

        });

    });

});
function filtrarCategoria(category){

fetch("get_games.php?category=" + category)
.then(res => res.json())
.then(data => {

const gamesList = document.getElementById("gamesList");
gamesList.innerHTML = "";

data.forEach(game => {

const div = document.createElement("div");

div.innerHTML = `
<h3>${game.title}</h3>
<p>${game.description}</p>
<button onclick="playGame('${game.file_path}')">Jugar</button>
`;

gamesList.appendChild(div);

});

});

}
document.getElementById("msg")
.addEventListener("input", ()=>{

fetch("typing.php",{

method:"POST",

headers:{
"Content-Type":
"application/x-www-form-urlencoded"
},

body:`friend_id=${friend_id}`

});

});
setInterval(()=>{

fetch(
`check_typing.php?friend_id=${friend_id}`
)

.then(res=>res.text())

.then(data=>{

if(data==="typing"){

document.getElementById("typingText")
.innerText="🔵 Escribiendo...";

}else{

document.getElementById("typingText")
.innerText="";

}

});

},1000);
let oldCount = 0;

function cargarHistorial(){

fetch(`get_messages.php?friend_id=${friend_id}`)

.then(res=>res.text())

.then(data=>{

let chatBox =
document.getElementById("chatBox");

let newCount =
(data.match(/class='message/g) || []).length;

if(newCount > oldCount){

document
.getElementById("msgSound")
.play();

}

oldCount = newCount;

chatBox.innerHTML = data;

chatBox.scrollTop =
chatBox.scrollHeight;

});

}
