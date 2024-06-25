import './bootstrap';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-bs5';
import $ from 'jquery';

$('#dataTable').DataTable({
    responsive: true,
    pageLength: 5
});

document.addEventListener('DOMContentLoaded', () => {
    let db;
    const request = indexedDB.open('indexed-db', 1);

    request.onerror = function(event) {
        console.error('Database error:', event.target.errorCode);
    };

    request.onsuccess = function(event) {
        db = event.target.result;
        displayData();
    };

    request.onupgradeneeded = function(event) {
        db = event.target.result;
        const objectStore = db.createObjectStore('user-store', { keyPath: 'id', autoIncrement: true });
        objectStore.createIndex('name', 'name', { unique: false });
        objectStore.createIndex('contact', 'contact', { unique: false });
        objectStore.createIndex('email', 'email', { unique: false });
    };

    document.getElementById('dataForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const recordId = document.getElementById('recordId').value;
        const data = {
            name: document.getElementById('name').value,
            contact: document.getElementById('contact').value,
            email: document.getElementById('email').value,
        };

        if (recordId === "") {
            addData(data);
        } else {
            updateData(Number(recordId), data);
        }
    });

    function addData(data) {
        const transaction = db.transaction(['user-store'], 'readwrite');
        const objectStore = transaction.objectStore('user-store');
        const request = objectStore.add(data);

        request.onsuccess = function() {
            clearForm();
            displayData();
        };

        request.onerror = function(event) {
            console.error('Database error:', event.target.errorCode);
        };
    }

    function updateData(id, data) {
        const transaction = db.transaction(['user-store'], 'readwrite');
        const objectStore = transaction.objectStore('user-store');
        data.id = id;
        const request = objectStore.put(data);

        request.onsuccess = function() {
            clearForm();
            displayData();
        };

        request.onerror = function(event) {
            console.error('Database error:', event.target.errorCode);
        };
    }

    function displayData() {
        const objectStore = db.transaction('user-store').objectStore('user-store');
        const tableBody = document.querySelector('#dataTable tbody');
        tableBody.innerHTML = '';
        let count = 1; // Initialize the counter

        objectStore.openCursor().onsuccess = function(event) {
            const cursor = event.target.result;
            if (cursor) {
                const row = document.createElement('tr');
                row.innerHTML = `
                            <th scope="row">${count}</th> <!-- Use the counter -->
                            <td>${cursor.value.name}</td>
                            <td>${cursor.value.contact}</td>
                            <td>${cursor.value.email}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm edit-btn" data-id="${cursor.key}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${cursor.key}">Delete</button>
                            </td>
                        `;
                tableBody.appendChild(row);
                count++; // Increment the counter
                cursor.continue();
            } else {
                initializeDataTable();
            }
        };
    }

    function initializeDataTable() {

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = Number(this.getAttribute('data-id'));
                deleteData(id);
            });
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = Number(this.getAttribute('data-id'));
                loadData(id);
            });
        });
    }

    function deleteData(id) {
        const transaction = db.transaction(['user-store'], 'readwrite');
        const objectStore = transaction.objectStore('user-store');
        const request = objectStore.delete(id);

        request.onsuccess = function() {
            displayData();
        };

        request.onerror = function(event) {
            console.error('Database error:', event.target.errorCode);
        };
    }

    function loadData(id) {
        const transaction = db.transaction(['user-store'], 'readonly');
        const objectStore = transaction.objectStore('user-store');
        const request = objectStore.get(id);

        request.onsuccess = function(event) {
            const data = event.target.result;
            document.getElementById('recordId').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('contact').value = data.contact;
            document.getElementById('email').value = data.email;
            document.getElementById('submitBtn').textContent = 'Update';
        };

        request.onerror = function(event) {
            console.error('Database error:', event.target.errorCode);
        };
    }

    function clearForm() {
        document.getElementById('recordId').value = '';
        document.getElementById('name').value = '';
        document.getElementById('contact').value = '';
        document.getElementById('email').value = '';
        document.getElementById('submitBtn').textContent = 'Submit';
    }
});
