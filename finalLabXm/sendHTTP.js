document.getElementById('search').addEventListener('input', function () {
    const query = this.value;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `server/employee.php?search=${query}`, true);
    xhr.onload = function () {
        if (this.status === 200) {
            const employees = JSON.parse(this.responseText);
            const employeeList = document.getElementById('employeeList');
            employeeList.innerHTML = employees.map(emp => `<li>${emp.name} (${emp.contact_no})</li>`).join('');
        }
    };
    xhr.send();
});
