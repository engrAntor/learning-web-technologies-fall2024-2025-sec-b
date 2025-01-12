document.getElementById('addEmployeeForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value.trim();
    const contactNo = document.getElementById('contact_no').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!name || !contactNo || !username || !password) {
        alert('All fields are required!');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'server/employee.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        alert(this.responseText);
    };
    xhr.send(`action=add&name=${name}&contact_no=${contactNo}&username=${username}&password=${password}`);
});
