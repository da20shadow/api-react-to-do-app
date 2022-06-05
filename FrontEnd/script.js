let regForm = document.getElementById('regForm');
let message = document.getElementById('message');
regForm.addEventListener('submit',register);

async function register(e){

    let url = '../index.php?user';
    e.preventDefault();

    const formData = new FormData(e.currentTarget);
    const sendData = {
        username: formData.get('username'),
        email: formData.get('email'),
        password: formData.get('password'),
        confirm_password: formData.get('confirm_password'),
    }
    console.log('Data to send', sendData);

    const res = await fetch(url,{
        method: 'POST',
        headers: {'content-type': 'application/json'},
        body: JSON.stringify(sendData)
    })
        .then(async function responseHandler(res){
            console.log('Response is: ',  res)

            let jsonData = await res.json();

            if (res.status === 200){
                return jsonData;
            }else {
                throw jsonData;
            }
        })
        .then(data => {
            console.log('This is the DATA Received: ', data);
            message.style.color = 'green';
            message.style.backgroundColor = 'lightgreen';
            message.textContent = data['message'];
            setInterval(() => {
                location.href = 'account.html';
            },1500);
        })
        .catch(err => {
            console.log('ERROR: ', err)
            message.style.color = 'red';
            message.style.backgroundColor = 'lightpink';
            message.textContent = err['message'];
        })
}