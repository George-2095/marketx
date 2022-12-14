const date = new Date()
const stylecss = document.querySelectorAll("#stylecss")
const paneljs = document.querySelectorAll("#paneljs")
const loginjs = document.querySelectorAll("#loginjs")

for (let i = 0; i < stylecss.length; i++) {
    const element = stylecss[i];
    element.href = `../styles/style.css?${date.getTime()}=${Math.random()}`
}

for (let i = 0; i < paneljs.length; i++) {
    const element = paneljs[i];
    element.src = `../js/panel.js?${date.getTime()}=${Math.random()}`
}

for (let i = 0; i < loginjs.length; i++) {
    const element = loginjs[i];
    element.src = `../js/login.js?${date.getTime()}=${Math.random()}`
}