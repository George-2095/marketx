const itemarea = document.querySelector("#itemarea")
const keyvalues = window.location.search
const urlparams = new URLSearchParams(keyvalues)
const urlid = urlparams.get('id')
const id = urlid
const title = document.querySelector("title")

fetch("./panel/Products.php").then(response => response.json()).then(data => {
    const element = data.filter(item => item.id = id);
    title.innerHTML = `XMARKET - ${element[0].header}`
    const item = document.createElement("div")
    item.classList.add("item")
    item.innerHTML += `<img src="./images/${element[0].imagename}" />
    <hr />
    <div class="d-flex justify-content-between">
        <div>
            <h3>${element[0].header}</h3>
        </div>
        <div>
            <b>ფასი: ${element[0].price} ₾</b>
        </div>
    </div>
    <hr />
    <div>
        <b>${element[0].description}</b>
    </div>`
    itemarea.appendChild(item)
}).catch(error => console.log(error))