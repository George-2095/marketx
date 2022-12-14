const username = document.querySelector('#username')
const usernameerror = document.querySelector('#usernameerror')
const password = document.querySelector('#password')
const passworderror = document.querySelector('#passworderror')

document.querySelector("#passwordtoggle").addEventListener("click", () => {
    if (password.type === 'password') {
        password.type = 'text'
    } else {
        password.type = 'password'
    }
})

fetch("./Admin.php").then(response => response.json()).then(data => {
    if (data.length === 1) {
        document.location.href = './index.html'
    } else {
        document.querySelector("form").addEventListener("submit", (e) => {
            e.preventDefault()
            if (username.value === '' || password.value === '') {
                if (username.value === '') {
                    usernameerror.innerHTML = `იუზერნეიმის შეყვანა სავალდებულოა.`
                } else {
                    usernameerror.innerHTML = ``
                }
                if (password.value === '') {
                    passworderror.innerHTML = `პაროლის შეყვანა სავალდებულოა.`
                } else {
                    passworderror.innerHTML = ``
                }
            } else {
                usernameerror.innerHTML = ``
                passworderror.innerHTML = ``
                fetch("./Admin.php",
                    {
                        method: "POST",
                        body: JSON.stringify({
                            username: username.value,
                            password: password.value
                        })
                    }).then(response => response.text()).then(data => {
                        if (data === '') {
                            document.location.reload()
                        } else {
                            usernameerror.innerHTML = data
                        }
                    }).catch(error => console.log(error))
            }
        })
    }
})