<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="design.css">
    <script src="sendHTTP.js" defer></script>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Form to Add Employee -->
    <form id="addEmployeeForm">
        <input type="text" id="name" placeholder="Name" required>
        <input type="text" id="contact_no" placeholder="Contact No" required>
        <input type="text" id="username" placeholder="Username" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Add Employee</button>
    </form>

    <!-- Search Employees -->
    <h2>Search Employee</h2>
    <input type="text" id="search" placeholder="Search by name" oninput="searchEmployee()">

    <!-- Employee List -->
    <h2>Employee List</h2>
    <ul id="employeeList"></ul>

    <script>
        // Handle Adding Employee
        document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const contact_no = document.getElementById('contact_no').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const data = new FormData();
            data.append('name', name);
            data.append('contact_no', contact_no);
            data.append('username', username);
            data.append('password', password);

            fetch('add_employee.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                loadEmployees(); // Reload employee list after adding
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Load Employee List (this can be called on page load)
        function loadEmployees() {
            fetch('load_employees.php')
                .then(response => response.json())
                .then(data => {
                    const employeeList = document.getElementById('employeeList');
                    employeeList.innerHTML = '';

                    data.forEach(employee => {
                        const li = document.createElement('li');
                        li.innerHTML = `${employee.name} - ${employee.contact_no} <button onclick="deleteEmployee(${employee.id})">Delete</button>`;
                        employeeList.appendChild(li);
                    });
                })
                .catch(error => console.error('Error loading employees:', error));
        }

        // Search Employee
        function searchEmployee() {
            const searchQuery = document.getElementById('search').value;
            fetch('search_employee.php?query=' + searchQuery)
                .then(response => response.json())
                .then(data => {
                    const employeeList = document.getElementById('employeeList');
                    employeeList.innerHTML = '';

                    data.forEach(employee => {
                        const li = document.createElement('li');
                        li.innerHTML = `${employee.name} - ${employee.contact_no} <button onclick="deleteEmployee(${employee.id})">Delete</button>`;
                        employeeList.appendChild(li);
                    });
                })
                .catch(error => console.error('Error searching employee:', error));
        }

        // Delete Employee
        function deleteEmployee(employeeId) {
            if (confirm('Are you sure you want to delete this employee?')) {
                fetch('delete_employee.php?id=' + employeeId, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadEmployees(); // Reload employee list after deletion
                })
                .catch(error => console.error('Error deleting employee:', error));
            }
        }

        // Initial load of employees when the page loads
        loadEmployees();
    </script>
</body>
</html>
