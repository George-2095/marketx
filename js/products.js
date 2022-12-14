const list = document.querySelector("#list")

fetch("./panel/Products.php").then(response => response.json()).then(data => {
    for (let i = 0; i < data.length; i++) {
        let element = data[i];
        const item = document.createElement("div")
        item.classList.add("item")
        item.classList.add("col-sm-12")
        item.classList.add("col-md-3")
        item.innerHTML += `<a href="./details.html?id=${element.id}">
            <img src="./images/${element.imagename}" />
                <hr />
            <div class="d-flex justify-content-between">
                <div>
                    <h3 id="header">${element.header}</h3>
                </div>
                <div>
                    <b>ფასი: ${element.price} ₾</b>
                </div>
            </div>
        </a>`
        list.appendChild(item)
    }
}).catch(error => console.log(error))