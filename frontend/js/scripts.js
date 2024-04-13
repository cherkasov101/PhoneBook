document.addEventListener('DOMContentLoaded', function() {
    loadContacts();

    const addContactForm = document.getElementById('addContactForm');
    addContactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        addContact(name, phone);
    });
});

function loadContacts() {
    fetch('/get_contacts')
        .then(response => response.json())
        .then(data => {
            const contactTableBody = document.querySelector('#contactTable tbody');
            contactTableBody.innerHTML = ''; 

            data.forEach(contact => {
                const row = `
                    <tr>
                        <td>${contact.name}</td>
                        <td>${contact.phone}</td>
                        <td><button onclick="deleteContact(${contact.id})">Удалить</button></td>
                    </tr>
                `;
                contactTableBody.insertAdjacentHTML('beforeend', row);
                console.log(contact);
            });
        })
        .catch(error => console.error('Ошибка при загрузке контактов:', error));
}

function addContact(name, phone) {
    fetch('/add_contact', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, phone })
    })
    .then(response => {
        if (response.ok) {
            loadContacts(); 
        } else {
            console.error('Ошибка при добавлении контакта');
        }
    })
    .catch(error => console.error('Ошибка при добавлении контакта:', error));
}

function deleteContact(contactId) {
    fetch('/delete_contact', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: contactId })
    })
    .then(response => {
        if (response.ok) {
            loadContacts(); 
        } else {
            console.error('Ошибка при удалении контакта');
        }
    })
    .catch(error => console.error('Ошибка при удалении контакта:', error));
}
