const date = new Date()
const stylecss = document.querySelectorAll("#stylecss")
const productsjs = document.querySelectorAll("#productsjs")
const detailsjs = document.querySelectorAll("#detailsjs")

for (let i = 0; i < stylecss.length; i++) {
    const element = stylecss[i];
    element.href = `./styles/style.css?${date.getTime()}=${Math.random()}`
}

for (let i = 0; i < productsjs.length; i++) {
    const element = productsjs[i];
    element.src = `./js/products.js?${date.getTime()}=${Math.random()}`
}

for (let i = 0; i < detailsjs.length; i++) {
    const element = detailsjs[i];
    element.src = `./js/details.js?${date.getTime()}=${Math.random()}`
}