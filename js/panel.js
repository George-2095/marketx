fetch("./Admin.php").then(response => response.json()).then(data => {
    if (data.length !== 1) {
        document.location.href = './login.html'
    } else {
        const list = document.querySelector("#list")
        fetch("./Products.php").then(response => response.json()).then(data => {
            for (let i = 0; i < data.length; i++) {
                const element = data[i];
                const item = document.createElement("div")
                item.classList.add("item")
                item.classList.add("col-sm-12")
                item.classList.add("col-md-3")
                item.innerHTML += `<div>
                    <button class="btn btn-danger" onclick="deleteFunction(${element.id})">X</button>
                </div>
                <hr />
                <a href="../details.html?id=${element.id}">
                    <img src="../images/${element.imagename}" />
                        <hr />
                        <h3>${element.header}</h3>
                    <div>
                        <b>ფასი: ${element.price} ₾</b>
                    </div>
                </a>`
                list.appendChild(item)
            }
        }).catch(error => console.log(error))
    }
})
